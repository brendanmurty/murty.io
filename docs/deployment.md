# Deployment

## Setup

Navigate to your repository on GitHub, then go to `Settings > Secrets`.

Add new secrets here:

- Name: `SSH_HOST`, Value: IP address of your web server, Example: `123.1.2.3`
- Name: `SSH_USERNAME`, Value: The username you use to login to the server, Example: `jane_doe`
- Name: `SSH_PASSWORD`, Value: The password you use to login to the server, Example: `s$crt534^fff`
- Name: `REMOTE_DIRECTORY`, Value: The directory where the website is located on the server, Example: `/var/www/html`

## Process

After testing locally, commit and push your changes up to the remote repository.

Then run [deploy.sh](../deploy.sh) to make a new version and deploy it:

```
bash deploy.sh "YYYY.xxx"
```

Where `YYYY` is the current year, and `xxx` is the revision number for that year.

This script will:

- Update the content in [CHANGELOG.md](../CHANGELOG.md)
- Create a new Git Tag (`YYYY.xxx` as detailed above)
- Push changes up to the origin repository
- This will then trigger a deployment using GitHub Actions via [../.github/workflows/deployment.yml](../.github/workflows/deployment.yml)
