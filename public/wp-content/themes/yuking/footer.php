<?php
/**
 * The footer for our theme
 *
 * @package Theme yuking
 * @since 1.0
 * @version 1.0
 */
?>

<footer id="section-contact" class="l-footer" role="contentinfo">
  <div class="l-inner">

    <section class="l-section">
      <div class="l-inner">
        <h2 class="c-ttl-primary">Contact</h2>
        <p class="section_txt u-tac u-mb40">以下、SNSにてメッセージいただければ幸いでございます。</p>
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
      </div><!-- /.l-inner -->
    </section><!-- /#section-contact.l-section -->

  </div><!-- /.l-inner -->

  <p class="copyright" itemscope itemtype="http://schema.org/CreativeWork">
    <small>&copy; <span itemprop="copyrightYear">2019</span> <span itemprop="copyrightHolder">yuking11.net</span></small>
  </p><!-- /.copyright -->

</footer><!-- /.l-footer -->

<?php
  $js_timestamp = getTimeStamp( '/assets/js/app.js' );
  if ( isProduction() ) {
    $js_file = '/assets/js/app.min.js';
  } else {
    $js_file = '/assets/js/app.js?' . $js_timestamp;
  }
?>
<script defer src="<?php echo esc_url( get_template_directory_uri() . $js_file ); ?>"></script>
<?php
  wp_footer();
?>
<?php if ( isProduction() ) : ?>
<?php endif; ?>
</body>
</html>
