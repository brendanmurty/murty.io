// Brendan Posts controller
murtyApp.controller('brendanPostsCtrl', ['$scope', '$rootScope', '$routeParams', 'pageSvc', function ($scope, $rootScope, $routeParams, pageSvc) {
    $rootScope.site_title = 'Brendan Murty';
    $rootScope.site_description = 'Brendan is a Senior Web Developer based in Sydney, Australia.';
    $rootScope.site_author = 'Brendan Murty';
    $rootScope.site_index_link = '/brendan';
    $rootScope.page_theme = '#171d1c';
    $rootScope.page_icon = '/images/brendan/icon-192.png';

    $rootScope.class_page = 'brendan brendan_posts';
    $rootScope.class_container = '';

    $rootScope.init();

    $rootScope.page_title = 'Posts - ' + $rootScope.site_title;

    // Load the posts list
    pageSvc.getPostsByBrendan().then(function(content) {
        $scope.list_posts = content.data;
        $rootScope.page_loading = false;
    });
}]);
