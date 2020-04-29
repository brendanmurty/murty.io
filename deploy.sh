# Exit if the version is not specified as a parameter
if [ $# -eq 0 ]; then
  echo "Please specify a version in a format like: 2020.123"
  exit 1
fi

# Ask for confirmation from the user before continuing
read -p "Are you sure you want to create a new version ($1) and deploy the changes to the webserver? (y/n) " ANSWER
if [ "$ANSWER" != "y" ]; then
  echo "Cancelled."
  exit 1
fi

echo "Starting deployment..."

echo "Generating gallery image thumbnail images..."

php "scripts/gallery-thumbnails.php"

echo "Generating content search index..."

php "scripts/content-search-index.php"

echo "Updating changelog..."

printf "# Change Log\n\n- Version $1\n" > CHANGELOG.md
git log --oneline --format="- %s" --date=iso --no-merges >> CHANGELOG.md

echo "Committing the changes..."

git add "CHANGELOG.md"
git add "public/images/gallery/thumbs/"
git commit -m "Version $1" --quiet
git tag $1

echo "Pushing the changes up..."

git push --quiet
git push --tags --quiet

echo "Checking deployment configuration..."

DEPLOY_SSH_USERNAME=$(grep DEPLOY_SSH_USERNAME .env | cut -d '=' -f 2-)
DEPLOY_SSH_HOST=$(grep DEPLOY_SSH_HOST .env | cut -d '=' -f 2-)
DEPLOY_REMOTE_DIRECTORY=$(grep DEPLOY_REMOTE_DIRECTORY .env | cut -d '=' -f 2-)

if [ -z "$DEPLOY_SSH_USERNAME" ] || [ -z "$DEPLOY_SSH_HOST" ] || [ -z "$DEPLOY_REMOTE_DIRECTORY" ]; then
  echo "Deployment to web server cancelled."
  echo "This script requires appropriate values for all of the 'DEPLOY_' variables in the '.env' file."   
  exit 1
fi

echo "Connecting to the web server..."

ssh $DEPLOY_SSH_USERNAME@$DEPLOY_SSH_HOST << EOF
cd $DEPLOY_REMOTE_DIRECTORY
git pull origin master --quiet
composer install --no-interaction
npm install --silent
php artisan view:clear
npm run production
EOF

echo "Deployment completed."
