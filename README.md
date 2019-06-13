[murty.io](https://murty.io)
=======

[![Brendan](/public/images/brendan/brendan_murty.jpg)](https://murty.io/brendan) [![Ella](/public/images/ella/ella_condon.jpg)](https://ellacondon.com/) [![Isla](/public/images/isla/isla_murty.jpg)](https://murty.io/isla) [![Freya](/public/images/freya/freya_murty.jpg)](https://murty.io/freya)

## About

Here's the [Murty website](https://murty.io) built with [Laravel](https://laravel.com/) and [Feather](http://feathericons.com) icons.

## Why

I was inspired by [Brad Frost](https://github.com/bradfrost)'s [TED talk](https://twitter.com/brad_frost/status/476515058738925568) about being open by default. If you haven't seen this talk yet, I'd recommend investing half an hour to [watch the video](https://www.youtube.com/watch?v=7rW9vTrN6OU) and read the [blog post](http://bradfrostweb.com/blog/post/creative-exhaust/).

As I'm self-taught, engaging with the [community](https://twitter.com/brendanmurty/lists/development/members), [listening to inspirational people](http://boagworld.com/show) and [reading about new techniques](https://signalvnoise.com/programming) helped me turn my passion in to my career.

I hope someone can learn something new from what I've done here and start their own career. Hopefully I can give back to the community that has taught me so much over the years.

## License

You can view the [License](LICENSE.md) file for rights and limitations when using the code here in your own projects.

The license is based on the [CSS-Tricks License](https://css-tricks.com/license/) which was created by [Chris Coyier](https://github.com/chriscoyier/).

## Structure

- **[app](app/)**: Back-end PHP classes
- **[config](config/)**: Site configuration files
- **[content](content/)**: Markdown files that contain the content of each page and post
- **[public](public/)**: Compiled files which are served to public site visitors
- **[public/images](public/images/)**: Icons, images and photos used in the layout and referenced in Markdown files
- **[resources](resources)**: Uncompiled front-end code
- **[resources/sass](resources/sass)**: SASS style files
- **[package.json](package.json)**: Contains website developer information and shortcut commands
- **[setup.sh](setup.sh)**: Initial web server setup script

## Development

### Requirements

- [Node 10.7.x](https://nodejs.org/en/download/package-manager/)
- [PHP 7.3](https://www.php.net/manual/en/install.php)

### Initial Setup

On a Ubuntu 18.x machine, you can run [setup.sh](setup.sh) from a local clone of this repository:

```
sh setup.sh
```

Then set the variable values in the ENV file:

```
vim .env
```

### Local Server

To watch front-end assets for changes:

```
npm run watch
```

To run a local server:

```
php artisan serve
```

### Production Server

Configure your web server to send requests to the relevant domain directly to the `public` sub-directory.

To minify the front-end assets for production use:

```
npm run production
```
