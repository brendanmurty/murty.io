// API Feed Controller

// Return a JSON Feed containing a list of current posts by a certain author
exports.get = function (request, response) {
    // JSON Feed properties
    var feed_info = [];
    feed_info.version = 'https://jsonfeed.org/version/1';
    feed_info.title = '';
    feed_info.home_page_url = '';
    feed_info.feed_url = '';

    if (request.params.author) {
        var fs = require('fs'),
            path = require('path'),
            author = request.params.author.toLowerCase(),
            post_folder = path.join(__dirname, '../../content/' + author + '/posts'),
            posts_json_file = post_folder + '/posts.json';

        if (!fs.existsSync(posts_json_file)) {
            // Couldn't find the JSON cache file
            // TODO: Prompt a suitable call to the "posts" API method to recreate the posts JSON file
        } else {
            // The cached JSON was found, use this content to generate the JSON Feed
            fs.readFile(posts_json_file, function(error, posts_content) {
                // TODO: Combine the "feed_info" object including a new property of "items" which contains the content from "posts_content", then send this trough "JSON.parse" before returning the output
                var json_feed = '';

                response.writeHead(200, { 'Content-Type': 'application/json' });
                response.write(json_feed);
                response.end();
            });
        }
    }
};
