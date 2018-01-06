// API Feed Controller

// Return a JSON Feed containing a list of current posts by a certain author
exports.get = function (request, response) {
    var fs = require('fs'),
        path = require('path');

    // JSON Feed properties
    var feed = {};
    feed.version = 'https://jsonfeed.org/version/1';
    feed.author = {};
    feed.items = {};

    if (request.params.author) {
        var author = request.params.author.toLowerCase(),
            author_name = author.charAt(0).toUpperCase() + author.slice(1) + ' Murty',
            post_folder = path.join(__dirname, '../../content/' + author + '/posts'),
            posts_json_file = post_folder + '/posts.json';

        if (!fs.existsSync(posts_json_file)) {
            // Couldn't find the JSON cache file
            // TODO: Call to the "posts" API method to recreate the posts JSON file
        } else {
            // The cached JSON was found, use this content to generate the JSON Feed
            // TODO: Save this content to a cached file and use this in future requests

            feed.title = 'Posts by ' + author_name;
            feed.home_page_url = 'https://murty.io/' + author;
            feed.feed_url = 'https://murty.io/api/feed/by/' + author;
            feed.author.name = author_name;
            feed.author.url = 'https://murty.io/' + author;
            feed.author.avatar = 'https://murty.io/images/' + author + '/avatar.jpg';

            fs.readFile(posts_json_file, function(error, posts_content) {
                feed.items = JSON.parse(posts_content);
                var json_feed = JSON.stringify(feed);

                response.writeHead(200, { 'Content-Type': 'application/json' });
                response.write(json_feed);
                response.end();
            });
        }
    }
};
