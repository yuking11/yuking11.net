'use strict';
/**
 * gulp-config
 */
require('@babel/register');
import gulp from 'gulp';
/**
 * site config
 */
import config from './config.js';
const conf  = config.base;
const paths = config.path;
const isWin = process.platform === 'win32';
const isMac = process.platform === 'darwin';
const isLinux = process.platform === 'linux';
/*
 * gulp-load-plugins
 *   gulp-connect-php / gulp-consolidate / gulp-iconfont
 *   gulp-imageoptim / gulp-load-plugins / gulp-notify
 *   gulp-phplint / gulp-plumber / gulp-rename
 */
import gulpLoadPlugins from 'gulp-load-plugins';
const $ = gulpLoadPlugins();
/*
 * Other Plugins
 */
// Browser Sync
import browserSync from 'browser-sync';
const bs = browserSync.create();
// webpack
import wp from 'webpack';
import wpStream from 'webpack-stream';
import wpConfig from './webpack.config.js';
import wpConfigProd from './webpack.config.prod.js';


/**
 * PHP Settings
 */
let phpOptions = {};
if ( isWin ) {
  phpOptions = {
    port: 8001,
    base: conf.phpBase,
    bin: 'C:/php/' + conf.phpVer + '/php.exe',
    ini: 'C:/php/' + conf.phpVer + '/php.ini'
  }
} else {
  phpOptions = {
    port: 8001,
    base: conf.phpBase
  }
}


/**
 * BrowserSync Settings
 */
let bsOptions  = {};
if ( conf.env === 'local' ) {
  bsOptions = {
    proxy: conf.url,// 経由するURL
    open:  'external'// URLをUPで開く
  }
} else {
  bsOptions = {
    port:   8000,
    proxy:  'localhost:8001',
    open:   'external'// URLをUPで開く
  }
}


/**
 * gulp.tasks
 */

// Watch
export const watch = () => {
  gulp.watch(
    [
      paths.sass + '/**/*.scss',
      paths.srcScripts + '/**/*.js',
      paths.srcScripts + '/**/*.vue'
    ],
    webpack
  );
  gulp.watch( paths.dest + '/**/*.php', html );
  gulp.watch( paths.dest + '/**/*.php', phpLint );
}

// js ES2015 WebPack
export const webpack = () => {
  return wpStream(wpConfig, wp)
    .pipe($.plumber())
    .pipe(gulp.dest( paths.assets ))
    .pipe(bs.reload({ stream: true }));
}
// Production
export const webpackProd = () => {
  return wpStream(wpConfigProd, wp)
    .pipe($.plumber())
    .pipe(gulp.dest( paths.assets ))
    .pipe(bs.reload({ stream: true }));
}

// HTML
export const html = () => {
  return gulp.src(paths.themes + '/**/*.php')
    .pipe($.plumber({
        errorHandler: $.notify.onError("Error: <%= error.message %>")
    }))
    // .pipe($.plumber())
    .pipe(bs.reload({stream: true}));
}
// lint
export const phpLint = () => {
  return gulp.src(paths.themes + '/**/*.php')
    .pipe($.plumber({
        errorHandler: $.notify.onError("Error: <%= error.message %>")
    }))
    // .pipe($.plumber())
    .pipe($.phplint())
    .pipe($.phplint.reporter());
}

// BrowserSync
export const server = () => {
  if ( conf.env === 'local' ) {
    bs.init( bsOptions );
  } else if ( conf.env === 'current' ) {
    $.connectPhp.server(
      phpOptions,
      function () {
        bs.init( bsOptions );
      }
    );
  }
}


/**
 * gulp option tasks
 */

// sprite
export const sprite = () => {
  const spriteData = gulp.src( paths.images + '/sprites/*.png' )
    .pipe($.spritesmith({
      imgName: 'sprite.png',
      imgPath: '../img/sprite.png',
      cssName: '_sprites.scss',
      padding: 40
  }));
  spriteData.img.pipe(gulp.dest( paths.images ));
  return spriteData.css.pipe(gulp.dest( paths.sass + '/object/modules' ));
}

// sprite ( retina )
export const spriter = () => {
  const spriteData = gulp.src( paths.images + '/sprites/*.png' )
    .pipe($.spritesmith({
      retinaSrcFilter: paths.images + '/sprites/*-2x.png',
      imgName: 'sprite.png',
      retinaImgName: 'sprite-2x.png',
      imgPath: '../img/sprite.png',
      retinaImgPath: paths.images + '/sprite-2x.png',
      cssName: '_sprites.scss',
      padding: 40
  }));
  spriteData.img.pipe(gulp.dest( paths.images ));
  return spriteData.css.pipe(gulp.dest( paths.sass + '/object/modules' ));
}

// iconfont
export const font = () => {
  const fontName = 'icon';
  return gulp.src( paths.srcFonts + '/*.svg' )
    .pipe( $.iconfont( {
      normalize : true,
      fontName: fontName,
      appendCodepoints: true,
      startUnicode: 0xF001,
      fontHeight: 1001
    } ) )
    .on('glyphs', (glyphs) => {
    // .on( 'codepoints', function( codepoints ) {
      const options = {
        glyphs: glyphs.map( (glyph) => {
          // this line is needed because gulp-iconfont has changed the api from 2.0
          return { name: glyph.name, codepoint: glyph.unicode[0].charCodeAt(0) }
        }),
        fontName  : fontName,
        className : fontName,
        fontPath  : '../fonts/',
        cssPath   : '/assets/css/app.css',
        timeStamp : Date.now()
      };
      // CSS
      gulp.src( './src/_icons/template.css' )
        .pipe( $.consolidate( 'lodash', options ) )
        .pipe( $.rename( {
          basename: '_iconfont',
          extname: '.scss'
        } ) )
        .pipe( gulp.dest( paths.sass + '/object/modules' ) );
      // フォント一覧 HTML
      gulp.src( './src/_icons/template.php' )
        .pipe( $.consolidate( 'lodash', options ) )
        .pipe( $.rename( {
          basename: '_icon-sample',
          extname: '.php'
        }))
        .pipe( gulp.dest( paths.dest ) );
    } )
  .pipe( gulp.dest( paths.fonts ) );
}

// imageoptim
// export const img = () => {
//   return gulp.src( paths.srcImages + '/**/*' )
//     .pipe( $.imageoptim.optimize() )
//     .pipe( gulp.dest(paths.images) );
// }


/**
 * gulp.default
 */
export default gulp.series( gulp.parallel(server, watch) );
