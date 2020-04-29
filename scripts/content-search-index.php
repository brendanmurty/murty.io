<?php

/*

scripts/content-search-index.php
 - Generates a JSON file containing the content of each Markdown content file for use by the search feature.

Based on code from:
 - https://stackoverflow.com/questions/4987551/parse-directory-structure-strings-to-json-using-php

*/

$content_dir = join(DIRECTORY_SEPARATOR, array(dirname(dirname(__FILE__)), 'content', ''));
$content_index_file = $content_dir . 'index.json';

file_put_contents(
    $content_index_file,
    json_encode(read_directory($content_dir), JSON_PRETTY_PRINT)
);

echo 'Updated content index file.' . PHP_EOL;

function read_directory($dir, $list_dir=array()) {
    $list_dir = array();

    if ($handler = opendir($dir)) {
        // Loop through each file and sub-directory in the selected directory
        while (($sub = readdir($handler)) !== FALSE) {
            if ($sub != "." && $sub != "..") {
                if (is_file($dir . DIRECTORY_SEPARATOR . $sub) && substr($sub, -3) == '.md') {
                    // This is a Markdown file, add it to the output array
                    $list_dir[substr($sub, 0, -3)] = file_get_contents($dir . DIRECTORY_SEPARATOR . $sub);
                } elseif (is_dir($dir . DIRECTORY_SEPARATOR . $sub)) {
                    // This is a sub-directory, create an array containing it's contents
                    $list_dir[$sub] = read_directory($dir . DIRECTORY_SEPARATOR . $sub); 
                }
            }
        }

        closedir($handler); 
    }

    return $list_dir;    
}
