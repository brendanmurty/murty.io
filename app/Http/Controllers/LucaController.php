<?php

namespace App\Http\Controllers;

use Content;

class LucaController extends Controller
{
    public $site = [
        'title' => 'Luca Murty',
        'title_short' => 'LJM',
        'author' => 'Luca Murty',
        'description' => 'The latest addition to the family.',
        'theme' => '#e94e0f',
        'icon' => 'images/common/murty-192.png',
        'icon_large' => 'images/common/murty-192.png',
        'body_class' => 'luca luca_index'
    ];

    public function index() {
        return view('luca.index')->with(
            'content_html',
            Content::getMarkdownContentAsHTML('luca/index.md')
        )->with(
            'site',
            $this->site
        );
    }
}