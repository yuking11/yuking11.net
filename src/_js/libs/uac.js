/**
 *
 * User Agent Check Class
 *
 * @method: browser()
 * @method: device()
 * @method: iosVer()
 * @method: isIE()
 * @method: isiOS()
 * @method: isMobile()
 * @method: isTablet()
 * @method: isTouch()
 * @method: isModern()
 * @method: homeClass()
 *
 */
 export class Uac {

  /**
   * Constructor
   *
   * @param _uac: object
   * @param ua
   * @param ver
   *
   */
  constructor() {
    this._uac = {}; // define _uac as a global object
    this.ua   = window.navigator.userAgent.toLowerCase();
    this.ver  = window.navigator.appVersion.toLowerCase();
  }

  /**
   * check browser version
   */
  browser() {
    if (this.ua.indexOf('edge') !== -1) return 'edge';                    // Edge
    else if (this.ua.indexOf("iemobile") !== -1)    return 'iemobile';    // ieMobile
    else if (this.ua.indexOf('trident/7') !== -1)   return 'ie11';        // ie11
    else if (this.ua.indexOf("msie") !== -1 && this.ua.indexOf('opera') === -1){
      if      (ver.indexOf("msie 6.")  !== -1) return 'ie6';              // ie6
      else if (ver.indexOf("msie 7.")  !== -1) return 'ie7';              // ie7
      else if (ver.indexOf("msie 8.")  !== -1) return 'ie8';              // ie8
      else if (ver.indexOf("msie 9.")  !== -1) return 'ie9';              // ie9
      else if (ver.indexOf("msie 10.") !== -1) return 'ie10';             // ie10
    }
    else if (this.ua.indexOf('chrome')  !== -1 && this.ua.indexOf('edge') === -1)   return 'chrome';    // Chrome
    else if (this.ua.indexOf('safari')  !== -1 && this.ua.indexOf('chrome') === -1) return 'safari';    // Safari
    else if (this.ua.indexOf('opera')   !== -1) return 'opera';           // Opera
    else if (this.ua.indexOf('firefox') !== -1) return 'firefox';         // FIrefox
    else return 'unknown_browser';
  }

  /**
   * check device
   */
  device() {
    if(this.ua.indexOf('iphone') !== -1 || this.ua.indexOf('ipod') !== -1 ) return 'iphone';
    else if (this.ua.indexOf('ipad')    !== -1) return 'ipad';
    else if (this.ua.indexOf('android') !== -1) return 'android';
    else if (this.ua.indexOf('windows') !== -1 && this.ua.indexOf('phone') !== -1) return 'windows_phone';
    else return '';
  }

  /**
   * check ios version
   */
  iosVer() {
    if ( /iP(hone|od|ad)/.test( navigator.platform ) ) {
      const v = (navigator.appVersion).match(/OS (\d+)_(\d+)_?(\d+)?/);
      const versions = [parseInt(v[1], 10), parseInt(v[2], 10), parseInt(v[3] || 0, 10)];
      return versions[0];
    }
    else return 0;
  }

  /**
   * boolean IE
   */
  isIE() {
    return (this.browser().substr(0, 2) === 'ie' && this.browser() !== 'iemobile');
  }

  /**
   * boolean iOS
   */
  isiOS() {
    return (this.device() === 'iphone' || this.device() === 'ipad');
  }

  /**
   * boolean Mobile
   */
  isMobile() {
    return (this.ua.indexOf('mobi') !== -1 || this.device() === 'iphone' || (this.device() === 'windows_phone' && this.ua.indexOf('wpdesktop') === -1) || this.device() === 'iemobile');
  }

  /**
   * boolean Tablet
   */
  isTablet() {
    return (this.device() === 'ipad' || (this.device() === 'android' && !this.isMobile()));
  }

  /**
   * boolean Touch Device
   */
  isTouch() {
    return ('ontouchstart' in window);
  }

  /**
   * boolean Modern Browser
   */
  isModern() {
    return !(this.browser() === 'ie6' || this.browser() === 'ie7' || this.browser() === 'ie8' || this.browser() === 'ie9' || (0 < this.iosVer() && this.iosVer() < 8));
  }

  /**
   * Set the results as class names of the html
   */
  homeClass() {
    let classStr = '';
    classStr += (this.browser() !== '') ? this.browser() + " " : 'browser-unknown ',
    classStr += (this.device()  !== '') ? this.device() + " "  : 'device-unknown ',
    classStr += (this.isMobile()) ? 'mobile ' : 'desktop ',
    classStr += (this.isTouch()) ? 'touch '  : 'mouse ',
    classStr += (this.isiOS()) ? 'ios ' : '',
    classStr += (this.isIE()) ? 'ie ' : '',
    classStr += (this.isModern()) ? 'modern ' : 'old ';
    // return classStr;
    // document.addEventListener('DOMContentLoaded', function() {
    document.documentElement.className += classStr;
    // });
  };
}
