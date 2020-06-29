module.exports = {
  // ignorePatterns: [],
  root: true,
  env: {
    browser: true,
    node: true,
  },
  extends: [
    '@nuxtjs/eslint-config-typescript',
    'prettier',
    'prettier/vue',
    'plugin:prettier/recommended',
    'plugin:nuxt/recommended',
  ],
  plugins: ['prettier'],
  // add your custom rules here
  rules: {
    strict: ['error', 'global'],
    // タグの最後で改行しないで
    // 'vue/html-closing-bracket-newline': [2, { multiline: 'never' }],
    // 不要なカッコは消す
    'no-extra-parens': 2,
    // 無駄なスペースは削除
    'no-multi-spaces': 2,
    // 不要な空白行は削除。2行開けてたらエラー
    'no-multiple-empty-lines': [2, { max: 1 }],
    // 関数とカッコはあけない(function hoge() {/** */})
    'func-call-spacing': [2, 'never'],
    // true/falseを無駄に使うな
    'no-unneeded-ternary': 2,
    // セミコロンは禁止
    semi: [2, 'never'],
    // 文字列はシングルクオートのみ
    quotes: [2, 'single'],
    // varは禁止
    'no-var': 2,
    // jsのインデントは２
    indent: [2, 2],
    // かっこの中はスペースなし
    'space-in-parens': [2, 'never'],
    // カンマの前後にスペース入れる
    'comma-spacing': 2,
    // 配列のindexには空白入れるな(hogehoge[ x ])
    'computed-property-spacing': 2,
    // キー
    'key-spacing': 2,
    // キーワードの前後には適切なスペースを
    'keyword-spacing': 2,
    // productionではconsole 記述はエラー
    'no-console': [
      process.env.MODE === 'develop' ? 'off' : 'error',
      {
        allow: ['warn', 'error'],
      },
    ],
    'no-debugger': process.env.MODE === 'develop' ? 'off' : 'error',
    // 利用されていない変数
    'no-unused-vars': 1,
    // 利用されていないコンポネント
    'vue/no-unused-components': 1,
    // ホワイトスペースを注意
    'no-irregular-whitespace': 1,
    // v-for に keyが設定されていない場合
    'vue/require-v-for-key': 2,
    // 1行が長すぎる場合に折り返ししない
    'vue/max-attributes-per-line': 'off',
    // v-htmlを許可(xssに注意してください)
    'vue/no-v-html': 'off',
    // async内にawaitがない場合
    'require-await': 1,
    // 異なる演算子の混合
    'no-mixed-operators': 2,
    // return に代入式を利用しない
    'no-return-assign': 1,
    // 厳密等価演算子を利用
    eqeqeq: 1,
    '@typescript-eslint/no-unused-vars': [
      'error',
      { ignoreRestSiblings: true },
    ],
  },
}
