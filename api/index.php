<?php

// API router

if (
    $_SERVER['HTTP_HOST'] == 'murty.dev' ||
    $_SERVER['HTTP_HOST'] == 'murty.io' ||
    $_SERVER['HTTP_HOST'] == 'b.murty.io' ||
    $_SERVER['HTTP_HOST'] == 'i.murty.io'
) {
    // Valid base URL

    $request_path = str_replace(array('?' . $_SERVER['QUERY_STRING'], '/api/'), '', $_SERVER['REQUEST_URI']);

    if (file_exists($request_path)) {
        // Valid API file URL
        include_once($request_path);
    } elseif (file_exists($request_path . 'php')) {
        // Valid API file URL
        include_once($request_path);
    } else {
        // Invalid API file URL
        header('HTTP/1.0 404 Not Found');
    }
} else {
    // Invalid base URL
    header('HTTP/1.0 404 Not Found');
}
