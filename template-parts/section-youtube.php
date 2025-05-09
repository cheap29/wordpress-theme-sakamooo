<?php
/**
 * template-parts/section-page.php
 * グリッドレイアウト／テキストセクション
 */



$args = [
  'post_type'      => 'post',
  'post_status'    => 'publish',
  'category_name'  => 'youtube',
  'posts_per_page' => -1,
  'orderby'        => 'date',
  'order'          => 'DESC',
];


$youtube_posts = new WP_Query( $args );
if ( $youtube_posts->have_posts() ) :
?>
<section class="l-section-grid page">
  <div class="l-section-grid__inner">
    <h2 class="c-section-title">
      <?php echo esc_html( get_theme_mod('grid_title', '動画紹介') ); ?>
    </h2>

    <div class="c-grid ">
      <?php while ( $youtube_posts->have_posts() ) : $youtube_posts->the_post(); ?>
        <?php
          $permalink = get_the_permalink();
        ?>
        <a href="<?php echo esc_url( $permalink ); ?>"
           class="c-grid__item c-grid__item--has-arrow"
           aria-label="<?php the_title_attribute(); ?>">
          <?php if ( has_post_thumbnail() ) : ?>
            <?php the_post_thumbnail( 'grid-large', [
              'class' => 'c-grid__image',
              'alt'   => get_the_title(),
            ] ); ?>
          <?php else : ?>
            <img loading="lazy" src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/placeholder.jpg' ); ?>"
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
