<?php

namespace App\Http\Controllers;

use Content;

class IslaController extends Controller
{
    public $site = [
        'title' => 'Isla Murty',
        'title_short' => 'IJM',
        'author' => 'Isla Murty',
        'description' => 'Loves salt and vinegar chips and plain crackers with Philadelphia.',
        'theme' => '#14b3fb',
        'icon' => 'images/isla/icon-192.png',
        'icon_large' => 'images/isla/isla-murty.jpg',
        'body_class' => 'isla isla_index'
    ];

    public function index() {
        return view('isla.index')->with(
            'content_html',
            Content::getContentAsHTML('isla/index.md')
        )->with(
            'site',
            $this->site
        );
    }
}