# Exit if the version is not specified as a parameter
if [ $# -eq 0 ]; then
  echo "Please specify a version in a format like: 2020.123"
  exit 1
fi

# Ask for confirmation from the user before continuing
read -p "Are you sure you want to create a new version ($1) and deploy this to the production environment? (y/n) " ANSWER
if [ "$ANSWER" != "y" ]; then
  echo "Cancelled."
  exit 1
fi

echo "Starting deployment..."

echo "Updating changelog..."

printf "# Change Log\n\n" > CHANGELOG.md
git log --oneline --format="- %h (%ad) %s" --date=iso >> CHANGELOG.md

echo "Committing the changes..."

git commit -am "Version $1" --quiet
git tag $1

echo "Pushing the changes up..."

git push --quiet
git push --tags --quiet

echo "Deploying to production..."

vapor deploy production --quiet --no-interaction
vapor deploy production-redirects --quiet --no-interaction

echo "Deployment completed."
