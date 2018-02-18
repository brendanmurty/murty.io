// Header controller
murtyApp.controller('headerCtrl', ['$scope', '$rootScope', '$location', '$http', '$q', 'siteSvc', function ($scope, $rootScope, $location, $http, $q, siteSvc) {
    // Initialise the website data properties
    $rootScope.sites = siteSvc.getSites();
    $rootScope.site = {};
    $rootScope.current_site = '';

    // Handle initial page tasks
    $rootScope.init = function(site_name) {
        // Empty the page content to avoid showing content from the previous page
        $rootScope.page_content = '';

        // Update the current site
        siteSvc.setCurrentSite(site_name);

        // Ensure all scope variables reflect their current assignments
        setTimeout(function () {
            $rootScope.$apply();
            $scope.$apply();

            // Attempt to set the current site again if it still isn't set
            if (typeof $rootScope.site == undefined) {
                setTimeout(function () {
                    siteSvc.setCurrentSite(site_name);
                    $rootScope.$apply();
                    $scope.$apply();
                }, 500);
            }
        }, 1000);

        // Save the current page URL so templates can access it
        $rootScope.current_location = $location.path();
    };
}]);
