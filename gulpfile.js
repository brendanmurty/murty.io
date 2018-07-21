var gulp = require('gulp');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var minify = require('gulp-minify-css');

var css_files = [
    'app/styles/common.css',
    'app/styles/brendan.css',
    'app/styles/isla.css',
    'app/styles/freya.css',
    'app/styles/murty.css'
];

var js_files = [
    'node_modules/angular/angular.min.js',
    'node_modules/angular-route/angular-route.min.js',
    'node_modules/angular-sanitize/angular-sanitize.min.js',
    'node_modules/showdown/dist/showdown.min.js',
    'node_modules/ng-showdown/dist/ng-showdown.min.js',
    'app/app.js',
    'app/router.js',
    'app/services/site.js',
    'app/services/page.js',
    'app/controllers/header.js',
    'app/controllers/murty/index.js',
    'app/controllers/isla/index.js',
    'app/controllers/freya/index.js',
    'app/controllers/brendan/index.js',
    'app/controllers/brendan/posts.js',
    'app/controllers/brendan/post.js',
    'app/controllers/brendan/page.js'
];

gulp.task('js', function() {
    gulp.src(js_files).pipe(concat('murty.min.js')).pipe(uglify()).pipe(gulp.dest('app/build/'));
});

gulp.task('css', function() {
    gulp.src(css_files).pipe(concat('murty.min.css')).pipe(minify()).pipe(gulp.dest('app/build/'));
});

gulp.task('watch', function() {
  gulp.watch(css_files, gulp.series('css'));
  gulp.watch(js_files, gulp.series('js'));
});

gulp.task('default', gulp.parallel('js', 'css', 'watch'));
