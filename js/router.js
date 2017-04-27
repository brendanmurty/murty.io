// Router
murtyApp.config(['$routeProvider', function ($routeProvider, $location) {
    $routeProvider
        .when(
            "/",
            {
                templateUrl: "html/murty/index.html",
                controller: "indexCtrl"
            }
        )
        .when(
            "/brendan",
            {
                templateUrl: "html/brendan/index.html",
                controller: "brendanCtrl"
            }
        )
        .when(
            "/brendan/posts",
            {
                templateUrl: "html/brendan/posts.html",
                controller: "brendanPostsCtrl"
            }
        )
        .when(
            "/brendan/:page_name",
            {
                templateUrl: "html/brendan/index.html",
                controller: "brendanCtrl"
            }
        )
        .when(
            "/brendan/post/:post_name",
            {
                templateUrl: "html/brendan/post.html",
                controller: "brendanCtrl"
            }
        )
        .when(
            "/isla",
            {
                templateUrl: "html/isla/index.html",
                controller: "islaCtrl"
            }
        ).otherwise({
			redirectTo: '/'
		});
}]);
