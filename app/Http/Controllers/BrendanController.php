<?php

namespace App\Http\Controllers;

use \DateTime;
use File;
use Markdown;
use Response;
use Storage;

class BrendanController extends Controller
{
    public function index() {
        return view('brendan.index')->with(
            'content_html',
            Markdown::convertToHtml(File::get('../content/brendan/index.md'))
        );
    }
    
    public function page($page_name) {
        return view('brendan.page')->with(
            'content_html',
            Markdown::convertToHtml(File::get('../content/brendan/' . $page_name . '.md'))
        )->with(
            'page_name',
            $page_name
        );
    }

    public function posts($output_type) {
        // Construct a list of Brendan's Posts
        $post_folder = '../content/brendan/posts/';
        $post_files = glob($post_folder . '*.md');

        $post_items = [];
        foreach ($post_files as $post_file) {
            $post_slug = str_replace(array($post_folder, '.md'), '', $post_file);
            $post_url_relative = '/brendan/post/' . $post_slug;
            $post_url_full = 'https://murty.io' . $post_url_relative;

            $post_date_short = substr($post_slug, 0, 8);
            $post_date = DateTime::createFromFormat('Ymd', $post_date_short);
            $post_date_human = $post_date->format('j M Y');
            $post_date_published = $post_date->format('Y-m-d') . 'T09:00:00.000Z';

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
            
            return view('brendan.page')->with(
                'content_html',
                '<h1>Posts</h1><ul class="brendan_posts">' . $post_items . '</ul>'
            )->with(
                'page_name',
                'posts'
            );
        }
    }

    public function post($post_name) {
        $post_file = '../content/brendan/posts/' . $post_name . '.md';

        if (!file_exists($post_file)) {
            abort(404);
        }
        
        return view('brendan.post')->with(
            'content_html',
            Markdown::convertToHtml(File::get($post_file))
        )->with(
            'post_name',
            $post_name
        )->with(
            'post_title',
            ucwords(str_replace('-', ' ', substr($post_name, 9)))
        );
    }
}