// Router
murtyApp.config(['$routeProvider', function ($routeProvider, $location) {
    $routeProvider.when(
        '/',
        {
            templateUrl: 'html/murty/index.html',
            controller: 'murtyIndexCtrl'
        }
    ).when(
        '/brendan',
        {
            templateUrl: 'html/brendan/index.html',
            controller: 'brendanIndexCtrl'
        }
    ).when(
        '/brendan/posts',
        {
            templateUrl: 'html/brendan/posts.html',
            controller: 'brendanPostsCtrl'
        }
    ).when(
        '/brendan/:page_name',
        {
            templateUrl: 'html/brendan/page.html',
            controller: 'brendanPageCtrl'
        }
    ).when(
        '/brendan/post/:post_name',
        {
            templateUrl: 'html/brendan/post.html',
            controller: 'brendanPostCtrl'
        }
    ).when(
        '/isla',
        {
            templateUrl: 'html/isla/index.html',
            controller: 'islaIndexCtrl'
        }
    ).when(
        '/babyx',
        {
            redirectTo: '/freya'
        }
    ).when(
        '/freya',
        {
            templateUrl: 'html/freya/index.html',
            controller: 'freyaIndexCtrl'
        }
    ).otherwise(
        {
		    redirectTo: '/'
	    }
    );
}]);
