// API Sites Controller

// Return the content of the Sites JSON file
exports.get = function (request, response) {
    var fs = require('fs'),
        path = require('path'),
        sites_file = path.join(__dirname, '../../sites.json');

    fs.readFile(sites_file, {encoding: 'utf-8'}, function(error, data) {
        if (!error) {
            response.writeHead(200, { 'Content-Type': 'application/json' });
            response.write(data);
            response.end();
        }
    });
};
