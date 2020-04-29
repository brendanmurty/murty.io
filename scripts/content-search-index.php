<?php

/*

scripts/content-search-index.php
 - Generates a JSON file containing the content of each Markdown content file for use by the search feature.

*/

$content_dir = join(DIRECTORY_SEPARATOR, array(dirname(dirname(__FILE__)), 'content', ''));
