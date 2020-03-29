<?php

// Web Routes

// Routes: Root

Route::get('/', function() {
    // Domain level redirects
    switch (Request::getHost()) {
        case 'brendan.murty.io':
        case 'b.murty.io':
        case 'bmurty.dev':
            return Redirect::away('https://murty.io/brendan');
            break;
        case 'freya.murty.io':
        case 'f.murty.io':
            return Redirect::away('https://murty.io/freya');
            break;
        case 'isla.murty.io':
        case 'i.murty.io':
            return Redirect::away('https://murty.io/isla');
            break;
        case 'git.murty.io':
            return Redirect::away('https://murty.io/brendan/git');
            break;
        case 'bmurty.blog':
            return Redirect::away('https://murty.io/brendan/posts');
            break;
        default:
            // Show the site listing page
            $murty = new App\Http\Controllers\MurtyController;
            return $murty->index();
            break;
    }
});

// Routes: Brendan

Route::get('/brendan', 'BrendanController@index');

Route::get('/brendan/posts', function() {
    $brendan = new App\Http\Controllers\BrendanController;
    return $brendan->posts('page');
});

Route::get('/brendan/posts.json', function() {
    $brendan = new App\Http\Controllers\BrendanController;
    return $brendan->posts('json');
});

Route::get('/brendan/post', 'BrendanController@posts');
Route::get('/brendan/{page_name}', 'BrendanController@page');

Route::redirect('/brendan/post/farewell-upcomingtasks', '/brendan/post/20161014_farewell-upcomingtasks');

Route::get('/brendan/post/{post_name}', 'BrendanController@post');

// Routes: Freya

Route::get('/freya', 'FreyaController@index');

// Routes: Isla

Route::get('/isla', 'IslaController@index');
