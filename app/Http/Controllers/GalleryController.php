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
        'theme' => '#000000',
        'icon' => 'svg/gallery.svg',
        'icon_large' => 'svg/gallery.svg',
        'body_class' => 'gallery gallery_index',
        'container_class' => ''
    ];

    public function index() {
        $image_items = array();

        foreach (Content::getImageContentInDirectory('/') as $image_file_path) {
            $image_src = str_replace(
                base_path('public/images/gallery/'),
                asset('images') . '/gallery/thumbs/',
                $image_file_path
            );

            $image_slug = Content::getSlugWithExtension($image_file_path);
            $image_detail_url = '/gallery/' . $image_slug;

            $image_items[] = '<li class="gallery-list-item"><a class="gallery-list-link" href="' . $image_detail_url . '" title="' . $image_slug . '"><img class="gallery-image" src="' . $image_src . '" alt="' . $image_slug . '" loading="lazy"></a></li>';
        }

        $images_list = '<ul class="gallery-images">' . implode('', array_reverse($image_items)) . '</ul>';
        
        return view('gallery.index')->with(
            'content_html',
            $images_list
        )->with(
            'site',
            $this->site
        )->with(
            'breadcrumbs',
            [
                'Home' => '/',
                'Gallery' => '/gallery'
            ]
        );
    }

    public function item($item_name) {
        $image_src = asset('images') . '/gallery/' . $item_name;
        $image_path = base_path('public/images/gallery/' . $item_name);

        if (!Content::imageExists($item_name)) {
            abort(404);
        }

        $this->site['title'] = $item_name . ' - Gallery';
        $this->site['body_class'] = 'gallery gallery_item';

        $image_metadata = Content::getImageMetadata($image_path);

        $image_detail = '<div class="gallery-item"><span class="gallery-meta">' . $image_metadata . '</span><img class="gallery-image" src="' . $image_src . '" alt="' . $item_name . '"></div>';

        return view('gallery.item')->with(
            'content_html',
            $image_detail
        )->with(
            'site',
            $this->site
        )->with(
            'breadcrumbs',
            [
                'Home' => '/',
                'Gallery' => '/gallery',
                $item_name => ''
            ]
        );
    }

}