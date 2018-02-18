// Murty Index controller
murtyApp.controller('murtyIndexCtrl', ['$scope', '$rootScope', 'pageSvc', 'siteSvc', function ($scope, $rootScope, pageSvc, siteSvc) {
    $rootScope.init('murty');

    $rootScope.class_page = 'murty murty_index';
    $rootScope.class_container = 'listing avatars';

    // This page will automatically list websites from "sites.json"
}]);
