<?php
/**
 * header.php
 * ロゴ・サイトタイトルなど
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>      <!-- ← これがないと enqueue した CSS/JS が出力されません -->
</head>
<body <?php body_class(); ?>>

<header class="l-header">
  <div class="l-header__inner">
    <div class="l-header__logo">
      <span class="l-header__catch">catch copy</span>
    </div>
  </div>
</header>
<!-- ナブメニュー -->
<?php get_template_part( 'template-parts/subnav' ); ?>
