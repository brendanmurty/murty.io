# murty.io

This repository contains the website for the [Murty family](https://murty.io/). It's built on the [Laravel](https://laravel.com/) framework, contains [PHPUnit](https://phpunit.de/) tests and uses [Font Awesome 5 Pro](https://fontawesome.com/pro) SVG icons.

## Structure

- **[.github/workflows/deployment.yml](.github/workflows/deployment.yml)**: GitHub Action that deploys to the webserver when a new Git Tag is pushed up
- **[app/Http/Controllers](app/Http/Controllers/)**: Page controllers
- **[app/Content.php](app/Content.php)**: Common content and gallery related functions
- **[config](config/)**: Site configuration files
- **[content](content/)**: Content files in Markdown format
- **[public](public/)**: Front-end assets that are served to visitors
- **[public/images](public/images/)**: Icons, images and photos used in the layout and content files
- **[public/images/gallery](public/images/gallery/)**: Photos that populate the [Gallery website](https://murty.io/gallery)
- **[resources/css](resources/css/)**: CSS style files
- **[resources/views](resources/views/)**: Page templates
- **[resources/views/layouts/app.blade.php](resources/views/layouts/app.blade.php)**: Base page layout template
- **[routes/web.php](routes/web.php)**: Web routes logic including domain level redirects
- **[.env.example](.env.example)**: An environment configuration file which is used to generate the private `.env` file
- **[gulpfile.js](gulpfile.js)**: Configures Gulp to optimise front-end assets
- **[LICENSE.md](LICENSE.md)**: Review how you can use the code here in your own projects
- **[package.json](package.json)**: Dependency configuration and shortcut commands
- **[SECURITY.md](SECURITY.md)**: Details about what to do if you find any security issues in this code
- **[scripts/deploy.sh](scripts/deploy.sh)**: Generates a new version and triggers the deployment process
- **[scripts/setup.sh](scripts/setup.sh)**: Initialises a new local environment
- **[scripts/update.sh](scripts/update.sh)**: Update dependencies, commit these changes and push them up to the remote repository
- **[tests](tests)**: PHPUnit test scripts to check my custom back-end classes

## Requirements

- [Node 10.7.x](https://nodejs.org/en/download/package-manager/)
- [PHP 7.4](https://www.php.net/manual/en/install.php)
- [PHP Exif library](https://www.php.net/manual/en/exif.installation.php)
- [Composer 1.8](https://getcomposer.org/download/)

## Initial Setup

To setup a new local development environment, make a local clone of this repository and then run [scripts/setup.sh](https://github.com/brendanmurty/murty.io/blob/main/scripts/setup.sh) to complete the initial installation process:

```
bash scripts/setup.sh
```

Then edit the environment configuration variables to suit your requirements:

```
vim .env
```

## Commands

### Local web server

```
php artisan serve
```

### Build front-end assets

```
gulp
```

### Run unit tests

```
php artisan test
```

### Update dependencies

A helper script ([scripts/update.sh](https://github.com/brendanmurty/murty.io/blob/main/scripts/update.sh)) simplifies the process of updating dependencies and pushing any changes up to the remote repository. This can be run with the following command:

```
bash scripts/update.sh
```

## Managing Content

### Making a new published post

Make a new file using the date prefix of `YYYYMMDD`, such as:

```
/content/brendan/posts/20101230_example-published-post-title.md
```

### Making a new draft post

Make a new file using the date prefix of `999DRAFT`, such as:

```
/content/brendan/posts/999DRAFT_example-draft-post-title.md
```

Draft posts won't be included in the posts feed and will only be visible on local environments (`APP_ENV=local` in the `.env` file).

## Deployment

How to make a new version and deploy it to the web server.

### Setup

Navigate to your cloned repository on GitHub, then go to `Settings > Secrets`.

Add new secrets here:

- Name: `SSH_HOST`, Value: IP address of your web server, Example: `123.1.2.3`
- Name: `SSH_USERNAME`, Value: The username you use to login to the server, Example: `jane_doe`
- Name: `SSH_PASSWORD`, Value: The password you use to login to the server, Example: `s$crt534^fff`
- Name: `REMOTE_DIRECTORY`, Value: The directory where the website is located on the server, Example: `/var/www/html`

### Process

After testing locally, commit and push your changes up to the remote repository.

Then run [scripts/deploy.sh](https://github.com/brendanmurty/murty.io/blob/main/scripts/deploy.sh) to make a new version and deploy it:

```
bash scripts/deploy.sh "YYYY.xxx"
```

Where `YYYY` is the current year, and `xxx` is the revision number for that year.

This script will:

- Update the content in [CHANGELOG.md](https://github.com/brendanmurty/murty.io/blob/main/CHANGELOG.md)
- Create a new Git Tag (`YYYY.xxx` as detailed above)
- Push changes up to the origin repository
- This will then trigger an automated deployment process with GitHub Actions via [.github/workflows/deployment.yml](https://github.com/brendanmurty/murty.io/blob/main/.github/workflows/deployment.yml)
