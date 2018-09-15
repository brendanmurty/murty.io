<?php

namespace App\Http\Controllers;

use File;
use Markdown;

class IslaController extends Controller
{
    public function index() {
        return view('isla.index')->with(
            'content_html',
            Markdown::convertToHtml(File::get('../content/isla/index.md'))
        );
    }
}