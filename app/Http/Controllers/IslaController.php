<?php

namespace App\Http\Controllers;

use File;
use Markdown;

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
        $page_file = base_path('content/isla/index.md');

        // Correct the image URLs in the content
        $page_content = File::get($page_file);
        $page_content = str_replace('/images/', asset('images') . '/', $page_content);
        
        return view('isla.index')->with(
            'content_html',
            Markdown::convertToHtml($page_content)
        )->with(
            'site',
            $this->site
        );
    }
}