<?php

namespace App\Http\Controllers;

use \DateTime;
use Response;
use Storage;
use Content;

class BrendanController extends Controller
{
    public $site = [
        'title' => 'Brendan Murty',
        'title_short' => 'BCM',
        'author' => 'Brendan Murty',
        'description' => 'Brendan is Lead Developer with varied commercial experience in web-based development, mentorship, training and project management',
        'theme' => '#00549d',
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
            Content::getContentAsHTML('brendan/index.md')
        )->with(
            'site',
            $this->site
        );
    }
    
    public function page($page_name) {
        $page_file = 'brendan/' . $page_name . '.md';

        if (!Content::contentExists($page_file)) {
            abort(404);
        }

        $page_title = ucwords(str_replace(['-', 'resume'], [' ', 'resumé'], $page_name));

        $this->site['title'] = $page_title . ' - Brendan Murty';
        $this->site['body_class'] = 'brendan brendan_' . $page_name;

        return view('brendan.page')->with(
            'content_html',
            Content::getContentAsHTML($page_file)
        )->with(
            'site',
            $this->site
        )->with(
            'breadcrumbs',
            [
                'Brendan' => '/brendan',
                $page_title => ''
            ]
        );
    }

    public function posts($output_type) {
        // Construct a list of Brendan's Posts
        $post_items = [];
        foreach (Content::getContentInDirectory('brendan/posts/') as $post_file) {
            $post_slug = str_replace(array(base_path('content/brendan/posts/'), '.md'), '', $post_file);
            $post_url_relative = '/brendan/post/' . $post_slug;
            $post_url_full = 'https://murty.io' . $post_url_relative;
            $post_date_short = substr($post_slug, 0, 8);

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

                $post_date = DateTime::createFromFormat('Ymd', $post_date_short);
                $post_date_human = $post_date->format('j M Y');
                $post_date_published = $post_date->format('Y-m-d') . 'T09:00:00.000Z';
            }

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

        if ($output_type == 'json') {
            // Return a JSON Feed file of the newest to oldest posts
            $feed_array = [
                'version' => 'https://jsonfeed.org/version/1',
                'title' => 'Posts by Brendan Murty',
                'home_page_url' => 'https://murty.io/brendan',
                'feed_url' => 'https://murty.io/brendan/posts.json',
                'user_comment' => 'This feed allows you to read the posts from this site in any feed reader that supports the JSON Feed format. To add this feed to your reader, copy the following URL — https://murty.io/brendan/posts.json — and add it your reader.',
                'author' => [
                    'name' => 'Brendan Murty',
                    'url' => 'https://murty.io/brendan',
                    'avatar' => 'https://murty.io/images/brendan/avatar.jpg'
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
            )->with(
                'breadcrumbs',
                [
                    'Brendan' => '/brendan',
                    'Posts' => ''
                ]
            );
        }
    }

    public function post($post_name) {
        $post_file = 'brendan/posts/' . $post_name . '.md';

        if (!Content::contentExists($post_file)) {
            abort(404);
        }

        $post_title = ucwords(
            str_replace(
                ['-', 'upcomingtasks', 'api', 'php'],
                [' ', 'UpcomingTasks', 'API', 'PHP'],
                substr(
                    $post_name,
                    9
                )
            )
        );

        if (substr($post_name, 0, 8) == '999DRAFT') {
            // This is a draft post
            $post_title = 'DRAFT - ' . $post_title;
            
            // Draft posts should only be visible on local environments
            if (env('APP_ENV', 'production') != 'local') {
                return response(view('errors.404'), 404);
            }
        }

        $this->site['title'] = $post_title . ' - Brendan Murty';
        $this->site['body_class'] = 'brendan brendan_post';

        return view('brendan.post')->with(
            'content_html',
            Content::getContentAsHTML($post_file)
        )->with(
            'site',
            $this->site
        )->with(
            'breadcrumbs',
            [
                'Brendan' => '/brendan',
                'Posts' => '/brendan/posts',
                $post_title => ''
            ]
        );
    }
}