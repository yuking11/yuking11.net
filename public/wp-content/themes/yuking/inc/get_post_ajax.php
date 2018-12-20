<?php
/*
 * Ajax 設定
 **/

function ajaxurl() { ?>
  <script>var ajaxurl = '<?php echo admin_url( 'admin-ajax.php'); ?>';</script>
<?php }
add_action( 'wp_head', 'ajaxurl', 1 );


/*
 * Ajaxで投稿やり取り
 **/
function get_more() {
  global $post;
  $posts_per_page = get_option('posts_per_page');
  $now_post_num = $_POST['now_post_num'];
  // $get_post_num = $_POST['get_post_num'];
  $post_type = _h($_POST['post_type']);
  $post_cat  = _h($_POST['post_cat']);
  $returnObj = [];

  // get_posts オプション
  $args = [
    'post_type' => $post_type,
    'category_name' => $post_cat,
    'posts_per_page' => $posts_per_page,
    'offset' => $now_post_num,
  ];
  $args_all = [
    'post_type' => $post_type,
    'category_name' => $post_cat,
    'posts_per_page' => -1,
  ];
  if ( $post_type === 'portfolio' && !empty($post_cat)) {
    $args['category_name'] = null;
    $args['tax_query'] = [ [
      'taxonomy' => 'portfolio-cat',
      'field' => 'slug',
      'terms' => $post_cat,
    ] ];
    $args_all['category_name'] = null;
    $args_all['tax_query'] = [ [
      'taxonomy' => 'portfolio-cat',
      'field' => 'slug',
      'terms' => $post_cat,
    ] ];
  }
  $posts = get_posts( $args );
  $posts_all = get_posts( $args_all );

  //もし残存投稿があるならFlagを立ててMoreを継続させる
  $noDataFlg = 0;
  if( $now_post_num < count($posts_all) - $posts_per_page ){
    $noDataFlg = 1;
  }

  // html形成
  $html = '';
  foreach( $posts as $key => $post ) {
    // アイキャッチ画像のID/URL取得
    $img_src = getAttachUrl();
    // tag
    $tags = get_the_terms( $post->ID, 'portfolio-tag' );

    $html .= '<article class="p-post_item" data-post_item>';
    $html .= '<div class="p-post_head">';
    $html .= '<img src="' . $img_src . '" alt="' . get_the_title() . '" class="p-post_img">';
    $html .= '<div class="p-post_summary">';
    $html .= '<div class="p-post_summary_ttl">' . get_the_title() . '</div>';
    $html .= '<p class="p-post_summary_txt">' . get_field('pt_outline', $post->ID) . '</p>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '<h3 class="p-post_ttl">' . get_the_title() . '</h3>';
    $html .= '<p class="p-post_url">';
    $html .= '<i class="p-post_icon icon-external" aria-hidden="true"></i>';
    $html .= '<a href="' . get_field('pt_url', $post->ID) . '" class="p-post_link" target="_blank" rel="noopener noreferrer">';
    $html .= get_field('pt_url', $post->ID);
    $html .= '</a>';
    $html .= '</p>';
    $html .= '<ul class="p-post_tags">';
    foreach ($tags as $tag => $value) {
      $html .= '<li class="p-post_tag">' . $value->name . '</li>';
    }
    $html .= '</ul><!-- /.p-post_tags -->';
    $html .= '</article><!-- /.p-post_item -->';
  }

  // json形式に出力
  if ( $html ) { // 投稿があれば
    $returnObj = [
      'noDataFlg' => $noDataFlg,
      'html' => $html,
    ];
    echo json_encode( $returnObj );
  }
  // else { // 投稿がなければ
  //   echo json_encode( false );
  // }

  die();
}
add_action( 'wp_ajax_get_more', 'get_more' );
add_action( 'wp_ajax_nopriv_get_more', 'get_more' );
