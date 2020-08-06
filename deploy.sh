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

echo "${blue}The deployment process will now continue here:${end} https://github.com/brendanmurty/murty.io/actions"
