<?php

// Return the contents of a Markdown file

if (
    $_SERVER['HTTP_HOST'] == 'murty.dev' ||
    $_SERVER['HTTP_HOST'] == 'murty.io' ||
    $_SERVER['HTTP_HOST'] == 'b.murty.io' ||
    $_SERVER['HTTP_HOST'] == 'i.murty.io'
) {
    $empty_content = '# Page not found!';

    if (substr($_GET['path'], -3) == '.md') {
        // Suitable file path

        $file_path = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'content' . DIRECTORY_SEPARATOR . $_GET['path'];

        if (file_exists($file_path)) {
            // Valid content file
            echo file_get_contents($file_path);
        } else {
            // File not found
            echo $empty_content;
        }
    } else {
        // Invalid file path
        echo $empty_content;
    }
} else {
    header('HTTP/1.0 404 Not Found');
}
