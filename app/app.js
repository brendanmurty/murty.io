// Initialise an Angular module
var murtyApp = angular.module('murtyApp', ['ngRoute', 'ng-showdown']);

murtyApp.config(['$locationProvider', function($locationProvider) {
    // Enable HTML 5 mode to make URLs more human friendly
    $locationProvider.html5Mode({
        enabled: true
    });
}]);

murtyApp.config(['$qProvider', function ($qProvider) {
    // Hide "Unhandled Rejection" errors
    $qProvider.errorOnUnhandledRejections(false);
}]);
