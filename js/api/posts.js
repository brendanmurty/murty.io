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
            // Posts JSON cache file not found
            fs.readdir(post_folder, function(error, files) {
                if (!error) {
                    var post_list = [];

                    for (var i = 0; i < files.length; i++) {
                        if (file != 'posts.json') {
                            var file = files[i],
                                title = file
                                    .substr(9)
                                    .replace(/\.md/, '')
                                    .replace(/[_-]/g, ' ')
                                    .replace(/\b\w/g, function (first_letter) { return first_letter.toUpperCase() })
                                    .replace(/upcomingtasks/gi, 'UpcomingTasks')
                                    .replace(/api/gi, 'API')
                                    .replace(/php/gi, 'PHP');

                            post_list.push({
                                'title': title,
                                'date': file.substr(0, 8),
                                'link': '/' + author + '/post/' + file.replace(/\.md/, '')
                            });
                        }
                    }

                    // Sort posts by reverse chronological order
                    post_list.sort(function(a, b) {
                        if (a['date'] == b['date']) {
                            return 0;
                        } else {
                            return a['date'] > b['date'] ? -1 : 1;
                        }
                    });

                    var post_list_json = JSON.stringify(post_list);

                    // Save the JSON content to the cache file
                    fs.writeFile(posts_json_file, post_list_json);

                    response.writeHead(200, { 'Content-Type': 'application/json' });
                    response.write(post_list_json);
                    response.end();
                }
            });
        } else {
            // Posts JSON cache file found, us this content instead
            fs.readFile(posts_json_file, function(error, posts_content) {
                response.writeHead(200, { 'Content-Type': 'application/json' });
                response.write(posts_content);
                response.end();
            });
        }
    }
};
