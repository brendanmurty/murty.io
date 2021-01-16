<?php

namespace Tests\Http\Controllers;

use Tests\TestCase;

use App\Content;

class FreyaControllerTest extends TestCase {
    public function testFreyaIndex()
    {
        $response = $this->get('freya');

        $this->assertTrue(
            $response->headers->get('content-type') == 'text/html; charset=UTF-8' &&
            $response->status() == 200
        );
    }
}