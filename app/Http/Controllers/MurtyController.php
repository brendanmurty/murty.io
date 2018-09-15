<?php

namespace App\Http\Controllers;

class MurtyController extends Controller
{
    public $site = [
        'title' => 'Murty',
        'title_short' => 'MUR',
        'author' => 'Brendan Murty',
        'description' => 'Murty websites',
        'theme' => '#00549d',
        'icon' => '/images/common/murty-192.png',
        'icon_large' => '/images/common/murty-192.png',
        'body_class' => 'murty murty_index',
        'container_class' => 'listing avatars'
    ];

    public function index() {
        return view('index')->with(
            'site',
            $this->site
        );
    }
}