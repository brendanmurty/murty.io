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

printf "# Change Log\n\n- Version $1" > CHANGELOG.md
git log --oneline --format="- %s" --date=iso >> CHANGELOG.md

echo "Committing the changes..."

git add CHANGELOG.md
git commit -m "Version $1" --quiet
git tag $1

echo "Pushing the changes up..."

git push --quiet
git push --tags --quiet

echo "Deployment process will now continue here: https://github.com/brendanmurty/murty.io/actions"
