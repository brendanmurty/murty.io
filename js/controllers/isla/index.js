// Isla Index controller
murtyApp.controller('islaIndexCtrl', ['$scope', '$rootScope', 'pageSvc', function ($scope, $rootScope, pageSvc) {
    $rootScope.site_title = 'Isla Murty';
    $rootScope.site_description = 'Loves salt and vinegar chips and plain crackers with Philadelphia.';
    $rootScope.site_author = 'Brendan Murty';
    $rootScope.site_index_link = '/isla';
    $rootScope.page_theme = '#14b3fb';
    $rootScope.page_icon = '/images/isla/icon-192.png';

    pageSvc.getPageContent('isla/index.md').then(function(content) {
        $rootScope.page_content = content.data;
        $rootScope.page_loading = false;
    });

    $rootScope.class_page = 'isla isla_index';
    $rootScope.class_container = 'listing';

    $rootScope.init();
}]);
