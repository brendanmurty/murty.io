<?php

// Return the contents of a Markdown file

$empty_content = '# Page not found!';

if (substr($_GET['location'], -3) == '.md') {
    // Suitable file location

    $file_path = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'content' . DIRECTORY_SEPARATOR . $_GET['location'];

    if (file_exists($file_path)) {
        // Valid content file
        echo file_get_contents($file_path);
    } else {
        // File not found
        echo $empty_content;
    }
} else {
    // Invalid file location
    echo $empty_content;
}
