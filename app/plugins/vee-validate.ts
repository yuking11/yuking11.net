import Vue from 'vue'
import {
  ValidationProvider,
  ValidationObserver,
  extend,
  localize,
} from 'vee-validate'
import {
  required,
  min,
  max,
  email,
  confirmed,
  regex,
  numeric,
} from 'vee-validate/dist/rules'
import ja from 'vee-validate/dist/locale/ja.json'

extend('required', required)
extend('min', min)
extend('max', max)
extend('email', email)
extend('regex', regex)
extend('confirmed', confirmed)
extend('numeric', numeric)

localize('ja', ja)

Vue.component('ValidationProvider', ValidationProvider)
Vue.component('ValidationObserver', ValidationObserver)
