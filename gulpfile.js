var gulp = require('gulp'),
    browserSync = require('browser-sync'),
    concatCss = require('gulp-concat-css'),
    autoPrefix = require('gulp-autoprefixer');

//Concat
gulp.task('concat', function(){
    return gulp.src('css/*.css')
        .pipe(concatCss('main.css'))
        .pipe(gulp.dest('app/css'));
});

//Prefix
gulp.task('prefix', function(){
    return gulp.src('app/css/*.css')
        .pipe(autoPrefix({
            browsers: ['> 1%', 'IE 8'],
            cascade: false
        }))
        .pipe(gulp.dest('app/css'));
});

//Server
gulp.task('server', function(){
    browserSync({
        port: 9000,
        server: {
            baseDir: 'app'
        }
    });
});

//Watch
gulp.task('watch', function(){
    //gulp.watch('css/*.css', ['concat']);
    gulp.watch([
        'app/*.html',
        'app/*.php',
        'app/js/*.js',
        'app/css/*.css'
    ]).on('change', browserSync.reload);
});

//Default
gulp.task('default', ['prefix', 'server', 'watch']);