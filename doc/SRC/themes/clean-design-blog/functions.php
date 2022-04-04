<?php
/**
 * Clean Design Blog functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Clean Design Blog
 * @since 1.0.0
 */

if ( ! defined( 'CLEAN_DESIGN_BLOG_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	$theme_info = wp_get_theme();
	define( 'CLEAN_DESIGN_BLOG_VERSION', $theme_info->get( 'Version' ) );
}

if ( ! function_exists( 'clean_design_blog_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function clean_design_blog_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Clean Design Blog, use a find and replace
		 * to change 'clean-design-blog' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'clean-design-blog', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'clean-design-blog' ),
				'menu-2' => esc_html__( 'Top Header', 'clean-design-blog' ),
				'menu-3' => esc_html__( 'Bottom Footer', 'clean-design-blog' )
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
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

		/*
		 * Enable support for Post Formats.
		 * See https://developer.wordpress.org/themes/functionality/post-formats/
		 */
		add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'gallery',
			'quote',
			'video',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'clean_design_blog_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		// crop image size
		add_image_size('clean-design-blog-big-main', 840,440,true);
		add_image_size('clean-design-blog-big', 600,600,true);
		add_image_size('clean-design-blog-medium', 400,400,true);
		add_image_size('clean-design-blog-small', 150,150,true);


	}
endif;
add_action( 'after_setup_theme', 'clean_design_blog_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function clean_design_blog_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'clean_design_blog_content_width', 640 );
}
add_action( 'after_setup_theme', 'clean_design_blog_content_width', 0 );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Locate Front page file if needed
 * 
 */
function clean_design_blog_another_front_page_template( $template ) {
	if( is_front_page() && get_theme_mod( 'frontpage_sections_option', true ) ) {
		$another_front_page_template = 'theme-frontpage.php';
		$new_template = locate_template( array( $another_front_page_template ) );
		if ( !empty( $new_template ) ) {
			return $new_template;
		}
	}
    return $template;
}
add_filter( 'template_include', 'clean_design_blog_another_front_page_template', 99 );