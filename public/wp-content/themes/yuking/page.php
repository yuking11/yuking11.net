<?php
/**
 * The template for displaying all pages
 *
 * @package Theme yuking
 * @since 1.0
 * @version 1.0
 */

  get_header();

  if ( have_posts() ) :
    while ( have_posts() ) : the_post();
?>

<div class="l-wrap page page-<?php echo $post->post_name; ?>">

<main class="l-main l-main-col1" role="main">

  <article class="p-post p-post_detail-page">
    <h1 class="c-ttl-primary"><?php the_title(); ?></h1>
    <div class="p-post_content">

<?php
  echo do_shortcode( get_the_content() );
?>

    </div><!-- /.p-post_content -->
  </article><!-- /.p-post p-post_detail-page -->

</main><!-- /.l-main -->

</div><!-- /.l-wrap page page-<?php echo $post->post_name; ?>  -->

<?php
    endwhile;
  endif;

  get_footer();
