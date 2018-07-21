// Baby X Index controller
murtyApp.controller('freyaIndexCtrl', ['$scope', '$rootScope', 'pageSvc', 'siteSvc', function ($scope, $rootScope, pageSvc, siteSvc) {
    $rootScope.init('freya');

    pageSvc.getPageContent('freya/index.md').then(function(content) {
        $rootScope.page_content = content.data;
        $rootScope.page_loading = false;
    });

    $rootScope.class_page = 'freya freya_index';
    $rootScope.class_container = 'listing';
}]);
