<?php
/**
 * admin settings
 */

/*
 * デフォルト「投稿」→「ブログ」。
 */

// function change_post_menu_label() {
//   global $menu;
//   global $submenu;
//   $menu[5][0] = '最新情報';
//   $submenu['edit.php'][5][0] = '最新情報';
//   $submenu['edit.php'][10][0] = '新しいブログ';
//   $submenu['edit.php'][16][0] = 'タグ';
// }
// add_action( 'admin_menu', 'change_post_menu_label' );

// function change_post_object_label() {
//   global $wp_post_types;
//   $labels = &$wp_post_types['post']->labels;
//   $labels->name = 'ブログ';
//   $labels->singular_name = 'ブログ';
//   $labels->add_new = _x('追加', 'ブログ');
//   $labels->add_new_item = 'ブログの新規追加';
//   $labels->edit_item = 'ブログの編集';
//   $labels->new_item = '新規ブログ';
//   $labels->view_item = 'ブログを表示';
//   $labels->search_items = 'ブログを検索';
//   $labels->not_found = '記事が見つかりませんでした';
//   $labels->not_found_in_trash = 'ゴミ箱に記事は見つかりませんでした';
// }
// add_action( 'init', 'change_post_object_label' );


// 順序変更
// ====================================== //
// function custom_menu_order($menu_ord) {
//     if (!$menu_ord) return true;

//     return array(
//         'index.php', // ダッシュボード
//         'all-in-one-seo-pack', // ダッシュボード
//         // 'theme-general-settings', // テーマオプション（ACF）
//         'theme-contents-settings', // テーマオプション（ACF）
//         'separator1', // 区切り線１
//         'edit.php', // 投稿
//         'edit.php?post_type=page', // 固定ページ
//         // 'wpcf7', // コンタクトフォーム
//         'separator2', // 区切り線2
//         'upload.php', // メディア
//         'edit-comments.php', // コメント
//         'link-manager.php', // リンク
//         'users.php', // ユーザー
//         'separator3', // 区切り線3
//         'themes.php', // テーマ
//         'plugins.php', // プラグイン
//         'tools.php', // ツール
//         'options-general.php', // 設定
//         'separator-last', // 区切り線３
//     );
// }
// add_filter('custom_menu_order', 'custom_menu_order');
// add_filter('menu_order', 'custom_menu_order');


// 表示 / 非表示
// ====================================== //
// function remove_menus () {
//   global $menu, $submenu;
//   global $current_user;
//   get_currentuserinfo();
//   if ( $current_user->ID !== 1 ) {
//   }
//   print_r($menu);
//   unset($menu[2]);  // ダッシュボード
//   unset($menu[4]);  // メニューの線1
//   unset($menu[5]);  // 投稿
//   unset($menu[10]); // メディア
//   unset($menu[15]); // リンク
//   unset($menu[20]); // ページ
//   unset($menu[25]); // コメント
//   unset($menu[59]); // メニューの線2
//   unset($menu[60]); // テーマ
//   unset($menu[65]); // プラグイン
//   unset($menu[70]); // ユーザー
//   unset($menu[75]); // ツール
//   echo '<pre>';
//   var_dump($submenu);
//   echo '</pre>';
//   unset($submenu['options-general.php'][10]);// 一般
//   unset($submenu['options-general.php'][15]);// 投稿設定
//   unset($submenu['options-general.php'][20]);// 表示設定
//   unset($submenu['options-general.php'][25]);// ディスカッション
//   unset($submenu['options-general.php'][30]);// メディア
//   unset($submenu['options-general.php'][40]);// パーマリンク設定
//   unset($submenu['options-general.php'][41]);// Akismet Anti-Spam (アンチスパム)
//   unset($menu[80]); // 設定
//   unset($menu[90]); // メニューの線3
//   remove_menu_page('edit.php?post_type=acf-field-group'); //Smart Custom Field
// }
// add_action('admin_menu', 'remove_menus');


// CSS読み込み
// ====================================== //
function my_admin_style(){
  wp_enqueue_style( 'my_admin_style', get_template_directory_uri().'/admin/admin.css' );
}
add_action( 'admin_enqueue_scripts', 'my_admin_style' );


/**
 * メニュー追加
 *
 * add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
 * @param $page_title: titleタグで使用されるテキスト。
 * @param $menu_title: メニューで使用されるテキスト。
 * @param $capability: メニューを表示する権限。
 * @param $menu_slug: メニューのスラッグ名。
 * @param $function: メニュー表示の際に使用される関数。
 * @param $icon_url: メニューのアイコン。
 * @param $position: メニューの表示される位置。
 *
 */

// add_action( 'admin_menu', 'register_my_custom_menu_page' );
// function register_my_custom_menu_page() {
//   add_menu_page('管理画面の使い方', 'マニュアル', 'manage_options', 'manual', 'add_manual_page', 'dashicons-welcome-learn-more', 3);
// }

// function add_manual_page() {
//   include_once __DIR__ . '/../admin/manual.php';
// }


/**
 * サブメニュー追加
 *
 * add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function);
 * @param $parent_slug: 親メニューのスラッグ名、または親メニューのファイル名。
 * @param $page_title: titleタグで使用されるテキスト。
 * @param $menu_title: メニューで使用されるテキスト。
 * @param $capability: メニューを表示する権限。
 * @param $menu_slug: メニューのスラッグ名。
 * @param $function: メニュー表示の際に使用される関数。
 *
 */

// add_action('admin_menu', 'add_custom_submenu');
// function add_custom_submenu() {
//   add_submenu_page('manual', 'サイト設定について', '- サイト設定', 'manage_options', 'manual_options', 'add_manual_page_options');
// }

// function add_manual_page_options() {
//   include_once __DIR__ . '/../admin/manual_options.php';
// }
