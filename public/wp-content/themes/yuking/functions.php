<?php
/**
 * functions and definitions
 */

/**
 * サイト設定
 */
require_once ('inc/init.php');

/**
 * 管理画面設定
 */
require_once ('inc/admin.php');

/**
 * パーマリンク検証
 */
require_once ('inc/validate_permalink.php');

/**
 * 固定ページにカテゴリー追加
 */
// require_once ('inc/add_page_category.php');

/**
 * 関数
 */
require_once ('inc/function.php');

/**
 * ショートコード
 */
require_once ('inc/shortcode.php');

/**
 * カスタム投稿
 */
require_once ('inc/custom-post.php');

/**
 * プラグイン
 */
require_once ('inc/plugins.php');

/**
 * 一覧表示カスタマイズ（条件、件数等）
 */
// require_once ('inc/pre_get_posts.php');

/**
 * 記事取得 ajax
 */
require_once ('inc/get_post_ajax.php');
