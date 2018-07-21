// Page service
murtyApp.factory('pageSvc', ['$http', '$q', '$filter', function ($http, $q, $filter) {
    var pageSvc = {};

    // Extract content from a Markdown file
    pageSvc.getPageContent = function(markdown_file_path) {
        var deferred = $q.defer(),
            markdown_id = markdown_file_path.replace(/.md/, '').replace(/\//g, '--');

        $http({
            method: 'GET',
            url: '/api/content/of/' + markdown_id
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
        var page_title = page_name.toLowerCase();
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
            url: '/api/posts/by/brendan'
        }).then(function (posts) {
            deferred.resolve(posts);
        });

        return deferred.promise;
    };

    // Extract the post date from a post name
    // and return it in a more suitable format
    pageSvc.getPostDate = function(post_name) {
        post_date = post_name.substring(0, 8);

        if (!isNaN(post_date)) {
            return $filter('date')(post_date + 'T00:00:00.000Z', 'd MMM yyyy', 'en_AU');
        } else {
            return '';
        }
    };

    return pageSvc;
}]);
