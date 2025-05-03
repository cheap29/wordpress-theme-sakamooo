<?php get_header(); ?>
<?php get_template_part('template-parts/hero'); ?>
<main class="l-main">
  <?php get_template_part('template-parts/section', 'grid'); ?>
  <?php get_template_part('template-parts/section', 'post'); ?>
  <?php get_template_part('template-parts/section-list'); ?>
</main>
<?php get_footer(); ?>