import { resolve } from 'path'
import internalIp from 'internal-ip'
// Use dart-sass
import Fiber from 'fibers'
import Sass from 'sass'
// setup env
const env = process.env.NODE_ENV
const envFile = `.env.${env}`

require('dotenv').config({ path: resolve(__dirname, 'env', envFile) })

export default async () => {
  const hasHostnameArg = process.argv.includes('--hostname')
  if (hasHostnameArg && env === 'develop') {
    const ip = await internalIp.v4()
    const { API_BASE_URL } = process.env
    if (!API_BASE_URL || !ip) {
      return
    }
    process.env.API_BASE_URL = API_BASE_URL.replace(
      /localhost|127\.0\.0\.1|0\.0\.0\.0/,
      ip
    )
  }

  const nuxtConfig = {
    /*
     ** Nuxt rendering mode
     ** See https://nuxtjs.org/api/configuration-mode
     */
    mode: 'universal',
    /*
     ** Nuxt target
     ** See https://nuxtjs.org/api/configuration-target
     */
    target: 'static',
    server: {
      host: '127.0.0.1',
    },
    srcDir: 'app',
    router: {
      base:
        process.env.DEPLOY_ENV === 'GH_PAGES'
          ? '/yuking11.net/'
          : process.env.BASE_DIR,
      // middleware: ['auth'],
    },
    env: {
      API_BASE_URL: process.env.API_BASE_URL,
    },
    /*
     ** Headers of the page
     ** See https://nuxtjs.org/api/configuration-head
     */
    head: {
      meta: [
        { charset: 'utf-8' },
        { name: 'viewport', content: 'width=device-width, initial-scale=1' },
        {
          hid: 'description',
          name: 'description',
          content: process.env.npm_package_description || '',
        },
      ],
      link: [
        {
          rel: 'icon',
          type: 'image/x-icon',
          href:
            process.env.DEPLOY_ENV === 'GH_PAGES'
              ? '/yuking11.net/favicon.ico'
              : '/favicon.ico',
        },
        {
          rel: 'stylesheet',
          href:
            'https://fonts.googleapis.com/css?family=M+PLUS+1p:400,700|Nunito:400,700&display=swap',
        },
      ],
    },
    /*
     ** Customize the progress-bar color
     */
    loading: { color: '#fff' },
    /*
     ** Global CSS
     */
    css: [
      'sanitize.css',
      '~/assets/css/default.scss',
      '~/assets/css/utils/align.scss',
      '~/assets/css/utils/margin.scss',
      '~/assets/css/utils/layout.scss',
      '~/assets/css/utils/text.scss',
    ],
    /*
     ** Common Style Resources
     */
    styleResources: {
      scss: [
        '~/assets/css/settings/*.scss',
        '~/assets/css/functions/*.scss',
        '~/assets/css/mixins/*.scss',
      ],
    },
    /*
     ** Plugins to load before mounting the App
     */
    plugins: ['~/plugins/composition-api', '~/plugins/vee-validate'],
    /*
     ** Nuxt.js dev-modules
     */
    buildModules: [
      '@nuxt/typescript-build',
      'nuxt-composition-api',
      '@nuxtjs/style-resources',
      // Doc: https://github.com/nuxt-community/stylelint-module
      '@nuxtjs/stylelint-module',
    ],
    /*
     ** Nuxt.js modules
     */
    modules: [
      'nuxt-svg-loader',
      '@nuxtjs/svg-sprite',
      // Doc: https://axios.nuxtjs.org/usage
      '@nuxtjs/axios',
    ],
    workbox: {
      runtimeCaching: [
        // Web Font
        {
          urlPattern: 'https://fonts.googleapis.com/.*',
          handler: 'cacheFirst',
        },
        // API
        {
          urlPattern: `${process.env.API_BASE_URL}.*`,
          handler: 'NetworkFirst',
          strategyOptions: {
            cacheExpiration: {
              maxEntries: 10,
              maxAgeSeconds: 60 * 60 * 24, // 1day
            },
            cacheableResponse: {
              statuses: [200],
            },
          },
        },
      ],
    },
    /*
     ** SVG Loader
     */
    svgLoader: {
      svgoConfig: {
        plugins: [{ prefixIds: false }],
      },
    },
    /*
     ** Build configuration
     */
    build: {
      /*
       ** You can extend webpack config here
       */
      filenames: {
        app: ({ isDev }: { isDev: any }) =>
          isDev ? '[name].[hash].js' : '[chunkhash].js',
        chunk: ({ isDev }: { isDev: any }) =>
          isDev ? '[name].[hash].js' : '[chunkhash].js',
      },
      extend() {},
      transpile: ['vee-validate/dist/rules'],
      loaders: {
        scss: {
          implementation: Sass,
          sassOptions: {
            fiber: Fiber,
          },
        },
      },
    },
  }

  return nuxtConfig
}

// declare module 'vue/types/vue' {
//   interface Vue {
//     $axios: NuxtAxiosInstance
//   }
// }
