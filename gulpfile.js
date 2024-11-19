var gulp = require('gulp');
var cssnano = require('gulp-cssnano');
var browserSync = require('browser-sync').create();
//const uglify = require('rollup-plugin-uglify');
const sourcemaps = require('gulp-sourcemaps');
const sass = require('gulp-sass')(require('sass'));

// Tarea para compilar Sass
gulp.task('sass', () => {
    return gulp.src("./sass/*.scss")
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError)) // Manejo de errores
        .pipe(cssnano())
        .pipe(sourcemaps.write("."))
        .pipe(gulp.dest("dist/"))
        .pipe(browserSync.stream());
});

// Tarea para comprimir JavaScript, de momento no la usamos
gulp.task('compress_js', function() {
    return gulp.src([
        './js/*.js',
    ])
    .pipe(gulp.dest('./dist/js'))
});

// Tarea para iniciar el servidor y observar cambios
//gulp.task('start', gulp.series('sass', 'compress_js', function() {
    gulp.task('start', gulp.series('sass', function() {
    browserSync.init({
        //proxy: "http://localhost:8212/www8212/dswpbase",
        proxy: "https://arabat.local.com",
        notify: false
    });

    gulp.watch("sass/*.scss", gulp.series('sass'));
    gulp.watch("./*.html").on('change', browserSync.reload);
}));

// Tarea por defecto
gulp.task('default', gulp.series('start'));
