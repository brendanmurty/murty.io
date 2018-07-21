// Brendan Page controller
murtyApp.controller('brendanPageCtrl', ['$scope', '$rootScope', '$routeParams', 'pageSvc', 'siteSvc', function ($scope, $rootScope, $routeParams, pageSvc, siteSvc) {
    $rootScope.init('brendan');

    $rootScope.class_page = 'brendan brendan_' + $routeParams.page_name;
    $rootScope.class_container = '';

    var page_name = $routeParams.page_name;

    if (page_name == 'about') {
        // Use "index.md" for content when the "about" page is requested
        page_name = 'index';
    }

    // Extract the Markdown content and send it to the template
    pageSvc.getPageContent('brendan/' + page_name + '.md').then(function(content) {
        $rootScope.page_title = pageSvc.getPageTitle($routeParams.page_name) + ' - ' + siteSvc.getSiteProperty('brendan', 'title');

        $rootScope.page_content = content.data;

        $rootScope.page_loading = false;
    });
}]);
