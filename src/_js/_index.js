"use strict";

// js - plugins
// import Vue from 'vue';
import SweetScroll from "sweet-scroll";
import axios from 'axios';

// js - libs
import { Utils } from "./libs/utils";
import { Uac } from "./libs/uac";

const utils = new Utils();
const uac = new Uac();

/**
 * sample
 */
// console.log('utils.getWindowWidth: ' + utils.getWindowWidth());
// console.log('utils.mq("1279", "max"): ' + utils.mq('1279', 'max'));
// console.log('utils.mq("1280"): ' + utils.mq('1280'));

// console.log('browser name: ' + uac.browser());
// console.log('device name: ' + uac.device());
// console.log('if it\'s IE: ' + uac.isIE());
// console.log('if it\'s ios: ' + uac.isiOS());
// console.log('if it\'s a mobile device: ' + uac.isMobile());
// console.log('if it\'s a tablet device: ' + uac.isTablet());
// console.log('if it\'s a touch device: ' + uac.isTouch());
// console.log('if it\'s a modern browser: ' + uac.isModern());


/**
 * add classes <html>
 */
uac.homeClass();

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
  const sweetScroll = new SweetScroll({
    header: ".l-header"
  });
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


/**
 * SP Navigation
 *
 * @param none
 *
 */
if ( document.querySelectorAll('[data-nav_list]') ) {
  let handle = document.querySelectorAll('[data-nav_list] a');
  let navClose = () => {
    document.getElementById('gnav_ctrl').checked = false;
  }
  handle.forEach( (e) => {
    e.addEventListener("click", navClose, false);
  });
}// if


/**
 * 投稿追加読み込み - Ajax
 */
if ( document.querySelectorAll('[data-btn_more]') ) {
  let getMorePost = () => {
    let nowPostNum = document.querySelectorAll('[data-post_item]').length;// 現在表示されている数
    let postWrap = document.querySelector('[data-more-post_wrap]');
    let postType = postWrap.dataset.post_type;
    let postCat = postWrap.dataset.post_cat;
    let postBtn = document.querySelector('[data-btn_more-wrap]');
    postBtn.innerHTML = '<div class="c-loader" data-loader></div>';
    let params = new URLSearchParams();
    params.append('action', 'get_more');
    params.append('now_post_num', nowPostNum);
    params.append('post_type', postType);
    params.append('post_cat', postCat);
    let sendData = {
      'action': 'get_more',
      'now_post_num' : nowPostNum,
      'post_type' : postType,
      'post_cat' : postCat
    };
    // POST通信
    axios({
        method : 'POST',
        url    : ajaxurl,
        data   : params
      })
      .then(response => {
        // console.log('status:', response.status);
        // console.log('body:', response.data['html']);
        let postWrap = document.querySelector('[data-more-post_wrap]');
        let postBtn = document.querySelector('[data-btn_more-wrap]');
        let loader = document.querySelector('[data-loader]');
        postWrap.insertAdjacentHTML('beforeend', response.data['html']);
        postBtn.removeChild(loader);
        if ( response.data['noDataFlg'] > 0 ) {
          postBtn.insertAdjacentHTML('beforeend', '<button type="submit" class="c-btn c-btn-black c-btn-large c-btn-icon" data-btn_more><span class="c-btn_txt">More</span><i class="c-btn_icon icon-refresh" aria-hidden="true"></button>');
          let btn = document.querySelector('[data-btn_more]');
          btn.addEventListener("click", getMorePost, false);
        } else {
          postBtn.parentNode.removeChild(postBtn);
        }
      }).catch(err => {
        console.log('err:', err);
      });
  }
  let btn = document.querySelector('[data-btn_more]');
  btn.addEventListener("click", getMorePost, false);
}
