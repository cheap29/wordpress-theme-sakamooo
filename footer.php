<?php
/**
 * footer.php
 * フッター
 */
?>

<?php
// カスタマイザーで選ばれた固定ページID
$footer_page_id = get_theme_mod('footer_page_id', 0);

if ( $footer_page_id ) {
  $footer_page = get_post( $footer_page_id );
  if ( $footer_page && ! is_wp_error( $footer_page ) ) :
?>
  <section class="footer-page-block">
    <div class="footer-page-block__inner">
      <h2 class="footer-page-block__title">
        <?php echo esc_html( get_the_title( $footer_page ) ); ?>
      </h2>
      <div class="footer-page-block__content">
        <?php
          // ショートコードやフィルターを展開してコンテンツを表示
          echo apply_filters( 'the_content', $footer_page->post_content );
        ?>
      </div>
    </div>
  </section>
<?php
  endif;
}
?>


<footer class="l-footer">
  <div class="l-footer__inner">
    <p>&copy; <?php echo date('Y'); ?> this site create by <a href="https://sakamooo.com/">sakamoto企画</a> All rights reserved.</p>
  </div>
</footer>
<?php wp_footer(); ?>