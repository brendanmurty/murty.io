<?php

namespace Tests\Unit;

use Tests\TestCase;

use App\Content;

class ContentTest extends TestCase
{
    public function testMarkdownExists()
    {
        $this->assertTrue(
            Content::markdownExists('brendan/index.md')
        );
    }

    public function testGetMarkdownContent()
    {
        $this->assertTrue(
            strlen(Content::getMarkdownContent('brendan/index.md')) > 0
        );
    }

    public function testGetMarkdownContentAsHtml()
    {
        $this->assertTrue(
            strlen(Content::getMarkdownContentAsHTML('brendan/index.md')) > 0
        );
    }

    public function testGetMarkdownContentInDirectory()
    {
        $content = Content::getMarkdownContentInDirectory('brendan/');
    
        $this->assertTrue(
            !empty($content) && is_array($content)
        );
    }

    public function testGetImageContentInDirectory()
    {
        $content = Content::getImageContentInDirectory('/');

        $this->assertTrue(
            !empty($content) && is_array($content)
        );
    }

    public function testGetSlug()
    {
        $this->assertEquals(
            Content::getSlug('content\brendan\posts\20201124_luca-joseph-murty.md'),
            '20201124_luca-joseph-murty'
        );
    }

    public function testGetSlugWithExtension()
    {
        $this->assertEquals(
            Content::getSlugWithExtension('content\brendan\posts\20201124_luca-joseph-murty.md'),
            '20201124_luca-joseph-murty.md'
        );
    }

    public function testGetPostTitleFromFilename()
    {
        $this->assertEquals(
            Content::getPostTitleFromFilename('content\brendan\posts\20201124_luca-joseph-murty.md'),
            'Luca Joseph Murty'
        );
    }

    public function testGetPostDateShortFromFilename()
    {
        $this->assertEquals(
            Content::getPostDateShortFromFilename('content\brendan\posts\20201124_luca-joseph-murty.md'),
            '20201124'
        );
    }

    public function testGetPostDateHumanFromFilename()
    {
        $this->assertEquals(
            Content::getPostDateHumanFromFilename('content\brendan\posts\20201124_luca-joseph-murty.md'),
            '24 Nov 2020'
        );
    }

    public function testGetPostDatePublishedFromFilename()
    {
        $this->assertEquals(
            Content::getPostDatePublishedFromFilename('content\brendan\posts\20201124_luca-joseph-murty.md'),
            '2020-11-24T09:00:00.000Z'
        );
    }

    public function testPostIsDraft()
    {
        $this->assertTrue(
            Content::postIsDraft('content\example\999DRAFT_test-draft-post.md')
        );
    }

    public function testGetImageMetadata()
    {
        $this->assertTrue(
            strlen(
                Content::getImageMetadata('public\images\gallery\20201124_luca-murty.jpg')
            ) > 0
        );
    }
}
