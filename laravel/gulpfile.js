const gulp = require('gulp'),
  rename = require('gulp-rename'),
  autoprefixer = require('gulp-autoprefixer'),
  sass = require('gulp-sass'),
  imagemin = require('gulp-imagemin'),
  imageminJpegOptim = require('imagemin-jpegoptim'),
  concat = require('gulp-concat'),
  uglify = require('gulp-uglify'),
  gutil = require('gulp-util');

const SRC = 'resources/assets/',
  JS = `${SRC}js/**/`,
  SASS = `${SRC}sass/**/`,
  IMG = `${SRC}images/**/`,
  FILES = `${SRC}files/**/`,
  DEST = '../public_html/',
  PRODUCTION = gutil.env.NODE_ENV === 'production';

gulp.task('sass', () => {
  return gulp.src(`${SASS}app.scss`)
    .pipe(sass().on('error', sass.logError))
    .pipe(autoprefixer({
      browsers: ['last 4 versions'],
      cascade: false
    }))
    .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest(`${DEST}css`));
});

gulp.task('js', () => {
  return gulp.src([
    PRODUCTION ? `${JS}disable-logs.js` : '',
    `${JS}app.js`
  ])
    .pipe(concat('app.js'))
    .pipe(minifyIfNeeded())
    .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest(`${DEST}js`));
});

gulp.task('files', () => {
  return gulp.src(`${FILES}**/*.*`)
    .pipe(gulp.dest(`${DEST}files`));
});

gulp.task('images', () => {
  return gulp.src([
    `${IMG}*.png`,
    `${IMG}*.jpeg`,
    `${IMG}*.jpg`,
    `${IMG}*.gif`,
    `${IMG}*.svg`
  ])
    .pipe(imagemin([
      imagemin.gifsicle({interlaced: true}),
      imageminJpegOptim({
        progressive: true,
        max: 50
      }),
      imagemin.optipng({optimizationLevel: 7})
    ]))
    .pipe(gulp.dest(`${DEST}images`));
});

gulp.task('watch', () => {
  gulp.watch(`${SASS}**/*.scss`, ['sass']);
  gulp.watch(`${IMG}**/*.*`, ['images']);
  gulp.watch(`${JS}**/*.js`, ['js']);
  gulp.watch(`${FILES}**/*.*`, ['files']);
});

gulp.task('build', ['sass', 'js', 'images', 'files']);
gulp.task('default', ['build']);

function minify() {
  return uglify().on('error', function (err) {
    gutil.log(gutil.colors.red('[Error]'), err.toString());
    this.emit('end');
  });
}

function minifyIfNeeded() {
  return PRODUCTION ? minify() : gutil.noop();
}
