// Brendan Post controller
murtyApp.controller('brendanPostCtrl', ['$scope', '$rootScope', '$routeParams', 'pageSvc', function ($scope, $rootScope, $routeParams, pageSvc) {
    $rootScope.site_title = 'Brendan Murty';
    $rootScope.site_description = 'Brendan is a Project Manager and Senior Web Developer';
    $rootScope.site_author = 'Brendan Murty';
    $rootScope.site_index_link = '/brendan';

    $rootScope.icon_shortcut = 'images/brendan/favicon.png';
    $rootScope.icon_touch = 'images/brendan/apple-touch-icon-precomposed.png';

    $rootScope.class_page = 'brendan brendan_post';
    $rootScope.class_container = '';

    $rootScope.init();

    // Extract the Markdown content and send it to the template
    pageSvc.getPageContent('brendan/posts/' + $routeParams.post_name + '.md').then(function(content) {
        $rootScope.page_content = content.data;
        $rootScope.page_loading = false;
    });

    $scope.list_navigation = [
        { title: 'Home', link: '/brendan' },
        { title: 'About', link: '/brendan/about' },
        { title: 'Resumé', link: '/brendan/resume' },
        { title: 'Posts', link: '/brendan/posts' }
    ];
}]);
