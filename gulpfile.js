var gulp = require('gulp'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'),
    minify = require('gulp-minify-css'),
    less = require('gulp-less');

var less_files = [
    'app/styles/*.less'
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
    gulp.src(js_files)
        .pipe(concat('murty.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest('app/build/'));
});

gulp.task('css', function() {
    gulp.src(less_files, '!app/styles/_*.less')
        .pipe(less())
        .pipe(concat('murty.min.css'))
        .pipe(minify())
        .pipe(gulp.dest('app/build/'));
});

gulp.task('watch', function() {
    gulp.watch(less_files, gulp.series('css'));
    gulp.watch(js_files, gulp.series('js'));
});

gulp.task('default', gulp.parallel(
    'js',
    'css',
    'watch'
));
