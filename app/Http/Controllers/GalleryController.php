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
            $image_src = str_replace(
                base_path('public/images/'),
                asset('images') . '/',
                $image_file_path
            );

            $image_detail_url = '/gallery/' . Content::getSlugWithExtension($image_file_path);

            $image_metadata = Content::getImageMetadata($image_file_path);

            $image_items[] = '<li class="gallery-item"><a class="gallery-item-link" href="' . $image_detail_url . '"><img class="gallery-image" src="' . $image_src . '" /><span class="gallery-meta">' . $image_metadata . '</span></a></li>';
        }
        $images_list = '<ul class="gallery-images">' . implode('', array_reverse($image_items)) . '</ul>';
        
        return view('gallery.index')->with(
            'content_html',
            $images_list
        )->with(
            'site',
            $this->site
        );
    }

    public function item($item_name) {
        $image_src = asset('images') . '/gallery/' . $item_name;
        $image_path = base_path('public/images/gallery/' . $item_name);

        if (!Content::imageExists($item_name)) {
            abort(404);
        }

        $image_metadata = Content::getImageMetadata($image_path);

        $image_detail = '<div class="gallery-item-full"><img class="gallery-image" src="' . $image_src . '" /><span class="gallery-meta">' . $image_metadata . '</span></div>';
        
        return view('gallery.item')->with(
            'content_html',
            $image_detail
        )->with(
            'site',
            $this->site
        )->with(
            'breadcrumbs',
            [
                'Gallery' => '/gallery',
                $item_name => ''
            ]
        );
    }

}