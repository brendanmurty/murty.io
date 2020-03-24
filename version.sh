# Exit if the version is not specified as a parameter
if [ $# -eq 0 ]; then
  echo "Please specify a version in a format like: 2020.123"
  exit 1
fi

# Create or update the changelog content
printf "# Change Log\n\n" > CHANGELOG.md
git log --oneline --format="- %h (%ad) %s" --date=iso >> CHANGELOG.md

# Commit this change and save the revision as a tag
git commit -am "Version $1"
git tag $1

# Push the commit and tag up to the remote repository
git push --follow-tags
