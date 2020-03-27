<?php

namespace App\Http\Controllers;

use File;
use Markdown;

class FreyaController extends Controller
{
    public $site = [
        'title' => 'Freya Murty',
        'title_short' => 'FJM',
        'author' => 'Freya Murty',
        'description' => 'The latest addition to the family.',
        'theme' => '#981ceb',
        'icon' => 'images/freya/icon-192.png',
        'icon_large' => 'images/freya/freya-murty.jpg',
        'body_class' => 'freya freya_index'
    ];

    public function index() {
        $page_file = storage_path('content/freya/index.md');

        // Correct the image URLs in the content
        $page_content = File::get($page_file);
        $page_content = str_replace('\/images\/', asset('\/images\/'), $page_content);
        
        return view('freya.index')->with(
            'content_html',
            Markdown::convertToHtml($page_content)
        )->with(
            'site',
            $this->site
        );
    }
}