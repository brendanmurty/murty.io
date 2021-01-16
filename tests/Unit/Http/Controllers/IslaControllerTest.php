<?php

namespace Tests\Http\Controllers;

use Tests\TestCase;

use App\Content;

class IslaControllerTest extends TestCase {
    public function testIslaIndex()
    {
        $response = $this->get('isla');

        $this->assertTrue(
            $response->headers->get('content-type') == 'text/html; charset=UTF-8' &&
            $response->status() == 200
        );
    }
}