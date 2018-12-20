<?php
/**
 * パーマリンク日本語検証
 */

add_action('admin_notices', 'validate_permalink');

function validate_permalink() {
  global $pagenow;
  if ($pagenow == 'post.php') {
    $post_name = get_post()->post_name;
    $decoded = urldecode($post_name);
    if (!preg_match('/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+/', $decoded)) {
      echo '<div class="message error"><p>パーマリンク（URL）に日本語が含まれています！</p></div>';
    }
  }
}
