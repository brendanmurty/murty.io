// Murty Index controller
murtyApp.controller('murtyIndexCtrl', ['$scope', '$rootScope', 'pageSvc', 'siteSvc', function ($scope, $rootScope, pageSvc, siteSvc) {
    $rootScope.init('murty');

    $rootScope.class_page = 'murty murty_index';
    $rootScope.class_container = 'listing avatars';

    pageSvc.getPageContent('murty/index.md').then(function(content) {
        $rootScope.page_content = content.data;
        $rootScope.page_loading = false;
    });
}]);
