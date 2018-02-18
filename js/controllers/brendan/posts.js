// Brendan Posts controller
murtyApp.controller('brendanPostsCtrl', ['$scope', '$rootScope', '$routeParams', 'pageSvc', 'siteSvc', function ($scope, $rootScope, $routeParams, pageSvc, siteSvc) {
    $rootScope.init('brendan');

    $rootScope.class_page = 'brendan brendan_posts';
    $rootScope.class_container = '';

    $rootScope.page_title = 'Posts - ' + $rootScope.site_title;

    // Load the posts list
    pageSvc.getPostsByBrendan().then(function(content) {
        $scope.list_posts = content.data;
        $rootScope.page_loading = false;
    });
}]);
