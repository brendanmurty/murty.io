// Page service
murtyApp.factory('pageSvc', ['$http', '$q', function ($http, $q) {
    var pageSvc = {};

    // Extract content from a Markdown file
    pageSvc.getPageContent = function(markdown_file_path) {
        var deferred = $q.defer();

        $http({
            method: 'GET',
            url: '/api/page_content.php?path=' + markdown_file_path
        }).then(function (markdown_file_content) {
            deferred.resolve(markdown_file_content);
        });

        return deferred.promise;
    };

    // Extract a list of all of Brendan's posts
    pageSvc.getPostsByBrendan = function() {
        var deferred = $q.defer();

        $http({
            method: 'GET',
            url: '/api/post_list.php'
        }).then(function (posts) {
            deferred.resolve(posts);
        });

        return deferred.promise;
    };

    return pageSvc;
}]);
