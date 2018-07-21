// Router
murtyApp.config(['$routeProvider', function ($routeProvider, $location) {
    $routeProvider.when(
        '/',
        {
            templateUrl: 'app/templates/murty/index.html',
            controller: 'murtyIndexCtrl'
        }
    ).when(
        '/brendan',
        {
            templateUrl: 'app/templates/brendan/index.html',
            controller: 'brendanIndexCtrl'
        }
    ).when(
        '/brendan/posts',
        {
            templateUrl: 'app/templates/brendan/posts.html',
            controller: 'brendanPostsCtrl'
        }
    ).when(
        '/brendan/:page_name',
        {
            templateUrl: 'app/templates/brendan/page.html',
            controller: 'brendanPageCtrl'
        }
    ).when(
        '/brendan/post/:post_name',
        {
            templateUrl: 'app/templates/brendan/post.html',
            controller: 'brendanPostCtrl'
        }
    ).when(
        '/isla',
        {
            templateUrl: 'app/templates/isla/index.html',
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
            templateUrl: 'app/templates/freya/index.html',
            controller: 'freyaIndexCtrl'
        }
    ).otherwise(
        {
		    redirectTo: '/'
	    }
    );
}]);
