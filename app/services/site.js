// Site service
murtyApp.factory('siteSvc', ['$rootScope', '$http', '$q', function ($rootScope, $http, $q) {
    var siteSvc = {};

    // Return the full array of site data
    siteSvc.getSites = function() {
        var deferred = $q.defer();

        $http({
            method: 'GET',
            url: '/api/sites'
        }).then(function (sites_file_content) {
            deferred.resolve(sites_file_content.data);
            $rootScope.sites = sites_file_content.data;
        });

        return deferred.promise;
    };

    // Return an array of a site's data
    siteSvc.getSite = function(site_name) {
        return $rootScope.sites[site_name];
    };

    // Return a value of a site's property
    siteSvc.getSiteProperty = function(site_name, property) {
        return $rootScope.sites[site_name][property];
    };

    // Set the current site
    siteSvc.setCurrentSite = function(site_name) {
        $rootScope.current_site = site_name;
        $rootScope.site = siteSvc.getSite(site_name);
    };

    // Get the current site's data
    siteSvc.getCurrentSite = function() {
        return $rootScope.site;
    };

    return siteSvc;
}]);
