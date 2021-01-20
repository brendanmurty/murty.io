<?php

namespace Tests\Unit\Http\Controllers;

use Tests\TestCase;

use App\Content;

class GalleryControllerTest extends TestCase {
    public function testGalleryIndex()
    {
        $response = $this->get('gallery');

        $this->assertTrue(
            $response->headers->get('content-type') == 'text/html; charset=UTF-8' &&
            $response->status() == 200
        );
    }

    public function testGalleryItem()
    {
        $response = $this->get('gallery/20201124_luca-murty.jpg');

        $this->assertTrue(
            $response->headers->get('content-type') == 'text/html; charset=UTF-8' &&
            $response->status() == 200
        );
    }
}