// Brendan Post controller
murtyApp.controller('brendanPostCtrl', ['$scope', '$rootScope', '$routeParams', 'pageSvc', function ($scope, $rootScope, $routeParams, pageSvc) {
    $rootScope.site_title = 'Brendan Murty';
    $rootScope.site_description = 'Brendan is a Senior Web Developer based in Sydney, Australia.';
    $rootScope.site_author = 'Brendan Murty';
    $rootScope.site_index_link = '/brendan';
    $rootScope.page_theme = '#171d1c';
    $rootScope.page_icon = '/images/brendan/icon-192.png';
    $rootScope.feed_title = 'Posts by Brendan Murty';
    $rootScope.feed_url = 'https://murty.io/brendan/posts.json';

    $rootScope.class_page = 'brendan brendan_post';
    $rootScope.class_container = '';

    $rootScope.init();

    var post_name = $routeParams.post_name;

    // Custom post name fixes for old URLs
    if (post_name == 'farewell-upcomingtasks') {
        post_name = '20161014_farewell-upcomingtasks';
    }

    // Extract the Markdown content and send it to the template
    pageSvc.getPageContent('brendan/posts/' + post_name + '.md').then(function(content) {
        $rootScope.page_title = pageSvc.getPageTitle(post_name) + ' - ' + $rootScope.site_title;

        $rootScope.page_content = content.data;

        // Show the posted date in a footer element
        post_date = pageSvc.getPostDate(post_name);
        if (post_date) {
            $rootScope.page_content = content.data + '<footer>Posted ' + post_date + ' by <a href="/brendan">Brendan</a>. Subscribe using the <a href="' + $rootScope.feed_url + '">JSON Feed</a></footer>';
        }

        $rootScope.page_loading = false;
    });
}]);
