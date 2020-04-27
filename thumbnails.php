<?php

/*

thumbnails.php

Generates smaller versions of images in the Gallery directory,
that are then used in the Gallery list view to lower the network usage.

Requires the PHP GD2 extension.

*/

$originals_dir = join(DIRECTORY_SEPARATOR, array(dirname(__FILE__), 'public', 'images', 'gallery', ''));
$thumbs_dir = join(DIRECTORY_SEPARATOR, array($originals_dir, 'thumbs', ''));

$original_images = glob($originals_dir . '*.jpg');
$i = 0;
foreach ($original_images as $original_image) {
    $thumb_image = str_replace($originals_dir, $thumbs_dir, $original_image);

    if (!file_exists($thumb_image)) {
        make_thumb($original_image, $thumb_image, '250');
        $i++;
    }
}

echo 'Generated thumbnails for ' . $i . ' images.';

/*

Image thumbnail creation code from:
https://davidwalsh.name/create-image-thumbnail-php

*/

function make_thumb($src, $dest, $desired_width) {

	/* read the source image */
	$source_image = imagecreatefromjpeg($src);
	$width = imagesx($source_image);
	$height = imagesy($source_image);
	
	/* find the "desired height" of this thumbnail, relative to the desired width  */
	$desired_height = floor($height * ($desired_width / $width));
	
	/* create a new, "virtual" image */
	$virtual_image = imagecreatetruecolor($desired_width, $desired_height);
	
	/* copy source image at a resized size */
	imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);
	
	/* create the physical thumbnail image to its destination */
	imagejpeg($virtual_image, $dest);
}
