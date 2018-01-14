// API Feed Controller

// Return a JSON Feed containing a list of current posts by a certain author
exports.get = function (request, response) {
    var fs = require('fs'),
        path = require('path');

    if (request.params.author) {
        // Author and cache file settings
        var author = request.params.author.toLowerCase(),
            author_name = author.charAt(0).toUpperCase() + author.slice(1) + ' Murty',
            post_folder = path.join(__dirname, '../../content/' + author + '/posts'),
            feed_json_file = post_folder + '/feed.json',
            posts_json_file = post_folder + '/posts.json';

        // JSON Feed properties
        var feed = {};
        feed.version = 'https://jsonfeed.org/version/1';
        feed.title = 'Posts by ' + author_name;
        feed.home_page_url = 'https://murty.io/' + author;
        feed.feed_url = 'https://murty.io/' + author + '/posts.json';
        feed.user_comment = 'This feed allows you to read the posts from this site in any feed reader that supports the JSON Feed format. To add this feed to your reader, copy the following URL — ' + feed.feed_url + ' — and add it your reader.';
        feed.author = {};
        feed.author.name = author_name;
        feed.author.url = 'https://murty.io/' + author;
        feed.author.avatar = 'https://murty.io/images/' + author + '/avatar.jpg';
        feed.items = {};

        if (fs.existsSync(posts_json_file)) {
            if (!fs.existsSync(feed_json_file)) {
                fs.readFile(posts_json_file, function(error, posts_content) {
                    feed.items = JSON.parse(posts_content);
                    var json_feed = JSON.stringify(feed);

                    fs.writeFile(feed_json_file, json_feed);

                    response.writeHead(200, { 'Content-Type': 'application/json' });
                    response.write(json_feed);
                    response.end();
                });
            } else {
                fs.readFile(feed_json_file, function(error, feed_content) {
                    response.writeHead(200, { 'Content-Type': 'application/json' });
                    response.write(feed_content);
                    response.end();
                });
            }
        }
    }
};
