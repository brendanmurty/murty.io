<?php

namespace App\Http\Controllers;

use \DateTime;
use Response;
use Storage;
use Content;
use Cache;

class BrendanController extends Controller
{
    public $site = [
        'title' => 'Brendan Murty',
        'title_short' => 'BCM',
        'author' => 'Brendan Murty',
        'description' => 'Brendan is Lead Developer with varied commercial experience in web-based development, mentorship, training and project management',
        'theme' => '#23c5b0',
        'icon' => 'images/brendan/icon-192.png',
        'icon_large' => 'images/brendan/brendan-murty.jpg',
        'feed_title' => 'Posts by Brendan Murty',
        'feed_url' => 'https://murty.io/brendan/posts.json',
        'microblog_url' => 'https://micro.blog/brendanmurty',
        'body_class' => 'brendan brendan_index'
    ];

    public function index() {
        return view('brendan.index')->with(
            'content_html',
            Content::getMarkdownContentAsHTML('brendan/index.md')
        )->with(
            'site',
            $this->site
        );
    }
    
    public function page($page_name) {
        $page_file = 'brendan/' . $page_name . '.md';

        if (!Content::markdownExists($page_file)) {
            abort(404);
        }

        $page_title = ucwords(str_replace('-', ' ', $page_name));

        $this->site['title'] = $page_title . ' - Brendan Murty';
        $this->site['body_class'] = 'brendan brendan_' . $page_name;

        return view('brendan.page')->with(
            'content_html',
            Content::getMarkdownContentAsHTML($page_file)
        )->with(
            'site',
            $this->site
        );
    }

    public function posts($output_type) {
        // Construct a list of Brendan's Posts
        $post_items = [];
        $content_directory = 'brendan/posts/';

        if (Cache::has('content-directory-html-' . $content_directory)) {
            // A cached version of the constructed HTML list of the content in this directory was found, use this instead
            $post_items = Cache::get('content-directory-html-' . $content_directory);
        } else {
            // Construct the HTML list of the content in this directory
            foreach (Content::getMarkdownContentInDirectory($content_directory) as $post_file) {
                $post_slug = Content::getSlug($post_file);
                $post_url_relative = '/brendan/post/' . $post_slug;
                $post_url_full = 'https://murty.io' . $post_url_relative;
                $post_date_short = Content::getPostDateShortFromFilename($post_file);

                if ($post_date_short == '999DRAFT') {
                    // This is a draft post

                    // Draft posts should only be visible on local environments
                    if (env('APP_ENV', 'production') != 'local') {
                        continue;
                    }

                    $post_date_short = 'DRAFT';
                    $post_date_human = 'DRAFT';
                    $post_date_published = false;
                } else {
                    // This is a published post

                    $post_date_human = Content::getPostDateHumanFromFilename($post_file);
                    $post_date_published = Content::getPostDatePublishedFromFilename($post_file);
                }

                $post_title = Content::getPostTitleFromFilename($post_file);

                if ($output_type == 'json') {
                    // Construct a JSON Feed Item for this post
                    if ($post_date_published) {
                        $post_items[] = [
                            'id' => $post_url_full,
                            'url' => $post_url_full,
                            '_murty' => [
                                'date_short' => $post_date_short
                            ],
                            'date_published' => $post_date_published,
                            'content_text' => 'Read this post on murty.io',
                            'content_html' => '<p>Read this post on <a href="' . $post_url_full . '">murty.io</a></p>',
                            'title' => $post_title
                        ];
                    }
                } else {
                    // Construct a HTML List Item for this post
                    $post_items[] = '<li><span class="post-date">' . $post_date_human . '</span><a class="post-link" href="' . $post_url_relative . '">' . $post_title . '</a></li>';
                }
            }

            // Store the constructed HTML list in the cache for 30 days
            Cache::put('content-directory-html-' . $content_directory, $post_items, 2592000);
        }

        if ($output_type == 'json') {
            // Return a JSON Feed file of the newest to oldest posts
            $feed_array = [
                'version' => 'https://jsonfeed.org/version/1',
                'title' => 'Posts by Brendan Murty',
                'home_page_url' => 'https://murty.io/brendan',
                'feed_url' => 'https://murty.io/brendan/posts.json',
                'user_comment' => 'This feed allows you to read the posts from this site in any feed reader that supports the JSON Feed format. To add this feed to your reader, add the following URL to your feed reader — https://murty.io/brendan/posts.json',
                'author' => [
                    'name' => 'Brendan Murty',
                    'url' => 'https://murty.io/brendan',
                    'avatar' => 'https://murty.io/images/brendan/brendan-murty.jpg'
                ],
                'items' => array_reverse($post_items)
            ];

            return Response::json($feed_array, 200);
        } else {
            // Return a view using a HTML string of newest to oldest posts
            $post_items = implode(array_reverse($post_items));

            $this->site['title'] = 'Posts - Brendan Murty';
            $this->site['body_class'] = 'brendan brendan_posts';
            
            return view('brendan.page')->with(
                'content_html',
                '<h1>Posts</h1><ul class="brendan_posts">' . $post_items . '</ul>'
            )->with(
                'site',
                $this->site
            );
        }
    }

    public function post($post_name) {
        $post_file = 'brendan/posts/' . $post_name . '.md';

        if (!Content::markdownExists($post_file)) {
            abort(404);
        }

        $post_title = Content::getPostTitleFromFilename($post_file);

        if (Content::postIsDraft($post_file) && env('APP_ENV', 'production') != 'local') {
            // Draft posts should only be visible on local environments
            return response(view('errors.404'), 404);
        }

        $this->site['title'] = $post_title . ' - Brendan Murty';
        $this->site['body_class'] = 'brendan brendan_post';

        return view('brendan.post')->with(
            'content_html',
            Content::getMarkdownContentAsHTML($post_file)
        )->with(
            'site',
            $this->site
        );
    }
}