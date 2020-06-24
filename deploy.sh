# Setup the message colour characters
blue='\033[0;34m'
red='\033[0;31m'
end='\033[0m'

# Exit if the version is not specified as a parameter
if [ $# -eq 0 ]; then
  echo -e "${red}Please specify a version in a format like: 2020.123${end}"
  exit 1
fi

# Ask for confirmation from the user before continuing
read -p "Are you sure you want to create a new version ($1) and deploy the changes to the webserver? (y/n) " ANSWER
if [ "$ANSWER" != "y" ]; then
  echo -e "${red}Cancelled.${end}"
  exit 1
fi

echo -e "${blue}Starting deployment...${end}"

echo -e "${blue}Generating gallery image thumbnail images...${end}"

php "scripts/gallery-thumbnails.php"

echo -e "${blue}Generating content search index...${end}"

php "scripts/content-search-index.php"

echo -e "${blue}Updating the changelog...${end}"

printf "# Change Log\n\n- Version $1\n" > CHANGELOG.md
git log --oneline --format="- %s" --date=iso --no-merges >> CHANGELOG.md

echo -e "${blue}Committing the changes...${end}"

git add "CHANGELOG.md"
git add "public/images/gallery/thumbs/"
git add "content/index.json"
git commit -m "Version $1" --quiet
git tag $1

echo -e "${blue}Pushing the changes up...${end}"

git push --quiet
git push --tags --quiet

echo -e "${blue}Checking deployment configuration...${end}"

DEPLOY_SSH_USERNAME=$(grep DEPLOY_SSH_USERNAME .env | cut -d '=' -f 2-)
DEPLOY_SSH_HOST=$(grep DEPLOY_SSH_HOST .env | cut -d '=' -f 2-)
DEPLOY_REMOTE_DIRECTORY=$(grep DEPLOY_REMOTE_DIRECTORY .env | cut -d '=' -f 2-)

if [ -z "$DEPLOY_SSH_USERNAME" ] || [ -z "$DEPLOY_SSH_HOST" ] || [ -z "$DEPLOY_REMOTE_DIRECTORY" ]; then
  echo "Deployment to web server cancelled."
  echo "This script requires appropriate values for all of the 'DEPLOY_' variables in the '.env' file."   
  exit 1
fi

echo -e "${blue}Connecting to the web server...${end}"

ssh $DEPLOY_SSH_USERNAME@$DEPLOY_SSH_HOST << EOF
cd $DEPLOY_REMOTE_DIRECTORY
git pull origin master --quiet
composer install --quiet --no-interaction
npm install --silent --no-progress --no-fund
npm install --silent --no-progress --global gulp-cli
gulp --silent
php artisan view:clear
php artisan cache:clear
EOF

echo -e "${blue}Deployment completed.${end}"
