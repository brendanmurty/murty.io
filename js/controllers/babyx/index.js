// Baby X Index controller
murtyApp.controller('babyxIndexCtrl', ['$scope', '$rootScope', 'pageSvc', 'siteSvc', function ($scope, $rootScope, pageSvc, siteSvc) {
    $rootScope.init('babyx');

    pageSvc.getPageContent('babyx/index.md').then(function(content) {
        $rootScope.page_content = content.data;
        $rootScope.page_loading = false;
    });

    $rootScope.class_page = 'babyx babyx_index';
    $rootScope.class_container = 'listing';
}]);
