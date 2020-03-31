# Deployment

After testing locally, commit and push your changes up to the remote repository.

Then run [deploy.sh](../deploy.sh) to make a new version and deploy it:

```
bash deploy.sh "YYYY.xxx"
```

Where `YYYY` is the current year, and `xxx` is the revision number for that year.

This script will:

- Update the content in [CHANGELOG.md](../CHANGELOG.md)
- Create a new Git Tag
- Push changes up to the origin repository
- This will then trigger a deployment using GitHub Actions in [.github/workflows/deployment.yml](../.github/workflows/deployment.yml)
