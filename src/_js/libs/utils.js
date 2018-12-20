/**
 *
 * Utility Class
 *
 * @method: isTouchDevice()
 * @method: getWindowWidth()
 * @method: smoothScroll()
 *
 */
 export class Utils {

  constructor() {
    // console.log('Load Utils.');
  }

  /**
   * タッチデバイス判定
   *
   * @param none
   * @return bool
   *
   */
  isTouchDevice() {
    let result = false;
    if (window.ontouchstart === null) {
      result = true;
    }
    return result;
  }// isTouchDevice

  /**
   * window width 値取得
   *
   * @param none
   * @return number
   *
   */
  getWindowWidth() {
    let ww = window.innerWidth;
    return ww;
  }// getWindowWidth

  /**
   * Media Query判定
   *
   * @param size: string
   * @param rule(min / max): string
   * @return boolean
   *
   */
  mq(size, rule = 'min') {
    return window.matchMedia('('+rule+'-width: '+size+'px)').matches;
  }// mq

}
