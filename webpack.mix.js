const mix = require('laravel-mix');

mix.disableNotifications();

mix.styles(
    [
        'resources/css/_variables.css',
        'resources/css/common.css',
        'resources/css/murty.css',
        'resources/css/brendan.css',
        'resources/css/freya.css',
        'resources/css/isla.css'
    ],
    'public/css/app.css'
).version();
