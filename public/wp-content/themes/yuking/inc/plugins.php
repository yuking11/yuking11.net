<?php
/**
 * plugins settings
 * - ACF PRO
 * - wpcf7
 * - All in ONE SEO
 * - TinyMCE Templates
 */

/**
 * ACF PRO
 */

/**
 * @param string page_title ページのtitle属性値
 * @param string menu_title 管理画面のメニューに表示するタイトル
 * @param string menu_slug  メニューのslug
 * @param string capability メニューを操作できる権限（maange_options とか）
 * @param bool redirect リダイレクト設定
 */

// if( function_exists('acf_add_options_page') ) {
//   acf_add_options_page(
//     array(
//       'page_title'  => 'コンテンツ設定',
//       'menu_title'  => 'コンテンツ設定',
//       'menu_slug'   => 'theme-contents-settings',
//       'capability'  => 'edit_posts',
//       'redirect'    => false
//     )
//   );
// }


/**
 * コンタクトフォーム7
 */

// 確認用メールアドレス追加
// ====================================== //
// add_filter( 'wpcf7_validate_email', 'wpcf7_main_validation_filter', 11, 2 );
// add_filter( 'wpcf7_validate_email*', 'wpcf7_main_validation_filter', 11, 2 );
// function wpcf7_main_validation_filter( $result, $tag ) {
//   $type = $tag['type'];
//   $name = $tag['name'];
//   $_POST[$name] = trim( strtr( (string) $_POST[$name], "\n", " " ) );
//   if ( 'email' == $type || 'email*' == $type ) {
//     if (preg_match('/(.*)-confirm$/', $name, $matches)){
//       $target_name = $matches[1];
//       if ($_POST[$name] != $_POST[$target_name]) {
//         if (method_exists($result, 'invalidate')) {
//           $result->invalidate( $tag,"確認用のメールアドレスが一致していません");
//       } else {
//           $result['valid'] = false;
//           $result['reason'][$name] = '確認用のメールアドレスが一致していません';
//         }
//       }
//     }
//   }
//   return $result;
// }


// フォーム送信後の動作
// ====================================== //
// add_action( 'wp_footer', 'mycustom_wp_footer' );
// function mycustom_wp_footer() {
/*
  $url = esc_url( home_url() ) . '/contact/thankyou/';
?>
<script type="text/javascript">
  if($('.wpcf7')[0]){　//formのclassが存在するか判定
    var wpcf7Elm = document.querySelector( '.wpcf7' );
    wpcf7Elm.addEventListener( 'wpcf7mailsent', function( event ) {
      console.log(event.detail.contactFormId);
      if ( event.detail.contactFormId == '167' ) {
        location.replace('<?php echo $url; ?>');
      }
    }, false );
  }
</script>
<?php
}
*/

/**
 * All in ONE SEO
 */

// アーカイブにtitke設定
// ====================================== //
// add_filter( 'aioseop_title', 'custom_aioseop_title' );
// function custom_aioseop_title( $title ) {
//   global $post;
//   $prefix = ' | '.get_bloginfo('name');

//   // カテゴリー 一覧
//   if ( is_category() ) {
//     $term = get_queried_object();
//     $label =  '';
//     if ( get_field('seo_title', 'category_'.$term->term_id) ) {
//       $title = get_field('seo_title', 'category_'.$term->term_id) . $label . $prefix;
//     }
//     else {
//       $title = $term->name . $label . $prefix;
//     }
//   }
//   return $title;
// }

// アーカイブにdescription設定
// ====================================== //
// add_filter( 'aioseop_description', 'custom_aioseop_description' );
// function custom_aioseop_description( $description ) {
//   global $post;
//   // global $aioseop_options;
//   // $description = $aioseop_options['aiosp_home_description'];

//   // 日付アーカイブ
//   if ( is_date() ) {
//     $date .= get_query_var( 'year' ).'/';
//     $date .= sprintf("%02d", get_query_var( 'monthnum' ));
//     $description = $date . 'のお知らせ一覧です。';
//   }
//   // 全タクソノミー、カテゴリー 一覧
//   elseif ( is_tax() || is_category() )
//   {
//     $term = get_queried_object();
//     if ( get_field('seo_description', 'category_'.$term->term_id) ) {
//       $description = get_field('seo_description', 'category_'.$term->term_id);
//     }
//   }
//   return $description;
// }

// アーカイブにkeywords設定
// ====================================== //
// add_filter('aioseop_keywords', 'custom_aioseop_keywords');
// function custom_aioseop_keywords($keywords){
//   global $post;
//   // global $aioseop_options;
//   // $keywords = $aioseop_options['aiosp_home_keywords'];

//   // 全タクソノミー、カテゴリー 一覧
//   if ( is_tax() || is_category() ) {
//     $term = get_queried_object();
//     if ( get_field('seo_keywords', 'category_'.$term->term_id) ) {
//       $keywords = get_field('seo_keywords', 'category_'.$term->term_id);
//     }
//   }
//   return $keywords;
// }


/**
 * TinyMCE Templates
 */

// ACF のエディターで有効化
// ====================================== //
// add_filter( 'tinymce_templates_enable_media_buttons', function() {
//   // Displays insert template button on all visual editors
//   return true;
// } );
