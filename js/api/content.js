// API Content Controller

// Return the content of a Markdown file
exports.get = function (request, response) {
    if (request.params.content_path) {
        var fs = require('fs'),
            path = require('path'),
            markdown_file = path.join(__dirname, '../../content/' + request.params.content_path.replace(/--/g, '/') + '.md');

        fs.readFile(markdown_file, {encoding: 'utf-8'}, function(error, data) {
            if (!error) {
                response.writeHead(200, { 'Content-Type': 'text/markdown' });
                response.write(data);
                response.end();
            }
        });
    }
};
