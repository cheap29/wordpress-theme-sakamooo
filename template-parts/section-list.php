<?php
// Customizer で選ばれた３つのページIDを配列に
$page_blocks = [
  get_theme_mod('page_block_id1', 0),
  get_theme_mod('page_block_id2', 0),
  get_theme_mod('page_block_id3', 0),
];

foreach ( $page_blocks as $page_id ) {
  if ( $page_id && $page = get_post( $page_id ) ) :
?>
  <section class="l-page-block" id="<?php echo esc_attr( $page_id ); ?>">
    <div class="l-page-block__inner">
      <h2 class="c-section-title"><?php echo esc_html( get_the_title( $page ) ); ?></h2>
      <div class="page-block__content">
        <?php echo apply_filters( 'the_content', $page->post_content ); ?>
      </div>
    </div>
  </section>
<?php
  endif;
}
?>
