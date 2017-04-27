// Header controller
murtyApp.controller('headerCtrl', ['$scope', '$rootScope', '$location', '$http', '$q', function ($scope, $rootScope, $location, $http, $q) {
    // Get the domain of the request
    $rootScope.domain = $location.host();

    // Set suitable defaults to minimise content loading effect on usability
    $rootScope.site_title = 'Murty';
    $rootScope.page_content = '';
    $rootScope.page_loading = true;

    // Handle initial page tasks
    $rootScope.init = function() {
        // Ensure all scope variables reflect their current assignments
        setTimeout(function () {
            $rootScope.$apply();
            $scope.$apply();
        }, 2000);

        // Save the current page URL so templates can access it
        $rootScope.current_location = $location.path();
    };
}]);
