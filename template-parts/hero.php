<?php
/**
 * template-parts/hero.php
 * メインビジュアルとスクロール誘導（＋オーバーレイ見出し）
 */
?>

<section class="l-hero">
  <div class="l-hero__inner">
    <h1  class="c-section-title--overlay" >
      <?php echo esc_html( get_theme_mod('hero-title-text', get_bloginfo('name')) ); ?>
      <br>
      <span>
        <?php echo esc_html( get_theme_mod('hero-subtitle-text', get_bloginfo('description')) ); ?>
      </span>
    </h1>
    
    <div class="l-hero__visual">
      <?php if ( has_header_image() ) : ?>
        <img src="<?php echo esc_url( get_header_image() ); ?>" alt="">
      <?php endif; ?>
    </div>

  </div>
</section>
