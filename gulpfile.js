var gulp = require('gulp'),
    browserSync = require('browser-sync'),
    concatCss = require('gulp-concat-css'),
    autoPrefix = require('gulp-autoprefixer');

//Concat
gulp.task('concat', function(){
    return gulp.src('css/*.css')
        .pipe(concatCss('main.css'))
        .pipe(autoPrefix())
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
    gulp.watch('css/*.css', ['concat']);
    gulp.watch([
        'app/*.html',
        'app/js/*.js',
        'app/css/*.css'
    ]).on('change', browserSync.reload);
});

//Default
gulp.task('default', ['concat', 'server', 'watch']);