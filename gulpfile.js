var gulp = require('gulp');
var cleanCSS = require('gulp-clean-css');
var concat = require('gulp-concat');
var rename = require('gulp-rename');
var uglify = require('gulp-uglify-es').default;

function styles() {
    return gulp.src([
            'resources/css/_variables.css',
            'resources/css/common.css',
            'resources/css/murty.css',
            'resources/css/brendan.css',
            'resources/css/freya.css',
            'resources/css/isla.css',
            'resources/css/gallery.css'
        ])
        .pipe(concat('styles.min.css'))
        .pipe(cleanCSS())
        .pipe(gulp.dest('public/css/'));
}

function scripts() {
    return gulp.src('resources/js/gallery.js')
        .pipe(uglify())
        .pipe(rename('gallery.min.js'))
        .pipe(gulp.dest('public/js/'));
}

exports.default = gulp.series(styles, scripts);
