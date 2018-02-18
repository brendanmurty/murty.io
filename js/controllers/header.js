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
        }, 2000);

        // Save the current page URL so templates can access it
        $rootScope.current_location = $location.path();
    };
}]);
