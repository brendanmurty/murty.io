var gulp = require('gulp');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var minify = require('gulp-minify-css');

var css_files = [
    'css/common.css',
    'css/brendan.css',
    'css/isla.css',
    'css/murty.css'
];

var js_files = [
    'bower_components/angular/angular.min.js',
    'bower_components/angular-route/angular-route.min.js',
    'bower_components/angular-sanitize/angular-sanitize.min.js',
    'bower_components/showdown/dist/showdown.min.js',
    'bower_components/ng-showdown/dist/ng-showdown.min.js',
    'js/app.js',
    'js/router.js',
    'js/services/page.js',
    'js/controllers/header.js',
    'js/controllers/murty/index.js',
    'js/controllers/isla/index.js',
    'js/controllers/brendan/index.js',
    'js/controllers/brendan/posts.js',
    'js/controllers/brendan/post.js',
    'js/controllers/brendan/page.js',
];

gulp.task('js', function() {
    gulp.src(js_files).pipe(concat('murty.min.js')).pipe(uglify()).pipe(gulp.dest('js/build/'));
});

gulp.task('css', function() {
    gulp.src(css_files).pipe(concat('murty.min.css')).pipe(minify()).pipe(gulp.dest('css/build/'));
});

gulp.task('watch', function() {
  gulp.watch(css_files, ['css']);
  gulp.watch(js_files, ['js']);
});

gulp.task('default', ['js', 'css', 'watch'], function(){});
