// Isla Index controller
murtyApp.controller('islaIndexCtrl', ['$scope', '$rootScope', 'pageSvc', 'siteSvc', function ($scope, $rootScope, pageSvc, siteSvc) {
    $rootScope.init('isla');

    pageSvc.getPageContent('isla/index.md').then(function(content) {
        $rootScope.page_content = content.data;
        $rootScope.page_loading = false;
    });

    $rootScope.class_page = 'isla isla_index';
    $rootScope.class_container = 'listing';
}]);
