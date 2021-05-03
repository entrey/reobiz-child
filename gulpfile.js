'use strict';

const {
  task,
  src,
  dest,
  watch,
  series,
  parallel
} = require('gulp');
const sass = require('gulp-sass');
const sourcemaps = require('gulp-sourcemaps');
const autoprefixer = require('gulp-autoprefixer');
const uglifycss = require('gulp-uglifycss');

const pathTo = {
  elementor: {
    scss: './elementor/scss/*.scss',
    css: './elementor/css/',
    cssMap: './maps',
  }
};

task('sass', (done) => {
  src(pathTo.elementor.scss)
    .pipe(sourcemaps.init())
    .pipe(sass().on('error', sass.logError))
    .pipe(autoprefixer({ cascade: false }))
    .pipe(uglifycss({"uglyComments": false}))
    .pipe(sourcemaps.write(pathTo.elementor.cssMap))
    .pipe(dest(pathTo.elementor.css));

  done();
});

task('watch', () => {
  watch(pathTo.elementor.scss, parallel('sass'));
});
