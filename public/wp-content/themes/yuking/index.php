<?php
/**
 * The main template file
 *
 * @package Theme yuking
 * @since 1.0
 * @version 1.0
 */

  get_header();
?>

<div class="p-hero p-hero-top">
  <div class="p-hero_inner">

    <video poster="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/top/hero_01.jpg" muted autoplay loop class="p-hero_video">
      <source src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/top/hero_01.mp4" type="video/mp4">
    </video>

    <div class="p-hero_content">
      <h1 class="p-hero_ttl">Yuki Saito's<br>Portfolio Site</h1>
      <p class="p-hero_txt">Web Engineer</p>
    </div><!-- /.p-hero_content -->

  </div><!-- /.p-hero_inner -->
</div><!-- /.p-hero p-hero-top -->

<div class="l-container">
  <main class="l-main" role="main">

    <section id="section-about" class="l-section-top">
      <div class="l-inner">

        <h2 class="c-ttl-primary">About Me</h2>
        <div class="p-profile">
          <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/top/about.png" alt="" class="p-profile_img">
          <div class="p-profule_content">
            <h3 class="p p-profile_ttl">Yuki Saito（@Yuking11）</h3>
            <p class="p-profile_txt">東京／渋谷でとある会社のWeb事業部・フロントエンドエンジニアとして働いております。</p>
            <p class="p-profile_txt">といっても最近になってようやくVueに手を出し始めた、わりとオールドタイプのエンジニアです。</p>
            <p class="p-profile_txt">バックエンドも修行中、インフラ系もLAMP／LNMP環境くらいは難なく構築できます。</p>
            <ul class="c-sns c-sns-start">
              <li class="c-sns_item">
                <a href="https://github.com/yuking11" class="c-sns_link" target="_blank" rel="noopener">
                  <i class="c-sns_icon icon-github" title="Github"></i>
                  <span class="c-sns_txt">Github</span>
                </a>
              </li>
            </ul><!-- /.c-sns -->
          </div><!-- /.p-profule_content -->
        </div><!-- /.p-profile -->

        <h3 class="c-ttl-secondary">Skills</h3>
        <dl class="c-skill">
          <div class="c-skill_row">
            <dt class="c-skill_term">HTML</dt>
            <dd class="c-skill_desc c-skill_desc-4"><span class="p-skill_txt">かなりわかる</span></dd>
            <dt class="c-skill_term">CSS／SCSS</dt>
            <dd class="c-skill_desc c-skill_desc-4"><span class="p-skill_txt">かなりわかる</span></dd>
          </div>
          <div class="c-skill_row">
            <dt class="c-skill_term">JavaScript</dt>
            <dd class="c-skill_desc c-skill_desc-3"><span class="p-skill_txt">まぁまぁわかる</span></dd>
            <dt class="c-skill_term">Vue.js</dt>
            <dd class="c-skill_desc c-skill_desc-2"><span class="p-skill_txt">基本はわかる</span></dd>
          </div>
          <div class="c-skill_row">
            <dt class="c-skill_term">jQuery</dt>
            <dd class="c-skill_desc c-skill_desc-3"><span class="p-skill_txt">まぁまぁわかる</span></dd>
            <dt class="c-skill_term">Git</dt>
            <dd class="c-skill_desc c-skill_desc-2"><span class="p-skill_txt">基本はわかる</span></dd>
          </div>
          <div class="c-skill_row">
            <dt class="c-skill_term">PHP</dt>
            <dd class="c-skill_desc c-skill_desc-3"><span class="p-skill_txt">まぁまぁわかる</span></dd>
            <dt class="c-skill_term">MySQL</dt>
            <dd class="c-skill_desc c-skill_desc-2"><span class="p-skill_txt">基本はわかる</span></dd>
          </div>
          <div class="c-skill_row">
            <dt class="c-skill_term">gulp</dt>
            <dd class="c-skill_desc c-skill_desc-3"><span class="p-skill_txt">まぁまぁわかる</span></dd>
            <dt class="c-skill_term">webpack</dt>
            <dd class="c-skill_desc c-skill_desc-3"><span class="p-skill_txt">まぁまぁわかる</span></dd>
          </div>
          <div class="c-skill_row">
            <dt class="c-skill_term">Linux</dt>
            <dd class="c-skill_desc c-skill_desc-2"><span class="p-skill_txt">基本はわかる</span></dd>
            <dt class="c-skill_term">Web Design</dt>
            <dd class="c-skill_desc c-skill_desc-0"><span class="p-skill_txt">破滅的センス</span></dd>
          </div>
        </dl><!-- /.c-skill -->

      </div><!-- /.l-inner -->
    </section><!-- /.l-section-top -->

<?php
  $portfolio = get_posts( array(
    'post_type'   => 'portfolio',
    'post_status' => 'publish',
    'posts_per_page' => get_option('posts_per_page'),
  ) );
  if ( $portfolio ) :
?>
    <section id="section-portfolio" class="l-section-top">
      <div class="l-inner">

        <h2 class="c-ttl-primary">Portfolio</h2>

        <div class="p-post_list" data-more-post_wrap data-post_type="portfolio" data-post_cat="">
<?php
  foreach ( $portfolio as $post ) :
    setup_postdata( $post );
    // アイキャッチ画像のID/URL取得
    $img_src = getAttachUrl();
    // tag
    $tags = get_the_terms( $post->ID, 'portfolio-tag' );
?>
          <article class="p-post_item" data-post_item>
            <div class="p-post_head">
              <img src="<?php echo $img_src; ?>" alt="<?php the_title(); ?>" class="p-post_img">
              <div class="p-post_summary">
                <div class="p-post_summary_ttl"><?php the_title(); ?></div>
                <p class="p-post_summary_txt"><?php echo get_field('pt_outline', $post->ID); ?></p>
              </div>
            </div>
            <h3 class="p-post_ttl"><?php the_title(); ?></h3>
            <p class="p-post_url"><i class="p-post_icon icon-external" aria-hidden="true"></i><a href="<?php echo get_field('pt_url', $post->ID); ?>" class="p-post_link" target="_blank" rel="noopener noreferrer"><?php echo get_field('pt_url', $post->ID); ?></a></p>
            <ul class="p-post_tags"><?php
                foreach ($tags as $tag => $value) {
                  echo '<li class="p-post_tag">' . $value->name . '</li>';
                }
            ?></ul><!-- /.p-post_tags -->
          </article><!-- /.p-post_item -->
<?php
  endforeach;
  wp_reset_postdata();
?>
        </div><!-- /.p-post_list -->

        <div class="c-btn_wrap" data-btn_more-wrap>
          <a href="#" class="c-btn c-btn-black c-btn-large c-btn-icon" data-btn_more>
            <span class="c-btn_txt">More</span>
            <i class="c-btn_icon icon-refresh" aria-hidden="true"></i>
          </a>
        </div><!-- /.c-btn_wrap -->

      </div><!-- /.l-inner -->
    </section><!-- /.l-section-top -->
<?php
  endif;
  unset($portfolio);
?>

<?php
  //
  // https://qiita.com/api/v2/docs#get-apiv2authenticated_useritems
  //
  $json = [
    'page'     => '1',
    'per_page' => '6',
  ];
  $curl = curl_init('https://qiita.com/api/v2/authenticated_user/items');
  $option = [
    CURLOPT_CUSTOMREQUEST  => 'GET',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POSTFIELDS     => json_encode($json),
    CURLOPT_HTTPHEADER     => [
      'Authorization: Bearer 2ba25d7b283594165c0c9fdd6c6a4c7d8b720b5a',
      'Content-Type: application/json',
    ],
  ];
  curl_setopt_array($curl, $option);
  $qiita = json_decode(curl_exec($curl));
  curl_close($curl);
  if ( $qiita ) :
?>
    <section id="section-blog" class="l-section-top">
      <div class="l-inner">

        <h2 class="c-ttl-primary">Qiita</h2>

        <div class="p-post_list">
<?php
  foreach ( $qiita as $item ) :
?>
          <article class="p-post_item">
            <a href="<?php echo $item->url; ?>" class="p-post_link p-post_link-qiita" target="_blank" rel="noopener noreferrer">
              <div class="p-post_head">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/top/qiita_logo.png" alt="<?php echo $item->title; ?>" class="p-post_img">
                <div class="p-post_summary">
                  <div class="p-post_summary_ttl"><?php echo $item->title; ?></div>
                  <p class="p-post_summary_txt">
                    <?php echo getExcerpt($item->rendered_body, 80); ?>
                  </p>
                </div>
              </div>
              <h3 class="p-post_ttl"><?php echo $item->title; ?></h3>
              <p class="p-post_likes"><i class="p-post_icon icon-thumbs-up" aria-hidden="true"></i><span>いいね <?php echo $item->likes_count; ?></span></p>
              <ul class="p-post_tags"><?php
                  foreach ($item->tags as $tag => $value) {
                    echo '<li class="p-post_tag">' . $value->name . '</li>';
                  }
              ?></ul><!-- /.p-post_tags -->
            </a>
          </article><!-- /.p-post_item -->
<?php
  endforeach;
  wp_reset_postdata();
?>
        </div><!-- /.p-post_list -->

        <div class="c-btn_wrap">
          <a href="https://qiita.com/yuking11" class="c-btn c-btn-black c-btn-large c-btn-icon" target="_blank" rel="noopener noreferrer">
            <span class="c-btn_txt">More</span>
            <i class="c-btn_icon icon-external" aria-hidden="true"></i>
          </a>
        </div><!-- /.c-btn_wrap -->

      </div><!-- /.l-inner -->
    </section><!-- /.l-section-top -->
<?php
  endif;
  unset($qiita);
?>

<?php
  /*
    <section id="section-blog" class="l-section-top">
      <div class="l-inner">

        <h2 class="c-ttl-primary">Blog</h2>

      </div><!-- /.l-inner -->
    </section><!-- /.l-section-top -->
  */
?>

  </main>
</div><!-- /.l-container -->

<?php
  get_footer();
