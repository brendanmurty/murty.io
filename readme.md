[murty.io](https://murty.io)
=======

[![Brendan](/public/images/brendan/brendan_murty.jpg)](https://murty.io/brendan) [![Ella](/public/images/ella/ella_condon.jpg)](https://ellacondon.com/) [![Isla](/public/images/isla/isla_murty.jpg)](https://murty.io/isla) [![Freya](/public/images/freya/freya_murty.jpg)](https://murty.io/freya)

## About

Here's the [Murty website](https://murty.io) built with [Laravel 5.7](https://laravel.com/) and [Feather](http://feathericons.com) icons.

## Why

I was inspired by [Brad Frost](https://github.com/bradfrost)'s [TED talk](https://twitter.com/brad_frost/status/476515058738925568) about being open by default. If you haven't seen this talk yet, I'd recommend investing half an hour to [watch the video](https://www.youtube.com/watch?v=7rW9vTrN6OU) and read the [blog post](http://bradfrostweb.com/blog/post/creative-exhaust/).

As I'm self-taught, engaging with the [community](https://twitter.com/brendanmurty/lists/development/members), [listening to inspirational people](http://boagworld.com/show) and [reading about new techniques](https://signalvnoise.com/programming) helped me turn my passion in to my career.

I hope a budding web developer can learn something new from what I've done here and start their own career. Hopefully I can give back to the community that has taught me so much over the last few years.

## Contribute

If you have an idea for a website update or have found a bug, please [add to the Trello board](https://trello.com/b/ag7rb8Hk/murtyio).

## License

You can view the [License](license.md) file for rights and limitations when using the code here in your own projects.

The license is based on the [CSS-Tricks License](https://css-tricks.com/license/) which was created by [Chris Coyier](https://github.com/chriscoyier/).

## Structure

- **[app](app/)**: Back-end PHP classes
- **[config](config/)**: Site configuration
- **[config/sites.json](config/sites.json)**: Plain-text file that allows for quick customisation of common front-end properties for each website
- **[content](content/)**: Markdown files that contain the content of each page and post
- **[package.json](package.json)**: Contains website developer information and shortcut commands
- **[public](public/)**: Compiled files which are served to public site visitors
- **[public/images](public/images/)**: Icons, images and photos used in the layout and referenced in Markdown files
- **[resources](resources)**: Uncompiled front-end code
- **[resources/sass](resources/sass)**: SASS style files

## Development

### Initial Setup

These commands need to be in order once on each environment from the machine's copy of this repository.

```
cp .env.example .env
vim .env

sudo apt -y install php7.2 php7.2-mbstring php7.2-xml php7.2-zip

sudo apt install npm
npm install --global cross-env

php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('SHA384', 'composer-setup.php') === '544e09ee996cdf60ece3804abc52599c22b1f40f4323403c44d44fdfdd586475ca9813a858088ffbc1f233e9b180f061') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
sudo mv composer.phar /usr/bin/composer

composer install

npm install

php artisan key:generate

sudo service apache2 restart

chown -R www-data:www-data storage
chmod -R 755 storage
```

### Local Server

```
npm run watch
php artisan serve
```

### Production Server

First copy the ENV file and update the values to match your production details:

```
cp .env.example .env
vim .env
```

Then configure your web server to send relevant domain requests to the `public` folder.

Now you can compile the front-end assets for production use:

```
npm run production
```

### SSL Configuration

To setup SSL using [Let's Encrypt](https://letsencrypt.org/):

```
sudo apt-get install letsencrypt
letsencrypt certonly --webroot -w ./ -d your-domain.com
```

Then copy the resulting `fullchain.pem` and `privkey.pem` files in to the `app/ssl` folder.

To renew the SSL certificate, run:

```
letsencrypt certonly
```

Then select the *renew* option in the prompt and copy the resulting `fullchain.pem` and `privkey.pem` files in to the `ssl` folder.
