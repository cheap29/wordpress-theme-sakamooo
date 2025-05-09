<?php
/**
 * template-parts/hero.php
 * メインビジュアルとスクロール誘導（＋オーバーレイ見出し）
 */
?>

<section class="l-hero">
  <div class="l-hero__inner">
    <h1
      class="c-section-title--overlay"
      style="
        top: var(--hero-title-top);
        left: var(--hero-title-left);
        font-size: var(--hero-title-size);
        background-color: #666;
        background-clip: text;
      "
    >
      <?php echo esc_html( get_theme_mod('hero-title-text', get_bloginfo('name')) ); ?>
      <br>
      <span style="font-size: 0.6em; ">
        <?php echo esc_html( get_theme_mod('hero-subtitle-text', get_bloginfo('description')) ); ?>
      </span>
    </h1>
    
    <div class="l-hero__visual">
      <?php if ( has_header_image() ) : ?>
        <img loading="lazy" src="<?php echo esc_url( get_header_image() ); ?>" alt="">
      <?php else : ?>
        <img loading="lazy" src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/hero-placeholder.jpg' ); ?>" alt="">
      <?php endif; ?>
    </div>

    <div class="l-hero__scroll">
      <p class="l-hero__scroll-arrow">⌄</p>
    </div>

  </div>
</section>
