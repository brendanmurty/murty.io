# murty.io

This repository contains the [Murty website](https://murty.io/) which is built with [Laravel](https://laravel.com/), hosted via [Laravel Vapor](https://vapor.laravel.com/) and uses some icons from the [Feather](http://feathericons.com/) icon pack.

[![Brendan](/public/images/brendan/brendan-murty.jpg)](https://murty.io/brendan) [![Ella](/public/images/ella/ella_condon.jpg)](https://ellacondon.com/) [![Isla](/public/images/isla/isla-murty.jpg)](https://murty.io/isla) [![Freya](/public/images/freya/freya-murty.jpg)](https://murty.io/freya)

## Structure

- **[app/Http/Controllers](app/Http/Controllers/)**: Page controllers
- **[config](config/)**: Site configuration files
- **[content](content/)**: Content files in Markdown format
- **[docs](docs/)**: Documentation files in Markdown format
- **[public](public/)**: Front-end assets that are served to visitors
- **[public/images](public/images/)**: Icons, images and photos used in the layout and content files
- **[resources/css](resources/css/)**: CSS style files
- **[resources/views](resources/views/)**: Page templates
- **[resources/views/layouts/app.blade.php](resources/views/layouts/app.blade.php)**: Base page layout template
- **[routes/web.php](routes/web.php)**: Web routes logic including domain level redirects
- **[deploy.sh](deploy.sh)**: A helper script to generate a new version and trigger a deployment
- **[package.json](package.json)**: Dependency configuration and shortcut commands
- **[setup.sh](setup.sh)**: A helper script to initialise a new local environment
- **[vapor.yml](vapor.yml)**: [Laravel Vapor](https://vapor.laravel.com/) environment configuration file

## License

Please refer to [LICENSE.md](LICENSE.md) for rights and limitations when using the code here in your own projects.

## Documentation

To view more documentation, refer to the files in the [docs](docs/) directory.
