[murty.io](https://murty.io)
=======

[![Brendan](/public/images/brendan/brendan-murty.jpg)](https://murty.io/brendan) [![Ella](/public/images/ella/ella_condon.jpg)](https://ellacondon.com/) [![Isla](/public/images/isla/isla-murty.jpg)](https://murty.io/isla) [![Freya](/public/images/freya/freya-murty.jpg)](https://murty.io/freya)

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
- **[public](public/)**: Compiled files which are served to public site visitors
- **[public/images](public/images/)**: Icons, images and photos used in the layout and referenced in Markdown files
- **[resources](resources)**: Uncompiled front-end code
- **[resources/css](resources/css)**: CSS style files
- **[storage/app/content](storage/app/content/)**: Markdown files that contain the content of each page and post
- **[package.json](package.json)**: Contains website developer information and shortcut commands
- **[setup.sh](setup.sh)**: Initial web server setup script
- **[version.sh](version.sh)**: A helper script to generate a new version

## Requirements

- [Node 10.7.x](https://nodejs.org/en/download/package-manager/)
- [PHP 7.3](https://www.php.net/manual/en/install.php)
- [Composer 1.8](https://getcomposer.org/download/)

## Content

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

## Development

### Initial Setup

Make a local clone of this repository and then run [setup.sh](setup.sh) to complete the initial installation process:

```
bash setup.sh
```

Then edit the environment configuration variables to suit your requirements:

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

Configure your web server to send requests to the relevant domain directly to the [public](public/) sub-directory.

To prepare the site for production use:

```
php artisan view:clear
npm run production
```

### Publishing

Run [deploy.sh](deploy.sh) to make a new version and deploy it:

```
bash deploy.sh "YYYY.xxx"
```

Where `YYYY` is the current year, and `xxx` is the revision number for that year.

This script will update [CHANGELOG.md](CHANGELOG.md), create a new Git Tag and push changes up to the origin repository.

**Note that the [deployment workflow](.github/workflows/deployment.yml) will automatically trigger when new Git Tags are pushed to the origin repository.**
