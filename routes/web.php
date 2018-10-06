<?php

// Web Routes

// Routes: Root

Route::get('/', 'MurtyController@index');

// Routes: Brendan

Route::get('/content/brendan/browser-new-tab.html', function() {
    return File::get('../content/brendan/browser-new-tab.html');
});

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

Route::get('/brendan/post/farewell-upcomingtasks', function() {
    return redirect('/brendan/post/20161014_farewell-upcomingtasks');
});

Route::get('/brendan/post/{post_name}', 'BrendanController@post');

// Routes: Freya

Route::get('/freya', 'FreyaController@index');

// Routes: Isla

Route::get('/isla', 'IslaController@index');
