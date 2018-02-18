// Brendan Index controller
murtyApp.controller('brendanIndexCtrl', ['$scope', '$rootScope', '$routeParams', 'pageSvc', 'siteSvc', function ($scope, $rootScope, $routeParams, pageSvc, siteSvc) {
    $rootScope.init('brendan');

    $rootScope.page_title = siteSvc.getSiteProperty('brendan', 'site_title');
    $rootScope.class_page = 'brendan brendan_index';
    $rootScope.class_container = '';

    // Default to Brendan's index content
    var page_content_url = 'brendan/index.md';

    if ($routeParams.page_name) {
        // Page request
        page_content_url = 'brendan/' + $routeParams.page_name + '.md';
        $rootScope.class_page = 'brendan brendan_' + $routeParams.page_name;
    } else if ($routeParams.post_name) {
        // Post request
        page_content_url = 'brendan/posts/' + $routeParams.post_name + '.md';
        $rootScope.class_page = 'brendan brendan_post';
    }

    // Extract the Markdown content and send it to the template
    if (page_content_url) {
        pageSvc.getPageContent(page_content_url).then(function(content) {
            $rootScope.page_content = content.data;
            $rootScope.page_loading = false;
        });
    }
}]);
