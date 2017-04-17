// Isla controller
murtyApp.controller('islaCtrl', ['$scope', '$rootScope', 'pageSvc', function ($scope, $rootScope, pageSvc) {
    $rootScope.site_title = 'Isla Murty';
    $rootScope.site_description = 'Chip connoisseur. Cheeky.';
    $rootScope.site_author = 'Brendan Murty';
    $rootScope.site_index_link = '/isla';

    $rootScope.icon_shortcut = 'images/isla/favicon.png';
    $rootScope.icon_touch = '';

    pageSvc.getPageContent('isla/index.md').then(function(content) {
        $rootScope.page_content = content.data;
    });

    $rootScope.class_page = 'isla isla_index';
    $rootScope.class_container = 'listing avatars';

    $rootScope.init();
}]);
