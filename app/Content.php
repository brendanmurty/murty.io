<?php

namespace App;

use File;
use Markdown;

/**
 * Functions related to content that are used site-wide.
 */
class Content
{
    /**
     * Check if a certain content file exists in the top-level "content" directory.
     * 
     * @param  string $content_file_path Path to the file inside the top-level "content" directory.
     * @return bool                      Whether this content file exists or not.
     */
    public static function pageContentFileExists($content_file_path)
    {
        $page_file = base_path('content/' . $content_file_path);

        return file_exists($page_file);
    }

    /**
     * Get the contents of a content file in Markdown format.
     * 
     * @param  string $content_file_path Path to the file inside the top-level "content" directory.
     * @return string                    Contents of this file in Markdown format.
     */
    public static function getPageContentAsMarkdown($content_file_path)
    {
        $page_file = base_path('content/' . $content_file_path);

        // Correct the image URLs in the content
        $page_content = File::get($page_file);
        $page_content = str_replace('/images/', asset('images') . '/', $page_content);
        
        return $page_content;
    }

    /**
     * Get the contents of a content file in HTML format.
     * 
     * @param  string $content_file_path Path to the file inside the top-level "content" directory.
     * @return string                    Contents of this file in HTML format.
     */
    public static function getPageContentAsHTML($content_file_path)
    {
        $page_content = self::getPageContentAsMarkdown($content_file_path);
        $page_content = Markdown::convertToHtml($page_content);
        
        return $page_content;
    }

    /**
     * Get a list of all content files in a specific sub-directory of the top-level "content" directory.
     * 
     * @param  string $content_directory_path Path to the content sub-directory.
     * @return array                          All Markdown files that are in the sub-directory.
     */
    public static function getContentFilesInDirectory($content_directory_path)
    {
        $directory_path = base_path('content/' . $content_directory_path);

        return glob($directory_path . '*.md');
    }

}
