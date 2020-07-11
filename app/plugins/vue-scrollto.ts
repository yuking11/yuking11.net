// plugins/lib/vue-scrollto.js
import Vue from 'vue'
import VueScrollTo from 'vue-scrollto'

Vue.use(VueScrollTo, {
  duration: 750,
  easing: [0, 0, 0.05, 1],
  offset: -55,
})
