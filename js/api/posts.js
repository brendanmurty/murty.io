// API Posts Controller

// Return a JSON list of current posts by a certain author
exports.get = function (request, response) {
    if (request.params.author) {
        var fs = require('fs'),
            path = require('path'),
            author = request.params.author.toLowerCase(),
            post_folder = path.join(__dirname, '../../content/' + author + '/posts'),
            posts_json_file = post_folder + '/posts.json';

        if (!fs.existsSync(posts_json_file)) {
            // Couldn't find the JSON cache file
            fs.readdir(post_folder, function(error, files) {
                if (!error) {
                    var post_list = [];

                    for (var i = 0; i < files.length; i++) {
                        if (files[i] != 'posts.json' && files[i] != 'feed.json') {
                            var file = files[i],
                                date_short = file.substr(0, 8),
                                date_object = new Date(date_short.substr(0, 4), date_short.substr(4, 2) - 1, date_short.substr(6, 2), 9, 0, 0, 0),
                                date_published = date_object.toISOString(),
                                post_url = 'https://murty.io/' + author + '/post/' + file.replace(/\.md/, ''),
                                title = file
                                    .substr(9)
                                    .replace(/\.md/, '')
                                    .replace(/[_-]/g, ' ')
                                    .replace(/\b\w/g, function (first_letter) { return first_letter.toUpperCase() })
                                    .replace(/upcomingtasks/gi, 'UpcomingTasks')
                                    .replace(/api/gi, 'API')
                                    .replace(/php/gi, 'PHP');

                            post_list.push({
                                'id': post_url,
                                'url': post_url,
                                '_murty': { 'date_short': date_short },
                                'date_published': date_published,
                                'content_text': 'Read this post on murty.io',
                                'content_html': '<p>Read this post on <a href="' + post_url + '">murty.io</a></p>',
                                'title': title
                            });
                        }
                    }

                    // Sort posts by reverse chronological order
                    post_list.sort(function(a, b) {
                        if (a['_murty']['date_short'] == b['_murty']['date_short']) {
                            return 0;
                        } else {
                            return a['_murty']['date_short'] > b['_murty']['date_short'] ? -1 : 1;
                        }
                    });

                    var post_list_json = JSON.stringify(post_list);

                    // Save the JSON content to the cache file
                    fs.writeFile(
                        posts_json_file,
                        post_list_json,
                        (error) => {
                            if (error) {
                                console.log(error);
                            }
                        }
                    );

                    response.writeHead(200, { 'Content-Type': 'application/json' });
                    response.write(post_list_json);
                    response.end();
                }
            });
        } else {
            // The cached JSON was found, use this content instead
            fs.readFile(posts_json_file, function(error, posts_content) {
                response.writeHead(200, { 'Content-Type': 'application/json' });
                response.write(posts_content);
                response.end();
            });
        }
    }
};
