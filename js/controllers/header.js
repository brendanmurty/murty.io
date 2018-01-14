// Header controller
murtyApp.controller('headerCtrl', ['$scope', '$rootScope', '$location', '$http', '$q', function ($scope, $rootScope, $location, $http, $q) {
    // Get the domain of the request
    $rootScope.domain = $location.host();

    // Set suitable defaults to minimise content loading effect on usability
    $rootScope.site_title = 'Murty';
    $rootScope.page_title = '';
    $rootScope.page_content = '';
    $rootScope.page_loading = true;
    $rootScope.page_theme = '#00549d';
    $rootScope.page_icon = '/images/common/murty-192.png';
    $rootScope.feed_title = '';
    $rootScope.feed_url = '';

    // Handle initial page tasks
    $rootScope.init = function() {
        // Empty the page content to avoid showing content from the previous page
        $rootScope.page_content = '';

        // Ensure all scope variables reflect their current assignments
        setTimeout(function () {
            $rootScope.$apply();
            $scope.$apply();
        }, 2000);

        // Save the current page URL so templates can access it
        $rootScope.current_location = $location.path();
    };
}]);
