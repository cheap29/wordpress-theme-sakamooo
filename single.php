<?php get_header(); ?>

<main class="l-main main-contents">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <!-- パンくず -->
    <nav class="breadcrumb">
      <a href="<?php echo home_url(); ?>">Home</a>
      <span>›</span>
      <span><?php the_title(); ?></span>
    </nav>

    <article class="article">
      <!-- キャッチ画像（幅420pxで固定、回転＆ピン風） -->
      <?php if ( has_post_thumbnail() ) : ?>
        <div class="article__thumbnail pinned">
          <?php 
            $thumb_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
          ?>
          <img loading="lazy"
            src="<?php echo esc_url($thumb_url); ?>" 
            alt="<?php the_title_attribute(); ?>" 
            class="article__thumbnail-img">
        </div>
      <?php endif; ?>

      <!-- ヘッダー（タイトル＋メタ） -->
      <header class="article__header">
        <h1 class="article__title"><?php the_title(); ?></h1>
        <div class="article__meta">
          <!-- <span class="article__date"><?php echo get_the_date( 'Y/m/d' ); ?></span> -->
          <span class="article__categories">
            <?php the_category( ', ' ); ?>
          </span>
        </div>
      </header>

      <!-- 本文 -->
      <div class="article__content">
        <?php the_content(); ?>
      </div>
    </article>

  <?php endwhile; endif; ?>

</main>

<?php get_footer(); ?>
