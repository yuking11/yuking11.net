"use strict";
// sass
import '../_sass/app.scss';
// js
import { Utils } from "./utils";
import { Uac } from "./uac";
import Vue from 'vue';
import SweetScroll from "sweet-scroll";

const utils = new Utils();
const uac = new Uac();

/**
 * sample
 */
console.log('utils.getWindowWidth: ' + utils.getWindowWidth());
console.log('utils.mq("1279", "max"): ' + utils.mq('1279', 'max'));
console.log('utils.mq("1280"): ' + utils.mq('1280'));

console.log('browser name: ' + uac.browser());
console.log('device name: ' + uac.device());
console.log('if it\'s IE: ' + uac.isIE());
console.log('if it\'s ios: ' + uac.isiOS());
console.log('if it\'s a mobile device: ' + uac.isMobile());
console.log('if it\'s a tablet device: ' + uac.isTablet());
console.log('if it\'s a touch device: ' + uac.isTouch());
console.log('if it\'s a modern browser: ' + uac.isModern());


/**
 * add classes <html>
 */
// uac.homeClass();


/**
 * Vue Test
 */
const vc = new Vue({
  el: '#app',
  data: {
    count: 0
  },
  methods: {
    countUp: function(){
      this.count++;
    }
  }
});

const vs = new Vue({
  el: '#vue-carousel',
  data: {
    contents: [
      {
        // 青の中身
        title: 'Content 1',
        bg_color: '#7bbff9',
      },
      {
        // 赤の中身
        title: 'Content 2',
        bg_color: '#f16972',
      },
      {
        // 緑の中身
        title: 'Content 3',
        bg_color: '#20d2a3',
      }
    ],
    transition_name: 'show-next',
    visible_content: 0,
  },
  methods: {
    back(){
      this.transition_name = 'show-prev';
      if ( this.visible_content <= 0  ) {
        this.visible_content = this.contents.length - 1;
        return false;
      }
      this.visible_content--;
    },
    next(){
      this.transition_name = 'show-next';
      if ( this.visible_content >= this.contents.length - 1 ) {
        this.visible_content = 0;
        return false;
      }
      this.visible_content++;
    },
    move(index){
      if ( this.visible_content > index ) {
        this.transition_name = 'show-prev';
      } else {
        this.transition_name = 'show-next';
      }
      this.visible_content = index;
    }
  },
})


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
 * sweet scroll ES6
 * @author http://webdesign-dackel.com/2015/12/17/sweet-scroll/
 * @param option
 * @param HTMLElement
 */
document.addEventListener('DOMContentLoaded', () => {
  const sweetScroll = new SweetScroll();
}, false);


/**
 * page top btn
 *
 * @param none
 *
 */
if ( document.querySelectorAll('[data-pagetop]') ) {
  let btnPageTop = document.querySelectorAll('[data-pagetop]');
  for (let i = 0; i < btnPageTop.length; i++) {
    window.onscroll = () => {
      const offset = window.pageYOffset,
            value  = btnPageTop[i].getAttribute('data-pagetop');
      if ( offset > value ) {
        btnPageTop[i].classList.add('is-active');
      } else {
        btnPageTop[i].classList.remove('is-active');
      }
    };
  }// for
}// if
