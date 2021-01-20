<?php

namespace Tests\Unit\Http\Controllers;

use Tests\TestCase;

use App\Content;

class BrendanControllerTest extends TestCase {
    public function testBrendanIndex()
    {
        $response = $this->get('brendan');

        $this->assertTrue(
            $response->headers->get('content-type') == 'text/html; charset=UTF-8' &&
            $response->status() == 200
        );
    }

    public function testBrendanPage()
    {
        $response = $this->get('brendan/resume');

        $this->assertTrue(
            $response->headers->get('content-type') == 'text/html; charset=UTF-8' &&
            $response->status() == 200
        );
    }

    public function testBrendanPostList()
    {
        $response = $this->get('brendan/posts');

        $this->assertTrue(
            $response->headers->get('content-type') == 'text/html; charset=UTF-8' &&
            $response->status() == 200
        );
    }

    public function testBrendanPostItem()
    {
        $response = $this->get('brendan/post/20201124_luca-joseph-murty');

        $this->assertTrue(
            $response->headers->get('content-type') == 'text/html; charset=UTF-8' &&
            $response->status() == 200
        );
    }
}