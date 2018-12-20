<?php
/**
 * functions and definitions
 */

// ホームURL
// ====================================== //
function getHomeUrl($attr) {
  extract( shortcode_atts( array(
    'attr' => '',
  ), $attr) );
  return esc_url( home_url($attr) );
}
add_shortcode('home_url', 'getHomeUrl');


// テンプレートディレクトリ
// ====================================== //
function getTempalteDirectoryUri($attr) {
  extract( shortcode_atts( array(
    'attr' => '',
  ), $attr) );
  return esc_url( get_template_directory_uri() . $attr );
}
add_shortcode('get_template_directory_uri', 'getTempalteDirectoryUri');


// Uploadディレクトリ
// ====================================== //
function getUploadDirectoryUri($attr) {
  extract( shortcode_atts( array(
    'attr' => '',
  ), $attr) );
  return esc_url( home_url('/wp-content/uploads' . $attr) );
}
add_shortcode('get_upload_directory_uri', 'getUploadDirectoryUri');


// php include
// ====================================== //
function includeMyPhp( $params = array() ) {
  extract( shortcode_atts( array(
    'file' => 'default',
    'dir'  => '/template_parts',
  ), $params) );
  ob_start();
  include( get_theme_root() . '/' . get_template() . $dir . '/' .$file . '.php' );
  return ob_get_clean();
}
add_shortcode('phpinc', 'includeMyPhp');


// get custom field (ACF)
// ====================================== //
function getCustomField( $params = array() ) {
  extract( shortcode_atts( array(
    'name' => '',
    'id'   => $post->ID,
  ), $params) );
  ob_start();
  if ( $id === 'options' ) {
    return get_field($name, 'options');
  } else {
    return get_field($name, $id);
  }
}
add_shortcode('gcf', 'getCustomField');


// get index
// ====================================== //
function makeIndex() {
  global $post;
  $content = trim($post->post_content);
  $index   = array();
  preg_match_all('/<h[1-6].+?<\/h[1-6]>/u', $content, $matches);
  foreach ( $matches as $match => $html ) {
    foreach ( $html as $key => $value ) {
      preg_match( '/<h(\w+)/', $value, $str );
      preg_match( '/<h[1-6] id="(\w+)"/', $value, $id );
      array_push( $index,
        array(
          'h' => $str[1],
          'id'   => $id[1],
          'text' => trim( strip_tags($value) )
        )
      );
    }
  }
  $current_h = 1;
  $html = '';
  $html .= '<section class="p-post_index">';
  $html .= '<h2 class="p-post_index_ttl">このページの目次</h2>';
  $html .= '<div class="p-post_index_list_wrap">';

  foreach ( $index as $key => $value ) {
    while ( $current_h > (int) $value['h'] ) {
      $current_h--;
      $html .= '</li>';
      $html .= '</ol>';
    }
    if ( $current_h === (int) $value['h'] ) {
      $html .= '</li><li class="list_item list_item-h'. $value['h'] .'">';
    } else {
      while ( $current_h < (int) $value['h'] ) {
        $current_h++;
        $html .= '<ol class="p-post_index_list">';
        $html .= '<li class="list_item list_item-h'. $value['h'] .'">';
      }
    }
    $html .= '<a href="#'.$value['id'].'" class="list_link" data-scroll>';
    $html .= $value['text'];
    $html .= '</a>';
  }
  $html .= '</div><!-- /.p-post_index_list_wrap -->';
  $html .= '</section>';
  return $html;
}
add_shortcode('make_index', 'makeIndex');
