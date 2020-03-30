# Deployment

## Configuration

### Add a new domain

1. Export a `DNS Zone File` from the current registrar
2. Add a new domain via the [Vapor web interface](https://vapor.laravel.com/app/)
3. Allow it to import existing records
4. Migrate the domain to Laravel Vapor using the Nameservers details on the domain page in the [Vapor web interface](https://vapor.laravel.com/app/)
5. In `AWS Console > Route 53`, import the zone for this domain using the export file
6. In `AWS Console > Route 53`, ensure domain records with longer values (such as `DKIM` records) use the [`""` workaround](https://aws.amazon.com/premiumsupport/knowledge-center/txtrdatatoolong-error/)
7. Setup certificates for the new domain via the CLI: `vapor cert xxx.abc` - one for `us-east-1` and then optionally one for the region the project has been configured for
8. View the domain in the [Vapor web interface](https://vapor.laravel.com/app/) and check the `DNS Records` and `Certificates` lists show the appropriate records and `ISSUED` certificates
9. Add the domain to the `domain` list for the relevant environment in [vapor.yml](../vapor.yml)
10. Run a deployment for this environment
11. Test

## Deploy to staging

After testing locally, commit and push your changes up to the remote repository.

Then run:

```
vapor deploy staging
```

## Deploy to production

After testing locally, commit and push your changes up to the remote repository.

Then run [deploy.sh](deploy.sh) to make a new version and deploy it to production:

```
bash deploy.sh "YYYY.xxx"
```

Where `YYYY` is the current year, and `xxx` is the revision number for that year.

This script will:

- Update the content in [CHANGELOG.md](CHANGELOG.md)
- Create a new Git Tag
- Push changes up to the origin repository
- Start a Vapor deployment to the `production` environment defined in [vapor.yml](../vapor.yml)
