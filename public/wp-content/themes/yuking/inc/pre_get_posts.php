<?php
/**
 * 一覧表示件数変更
 */

function my_pre_get_posts($query) {
  if ( is_admin() || !$query->is_main_query())
    return;

  // トップ
  if ( $query->is_main_query() && $query->is_home() ) {
    $favorit_disp = get_field('disp_count_favorit', 'options');

    $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
    $query->set( 'post_type', 'post' );
    $query->set( 'post_status', 'publish' );
    $query->set( 'posts_per_page', $favorit_disp );
    $query->set( 'paged', $paged );
    return;
  }

  // カテゴリー一覧
  if ( $query->is_main_query() && $query->is_category() ) {
    $cat_disp = get_field('disp_count_category', 'options');

    $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
    $query->set( 'post_type', 'post' );
    $query->set( 'post_status', 'publish' );
    $query->set( 'posts_per_page', $cat_disp );
    $query->set( 'paged', $paged );
    return;
  }

  // アーカイブ一覧
  if ( $query->is_main_query() && $query->is_archive() ) {
    $archive_disp = get_field('disp_count_archive', 'options');

    $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
    $query->set( 'post_type', 'post' );
    $query->set( 'post_status', 'publish' );
    $query->set( 'posts_per_page', $archive_disp );
    $query->set( 'paged', $paged );
    return;
  }

}
add_action('pre_get_posts', 'my_pre_get_posts');
