<?php

// Return a JSON string containing a list of all Brendan's posts

$posts = array();

// Construct the path to Brendan's post folder
$directory = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'content' . DIRECTORY_SEPARATOR . 'brendan' . DIRECTORY_SEPARATOR . 'posts' . DIRECTORY_SEPARATOR;

// The file to cache the JSON to
$posts_json = $directory . 'posts.json';

if (
    !file_exists($posts_json) ||
    filemtime ($posts_json) < strtotime('-30 days')
) {
    // The cached JSON file doesn't exist or is out of date

    // Find all Markdown files in the directory
    foreach (glob($directory . '*.md') as $file_path) {
        $file_name = str_replace(
            array($directory, '.md'),
            '',
            $file_path
        );

        $date = substr($file_name, 0, 8);

        $title = str_replace(
            array('Upcomingtasks', 'Api', 'Php'),
            array('UpcomingTasks', 'API', 'PHP'),
            ucwords(
                str_replace(
                    array($date . '_', '-'),
                    array('', ' '),
                    $file_name
                )
            )
        );

        $posts[] = array(
            'title' => $title,
            'date' => $date,
            'link'  => '/brendan/post/' . $file_name
        );
    }

    // Sort by reverse chronological order
    usort($posts, function ($a, $b) {
        if ($a['date'] == $b['date']) {
            return 0;
        } else {
            return $a['date'] > $b['date'] ? -1 : 1;
        }
    });

    // Convert the posts array to JSON
    $posts = json_encode($posts, JSON_PRETTY_PRINT);

    // Cache this content to a JSON file
    try {
        file_put_contents($posts_json, $posts);
    } catch (Exception $e) {
        // Couldn't save the file
    }
} else {
    // Extract the cached content
    $posts = file_get_contents($posts_json);
}

// Output in JSON format
echo $posts;
