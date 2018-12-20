<?php
/**
 * The 404 template file
 *
 * @package Theme yuking
 * @since 1.0
 * @version 1.0
 */

  get_header();

  // if (have_posts()) :
  //   while (have_posts()) : the_post();
?>

<div class="l-contents_head">

<div class="p-mv p-mv-lows">
  <div class="p-mv_inner">

    <div class="p-mv_ttl">
      <span class="p-mv_ttl-main">404</span>
      <span class="p-mv_ttl-sub">- Not Found -</span>
    </div><!-- /.p-mv_ttl -->

  </div><!-- /.p-mv_inner -->
</div><!-- /.p-mv p-mv-lows -->

<?php
  // パンくず
  if ( function_exists('cin_breadcrumb') ) {
    include_once(__DIR__.'/template_parts/breadcrumb.php');
  }
?>

</div><!-- /.l-contents_head -->

<div class="l-wrap">

<main class="l-main-lows l-main-col1 not_found" role="main">


  <section class="section">

    <h1 class="c-ttl-primary">404 Not Found</h1>

    <p class="section_txt u-tac">URLが正しく入力されていないか、このページが削除された可能性があります。</p>

    <div class="c-btn_wrap">
      <a href="<?php echo esc_url( home_url('/') ); ?>" class="c-btn">TOPへ</a>
    </div><!-- /.c-btn_wrap -->

  </section><!-- /.section -->

</main><!-- /.l-main-lows -->

</div><!-- /.l-wrap -->

<?php
  //   endwhile;
  // endif;

  get_footer();
