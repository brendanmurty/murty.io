<?php

// Laravel HTMLMin Configuration - https://github.com/HTMLMin/Laravel-HTMLMin
return [
    'blade' => true,
    'force' => true,
    'ignore' => [
        'resources/views/emails',
        'resources/views/html',
        'resources/views/notifications',
        'resources/views/markdown',
        'resources/views/vendor/emails',
        'resources/views/vendor/html',
        'resources/views/vendor/notifications',
        'resources/views/vendor/markdown',
    ],
];
