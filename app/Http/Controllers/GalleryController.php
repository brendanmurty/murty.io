<?php

namespace App\Http\Controllers;

use Content;

class GalleryController extends Controller
{
    public $site = [
        'title' => 'Gallery',
        'title_short' => 'GAL',
        'author' => 'Brendan Murty',
        'description' => 'Murty family photo gallery.',
        'theme' => '#00549d',
        'icon' => 'images/common/murty-192.png',
        'icon_large' => 'images/common/murty-192.png',
        'body_class' => 'gallery gallery_index',
        'container_class' => ''
    ];

    public function index() {
        $image_items = array();
        foreach (Content::getImageContentInDirectory('/') as $image_file_path) {
            // Get the public URL for this image
            $image_src = str_replace(
                base_path('public/images/'),
                asset('images') . '/',
                $image_file_path
            );

            // Extract image metadata and construct summary line
            $image_date = Content::getPostDateHumanFromFilename($image_file_path);
            $image_metaline = $image_date . ', ';
            $image_metadata = Content::getImageMetadata($image_file_path);
            if (!empty($image_metadata)) {
                $image_metaline .= $image_metadata['Make'] . ' ' . $image_metadata['Model'] . ', ' . $image_metadata['COMPUTED']['ApertureFNumber'] . ', ISO ' . $image_metadata['ISOSpeedRatings'];
            }

            $image_items[] = '<li><img src="' . $image_src . '" /><span>' . $image_metaline . '</span></li>';
        }
        $images_list = '<ul class="gallery">' . implode('', array_reverse($image_items)) . '</ul>';
        
        return view('gallery.index')->with(
            'content_html',
            $images_list
        )->with(
            'site',
            $this->site
        );
    }
}