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
        $images_list = '<ul class="gallery">';
        foreach (Content::getImageContentInDirectory('gallery/') as $image) {
            $images_list .= '<li><img src="' . $image . '" /></li>';
        }
        $images_list .= '</ul>';
        
        return view('gallery.index')->with(
            'content_html',
            $images_list
        )->with(
            'site',
            $this->site
        );
    }
}