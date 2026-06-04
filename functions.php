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

		// Adiciona suporte a logo personalizada
		add_theme_support( 'custom-logo', array(
			'flex-height' => true,
			'flex-width'  => true,
		) );

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

    // Script do clima
    wp_enqueue_script( 'radio-news-theme-weather', get_template_directory_uri() . '/assets/js/weather.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'radio_news_theme_scripts' );

/**
 * Adiciona classes do Tailwind à logo personalizada do painel
 */
function radio_news_custom_logo_classes( $html ) {
	$html = str_replace( 'class="custom-logo-link"', 'class="custom-logo-link flex items-center"', $html );
	$html = str_replace( 'class="custom-logo"', 'class="custom-logo h-10 md:h-12 w-auto object-contain"', $html );
	return $html;
}
add_filter( 'get_custom_logo', 'radio_news_custom_logo_classes' );
