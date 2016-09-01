var gulp       = require('gulp'),
    sass       = require('gulp-sass'),
    jshint     = require('gulp-jshint'),
    concat     = require('gulp-concat'),
    uglify     = require('gulp-uglify'),
    imagemin   = require('gulp-imagemin'),
    plumber    = require('gulp-plumber'),
    notify     = require('gulp-notify'),
    livereload = require('gulp-livereload'),
    fse        = require('fs-extra'),
    $          = require('gulp-load-plugins')();

var sassPaths = [
    'bower_components/foundation-sites/scss',
    'bower_components/motion-ui/src'
];

/**
 * Error handler
 */
var plumberErrorHandler = {
    errorHandler: notify.onError({
        title: 'Gulp',
        message: 'Error: <%= error.message %>'
    })
};

/**
 * Sass compilation
 */
gulp.task('sass', function() {
    gulp.src(['scss/*.scss', '!scss/admin.scss'])
        .pipe(plumber(plumberErrorHandler))
        .pipe(sass({
            includePaths: sassPaths,
            outputStyle: 'compressed'
        }))
        .pipe(concat('styles.css'))
        .pipe(notify('SASS compiled'))
        .pipe($.autoprefixer({
          browsers: ['last 2 versions', 'ie >= 9']
        }))
        .pipe(gulp.dest('./css'))
        .pipe(livereload());
});

/**
 * Sass compilation of admin .scss
 */
gulp.task('admin-sass', function() {
    gulp.src('scss/admin.scss')
        .pipe(plumber(plumberErrorHandler))
        .pipe(sass({
            includePaths: sassPaths,
            outputStyle: 'compressed'
        }))
        .pipe(notify('Admin SASS compiled'))
        .pipe(gulp.dest('./css'))
        .pipe(livereload());
});

/**
 * JSHint and concatenate .js files
 */
gulp.task('js', function() {
    gulp.src(['js/src/*.js', '!js/src/custom-tinymce-plugins.js', '!js/src/admin-scripts.js'])
        .pipe(plumber(plumberErrorHandler))
        .pipe(jshint())
        .pipe(jshint.reporter('fail'))
        .pipe(concat('scripts.min.js'))
        .pipe(uglify())
        .pipe(notify('JavaScript compiled'))
        .pipe(gulp.dest('js'))
        .pipe(livereload());
});

/**
 * JSHint and concatenate admin .js files
 */
gulp.task('admin-js', function() {
    gulp.src('js/src/admin-scripts.js')
        .pipe(plumber(plumberErrorHandler))
        .pipe(jshint())
        .pipe(jshint.reporter('fail'))
        .pipe(concat('admin-scripts.min.js'))
        .pipe(uglify())
        .pipe(notify('Admin JavaScript compiled'))
        .pipe(gulp.dest('js'))
        .pipe(livereload());
});

/**
 * JSHint and concatenate custom-tinymce-plugins .js files
 */
gulp.task('custom-tinymce-plugins-js', function() {
    gulp.src('js/src/custom-tinymce-plugins.js')
        .pipe(plumber(plumberErrorHandler))
        .pipe(jshint())
        .pipe(jshint.reporter('fail'))
        .pipe(concat('custom-tinymce-plugins.min.js'))
        .pipe(uglify())
        .pipe(notify('TinyMCE Custom Plugins JavaScript compiled'))
        .pipe(gulp.dest('js'))
        .pipe(livereload());
});

/**
 * Copy Foundation .js
 */
gulp.task('copy-files', function() {
    fse.copySync('bower_components/foundation-sites/dist/foundation.min.js', 'js/foundation.min.js');
});

/**
 * Imagemin compression
 */
gulp.task('img', function() {
    gulp.src('images/src/*.{png,jpg,dif}')
        .pipe(plumber(plumberErrorHandler))
        .pipe(imagemin({
            optimizationLevel: 7,
            progressive: true
        }))
        .pipe(notify('Images compressed'))
        .pipe(gulp.dest('images'))
        .pipe(livereload());
});

/**
 * Watch tasks
 */
gulp.task('watch', function() {
    livereload.listen();
    gulp.watch(['scss/*.scss', '!scss/admin.scss'], ['sass']);
    gulp.watch('scss/admin.scss', ['admin-sass']);
    gulp.watch(['js/src/*.js', '!js/src/admin-scripts.js'], ['js']);
    gulp.watch('js/src/admin-scripts.js', ['admin-js']);
    gulp.watch('js/src/custom-tinymce-plugins.js', ['custom-tinymce-plugins-js']);
    gulp.watch('images/src/*.{png,jpg,gif}', ['img']);
});

// Run the tasks
gulp.task('default', ['sass', 'admin-sass', 'js', 'admin-js', 'custom-tinymce-plugins-js', 'img', 'copy-files', 'watch']);
