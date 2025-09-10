const { src, dest, watch, series } = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const sourcemaps = require('gulp-sourcemaps');
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');
const browserSync = require('browser-sync').create();

// Tarea para compilar Sass
function css() {
    return src('./public/scss/**/*.scss')
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(postcss([autoprefixer()]))
        .pipe(sourcemaps.write('.'))
        .pipe(dest('./public/assets/css'))
        .pipe(browserSync.stream());
}

// Tarea para iniciar BrowserSync con proxy a PHP
function dev() {
    browserSync.init({
        proxy: "http://localhost:8000", // Servidor PHP embebido
        open: true,
        port: 3000
    });
    watch('./public/scss/**/*.scss', css);
    watch('./public/**/*.php').on('change', browserSync.reload);
}

// Exporta las tareas
exports.css = css;
exports.dev = dev;
exports.default = series(css, dev);
