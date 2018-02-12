// Initialise app
var https = require('https'),
    fs = require('fs'),
    express = require('express'),
    app = express(),
    app_domain = process.env.APP_DOMAIN || 'localhost',
    app_port = process.env.APP_PORT || 80,
    router = express.Router(),
    compression = require('compression');

// Configure API controllers
var content_controller = require('./js/api/content.js'),
    posts_controller = require('./js/api/posts.js'),
    feed_controller = require('./js/api/feed.js');

// Configure API Posts Route
router.get('/api/posts/by/:author', posts_controller.get);

// Configure API Feed Route
router.get('/api/feed/by/:author', feed_controller.get);

// Configure API Page Content Route
router.get('/api/content/of/:content_path', content_controller.get);

// Custom redirects
router.get('/readme.md',            function(request, response) { response.redirect('https://bitbucket.org/brendanmurty/murty.io/src/master/readme.md'); });
router.get('/license.md',           function(request, response) { response.redirect('https://bitbucket.org/brendanmurty/murty.io/src/master/license.md'); });
router.get('/code',                 function(request, response) { response.redirect('https://bitbucket.org/brendanmurty/murty.io'); });
router.get('/brendan/posts.json',   function(request, response) { response.sendFile(__dirname + '/content/brendan/posts/feed.json'); });

// System health check
router.get('/health-check',         function(request, response) { response.sendStatus(200); });

// Allow static content requests
app.use('/', router);
app.use(express.static(__dirname));

// Use Gzip compression
app.use(compression());

// Use Helmet to send correct HTTP headers for HTTPS connections
app.use(require('helmet')());

// Send all other requests to Angular
app.get('*', function (request, response) {
    response.sendFile('index.html', { 'root': __dirname });
});

// Start the HTTP server
app.listen(app_port, app_domain);
console.log('http server started at http://' + app_domain + ':' + app_port);

if (app_domain != 'localhost') {
    // Start the HTTPS server
    https.createServer(
        {
            cert: fs.readFileSync('./ssl/fullchain.pem'),
            key: fs.readFileSync('./ssl/privkey.pem')
        },
        app
    ).listen(443);

    console.log('https server started at https://' + app_domain + ':443');
}
