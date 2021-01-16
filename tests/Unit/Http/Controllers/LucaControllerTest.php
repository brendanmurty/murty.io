<?php

namespace Tests\Http\Controllers;

use Tests\TestCase;

use App\Content;

class LucaControllerTest extends TestCase {
    public function testLucaIndex()
    {
        $response = $this->get('luca');

        $this->assertTrue(
            $response->headers->get('content-type') == 'text/html; charset=UTF-8' &&
            $response->status() == 200
        );
    }
}