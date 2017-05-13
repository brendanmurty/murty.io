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

    // Create a more human readable page title
    pageSvc.getPageTitle = function(page_name) {
        if (!isNaN(page_name.substring(0, 8))) {
            // This is a post, remove the date and convert dividers
            page_name = page_name.substring(9);
            page_name = page_name.replace(/-/g, ' ');
        }

        // Make each word start with a capitalised letter
        page_title = page_name.toLowerCase();
        page_title = page_title.replace(
            /(^([a-zA-Z\p{M}]))|([ -][a-zA-Z\p{M}])/g,
          	function(s){
          	  return s.toUpperCase();
        	}
        );

        // Customise title content
        if (page_title == 'Resume') {
            page_title = 'Resumé';
        }

        // Correct some capitalisation
        page_title = page_title.replace(/upcomingtasks/gi, 'UpcomingTasks');
        page_title = page_title.replace(/api/gi, 'API');

        return page_title;
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
