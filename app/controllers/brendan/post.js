// Brendan Post controller
murtyApp.controller('brendanPostCtrl', ['$scope', '$rootScope', '$routeParams', 'pageSvc', 'siteSvc', function ($scope, $rootScope, $routeParams, pageSvc, siteSvc) {
    $rootScope.init('brendan');

    $rootScope.class_page = 'brendan brendan_post';
    $rootScope.class_container = '';

    var post_name = $routeParams.post_name;

    // Custom post name fixes for old URLs
    if (post_name == 'farewell-upcomingtasks') {
        post_name = '20161014_farewell-upcomingtasks';
    }

    // Extract the Markdown content and send it to the template
    pageSvc.getPageContent('brendan/posts/' + post_name + '.md').then(function(content) {
        $rootScope.page_title = pageSvc.getPageTitle(post_name) + ' - ' + siteSvc.getSiteProperty('brendan', 'title');

        $rootScope.page_content = content.data;

        $rootScope.page_loading = false;
    });
}]);
