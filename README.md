# murty.io

This repository contains the [Murty website](https://murty.io/) which is built with [Laravel](https://laravel.com/) and uses some icons from the [Feather](http://feathericons.com/) icon pack.

[![Brendan](/public/images/brendan/brendan-murty.jpg)](https://murty.io/brendan) [![Ella](/public/images/ella/ella_condon.jpg)](https://ellacondon.com/) [![Isla](/public/images/isla/isla-murty.jpg)](https://murty.io/isla) [![Freya](/public/images/freya/freya-murty.jpg)](https://murty.io/freya)

## Documentation

For detailed documentation on how to setup and manage this website, please visit [docs.murty.io/public/murty-website](https://docs.murty.io/public/murty-website).

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
- **[package.json](package.json)**: Dependency configuration and shortcut commands
- **[scripts](scripts/)**: Helper scripts
- **[scripts/deploy.sh](scripts/deploy.sh)**: Generates a new version and triggers the deployment process
- **[scripts/setup.sh](scripts/setup.sh)**: Initialises a new local environment
- **[scripts/update.sh](scripts/update.sh)**: Update dependencies, commit these changes and push them up to the remote repository

## License

Please refer to [LICENSE.md](LICENSE.md) for rights and limitations when using the code here in your own projects.
