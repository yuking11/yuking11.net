<?php
/**
 * The header for our theme
 *
 * @package Theme yuking
 * @since 1.0
 * @version 1.0
 */

// require_once (__DIR__ . '/inc/redirect.php');

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="<?php echo $browser_class; ?>">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width">
<meta name="format-detection" content="telephone=no">
<title><?php echo wp_get_document_title(); ?></title>
<?php
  // GTM
  if ( isProduction() ) :
?>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-PL3KJCJ');</script>
<!-- End Google Tag Manager -->
<?php
  endif;
  // Fonts
// <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800" rel="stylesheet">

?>

<link rel="preload" href="https://fonts.googleapis.com/css?family=M+PLUS+1p:400,700|Nunito:400,700" as="font" type="font/woff2" crossorigin="anonymous">
<link rel="preload" href="https://fonts.googleapis.com/css?family=M+PLUS+1p:400,700|Nunito:400,700" as="font" type="font/woff" crossorigin="anonymous">
<link rel="preload" href="https://fonts.googleapis.com/css?family=M+PLUS+1p:400,700|Nunito:400,700" as="style">
<?php
  /*
<link href="https://fonts.googleapis.com/css?family=M+PLUS+1p:400,700|Nunito:400,700" rel="stylesheet">
  */
  $css_timestamp = getTimeStamp( '/assets/css/app.css' );
  if ( isProduction() ) {
    // $css_file = '/assets/css/app.css?' . $css_timestamp;
    $css_file = '/assets/css/app.min.css';
  } else {
    $css_file = '/assets/css/app.css?' . $css_timestamp;
  }
?>
<link rel="preload" href="<?php echo esc_url( get_template_directory_uri() . $css_file ); ?>" as="style">
<link rel="preload" href="<?php echo esc_url( get_template_directory_uri() ); ?>/style.css" as="style">
<link href="<?php echo esc_url( get_template_directory_uri() . $css_file ); ?>" rel="stylesheet" media="all">
<link href="<?php echo esc_url( get_template_directory_uri() ); ?>/style.css" rel="stylesheet" media="all">
<?php
  // wp_deregister_script('jquery');
  // wp_enqueue_script('jquery', esc_url( get_template_directory_uri() . '/assets/js/libs/jquery-3.2.1.min.js' ), array(), '3.2.1');
  wp_head();
  $body_class = 'l-body l-body-top';
  if ( !is_home() && !is_front_page() ) {
    $body_class = 'l-body l-body-lows';
  }
?>
<body <?php body_class($body_class); ?> ontouchstart="">

<?php if ( isProduction() ) : ?>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PL3KJCJ"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<?php endif; ?>

<header class="l-header" role="banner">
  <div class="l-inner">

    <div class="p-logo">
      <a href="<?php echo esc_url( home_url('/') ); ?>" class="p-logo_link">
        <svg id="p-logo_svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 671.813 76.875">
          <path id="p-logo_path" data-name="&lt;yuking11.net/&gt;" class="" d="M63.9,200.888l30.88,20v-10.64l-21.2-13.28v-0.32l21.2-13.28v-10.64l-30.88,20v8.16Zm42.159,26.64-2.08,8.96a16.822,16.822,0,0,0,2.8.6,25.435,25.435,0,0,0,3.28.2,20.612,20.612,0,0,0,6.6-.96,14.721,14.721,0,0,0,5-2.84,19.059,19.059,0,0,0,3.84-4.72,43.7,43.7,0,0,0,3.12-6.6l15.68-40.08h-11.12l-5.84,17.04q-0.88,2.96-1.84,5.96t-1.76,5.96h-0.32q-0.96-3.12-1.92-6.12t-2.08-5.8l-6.64-17.04H101.1l17.2,38.64-0.8,2.08a8.69,8.69,0,0,1-2.92,3.76,8.957,8.957,0,0,1-5.4,1.44,10.3,10.3,0,0,1-3.12-.48h0Zm78.56-45.44h-11.76v26.08a13.991,13.991,0,0,1-3.8,3.6,8,8,0,0,1-3.96.96q-3.36,0-4.56-1.84t-1.2-5.84v-22.96h-11.76v24.48q0,7.519,3.04,11.84t9.84,4.32a15.09,15.09,0,0,0,7.52-1.8,22.09,22.09,0,0,0,5.84-4.84h0.32l0.88,5.68h9.6v-39.68Zm8.079,39.68h11.76v-9.84l5.92-5.76,10.32,15.6h12.72l-16.24-23.36,15.04-16.32h-12.88l-14.64,15.68-0.24.08v-32.16H192.7v56.08Zm44.239-30.48h15.92v30.48h11.76v-39.68H236.94v9.2Zm26.92-16.96a6.55,6.55,0,0,0,2.2-5.2,6.921,6.921,0,0,0-2.2-5.32,8.816,8.816,0,0,0-11.28,0,6.918,6.918,0,0,0-2.2,5.32,6.547,6.547,0,0,0,2.2,5.2A9.244,9.244,0,0,0,263.86,174.328Zm16.519,47.44h11.76v-26.48a19.436,19.436,0,0,1,3.88-3.12,8.25,8.25,0,0,1,4.2-1.04q3.281,0,4.56,1.84t1.28,5.84v22.96h11.76v-24.48q0-7.519-3.12-11.84t-9.84-4.32a15.833,15.833,0,0,0-7.8,1.84,26.276,26.276,0,0,0-5.88,4.4h-0.32l-0.88-5.28h-9.6v39.68Zm52.64,2.92a7.422,7.422,0,0,1,2.16-1.88,20.385,20.385,0,0,0,2.52.36q1.4,0.12,3.56.12h4.96a17.079,17.079,0,0,1,5.2.6,2.424,2.424,0,0,1,1.76,2.52q0,2.079-2.96,3.48a18.3,18.3,0,0,1-7.76,1.4,19.107,19.107,0,0,1-7.4-1.16q-2.682-1.161-2.68-3.4A3.477,3.477,0,0,1,333.019,224.688Zm-8.88,8.36a10.281,10.281,0,0,0,3.76,3.16,20.322,20.322,0,0,0,5.72,1.84,40.276,40.276,0,0,0,7.16.6,40.977,40.977,0,0,0,9.76-1.08,25.859,25.859,0,0,0,7.44-2.96,14.519,14.519,0,0,0,4.72-4.52,10.521,10.521,0,0,0,1.68-5.76q0-5.359-4.12-7.68t-11.96-2.32h-7.36a13.344,13.344,0,0,1-5.12-.72,2.409,2.409,0,0,1-1.6-2.32,2.755,2.755,0,0,1,.44-1.6,5.467,5.467,0,0,1,1.32-1.28,20.361,20.361,0,0,0,5.44.8,24.938,24.938,0,0,0,6.44-.8,15.127,15.127,0,0,0,5.2-2.44,11.851,11.851,0,0,0,3.48-4.12,12.777,12.777,0,0,0,1.28-5.92,8.026,8.026,0,0,0-.56-3,8.709,8.709,0,0,0-1.28-2.28h8.08v-8.56h-16.08a20.712,20.712,0,0,0-6.56-.96,22.386,22.386,0,0,0-6.44.92,16.321,16.321,0,0,0-5.4,2.72,13.062,13.062,0,0,0-5.12,10.76,11.9,11.9,0,0,0,1.52,6.12,12.033,12.033,0,0,0,3.68,4.04v0.32a12.621,12.621,0,0,0-3.4,3.44,7.217,7.217,0,0,0-1.32,4,6.753,6.753,0,0,0,1.2,4.16,10.91,10.91,0,0,0,2.8,2.64v0.32q-6.162,3.039-6.16,7.92A7.675,7.675,0,0,0,324.139,233.048Zm13.08-32.6a6.488,6.488,0,0,1-1.72-4.92,6.376,6.376,0,0,1,1.72-4.84,5.858,5.858,0,0,1,4.2-1.64,6.144,6.144,0,0,1,4.28,1.64,6.22,6.22,0,0,1,1.8,4.84,6.327,6.327,0,0,1-1.8,4.92,6.144,6.144,0,0,1-4.28,1.64A5.858,5.858,0,0,1,337.219,200.448Zm56.839,11.8v-41.28h-8.64a36.76,36.76,0,0,1-5.96,2.72,48.866,48.866,0,0,1-7.64,1.92v7.28H382.3v29.36h-13.12v9.52h36.4v-9.52h-11.52Zm44,0v-41.28h-8.64a36.721,36.721,0,0,1-5.96,2.72,48.838,48.838,0,0,1-7.64,1.92v7.28H426.3v29.36h-13.12v9.52h36.4v-9.52h-11.52Zm29.839,7.8a9.766,9.766,0,0,0,13.441,0,9.294,9.294,0,0,0,2.559-6.68,10.036,10.036,0,0,0-.68-3.72,9.379,9.379,0,0,0-1.879-3,8.4,8.4,0,0,0-2.92-2,10.39,10.39,0,0,0-7.6,0,8.389,8.389,0,0,0-2.92,2,9.345,9.345,0,0,0-1.879,3,10.016,10.016,0,0,0-.68,3.72A9.29,9.29,0,0,0,467.9,220.048Zm32.48,1.72h11.76v-26.48a19.408,19.408,0,0,1,3.88-3.12,8.25,8.25,0,0,1,4.2-1.04q3.279,0,4.56,1.84t1.28,5.84v22.96h11.76v-24.48q0-7.519-3.12-11.84t-9.84-4.32a15.827,15.827,0,0,0-7.8,1.84,26.231,26.231,0,0,0-5.88,4.4h-0.32l-0.88-5.28h-9.6v39.68Zm44.359-11.04a19.32,19.32,0,0,0,4.68,6.52,20.146,20.146,0,0,0,6.96,4.08,26.006,26.006,0,0,0,8.64,1.4,28.508,28.508,0,0,0,8.16-1.24,29.309,29.309,0,0,0,7.52-3.4l-3.84-7.04a26.925,26.925,0,0,1-5.08,2.04,19.155,19.155,0,0,1-5.16.68,13.436,13.436,0,0,1-7.52-2.04,9.609,9.609,0,0,1-4-6.6h26.72q0.159-.72.32-2.04a24.528,24.528,0,0,0,.16-2.92,23.046,23.046,0,0,0-1.2-7.56,17.265,17.265,0,0,0-3.52-6.04,15.832,15.832,0,0,0-5.84-4,22.38,22.38,0,0,0-15.8,0,20.4,20.4,0,0,0-6.6,4.12,19.883,19.883,0,0,0-4.6,6.52A23.167,23.167,0,0,0,544.735,210.728Zm10.2-12.88a8.949,8.949,0,0,1,3.24-5.88,9.321,9.321,0,0,1,5.72-1.88q4.08,0,5.92,2.16a8.339,8.339,0,0,1,1.84,5.6h-16.72Zm41.6,7.44a26.819,26.819,0,0,0,.88,7.12,13.419,13.419,0,0,0,2.92,5.48,13.639,13.639,0,0,0,5.32,3.56,22.1,22.1,0,0,0,8,1.28,35.179,35.179,0,0,0,7.12-.68q3.28-.68,5.92-1.48l-2.08-8.48a26.18,26.18,0,0,1-3.72,1.04,21.4,21.4,0,0,1-4.28.4q-4.32,0-6.32-1.88t-2-6.44v-13.92h16.72v-9.2h-16.72v-10.56h-9.68l-1.52,10.56-10.48.48v8.72h9.92v14Zm98.56-40.32h-9.84l-26.32,69.6h9.84Zm40.639,27.76-30.88-20v10.64l21.2,13.28v0.32l-21.2,13.28v10.64l30.88-20v-8.16Z" transform="translate(-63.906 -161.781)"/>
        </svg>
      </a>
    </div><!-- /.p-logo -->

    <nav class="p-nav" role="navigation">
      <ul class="p-nav_inner">
        <li class="p-nav_item">
          <?php
            if (is_home() || is_front_page()) {
              echo '<a href="#" class="p-nav_link" data-scroll>Home</a>';
            } else {
              echo '<a href="'. esc_url( home_url('/') ) . ' class="p-nav_link">Home</a>';
            }
          ?>
        </li>
        <li class="p-nav_item">
          <a href="#section-about" class="p-nav_link" data-scroll>About</a>
        </li>
        <li class="p-nav_item">
          <a href="#section-portfolio" class="p-nav_link" data-scroll>Portfolio</a>
        </li>
        </li>
        <li class="p-nav_item">
          <a href="#section-blog" class="p-nav_link" data-scroll>Qiita</a>
        </li>
        <?php
          /*
        <li class="p-nav_item">
          <a href="<?php echo esc_url( home_url('/blog/') ); ?>" class="p-nav_link">Blog</a>
        </li>
          */
        ?>
        <li class="p-nav_item">
          <a href="#section-contact" class="p-nav_link" data-scroll>Contact</a>
        </li>
      </ul>
    </nav><!-- /.p-nav -->

    <div class="c-sns_wrap">
      <ul class="c-sns">
        <li class="c-sns_item">
          <a href="https://www.facebook.com/yuking.sa" class="c-sns_link" target="_blank" rel="noopener">
            <i class="c-sns_icon icon-facebook" title="Facebook"></i>
          </a>
        </li>
        <li class="c-sns_item">
          <a href="https://twitter.com/yuking11" class="c-sns_link" target="_blank" rel="noopener">
            <i class="c-sns_icon icon-twitter" title="Twitter"></i>
          </a>
        </li>
        <li class="c-sns_item">
          <a href="https://www.linkedin.com/in/yuki-saitoh-121198132/" class="c-sns_link" target="_blank" rel="noopener">
            <i class="c-sns_icon icon-linkedin" title="LinkedIn"></i>
          </a>
        </li>
      </ul><!-- /.c-sns -->
    </div><!-- /.c-sns_wrap -->

  </div><!-- /.l-inner -->
</header><!-- /.l-header -->


<div class="l-nav l-nav-sp" data-nav>
  <input type="checkbox" id="gnav_ctrl" name="gnav_ctrl">
  <label for="gnav_ctrl" class="gnav_btn"><span class="gnav_btn_inner"></span></label>
  <label for="gnav_ctrl" class="gnav_bg"></label>
  <nav class="l-nav_inner gnav" role="navigation" data-gnav>
    <ul class="c-sns">
      <li class="c-sns_item">
        <a href="https://www.facebook.com/yuking.sa" class="c-sns_link" target="_blank" rel="noopener">
          <i class="c-sns_icon icon-facebook" title="Facebook"></i>
        </a>
      </li>
      <li class="c-sns_item">
        <a href="https://twitter.com/yuking11" class="c-sns_link" target="_blank" rel="noopener">
          <i class="c-sns_icon icon-twitter" title="Twitter"></i>
        </a>
      </li>
      <li class="c-sns_item">
        <a href="https://www.linkedin.com/in/yuki-saitoh-121198132/" class="c-sns_link" target="_blank" rel="noopener">
          <i class="c-sns_icon icon-linkedin" title="LinkedIn"></i>
        </a>
      </li>
    </ul><!-- /.c-sns -->
    <ul class="gnav_list" data-nav_list>
      <li class="gnav_item"><?php
        if (is_home() || is_front_page()) {
          echo '<a href="#" class="gnav_link" data-scroll>Home</a>';
        } else {
          echo '<a href="'. esc_url( home_url('/') ) . ' class="p-nav_link">Home</a>';
        }
      ?></li>
      <li class="gnav_item"><a href="#section-about" class="gnav_link" data-scroll>About</a></li>
      <li class="gnav_item"><a href="#section-portfolio" class="gnav_link" data-scroll>Portfolio</a></li>
      <li class="gnav_item"><a href="#section-blog" class="gnav_link" data-scroll>Qiita</a></li>
      <?php
        /*
      <li class="gnav_item"><a href="<?php echo esc_url( home_url('/blog/') ); ?>" class="gnav_link">Blog</a></li>
        */
      ?>
      <li class="gnav_item"><a href="#section-contact" class="gnav_link" data-scroll>Contact</a></li>
    </ul><!-- /.gnav_list -->
  </nav><!-- /.l-nav_inner gnav -->
</div><!-- /.l-nav l-nav-sp -->

