<?php
/**
 * Funções e definições do tema
 *
 * @package Radio_News_Theme
 */

if ( ! function_exists( 'radio_news_theme_setup' ) ) :
	function radio_news_theme_setup() {
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );

		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'radio-news-theme' ),
			)
		);

		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'radio_news_theme_setup' );

function radio_news_theme_scripts() {
	wp_enqueue_style( 'radio-news-theme-style', get_stylesheet_uri(), array(), '1.0.0' );
	
	// Tailwind CSS (CDN for prototype)
	wp_enqueue_script( 'tailwindcss', 'https://cdn.tailwindcss.com', array(), null, false );

    // FontAwesome
    wp_enqueue_style( 'fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0' );
	
    // Swup para navegação sem reload
    wp_enqueue_script( 'swup', 'https://unpkg.com/swup@4', array(), null, true );
    
    // Nosso script principal
	wp_enqueue_script( 'radio-news-theme-main', get_template_directory_uri() . '/assets/js/main.js', array('swup'), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'radio_news_theme_scripts' );
