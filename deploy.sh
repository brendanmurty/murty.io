# Exit if the version is not specified as a parameter
if [ $# -eq 0 ]; then
  echo "Please specify a version in a format like: 2020.123"
  exit 1
fi

# Ask for confirmation from the user before continuing
read -p "Are you sure you want to create a new version ($1) and trigger a deployment? (y/n) " ANSWER
if [ "$ANSWER" != "y" ]; then
  echo "Cancelled."
  exit 1
fi

echo "Starting deployment..."

echo "Updating changelog..."

printf "# Change Log\n\n- Version $1\n" > CHANGELOG.md
git log --oneline --format="- %s" --date=iso --no-merges >> CHANGELOG.md

echo "Committing the changes..."

git add CHANGELOG.md
git commit -m "Version $1" --quiet
git tag $1

echo "Pushing the changes up..."

git push --quiet
git push --tags --quiet

echo "Attempting to deploy to the web server..."

DEPLOY_SSH_USERNAME=$(grep DEPLOY_SSH_USERNAME .env | cut -d '=' -f 2-)
DEPLOY_SSH_HOST=$(grep DEPLOY_SSH_HOST .env | cut -d '=' -f 2-)
DEPLOY_REMOTE_DIRECTORY=$(grep DEPLOY_REMOTE_DIRECTORY .env | cut -d '=' -f 2-)

if [ -z "$DEPLOY_SSH_USERNAME" ] || [ -z "$DEPLOY_SSH_HOST" ] || [ -z "$DEPLOY_REMOTE_DIRECTORY" ]; then
  echo 'Deployment cancelled. Please set values for the "DEPLOY_" variables in ".env" first.'   
  exit 1
fi

ssh $DEPLOY_SSH_USERNAME@$DEPLOY_SSH_HOST
cd $DEPLOY_REMOTE_DIRECTORY
git pull origin master --quiet
composer install --no-interaction
npm install --silent
php artisan view:clear
npm run production

echo "Deployment completed."
