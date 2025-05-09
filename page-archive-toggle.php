<?php
/*
Template Name: スケジュール年月アーカイブトグル
*/

get_header();
global $wpdb;

// GETパラメータから現在選択中の年・年月を取得
$current_year = isset( $_GET['year'] ) ? intval( $_GET['year'] ) : 0;
$current_m    = isset( $_GET['m'] )    ? intval( $_GET['m'] )    : 0;

// ① 年リストを取得（公開済みのみ）
$years = $wpdb->get_results(
  "SELECT DISTINCT YEAR(post_date) AS y
     FROM {$wpdb->posts}
    WHERE post_type = 'post'
      AND post_status = 'publish'
    ORDER BY y DESC"
);
?>

<div class="archive-toggle">
  <?php if ( ! $current_year ) : ?>
    <!-- 年トグル -->
    <?php foreach ( $years as $row ) :
      $y     = $row->y;
      $label = "{$y}年";
      $url   = add_query_arg( 'year', $y, get_permalink() );
    ?>
      <button class="toggle-btn<?php echo $current_year === $y ? ' is-active' : ''; ?>"
              onclick="location.href='<?php echo esc_url( $url ); ?>'">
        <?php echo esc_html( $label ); ?>
      </button>
    <?php endforeach; ?>
  <?php else : ?>
    <!-- 「年選択に戻る」ボタン -->
    <button class="toggle-btn" onclick="location.href='<?php echo esc_url( get_permalink() ); ?>'">
      年選択に戻る
    </button>

    <!-- ② 選択年の月リストを取得 -->
    <?php
      $months = $wpdb->get_results(
        $wpdb->prepare(
          "SELECT DISTINCT MONTH(post_date) AS m
             FROM {$wpdb->posts}
            WHERE post_type = 'post'
              AND post_status = 'publish'
              AND YEAR(post_date) = %d
            ORDER BY m DESC",
          $current_year
        )
      );
    ?>

    <!-- 月トグル -->
    <?php foreach ( $months as $row ) :
      $m      = $row->m;
      $ym     = sprintf( '%04d%02d', $current_year, $m );
      $label  = sprintf( '%02d月', $m );
      $url    = add_query_arg(
        [ 'year' => $current_year, 'm' => $ym ],
        get_permalink()
      );
      $active = ( $current_m == $ym ) ? ' is-active' : '';
    ?>
      <button class="toggle-btn<?php echo $active; ?>"
              onclick="location.href='<?php echo esc_url( $url ); ?>'">
        <?php echo esc_html( $label ); ?>
      </button>
    <?php endforeach; ?>
  <?php endif; ?>
</div>

<div class="archive-list">
  <?php
    // ③ WP_Query で公開済み・カテゴリ絞り込み・年月絞り込み
    $args = [
      'post_type'      => 'post',
      'post_status'    => 'publish',
      'posts_per_page' => -1,
      'category_name'  => 'schedulelist',
    ];
    if ( $current_m ) {
      $args['m'] = intval( $current_m );
    } elseif ( $current_year ) {
      // 年のみ選択済み：year パラメータで絞り込み
      $args['year'] = intval( $current_year );
    }

    $archive_q = new WP_Query( $args );

    if ( $archive_q->have_posts() ) :
  ?>
    <div class="archive-grid">
      <?php while ( $archive_q->have_posts() ) : $archive_q->the_post(); ?>
        <article class="archive-card">
          <?php if ( has_post_thumbnail() ) : ?>
            <div class="archive-card__thumbnail">
              <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('grid-large'); ?></a>
            </div>
          <?php endif; ?>
          <div class="archive-card__body">
            <h2 class="archive-card__title">
              <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h2>
            <time class="archive-card__time" datetime="<?php echo get_the_date('c'); ?>">
              <?php echo get_the_date(); ?>
            </time>
            <div class="archive-card__excerpt">
              <?php the_excerpt(); ?>
            </div>

            <?php
            $tags = get_the_tags();
            if ( $tags ) : ?>
                <div class="archive-card__tags">
                <?php foreach ( $tags as $tag ) : ?>
                    <a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>"
                    class="archive-card__tag">
                    <?php echo esc_html( $tag->name ); ?>
                    </a>
                <?php endforeach; ?>
                </div>
            <?php endif; ?>

          </div>
        </article>
      <?php endwhile; ?>
    </div>
  <?php
    else :
      echo '<p>この条件に該当する投稿はありません。</p>';
    endif;
    wp_reset_postdata();
  ?>
</div>

<?php get_footer(); ?>
