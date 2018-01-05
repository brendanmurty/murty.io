// Murty Index controller
murtyApp.controller('murtyIndexCtrl', ['$scope', '$rootScope', 'pageSvc', function ($scope, $rootScope, pageSvc) {
    $rootScope.site_title = 'Murty';
    $rootScope.site_description = 'Murty websites';
    $rootScope.site_author = 'Brendan Murty';
    $rootScope.site_index_link = '/';
    $rootScope.page_theme = '#00549d';
    $rootScope.page_icon = '/images/common/murty-192.png';

    pageSvc.getPageContent('murty/index.md').then(function(content) {
        $rootScope.page_content = content.data;
        $rootScope.page_loading = false;
    });

    $rootScope.class_page = 'murty murty_index';
    $rootScope.class_container = 'listing avatars';

    $rootScope.init();
}]);
