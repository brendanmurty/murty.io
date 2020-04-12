<?php

namespace App;

use \DateTime;
use File;
use Markdown;
use Image;

/**
 * Functions related to content that are used site-wide.
 */
class Content
{
    /**
     * Check if a certain Markdown content file exists in the top-level "content" directory.
     * 
     * @param  string $content_file_path Path to the file inside the top-level "content" directory.
     * @return bool                      Whether this content file exists or not.
     */
    public static function markdownExists($content_file_path)
    {
        $page_file = base_path('content/' . $content_file_path);

        return file_exists($page_file);
    }

    /**
     * Check if a certain image file exists in the "public/images/gallery/" directory.
     * 
     * @param  string $content_file_path Path to the file inside the "public/images/gallery/" directory.
     * @return bool                      Whether this content file exists or not.
     */
    public static function imageExists($image_file_path)
    {
        $image_file = base_path('public/images/gallery/' . $image_file_path);

        return file_exists($image_file);
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
     * Get a list of all image content files in the "public/images/gallery/" directory.
     * 
     * @param  string $content_directory_path Path to the images inside the "public/images/gallery/" directory.
     * @return array                          All Markdown files that are in the sub-directory.
     */
    public static function getImageContentInDirectory($content_directory_path)
    {
        $directory_path = base_path('public/images/gallery' . $content_directory_path);

        return glob($directory_path . '*.{jpg,png,gif}', GLOB_BRACE);
    }

    /**
     * Get a URL slug using a specified file path.
     * 
     * @param  string $content_file_path Path to the file.
     * @return string                    The related URL slug.
     */
    public static function getSlug($content_file_path)
    {
        $content_path_parts = pathinfo($content_file_path);

        return $content_path_parts['filename'];
    }

    /**
     * Get a URL slug (including a file extension) using a specified file path.
     * 
     * @param  string $content_file_path Path to the file.
     * @return string                    The related URL slug.
     */
    public static function getSlugWithExtension($content_file_path)
    {
        $content_path_parts = pathinfo($content_file_path);

        return $content_path_parts['basename'];
    }

    /**
     * Generate a title for a post using a specified content file path.
     * 
     * @param  string $content_file_path Path to the file inside the top-level "content" directory.
     * @return string                    The related generated post title.
     */
    public static function getPostTitleFromFilename($content_file_path)
    {
        $post_slug = self::getSlug($content_file_path);

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
        $post_slug = self::getSlug($content_file_path);

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

    /**
     * Extract image metadata from an image file.
     * 
     * @param  string $image_file_path Full path to the image from the project root.
     * @return array                   Metadata from the image or an empty array.
     */
    public static function getImageMetadata($image_file_path)
    {
        try {
            $image_date = Content::getPostDateHumanFromFilename($image_file_path);
            $image_metaline = $image_date . ', ';
            $image_metadata = Image::make($image_file_path)->exif();
            if (!empty($image_metadata)) {
                $image_metaline .= $image_metadata['Make'] . ' ' . $image_metadata['Model'] . ', ' . $image_metadata['COMPUTED']['ApertureFNumber'] . ', ISO ' . $image_metadata['ISOSpeedRatings'];
            }

            return $image_metaline;
        } catch (\Exception $e) {
            return array();
        }
    }
}
