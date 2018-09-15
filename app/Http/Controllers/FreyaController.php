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
        'icon' => '/images/freya/icon-192.png',
        'icon_large' => '/images/freya/freya_murty.jpg',
        'body_class' => 'freya freya_index'
    ];

    public function index() {
        return view('freya.index')->with(
            'content_html',
            Markdown::convertToHtml(File::get('../content/freya/index.md'))
        )->with(
            'site',
            $this->site
        );
    }
}