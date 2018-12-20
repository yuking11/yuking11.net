"use strict";
import $ from 'jquery';
import { Utils } from "./utils";

let utils = new Utils();

/**
 * 画像ロールオーバー vanilla JS
 *
 * @param none
 *
 */
function smartRollover() {
  let preLoadImg = {};
  if( document.getElementsByClassName ) {
    let elm = document.getElementsByClassName('over');
    for(let i=0; i < elm.length; i++) {
      let elmSrc = elm[i].getAttribute('src');
      let sep    = elmSrc.lastIndexOf('.');
      let onSrc  = elmSrc.substr(0, sep) + '_on' + elmSrc.substr(sep, 4);
      preLoadImg[elmSrc] = new Image();
      preLoadImg[elmSrc].src = onSrc;
      elm[i].onmouseover = (e) => {
        e.preventDefault();
        e.currentTarget.classList.add('is-hover');
        e.currentTarget.setAttribute('src', onSrc );
      }
      elm[i].onmouseout = (e) => {
        e.preventDefault();
        e.currentTarget.classList.remove('is-hover');
        e.currentTarget.setAttribute('src', elmSrc );
      }
    }// for
  }// if
}// func
window.addEventListener('load', smartRollover, false);


/**
 * スムーズスクロール with jQuery
 *
 * @param none
 *
 */
$( () => {
  $('[data-scroll]').on('click', (e) => {
    e.preventDefault();
    let speed   = 500,
        $self   = $(e.currentTarget),
        $href   = $self.attr('href'),
        $margin = ( $self.data('scroll') ) ? $self.data('scroll') : 0,
        $target = $($href);
    let ww = utils.getWindowWidth(),
        pos;
    // 位置調整
    if ( $.isPlainObject($margin) ) {
      if (ww >= 960) {
        pos = ( $target[0] && $target !== '#page_top' ) ? $target.offset().top + parseInt($margin['pc']) : 0;
      } else {
        pos = ( $target[0] && $target !== '#page_top' ) ? $target.offset().top + parseInt($margin['mb']) : 0;
      }
    } else {
      pos = ( $target[0] && $target !== '#page_top' ) ? $target.offset().top + parseInt($margin) : 0;
    }
    // Fixed要素がある場合
    let $fixed = $self.data('scroll-fixed');
    if ( $fixed ) {
      let $fixedHeight = $($fixed).outerHeight();
      pos -= $fixedHeight;
    }
    // scroll実行
    $('html,body').animate({scrollTop: pos}, speed, 'swing');
    $self.blur();
    return false;
  });// end function.onClick
});// end function


/**
 * ページトップリンク
 *
 * @param none
 *
 */
if ( $('[data-pagetop]')[0] ){
  $(() => {
    let $btn = $('[data-pagetop]'),
        showFlag = false;
    const value = $btn.data('pagetop');
    $(window).scroll( (e) => {
      e.preventDefault;
      if( $(e.currentTarget).scrollTop() > value ){
        if(showFlag === false){
          showFlag = true;
          $btn.addClass('is-active');
        }
      } else {
        if(showFlag){
          showFlag = false;
          $btn.removeClass('is-active');
        }
      }
    });
  });
}
