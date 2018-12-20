const VueLoaderPlugin = require('vue-loader/lib/plugin');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const WebpackNotifierPlugin = require('webpack-notifier');

// settings
// development / production
const ENV = 'development';
const userSourceMap = (ENV === 'development');

module.exports = {
  // モード値を production に設定すると最適化された状態で、
  mode: ENV,

  // メインとなるJavaScriptファイル（エントリーポイント）
  entry: {
    app: "./src/_sass/app.scss",
    app: "./src/_js/app.js",
  },
  // ファイルの出力設定
  output: {
    //  出力ファイルのディレクトリ名
    path: `${__dirname}/public/wp-content/themes/yuking/assets/`,
    // 出力ファイル名
    filename: 'js/[name].js'
  },
  // jQueryCDN用設定
  // externals: {
  //   jquery: 'jQuery',
  //   jquery: '$'
  // },
  module: {
    rules: [
      {
        test: /\.vue$/,
        use: [
          {
            loader: "vue-loader"
          }
        ]
      },
      {
        // 拡張子 .js の場合
        test: /\.js$/,
        use: [
          {
            // Babel を利用する
            loader: 'babel-loader',
            // Babel のオプションを指定する
            options: {
              presets: [
                // env を指定することで、ES2017 を ES5 に変換。
                // {modules: false}にしないと import 文が Babel によって CommonJS に変換され、
                // webpack の Tree Shaking 機能が使えない
                ['env', {'modules': false}]
              ]
            }
          }
        ],
        // node_modules は除外する
        exclude: /node_modules/,
      },
      {
        // 対象となるファイルの拡張子
        test: /\.scss$/,
        // Sassファイルの読み込みとコンパイル
        use: [
          // javascriptとしてバンドルせず css として出力する
          MiniCssExtractPlugin.loader,
          // 'style-loader',
          // CSSをバンドルするための機能
          {
            loader: 'css-loader',
            options: {
              // CSS内のurl()メソッドの取り込みを禁止する
              url: false,
              // ソースマップの利用有無
              sourceMap: userSourceMap,
              // 空白文字やコメントを削除する
              minimize: true,
              // Sass+PostCSSの場合は2を指定
              importLoaders: 2
            },
          },
          // PostCSSのための設定
          {
            loader: 'postcss-loader',
            options: {
              // PostCSS側でもソースマップを有効にする
              sourceMap: userSourceMap,
              plugins: [
                // Autoprefixerを有効化
                // ベンダープレフィックスを自動付与する
                require('autoprefixer')({
                  browsers: ['last 2 versions', 'Android >= 5.0'],
                  grid: true
                }),
                // postcss-assets
                require('postcss-assets')({
                  // プロジェクトで公開するパス
                  basePath : `${__dirname}/public/wp-content/themes/yuking/assets/`,
                  // basePathから見た画像フォルダの位置
                  loadPaths: ['img/'],
                  // img/とcss/の相対的な位置
                  relative : 'css/',
                  cachebuster: true
                }),
              ]
            },
          },
          // Sassをバンドルするための機能
          {
            loader: 'sass-loader',
            options: {
              // ソースマップの利用有無
              sourceMap: userSourceMap,
            }
          }
        ],
      }
    ],
  },
  devtool: 'source-map',
  resolve: {
    // importするときに省略できる拡張子の設定
    extensions: ['.js', '.vue', '.scss'],
    // aliasを追加
    alias: {
      'vue$': 'vue/dist/vue.esm.js'
    }
  },
  plugins: [
    // Vueを読み込めるようにするため
    new VueLoaderPlugin(),
    new WebpackNotifierPlugin(),
    new MiniCssExtractPlugin({
      filename: 'css/[name].css'
    }),
  ]
};
