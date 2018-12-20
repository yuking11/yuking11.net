<?php
/**
 * 固定ページにカテゴリーを設定
 */

// function add_categorie_to_pages() {
//   register_taxonomy_for_object_type('category', 'page');
// }
// add_action('init','add_categorie_to_pages');
// カテゴリーアーカイブに固定ページを含める
// function add_page_to_category_archive( $query ) {
//   if ( $query->is_category== true && $query->is_main_query() ) {
//     $query->set('post_type', array( 'post', 'page' ));
//   }
// }
// add_action( 'pre_get_posts', 'add_page_to_category_archive' );
