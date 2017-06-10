// Initialise app
var express = require('express'),
    app = express(),
    app_domain = process.env.APP_DOMAIN || 'localhost',
    app_port = process.env.APP_PORT || 80,
    router = express.Router(),
    compression = require('compression');

// Configure API controllers
var content_controller = require('./js/api/content.js'),
    posts_controller = require('./js/api/posts.js');

// Configure API Posts Route
router.get('/api/posts/by/:author', posts_controller.get);

// Configure API Page Content Route
router.get('/api/content/of/:content_path', content_controller.get);

// Custom redirects
router.get('/readme.md',    function(request, response) { response.redirect('https://github.com/brendanmurty/website/blob/master/readme.md'); });
router.get('/license.md',   function(request, response) { response.redirect('https://github.com/brendanmurty/website/blob/master/license.md'); });
router.get('/code',         function(request, response) { response.redirect('https://github.com/brendanmurty/website'); });

// Allow static content requests
app.use('/', router);
app.use(express.static(__dirname));

// Use Gzip compression
app.use(compression());

// Send all other requests to Angular
app.get('*', function (request, response) {
    response.sendFile('index.html', { 'root': __dirname });
});

// Start the web server
app.listen(app_port, app_domain);

console.log('server started at http://' + app_domain + ':' + app_port);
