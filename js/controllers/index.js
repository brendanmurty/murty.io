// Index controller
murtyApp.controller('indexCtrl', ['$scope', '$rootScope', 'pageSvc', function ($scope, $rootScope, pageSvc) {
    $rootScope.site_title = 'Murty';
    $rootScope.site_description = 'Murty websites';
    $rootScope.site_author = 'Brendan Murty';
    $rootScope.site_index_link = '/';

    $rootScope.icon_shortcut = 'images/common/server.png';
    $rootScope.icon_touch = '';

    pageSvc.getPageContent('murty/index.md').then(function(content) {
        $rootScope.page_content = content.data;
    });

    $rootScope.class_page = 'murty murty_index';
    $rootScope.class_container = 'listing avatars';

    $rootScope.init();
}]);
