<?php
/**
 * custom-post-type and definitions
 */

/**
 * カスタム投稿設定
 */

// ポートフォリオ
// ====================================== //
add_action('init', 'portfolio_post_custom_post_type');
function portfolio_post_custom_post_type() {
  $labels = array(
    'name'                => 'ポートフォリオ',
    'singular_name'       => 'ポートフォリオ',
    'add_new_item'        => '新しいポートフォリオを追加',
    'add_new'             => '新規追加',
    'new_item'            => '新しいポートフォリオ',
    'view_item'           => 'ポートフォリオを表示',
    'not_found'           => 'ポートフォリオはありません',
    'not_found_in_trash'  => 'ゴミ箱にポートフォリオはありません。',
    'search_items'        => 'ポートフォリオを検索',
  );
  $args = array(
    'labels'              => $labels,
    'public'              => true,
    'publicly_queryable'  => true,
    'show_ui'             => true,
    'query_var'           => true,
    'rewrite' => array('slug' => '', 'with_front' => false),
    'hierarchical'        => false,
    'menu_position'       => 4,
    'has_archive'         => true,
    'yarpp_support'       => true,
    'capability_type'     => 'post',
    'supports' => array(
      'title',
      // 'editor',
      'thumbnail',
      // 'excerpt',
      // 'custom-fields',
      'revisions',
      'page-attributes'
      )
  );
  register_post_type('portfolio', $args);
  flush_rewrite_rules( true );

  register_taxonomy(
    'portfolio-cat',
    array('portfolio'),
    array(
      'hierarchical' => true,
      'update_count_callback' => '_update_post_term_count',
      'label' => 'カテゴリー',
      'singular_label' => 'カテゴリー',
      'public' => true,
      'query_var' => true,
      'show_ui' => true,
      'rewrite' => array('slug' => 'portfolio', 'with_front' => false),
      )
  );

  register_taxonomy(
    'portfolio-tag',
    array('portfolio'),
    array(
      'hierarchical' => false,
      'update_count_callback' => '_update_post_term_count',
      'label' => 'タグ',
      'singular_label' => 'タグ',
      'add_new_item' => '新規タグを追加',
      'public' => true,
      'query_var' => true,
      'show_ui' => true,
      'rewrite' => array('slug' => '', 'with_front' => false),
      )
  );
}
// ページャー対応
add_rewrite_rule('portfolio/([^/]+)/page/([0-9]+)/?$', 'index.php?portfolio-cat=$matches[1]&paged=$matches[2]', 'top');


// 固定ページ 全投稿一覧
// ====================================== //
// add_rewrite_rule('information/([^/]+)/page/([0-9]+)/?$', 'index.php?category_name=$matches[1]&paged=$matches[2]', 'top');


/*
 * カスタム投稿一覧設定
 */

// 一覧にカラム追加表示
// ====================================== //

// ポートフォリオ「カテゴリー」
function add_order_column_portfolio( $columns ) {
  $new_columns = array();
  foreach ( $columns as $column_name => $column_display_name ) {
    if ( $column_name === 'date' ) {
      $new_columns['portfolio-cat'] = 'カテゴリー';
    }
    $new_columns[ $column_name ] = $column_display_name;
  }
  // $new_columns['menu_order'] = '順序';
  return $new_columns;
}
add_filter( 'manage_edit-portfolio_columns', 'add_order_column_portfolio' );

// ポートフォリオカテゴリー「カラー」
// function add_order_column_portfolio_cat( $columns ) {
//   $new_columns = array();
//   foreach ( $columns as $column_name => $column_display_name ) {
//     if ( $column_name === 'posts' ) {
//       $new_columns['cat_color'] = 'カラー';
//     }
//     $new_columns[ $column_name ] = $column_display_name;
//   }
//   // $new_columns['menu_order'] = '順序';
//   return $new_columns;
// }
// add_filter( 'manage_edit-portfolio-cat_columns', 'add_order_column_portfolio_cat' );

// 投稿カテゴリー「カラー」
// function add_order_column_category( $columns ) {
//   $new_columns = array();
//   foreach ( $columns as $column_name => $column_display_name ) {
//     if ( $column_name === 'posts' ) {
//       $new_columns['cat_color'] = 'カラー';
//     }
//     $new_columns[ $column_name ] = $column_display_name;
//   }
//   // $new_columns['menu_order'] = '順序';
//   return $new_columns;
// }
// add_filter( 'manage_edit-category_columns', 'add_order_column_category' );


// 一覧に追加したカラムの値を表示
// ====================================== //
function display_order_value( $column_name, $post_id ) {
  if ( $column_name == 'menu_order' ) {
    echo get_post_field( 'menu_order', $post_id );
  }
  // ポートフォリオ
  if ( $column_name == 'portfolio-cat' ) {
    echo get_the_term_list($id, 'portfolio-cat', '', ', ');
  }
}
add_action( 'manage_posts_custom_column', 'display_order_value', 10, 2 );


// タクソノミー一覧に追加したカラムの値を表示
// ====================================== //
// function custom_column_content( $value, $column_name, $tax_id ){
//   // 導入事例／講演実績「カラー」
//   if ($column_name === 'cat_color') {
//     $color = get_field('cat_color', 'category_' . $tax_id);
//     $box = '<div style="width: 16px; height: 16px; background-color: '.$color.';"></div>';
//     $box .= $color;
//     echo $box;
//   }
// }
// add_action( "manage_portfolio-cat_custom_column", 'custom_column_content', 10, 3);


// 一覧に絞り込み機能を追加
// ====================================== //
function my_add_filter() {
  global $post_type;
  if ( $post_type === 'portfolio' ) {
?>
    <select name="portfolio-cat">
      <option value="">カテゴリー指定なし</option>
<?php
    $terms = getRootTaxonomies( get_terms('portfolio-cat') );
    foreach ( $terms as $pv ) {
?>
      <option value="<?php echo $pv->slug; ?>" <?php if ( $_GET['portfolio-cat'] == $pv->slug ) { print 'selected'; } ?>><?php echo $pv->name; ?></option>
<?php
      foreach ( $pv->children as $ck => $cv ) {
?>
      <option value="<?php echo $cv->slug; ?>" <?php if ( $_GET['portfolio-cat'] == $cv->slug ) { print 'selected'; } ?>>- <?php echo $cv->name; ?></option>
<?php
      }
    }
?>
    </select>
<?php
  }// if
}
add_action( 'restrict_manage_posts', 'my_add_filter' );


/*
 * カスタム投稿詳細設定
 */

// カテゴリー表示順序をキープ
// ====================================== //
function solecolor_wp_terms_checklist_args( $args, $post_id ){
  if ( $args['checked_ontop'] !== false ){
    $args['checked_ontop'] = false;
  }
  return $args;
}
add_filter('wp_terms_checklist_args', 'solecolor_wp_terms_checklist_args',10,2);



/*
 * その他カスタム投稿関連
 */

// 親子関係入れ子整形
// ====================================== //
function getRootTaxonomies( $terms = null ) {
  $rootterms = array();
  if ( isset($terms) ) {
    foreach ( $terms as $k => $v ) {
      if ( $v->parent === 0 ) {
        $v->children = array();
        $rootterms[] = $v;
      }
    }
    foreach ( $rootterms as $k => $v ) {
      foreach ( $terms as $sk => $sv ) {
        if ( $v->term_id === $sv->parent ) {
          $rootterms[$k]->children[] = $sv;
        }
      }
    }
  }
  return $rootterms;
}
