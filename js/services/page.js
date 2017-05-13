// Page service
murtyApp.factory('pageSvc', ['$http', '$q', '$filter', function ($http, $q, $filter) {
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

    // Extract the post date from a post name
    // and return it in a more suitable format
    pageSvc.getPostDate = function(post_name) {
        post_date = post_name.substring(0, 8);

        return $filter('date')(post_date + 'T00:00:00.000Z', 'd MMM yyyy', 'en_AU');
    };

    return pageSvc;
}]);
