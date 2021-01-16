<?php

namespace Tests\Http\Controllers;

use Tests\TestCase;

use App\Content;

class MurtyControllerTest extends TestCase {
    public function testMurtyIndex()
    {
        $response = $this->get('/');

        $this->assertTrue(
            $response->headers->get('content-type') == 'text/html; charset=UTF-8' &&
            $response->status() == 200
        );
    }
}