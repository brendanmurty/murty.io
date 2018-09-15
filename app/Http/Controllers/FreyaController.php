<?php

namespace App\Http\Controllers;

use File;
use Markdown;

class FreyaController extends Controller
{
    public function index() {
        return view('freya.index')->with(
            'content_html',
            Markdown::convertToHtml(File::get('../content/freya/index.md'))
        );
    }
}