<?php
/**
 * template-parts/section-grid.php
 * グリッドレイアウト／テキストセクション
 */

$category = get_theme_mod('grid_category', '');

$args = [
  'post_type'      => 'page',
  'posts_per_page' => 3,
  'orderby'        => 'date',
  'order'          => 'DESC',
];

if ( ! empty( $category ) ) {
  $args['category_name'] = $category;
}

$grid_posts = new WP_Query( $args );
if ( $grid_posts->have_posts() ) :
?>
<section class="l-section-grid">
  <div class="l-section-grid__inner">
    <h2 class="c-section-title">
      <?php echo esc_html( get_theme_mod('grid_title', 'お知らせ') ); ?>
    </h2>

    <div class="c-grid c-grid--2col">
      <?php while ( $grid_posts->have_posts() ) : $grid_posts->the_post(); ?>
        <?php
          $permalink = get_the_permalink();
        ?>
        <a href="<?php echo esc_url( $permalink ); ?>"
           class="c-grid__item c-grid__item--has-arrow"
           aria-label="<?php the_title_attribute(); ?>">
          <?php if ( has_post_thumbnail() ) : ?>
            <?php the_post_thumbnail( 'medium', [
              'class' => 'c-grid__image',
              'alt'   => get_the_title(),
            ] ); ?>
          <?php else : ?>
            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/placeholder.jpg' ); ?>"
                 alt="<?php the_title_attribute(); ?>"
                 class="c-grid__image">
          <?php endif; ?>
          <p class="c-grid__title"><?php the_title(); ?></p>
        </a>
      <?php endwhile; wp_reset_postdata(); ?>
    </div>
  </div>
</section>
<?php
endif;
