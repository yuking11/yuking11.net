/**
 * ENV Settings
 */
const config = {
  env: 'local',// local or current
  url: 'http://yuking11.test/',// site url
  phpVer:  '7.2.9',// for Windows
  phpBase: 'public'
};


/**
 * site-config
 */
const paths = {
  dest       : './public',
  srcImages  : './src/_img',
  srcFonts   : './src/_icons',
  srcScripts : './src/_js',
  sass       : './src/_sass',
  themes     : './public/wp-content/themes/yuking',
  assets     : './public/wp-content/themes/yuking/assets',
  images     : './public/wp-content/themes/yuking/assets/img',
  fonts      : './public/wp-content/themes/yuking/assets/fonts',
  scripts    : './public/wp-content/themes/yuking/assets/js',
  styles     : './public/wp-content/themes/yuking/assets/css'
};


/**
 * exports
 */
module.exports = {
  // base
  base: config,
  // paths
  path: paths
};
