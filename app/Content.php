<?php

namespace App;

use \DateTime;
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
    public static function contentExists($content_file_path)
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
    public static function getMarkdownContent($content_file_path)
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
    public static function getMarkdownContentAsHTML($content_file_path)
    {
        $page_content = self::getMarkdownContent($content_file_path);
        $page_content = Markdown::convertToHtml($page_content);
        
        return $page_content;
    }

    /**
     * Get a list of all Markdown content files in a specific sub-directory of the top-level "content" directory.
     * 
     * @param  string $content_directory_path Path to the content sub-directory.
     * @return array                          All Markdown files that are in the sub-directory.
     */
    public static function getMarkdownContentInDirectory($content_directory_path)
    {
        $directory_path = base_path('content/' . $content_directory_path);

        return glob($directory_path . '*.md');
    }

    /**
     * Get a list of all image content files in a specific sub-directory of the top-level "content" directory.
     * 
     * @param  string $content_directory_path Path to the content sub-directory.
     * @return array                          All Markdown files that are in the sub-directory.
     */
    public static function getImageContentInDirectory($content_directory_path)
    {
        $directory_path = base_path('content/' . $content_directory_path);

        return glob($directory_path . '*.{jpg,png,gif}');
    }

    /**
     * Get the post slug using a specified Markdown content file path.
     * 
     * @param  string $content_file_path Path to the file inside the top-level "content" directory.
     * @return string                    The related post slug.
     */
    public static function getMarkdownPostSlug($content_file_path)
    {
        return basename($content_file_path, '.md');
    }

    /**
     * Generate a title for a post using a specified content file path.
     * 
     * @param  string $content_file_path Path to the file inside the top-level "content" directory.
     * @return string                    The related generated post title.
     */
    public static function getPostTitleFromFilename($content_file_path)
    {
        $post_slug = self::getMarkdownPostSlug($content_file_path);

        $post_title = ucwords(
            str_replace(
                ['-', 'upcomingtasks', 'api', 'php'],
                [' ', 'UpcomingTasks', 'API', 'PHP'],
                substr(
                    $post_slug,
                    9
                )
            )
        );

        if (self::postIsDraft($content_file_path)) {
            $post_title = 'DRAFT - ' . $post_title;
        }

        return $post_title;
    }

    /**
     * Extract the short date for a post (YYYYMMDD) using a specified content file path.
     * 
     * @param  string $content_file_path Path to the file inside the top-level "content" directory.
     * @return string                    The short date for the post file.
     */
    public static function getPostDateShortFromFilename($content_file_path)
    {
        $post_slug = self::getMarkdownPostSlug($content_file_path);

        return substr($post_slug, 0, 8);
    }

    /**
     * Extract the human-friendly date for a post (DD MMM YYYY) using a specified content file path.
     * 
     * @param  string $content_file_path Path to the file inside the top-level "content" directory.
     * @return string                    The human-friendly date for the post file.
     */
    public static function getPostDateHumanFromFilename($content_file_path)
    {
        $post_date = DateTime::createFromFormat('Ymd', self::getPostDateShortFromFilename($content_file_path));

        return $post_date->format('j M Y');
    }

    /**
     * Extract the RSS supported date for a post using a specified content file path.
     * 
     * @param  string $content_file_path Path to the file inside the top-level "content" directory.
     * @return string                    The RSS supported date for the post file.
     */
    public static function getPostDatePublishedFromFilename($content_file_path)
    {
        $post_date = DateTime::createFromFormat('Ymd', self::getPostDateShortFromFilename($content_file_path));

        return $post_date->format('Y-m-d') . 'T09:00:00.000Z';
    }


    /**
     * Determine whether a post is a draft given a specified content file path.
     * 
     * @param  string $content_file_path Path to the file inside the top-level "content" directory.
     * @return bool                    Whether the post is a draft or not.
     */
    public static function postIsDraft($content_file_path)
    {
        return self::getPostDateShortFromFilename($content_file_path) == '999DRAFT';
    }

}
