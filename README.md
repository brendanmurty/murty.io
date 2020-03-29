# murty.io

This repository contains the [Murty website](https://murty.io/) which is built with [Laravel](https://laravel.com/), hosted via [Laravel Vapor](https://vapor.laravel.com/) and uses some icons from the [Feather](http://feathericons.com/) icon pack.

[![Brendan](/public/images/brendan/brendan-murty.jpg)](https://murty.io/brendan) [![Ella](/public/images/ella/ella_condon.jpg)](https://ellacondon.com/) [![Isla](/public/images/isla/isla-murty.jpg)](https://murty.io/isla) [![Freya](/public/images/freya/freya-murty.jpg)](https://murty.io/freya)

## Structure

- **[app](app/)**: Back-end PHP classes
- **[config](config/)**: Site configuration files
- **[content](content/)**: Files that contain the content of each page and post on the site
- **[docs](docs/)**: Site documentation files
- **[public](public/)**: Compiled files which are served to public site visitors
- **[public/images](public/images/)**: Icons, images and photos used in the layout and referenced in Markdown files
- **[resources](resources/)**: Uncompiled front-end code
- **[resources/css](resources/css/)**: CSS style files
- **[deploy.sh](deploy.sh)**: A helper script to generate a new version and trigger a deployment
- **[package.json](package.json)**: Contains website developer information and shortcut commands
- **[setup.sh](setup.sh)**: Initial web server setup script
- **[vapor.yml](vapor.yml)**: [Laravel Vapor](https://vapor.laravel.com/) environment configuration file

## License

Please refer to [LICENSE.md](LICENSE.md) for rights and limitations when using the code here in your own projects.

## Documentation

To view more documentation, refer to the files in the [docs](docs/) directory.
