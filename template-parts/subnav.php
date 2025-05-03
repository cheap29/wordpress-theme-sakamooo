<?php
/**
 * template-parts/subnav.php
 * メニュー＋検索フォームを sticky で固定する部分
 */
?>
<div class="l-subnav">
  <nav class="l-subnav__nav js-menu">
    <?php
      wp_nav_menu([
        'theme_location' => 'primary',
        'container'      => false,             
        'menu_class'     => 'l-subnav__nav-list',
        'fallback_cb'    => 'wp_page_menu',      
      ]);
    ?>
  </nav>

  <form role="search" class="l-subnav__search" action="<?php echo home_url('/'); ?>">
    <input type="search" name="s" placeholder="Search…">
    <button type="submit">🔍</button>
  </form>

  <button class="l-subnav__toggle js-menu-toggle" aria-label="Menu">
    <span></span><span></span><span></span>
  </button>
</div>
<main class="l-main">
