<?php

/*

scripts/gallery-thumbnails.php
 - Generates smaller versions of Gallery images that are used by the Gallery list page to improve performance.

Requirements:
 - The "gd2" extension for PHP
 - The "exif" extension for PHP

Based on code from:
 - https://davidwalsh.name/create-image-thumbnail-php
 - https://stackoverflow.com/questions/12774411/php-resizing-image-on-upload-rotates-the-image-when-i-dont-want-it-to

*/

$originals_dir = join(DIRECTORY_SEPARATOR, array(dirname(dirname(__FILE__)), 'public', 'images', 'gallery', ''));
$thumbs_dir = join(DIRECTORY_SEPARATOR, array($originals_dir, 'thumbs', ''));
$thumbs_desired_width = '700';

// Find all JPG images in the original images directory
$original_images = glob($originals_dir . '*.jpg');
$t = count($original_images);
$i = 0;
foreach ($original_images as $original_image) {
    // Construct the path to the thumbnail version of this image
    $thumb_image = str_replace($originals_dir, $thumbs_dir, $original_image);

    if (!file_exists($thumb_image)) {
        // This thumbnail image doesn't exist yet, create it
        make_thumb($original_image, $thumb_image, $thumbs_desired_width);
        $i++;
    }
}

echo 'Generated ' . $i . ' new thumbnail images from ' . $t . ' original images.' . PHP_EOL;

if ($i > 0) {
    echo 'You will need to clear the cache to see the new images: php artisan cache:clear' . PHP_EOL;
}

function make_thumb($src, $dest, $desired_width) {
	$source_image = imagecreatefromjpeg($src);

    // Check the image metadata for it's orientation and retain that
    $exif = exif_read_data($src);
    if ($exif && isset($exif['Orientation'])) {
        $orientation = $exif['Orientation'];
        if ($orientation != 1) {
            $source_image = imagecreatefromjpeg($src);
            $deg = 0;

            switch ($orientation) {
                case 3:
                    $deg = 180;
                    break;
                case 6:
                    $deg = 270;
                    break;
                case 8:
                    $deg = 90;
                    break;
            }

            if ($deg) {
                $source_image = imagerotate($source_image, $deg, 0);
            }
        }
    }

    // Get the correct dimensions of this image
	$width = imagesx($source_image);
	$height = imagesy($source_image);

    // Find the "desired height" of this thumbnail, relative to the desired width
	$desired_height = floor($height * ($desired_width / $width));
	
	// Create a new, "virtual" image
	$virtual_image = imagecreatetruecolor($desired_width, $desired_height);

	// Copy source image at a resized size
	imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);
	
	// Save the physical thumbnail image to the destination directory
	imagejpeg($virtual_image, $dest);
}
