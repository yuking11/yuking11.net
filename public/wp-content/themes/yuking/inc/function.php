<?php
/**
 * functions and definitions
 * - URL関連
 * - html escape
 * - 抜粋取得
 * - アイキャッチ画像
 * - モバイル判定
 * - タイムスタンプ取得
 * - 文字列丸め込み
 * - URL「/」区切り配列で取得
 * - URL「category」消去
 * - パンくず
 * - ページャーの生成
 */


/**
 * URL関連
 */

// 全URL
// ====================================== //
function getCurrentURL() {
  $url = isset($_SERVER['HTTPS']) &&
              strtolower($_SERVER['HTTPS']) !== 'off' ? 'https' : 'http';
  $url .= '://' . $_SERVER['HTTP_HOST'] . $_SERVER["REQUEST_URI"];
  return _h($url);
}

// パラメーターのみ
// ====================================== //
function getCurrentParam() {
  return _h('?' . $_SERVER['QUERY_STRING']);
}

// パラメーター追加/変更/削除
// https://dgcolor.info/blog/87/
// ====================================== //
function changeUrlParam( $param = array(), $op = 0 ) {
  $url = parse_url($_SERVER["REQUEST_URI"]);
  if ( isset($url["query"]) ) {
    parse_str($url["query"], $query);
  } else {
    $query = array();
  }
  foreach ( $param as $key => $value ) {
    if ( $key && is_null($value) ) {
      unset($query[$key]);
    } else {
      $query[$key] = $value;
    }
  }
  $query = str_replace("=&", "&", http_build_query($query));
  $query = preg_replace("/=$/", "", $query);
  return $query ? (!$op ? "?" : "").htmlspecialchars($query, ENT_QUOTES) : "";
}

// URL「/」区切り配列で取得
// ====================================== //
function getUrlParam( $url = null ){
  if ( empty($url) ) {
    $url = $_SERVER["REQUEST_URI"];
  }
  $str = str_replace("/wp/", "/", $url);
  $my_url['url'] = $str;
  $my_url['url'] = substr_replace($my_url['url'], "", 0, 1);//一文字目の/を削除
  $my_url['path'] = explode("/", $my_url['url']);
  $my_url['url'] = "/".$my_url['url'];//一応/をいれておく。
  return $my_url;
}

// URL「category」消去
// ====================================== //
add_filter('user_trailingslashit', 'remcat_function');
function remcat_function($link) {
  return str_replace("/category/", "/", $link);
}
add_action('init', 'remcat_flush_rules');
function remcat_flush_rules() {
  global $wp_rewrite;
  $wp_rewrite->flush_rules();
}
// ページャー対応
add_rewrite_rule('([0-9]+)/page/([0-9]+)/?$', 'index.php?year=$matches[1]&paged=$matches[2]', 'top');
add_rewrite_rule('([^/]+)/page/([0-9]+)/?$', 'index.php?category_name=$matches[1]&paged=$matches[2]', 'top');
// add_filter('generate_rewrite_rules', 'remcat_rewrite');
// function remcat_rewrite($wp_rewrite) {
//   $new_rules = array('(.+)/page/(.+)/?' => 'index.php?category_name='.$wp_rewrite->preg_index(1).'&paged='.$wp_rewrite->preg_index(2));
//   $wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
// }

// 本番URL判定
// ====================================== //
function isProduction() {
  $host     = $_SERVER["HTTP_HOST"];
  $host_pd  = array('www.yuking11.net', 'yuking11.net');
  return in_array($host, $host_pd);
}

// uploadsディレクトリ取得
// ====================================== //
function get_uploads_directory_uri( $time = null ) {
  $upload_dir = wp_upload_dir($time);
  return $upload_dir['url'];
}


/**
 * html escape
 */

function _h( $arg, $encode = 'UTF-8' ) {
  return htmlspecialchars($arg, ENT_QUOTES, $encode);
}


/**
 * 抜粋取得
 */

function getExcerpt( $content, $length = 100, $start = 0, $encode = 'UTF-8') {
  $excerpt = strip_tags($content);
  $excerpt = str_replace('&nbsp;', " ", $excerpt);
  $excerpt = str_replace(array("\r\n","\r","\n"), '', $excerpt);
  return mb_strimlen($excerpt, $start, $length, '…', $encode);
}


/**
 * アイキャッチ画像のURLを取得する。
 * なければダミー画像を取得／falseを返す。
 *
 * @param int $param['id']: $post->ID
 * @param bool $param['alt']
 * @param int $param['w']: alt image width
 * @param int $param['h'] : alt image height
 * @param string $param['txt'] : alt image text
 * @return string|bool
 */

function getAttachUrl ( $w = 360, $h = 240, $txt = 'NoImage' ) {
  $thumb_id = get_post_thumbnail_id();
  $data = wp_get_attachment_image_src( $thumb_id, 'full' );
  $src  = false;
  if ( !empty($data[0]) ) {
    $src = $data[0];
  } else {
    $src = 'http://placehold.jp/'.$w.'x'.$h.'.png?text='.$txt;
  }
  return $src;
}


/**
 * モバイル判定
 */

function is_mobile() {
  $ua = array(
    'iPhone',         // Apple iPhone
    'iPod',           // Apple iPod touch
    'iPad',           // Apple iPad
    'Android',        // 1.5+ Android
    'dream',          // Pre 1.5 Android
    'CUPCAKE',        // 1.5+ Android
    'blackberry9500', // Storm
    'blackberry9530', // Storm
    'blackberry9520', // Storm v2
    'blackberry9550', // Storm v2
    'blackberry9800', // Torch
    'webOS',          // Palm Pre Experimental
    'incognito',      // Other iPhone browser
    'webmate'         // Other iPhone browser
  );
  $pattern = '/'.implode('|', $ua).'/i';
  $agent = $_SERVER['HTTP_USER_AGENT'];
  return preg_match($pattern, $agent);
}


/**
 * 文字列丸め込み
 * ex. echo mb_strimlen("メリークリスマス!", 0, 7, "...", 'UTF-8');
 *     メリーク...
 */

function mb_strimlen( $str, $start, $length, $trimmarker = '', $encoding = false ) {
  $encoding = $encoding ? $encoding : mb_internal_encoding();
  $str = mb_substr($str, $start, mb_strlen($str), $encoding);
  if (mb_strlen($str, $encoding) > $length) {
    $markerlen = mb_strlen($trimmarker, $encoding);
    $str = mb_substr($str, 0, $length - $markerlen, $encoding) . $trimmarker;
  }
  return $str;
}


/**
 * タイムスタンプ取得
 */

function getTimeStamp( $path ) {
  $url  = esc_url( get_template_directory_uri() ) . $path;
  if ( !file_exists($url) ) return date('Ymdhis');
  $file = $_SERVER['DOCUMENT_ROOT'] . parse_url($url, PHP_URL_PATH);
  return filemtime($file);
}


/**
 * 曜日（日本語）取得
 */

function getWeekJp( $date, $init = false ) {
  $week = array( '日', '月', '火', '水', '木', '金', '土' );
  $w = $week[date('w', $date)];
  if ( $init ) {
    $w .= '曜日';
  }
  return $w;
}


/**
 * パンくず
 */

if( !function_exists('origin_breadcrumb') ){

  function origin_breadcrumb($label = 'HOME'){

    global $post;
    // ポストタイプを取得
    $post_type = get_post_type( $post );

    $bc  = '<ol class="p-breadcrumb_list">';
    $bc .= '<li class="p-breadcrumb_item"><a class="p-breadcrumb_link" href="'.esc_url( home_url() ).'">'.$label.'</a></li>';

    if( is_home() ){
      // メインページ
      $bc .= '<li class="p-breadcrumb_item">最新記事一覧</li>';
    } elseif( is_search() ) {
      // 検索結果ページ
      $result = getSearchQuery($_GET);
      $title  = getSearchTitle($result);
      $bc .= '<li class="p-breadcrumb_item">'.$title.'</li>';
    } elseif( is_404() ) {
      // 404ページ
      $bc .= '<li class="p-breadcrumb_item">ページが見つかりませんでした</li>';
    } elseif( is_date() ) {
      // カスタム投稿の場合
      if( is_post_type_archive() ) {
        $obj = get_post_type_object($post_type);
        if( $obj->has_archive == true ){
          $bc .= '<li class="p-breadcrumb_item"><a class="p-breadcrumb_link" href="'.get_post_type_archive_link($post_type).'">'.get_post_type_object( $post_type )->label.'</a></li>';
        }
      }
      // 日付別一覧ページ
      $bc .= '<li class="p-breadcrumb_item">';
      if( is_day() ){
        $bc .= get_query_var( 'year' ).'年';
        $bc .= get_query_var( 'monthnum' ).'月';
        $bc .= get_query_var( 'day' ).'日';
      } elseif( is_month() ) {
        $bc .= get_query_var( 'year' ).'年';
        $bc .= get_query_var( 'monthnum' ).'月';
      } elseif( is_year() ) {
        $bc .= get_query_var( 'year' ).'年';
      }
      $bc .= '</li>';
    } elseif( is_post_type_archive() ) {
      // カスタムポストアーカイブ
      $bc .= '<li class="p-breadcrumb_item">'.post_type_archive_title('', false).'</li>';
    } elseif( is_category() ) {
      // カテゴリーページ
      $cat = get_queried_object();
      if( $cat -> parent != 0 ){
        $ancs = array_reverse(get_ancestors( $cat->cat_ID, 'category' ));
        foreach( $ancs as $anc ){
          $bc .= '<li class="p-breadcrumb_item"><a class="p-breadcrumb_link" href="'.get_category_link($anc).'">'.get_cat_name($anc).'</a></li>';
        }
      }
      $bc .= '<li class="p-breadcrumb_item">'.$cat->cat_name.'</li>';
    } elseif( is_tax() ) {
      // タクソノミー
      $query_obj = get_queried_object();
      $post_types = get_taxonomy( $query_obj->taxonomy )->object_type;
      $cpt = $post_types[0];
      $breadcrumbs[] = array( 'title' => get_post_type_object( $cpt )->label, 'link' => get_post_type_archive_link( $cpt ) );
      $taxonomy = get_query_var( 'taxonomy' );
      $term = get_term_by( 'slug', get_query_var( 'term' ), $taxonomy );
      if ( is_taxonomy_hierarchical( $taxonomy ) && $term->parent != 0 ) {
        $ancestors = array_reverse( get_ancestors( $term->term_id, $taxonomy ) );
        foreach ( $ancestors as $ancestor_id ) {
          $ancestor = get_term( $ancestor_id, $taxonomy );
          $breadcrumbs[] = array( 'title' => $ancestor->name, 'link' => get_term_link( $ancestor, $term->slug ) );
        }
      }
      $bc .= '<li class="p-breadcrumb_item"><a class="p-breadcrumb_link" href="'.get_post_type_archive_link( $cpt ).'">'.get_post_type_object( $cpt )->label.'</a></li>';
      $bc .= '<li class="p-breadcrumb_item">'.$term->name.'</li>';
    } elseif( is_tag() ) {
      // タグページ
      $bc .= '<li class="p-breadcrumb_item">'.single_tag_title("",false).'</li>';
    } elseif( is_author() ) {
      // 著者ページ
      $bc .= '<li class="p-breadcrumb_item">'.get_the_author_meta('display_name').'</li>';
    } elseif( is_attachment() ) {
      // 添付ファイルページ
      if( $post->post_parent != 0 ){
        $bc .= '<li class="p-breadcrumb_item"><a class="p-breadcrumb_link" href="'.get_permalink( $post->post_parent ).'">'.get_the_title( $post->post_parent ).'</a></li>';
      }
      $bc .= '<li class="p-breadcrumb_item">'.$post->post_title.'</li>';
    } elseif( is_singular( $post_type ) ) {

      $cats = get_the_category( $post->ID );
      $cat = $cats[0];
      // $link = esc_url( home_url('/information/') );
      $link = get_category_link( $anc );
      if( $cat->parent != 0 ){
        $ancs = array_reverse(get_ancestors( $cat->cat_ID, 'category' ));
        foreach( $ancs as $anc ){
          $bc .= '<li class="p-breadcrumb_item"><a class="p-breadcrumb_link" href="'.get_category_link( $anc ).'">'.get_cat_name($anc).'</a></li>';
        }
      }
      if($cat) {
        $bc .= '<li class="p-breadcrumb_item"><a class="p-breadcrumb_link" href="'.get_category_link( $cat->cat_ID ).'">'.$cat->cat_name.'</a></li>';
      }

      $obj = get_post_type_object($post_type);
      if( $obj->has_archive == true ){
        $bc .= '<li class="p-breadcrumb_item"><a class="p-breadcrumb_link" href="'.get_post_type_archive_link($post_type).'">'.get_post_type_object( $post_type )->label.'</a></li>';
      }
      $bc .= '<li class="p-breadcrumb_item">'.$post->post_title.'</li>';
    } else {
      // その他のページ
      $bc .= '<li class="p-breadcrumb_item">'.$post->post_title.'</li>';
    }

    $bc .= '</ol><!-- /.p-breadcrumb_list -->' . PHP_EOL;

    echo $bc;

  }
}


/**
 * ページャーの生成
 */

// オリジナル版
// ====================================== //
if( !function_exists('pagination') ){
  function pagination($pages = '', $range = 2) {
    $showitems = ($range * 2)+1;//表示するページ数（５ページを表示）

    global $paged;//現在のページ値
    if(empty($paged)) $paged = 1;//デフォルトのページ

    if($pages == '') {
      global $wp_query;
      $pages = $wp_query->max_num_pages;//全ページ数を取得POSTS_PER_PAGE_FOR_2ND);
      //全ページ数が空の場合は、１とする
      if(!$pages) {
        $pages = 1;
      }
    }

    //全ページが１でない場合はページネーションを表示する
    if(1 != $pages) {
      echo "<div class=\"p-pager\">\n";
      //Prev：現在のページ値が１より大きい場合は表示
      if($paged > 1) echo "<a class=\"p-pager_item\" href='".get_pagenum_link($paged - 1)."'>&lt;</a>\n";

      for ($i=1; $i <= $pages; $i++) {
        if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {
          if ( $paged == $i ) {
            echo "<span class=\"p-pager_item p-pager_item-current\">".$i."</span>\n";
          } else {
            echo "<a class=\"p-pager_item\" href='".get_pagenum_link($i)."'>".$i."</a>\n";
          }
        }
      }
      //Next：総ページ数より現在のページ値が小さい場合は表示
      if ($paged < $pages) echo "<a class=\"p-pager_item\" href=\"".get_pagenum_link($paged + 1)."\">&gt;</a>\n";
      echo "</div>\n";
    }
  }
}

// WP 純正カスタマイズ版
// ====================================== //
function wp_pagination() {
  global $wp_query;
  $big = 99999999;
  $page_format = paginate_links( array(
    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
    'format' => 'page/%#%/',
    'current' => max( 1, get_query_var('paged') ),
    'total' => $wp_query->max_num_pages,
    'mid_size' => 1,
    'prev_next' => True,
    'prev_text' => __('PREV'),
    'next_text' => __('NEXT'),
    'type' => 'array'
  ) );
  if( is_array($page_format) ) {
    $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
    echo '<div class="p-pager">';
    // echo '<li><span>'. $paged . ' of ' . $wp_query->max_num_pages .'</span></li>';
    foreach ( $page_format as $page ) {
      echo "$page";
    }
    echo '</div><!-- /.p-pager -->';
  }
  wp_reset_query();
}
