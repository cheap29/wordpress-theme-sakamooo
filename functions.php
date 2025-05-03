<?php
/**
 * Theme setup and asset enqueue
 */
function sakamooo_setup() {
  add_theme_support('html5', ['search-form', 'comment-list', 'gallery', 'caption']);
  add_theme_support('custom-header', [
    'width' => 1920,
    'height' => 1080,
    'flex-width' => true,
    'flex-height' => true,
    'header-text' => false
  ]);
  add_theme_support('post-thumbnails');
  
  // 画像サイズの設定
  add_image_size('grid-large', 600, 400, true);
  
  register_nav_menu( 'primary', __( 'グローバルナビ', 'sakamooo' ) );
  
  // カスタマイザーの設定
  add_action('customize_register', 'sakamooo_customize_register');
}

function sakamooo_customize_register($wp_customize) {
  // グリッドセクションの設定
  $wp_customize->add_section('grid_section', array(
    'title' => __('グリッドセクション', 'sakamooo'),
    'priority' => 30,
  ));

  // タイトル設定
  $wp_customize->add_setting('grid_title', array(
    'default' => '最新記事',
    'sanitize_callback' => 'sanitize_text_field',
  ));

  $wp_customize->add_control('grid_title', array(
    'label' => __('セクションタイトル', 'sakamooo'),
    'section' => 'grid_section',
    'type' => 'text',
  ));

  // カテゴリー設定
  $wp_customize->add_setting('grid_category', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_text_field',
  ));

  $wp_customize->add_control('grid_category', array(
    'label' => __('表示するカテゴリー', 'sakamooo'),
    'section' => 'grid_section',
    'type' => 'select',
    'choices' => sakamooo_get_categories(),
  ));
  

  // セクション追加
  $wp_customize->add_section('hero_title', [
      'title'    => 'Hero 設定',
      'priority' => 30,
  ]);

  // 表示／非表示
  $wp_customize->add_setting('show_h1_title', [
      'default'           => true,
      'sanitize_callback' => 'wp_validate_boolean',
  ]);
  $wp_customize->add_control('show_h1_title', [
      'settings' => 'show_h1_title',
      'section'  => 'hero_title',
      'label'    => 'h1見出しを表示する',
      'type'     => 'checkbox',
  ]);

  // ヒーローテキスト
  $wp_customize->add_setting('hero-title-text', [
      'default'           => '',
      'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('hero-title-text', [
      'settings' => 'hero-title-text',
      'section'  => 'hero_title',
      'label'    => 'ヒーローh1テキスト',
      'type'     => 'text',
  ]);


  // 縦位置
  $wp_customize->add_setting('hero_title_top', [
      'default'           => '2rem',
      'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('hero_title_top', [
      'settings' => 'hero_title_top',
      'section'  => 'hero_title',
      'label'    => '見出しの縦位置 (例: 2rem, 50px)',
      'type'     => 'text',
  ]);

  // 横位置
  $wp_customize->add_setting('hero_title_left', [
      'default'           => '50%',
      'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('hero_title_left', [
      'settings' => 'hero_title_left',
      'section'  => 'hero_title',
      'label'    => '見出しの横位置 (例: 50%, 200px)',
      'type'     => 'text',
  ]);

  // フォントサイズ
  $wp_customize->add_setting('hero_title_size', [
      'default'           => 'clamp(1.5rem, 5vw, 2.5rem)',
      'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('hero_title_size', [
      'settings' => 'hero_title_size',
      'section'  => 'hero_title',
      'label'    => '見出しのフォントサイズ (CSS clamp など可)',
      'type'     => 'text',
  ]);

  $wp_customize->add_section('page_block_section', [
    'title'    => '固定ページブロック',
    'priority' => 35,
  ]);

  for ( $i = 1; $i <= 3; $i++ ) {
    $wp_customize->add_setting( "page_block_id{$i}", [
      'default'           => 0,
      'sanitize_callback' => 'absint',
    ] );
    $wp_customize->add_control( new WP_Customize_Control(
      $wp_customize,
      "page_block_id{$i}",
      [
        'label'    => "表示する固定ページ {$i}",
        'section'  => 'page_block_section',
        'settings' => "page_block_id{$i}",
        'type'     => 'dropdown-pages',
      ]
    ) );
  }
}
add_action('customize_register', 'sakamooo_customize_register');

// head 内に CSS 変数として出力
function sakamooo_customizer_css_vars() {
    $show  = get_theme_mod('show_h1_title', true ) ? 'block' : 'none';
    $top   = esc_attr( get_theme_mod('hero_title_top', '2rem') );
    $left  = esc_attr( get_theme_mod('hero_title_left', '50%') );
    $size  = esc_attr( get_theme_mod('hero_title_size', 'clamp(1.5rem, 5vw, 2.5rem)') );
    $text  = esc_attr( get_theme_mod('hero-title-text', '') );

    echo "<style>:root {
      --h1-title-display: {$show};
      --hero-title-text: {$text};
      --hero-title-top: {$top};
      --hero-title-left: {$left};
      --hero-title-size: {$size};
    }</style>";
}
add_action('wp_head', 'sakamooo_customizer_css_vars');



function sakamooo_get_categories() {
  $categories = get_categories();
  $choices = array('' => '全てのカテゴリー');
  foreach ($categories as $category) {
    $choices[$category->slug] = $category->name;
  }
  return $choices;
}
add_action('after_setup_theme', 'sakamooo_setup');

function sakamooo_enqueue_assets() {
  wp_enqueue_style(
    'sakamooo-style',
    get_template_directory_uri() . '/assets/css/style.css',
    [],
    '1.0'
  );
  wp_enqueue_script(
    'sakamooo-script',
    get_template_directory_uri() . '/assets/js/script.js',
    ['jquery'],
    '1.0',
    true
  );
}
add_action('wp_enqueue_scripts', 'sakamooo_enqueue_assets');
