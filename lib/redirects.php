<?php

// Redirection for older pages

if ($_SERVER['HTTP_HOST'] == 'b.murty.io') {
    $url = $_SERVER['REQUEST_URI'];

    if ($_SERVER['REQUEST_URI'] == '/post/farewell-upcomingtasks') {
        $url = '/post/20161014_farewell-upcomingtasks';
    }

    header('Location: http://murty.io/brendan' . $url);
} elseif ($_SERVER['HTTP_HOST'] == 'i.murty.io') {
    header('Location: http://murty.io/isla' . $_SERVER['REQUEST_URI']);
}
