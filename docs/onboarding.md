# Onboarding

## Requirements

- [Node 10.7.x](https://nodejs.org/en/download/package-manager/)
- [PHP 7.3](https://www.php.net/manual/en/install.php)
- [PHP Exif library](https://www.php.net/manual/en/exif.installation.php)
- [Composer 1.8](https://getcomposer.org/download/)

## Initial Setup

Make a local clone of this repository and then run [setup.sh](../setup.sh) to complete the initial installation process:

```
bash setup.sh
```

Then edit the environment configuration variables to suit your requirements:

```
vim .env
```

## Local Server

To build front-end assets:

```
gulp
```

To run a local server:

```
php artisan serve
```