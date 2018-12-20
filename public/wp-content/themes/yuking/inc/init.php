<?php
/**
 * initialized
 */

/**
 * URI
 */

// スラッシュを追加
// ====================================== //
function add_slash_uri_end($uri, $type) {
  if ($type != 'single') {
    $uri = trailingslashit($uri);
  }
  return $uri;
}
add_filter('user_trailingslashit', 'add_slash_uri_end', 10, 2);


/**
 * wp_head()
 * 不要タグ削除
 */

//WordPressのバージョン情報
remove_action('wp_head', 'wp_generator');
//外部ツールを使ったブログ更新用のURL
remove_action('wp_head', 'rsd_link');
//wlwmanifestWindows Live Writerを使った記事投稿URL
remove_action('wp_head', 'wlwmanifest_link');
//デフォルトパーマリンクのURL
remove_action('wp_head', 'wp_shortlink_wp_head');
//前の記事と後の記事のURL
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
//RSSフィードのURL
remove_action('wp_head', 'feed_links_extra', 3);

/**
 * 投稿関連
 */

// 投稿内のhtmlコメントアウトを正常動作させる
// ====================================== //
remove_filter( 'the_content', 'wptexturize' );

// 画像のみpタグで囲わない
// ====================================== //
add_filter('the_content', 'remove_p_on_images');
function remove_p_on_images($content){
  return preg_replace('/<p>( |　)(\s*)(<img .* \/>)(\s*)( |　)<\/p>/iU', '\2', $content);
  // return preg_replace('/<p>(\s*)(<img .* \/>)(\s*)<\/p>/iU', '\2', $content);
}

//コメントアウトのみpタグで囲わない
// ====================================== //
add_filter('the_content', 'remove_p_on_commentout');
function remove_p_on_commentout($content){
  return preg_replace('/<p>(\s*)(<\!\-\- .* \-\->)(\s*)<\/p>/iU', '\2', $content);
}
add_filter('the_content', 'remove_p_on_commentout2');
function remove_p_on_commentout2($content){
  return preg_replace('/<p>(\s*)(<\!\-\-\/ .* \-\->)(\s*)<\/p>/iU', '\2', $content);
}

// 固定ページのエディタを非表示にする。
// ====================================== //
// add_action( 'init' , 'my_remove_post_editor_support' );
// function my_remove_post_editor_support() {
//   remove_post_type_support( 'page', 'editor' );
// }

// アイキャッチ画像を有効にする。
// ====================================== //
add_theme_support('post-thumbnails');
// サイズ指定
// if ( function_exists( 'add_image_size' ) ) {
//   add_image_size( 'opinion-thumb', 120, 120, true );
// }

// サムネイル自動生成停止
// ====================================== //
function remove_image_sizes($sizes) {
  // unset( $sizes['thumbnail'] );
  unset( $sizes['medium'] );
  unset( $sizes['large'] );
  return $sizes;
}
add_filter( 'intermediate_image_sizes_advanced', 'remove_image_sizes' );

// メディア不要属性削除
// ====================================== //
add_filter( 'image_send_to_editor', 'remove_image_attribute', 10 );
add_filter( 'post_thumbnail_html', 'remove_image_attribute', 10 );
function remove_image_attribute( $html ){
  $html = preg_replace( '/(width|height)="\d*"\s/', '', $html );
  // $html = preg_replace( '/class=[\'"]([^\'"]+)[\'"]/i', '', $html );
  // $html = preg_replace( '/title=[\'"]([^\'"]+)[\'"]/i', '', $html );
  $html = preg_replace( '/<a href=".+">/', '', $html );
  $html = preg_replace( '/<\/a>/', '', $html );
  return $html;
}

// 抜粋カスタマイズ
// ====================================== //
// 文字数
function my_excerpt_length($length) {
  return 100;
}
add_filter('excerpt_length', 'my_excerpt_length');

//概要（抜粋）の省略文字
function my_excerpt_more($more) {
  return '…';
}
add_filter('excerpt_more', 'my_excerpt_more');


// アーカイブ年月表示変更
// ====================================== //
// wp_get_archives の年表記を置き換える
// function my_archives_link($html){
//   $html = str_replace('年','/',$html);
//   $html = str_replace('月','',$html);
//   return $html;
// }
// add_filter('get_archives_link', 'my_archives_link');

// wp_get_archives の年表記を置き換える */
// function my_gettext($translated_text, $original_text, $domain) {
//   if ($original_text == '%1$s %2$d') {
//     $translated_text = '%2$s/%1$02d';
//   }
//   return $translated_text;
// }
// add_filter('gettext', 'my_gettext', 20, 3);
