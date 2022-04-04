<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Clean Design Blog
 * @since 1.0.0
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function clean_design_blog_body_classes( $classes ) {
	global $post;

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	// Main site layout
	$site_layout = get_theme_mod( 'site_layout', 'box-layout' );
	$classes[] = esc_attr( 'mainsite--' . $site_layout );
	$classes[] = 'header--layout-three';
	$classes[] = 'widget-title-layout-one';

	// Menu hover effect
	$menu_hover = get_theme_mod( 'menu_hover_style', 'menu_hover_1' );
	$classes[] = esc_attr( $menu_hover );

	// Manage sidebar layouts
	if( is_page() ) {
		$page_sidebar_option = get_theme_mod( 'page_sidebar_option', true );
		$page_sidebar_layout = get_theme_mod( 'page_sidebar_layout', 'right-sidebar' );
		$sidebar_layout = $page_sidebar_option ? $page_sidebar_layout : 'no-sidebar';
		//layout settings
		$layout = get_theme_mod( 'page_layout', 'full-width' );// layout value
	} else if( is_home() ) {
		$archive_sidebar_option = get_theme_mod( 'archive_sidebar_option', false );
		$archive_sidebar_layout = get_theme_mod( 'archive_sidebar_layout', 'right-sidebar' );
		$sidebar_layout = $archive_sidebar_option ? $archive_sidebar_layout : 'no-sidebar';

		// posts layout
		$archive_posts_layout = get_theme_mod( 'archive_posts_layout', 'list-layout' );
		$classes[] = esc_html( 'posts--'. $archive_posts_layout );	
	}
	else if( is_single() ) {
			$post_sidebar_option = get_theme_mod( 'post_sidebar_option', true );
			$post_sidebar_layout = get_theme_mod( 'post_sidebar_layout', 'right-sidebar' );
			$sidebar_layout = $post_sidebar_option ? $post_sidebar_layout : 'no-sidebar';
		//layout settings
		$layout = get_theme_mod( 'post_layout', 'full-width' ); // layout value
	} else if ( is_archive() || is_search() ) {
		// posts layout
		$archive_posts_layout = get_theme_mod( 'archive_posts_layout', 'list-layout' );
		$classes[] = esc_html( 'posts--'. $archive_posts_layout );

		$archive_sidebar_option = get_theme_mod( 'archive_sidebar_option', true );
		$archive_sidebar_layout = get_theme_mod( 'archive_sidebar_layout', 'right-sidebar' );
		$layout = get_theme_mod( 'archive_layout', 'full-width' ); // layout value
		$sidebar_layout = $archive_sidebar_option ? $archive_sidebar_layout : 'no-sidebar';
	}
	$classes[] = isset( $sidebar_layout ) ? esc_attr( $sidebar_layout ) : 'right-sidebar'; // sidebar class
	$classes[] = isset( $layout ) ? esc_attr( $layout ) : 'full-width'; // layout class

	return $classes;
}
add_filter( 'body_class', 'clean_design_blog_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function clean_design_blog_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'clean_design_blog_pingback_header' );

/**
 * Enqueue scripts and styles.
 */
function clean_design_blog_scripts() {
	wp_enqueue_style( 'clean-design-blog-font-awesome', get_template_directory_uri() . '/assets/lib/fontawesome/css/all.min.css', array(), '5.15.3', 'all' );
	wp_enqueue_style( 'slick-slider', get_template_directory_uri() . '/assets/lib/slick/slick.css', array(), '1.8.1', 'all' );

	// Theme Main Style
	wp_enqueue_style( 'clean_design_blog_maincss', get_template_directory_uri() . '/assets/style/main.css', array(), CLEAN_DESIGN_BLOG_VERSION );
	//Theme Block Style
	wp_enqueue_style( 'clean_design_blog_blockcss', get_template_directory_uri() . '/assets/style/blocks/blocks.css', array(), CLEAN_DESIGN_BLOG_VERSION );

	// enqueue inline style
	ob_start();
		include get_template_directory() . '/inc/inline-styles.php';
	$clean_design_blog_theme_inline_sss = ob_get_clean();
	wp_add_inline_style( 'clean_design_blog_maincss', wp_strip_all_tags($clean_design_blog_theme_inline_sss) );

	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'clean-design-blog-fonts', clean_design_blog_fonts_url(), array(), null );

	wp_enqueue_style( 'clean-design-blog-style', get_stylesheet_uri(), array(), CLEAN_DESIGN_BLOG_VERSION );
	wp_style_add_data( 'clean-design-blog-style', 'rtl', 'replace' );

	wp_enqueue_script( 'slick-slider', get_template_directory_uri() . '/assets/lib/slick/slick.min.js', array('jquery'), '1.8.1', true );
	wp_enqueue_script( 'waypoint', get_template_directory_uri() . '/assets/lib/waypoint/jquery.waypoint.min.js', array('jquery'), '4.0.1', true );
	wp_enqueue_script( 'clean-design-blog-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), CLEAN_DESIGN_BLOG_VERSION, true );
	// stickey js
	if( get_theme_mod( 'sticky_sidebar_option', true ) ) {
		wp_enqueue_script( 'sticky-sidebar-js', get_template_directory_uri() . '/assets/lib/sticky/theia-sticky-sidebar.js', array(), '1.7.0', true );
	}
	// theme js
	wp_enqueue_script( 'clean-design-blog-theme', get_template_directory_uri() . '/assets/js/theme.js', array( 'jquery' ), CLEAN_DESIGN_BLOG_VERSION, true );
	$scriptVars = array(
		'scrollToTop'		=> get_theme_mod( 'scroll_to_top_option', true ),
		'stickeyHeader_one' => get_theme_mod( 'sticky_header_option', true ),
		'stickySidebar'		=> get_theme_mod( 'sticky_sidebar_option', true )
	);
	wp_localize_script( 'clean-design-blog-theme', 'cleanDesignBlogThemeObject', $scriptVars );

	wp_localize_script( 'clean-design-blog-navigation', 'screenReaderText', array(
		'expand'   => __( 'expand child menu', 'clean-design-blog' ),
		'collapse' => __( 'collapse child menu', 'clean-design-blog' ),
	) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'clean_design_blog_scripts' );

//define constant
define( 'CLEAN_DESIGN_BLOG_INCLUDES_PATH', get_template_directory() . '/inc/' );

/**
 * Theme Hooks
 */
require CLEAN_DESIGN_BLOG_INCLUDES_PATH . 'hooks/hooks.php';

/**
 * Theme Widgets
 */
require CLEAN_DESIGN_BLOG_INCLUDES_PATH . 'widgets/widgets.php';

/**
 * Theme Admin Page 
 * 
 */
require CLEAN_DESIGN_BLOG_INCLUDES_PATH . 'admin/class-theme-info.php';

/**
 * Register Google fonts.
 * @return string Google fonts URL for the theme.
 */
if ( ! function_exists( 'clean_design_blog_fonts_url' ) ) :
function clean_design_blog_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'cyrillic,cyrillic-ext';

	if ( 'off' !== esc_html_x( 'on', 'Lora: on or off', 'clean-design-blog' ) ) {
		$fonts[] = 'Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700';
	}
	
	if ( 'off' !== esc_html_x( 'on', 'Open Sans: on or off', 'clean-design-blog' ) ) {
		$fonts[] = 'Open Sans:ital,wght@0,400;0,500;0,600;1,400;1,500;1,600&display=swap';
	}
	
	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

if( !function_exists( 'clean_design_blog_get_all_posts_ids' ) ) :
	/**
	 * Get all posts ids
	 * 
	 * @return array
	 */
	function clean_design_blog_get_all_posts_ids() {
		$all_post_ids = get_posts([
			'posts_per_page' => -1,
			'post_status' => 'publish',
			'post_type' => 'post',
			'fields' => 'ids',
		]);
		return apply_filters( 'clean_design_blog_get_all_posts_ids_filter', $all_post_ids );
	}
endif;

if( !function_exists( 'clean_design_blog_get_organized_all_posts_ids' ) ) :
	/**
	 * Get organized all posts ids
	 * 
	 * @return array
	 */
	function clean_design_blog_get_organized_all_posts_ids() {
		$ids = array();
		foreach( clean_design_blog_get_all_posts_ids() as $key => $value ) {
			$ids[$value] = $value;
		}
		return apply_filters( 'clean_design_blog_get_organized_all_posts_ids_filter', $ids );
	}
endif;

if( !function_exists( 'clean_design_blog_get_content_type' ) ) :
	/**
	 * Get content type
	 * @return string
	 */
	function clean_design_blog_get_content_type() {
		$content_type = apply_filters( 'clean_design_blog_post_content_type_filter', 'excerpt' );
		return apply_filters( 'clean_design_blog_post_content_type_filter', $content_type );
	}
endif;

// navigation fallback
if ( ! function_exists( 'clean_design_blog_primary_navigation_fallback' ) ) :
	/**
	 * Fallback for primary navigation.
	 *
	 * @since 1.0.0
	 */
	function clean_design_blog_primary_navigation_fallback( $args ) {

		echo '<ul id="menu-main-menu" class="primary-menu">';
		?>
		<li class="menu-item <?php if(is_front_page()){ echo esc_attr('current-menu-item'); }?>"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<?php esc_html_e( 'Home', 'clean-design-blog' ) ?></a></li>
		<?php

		$page_args = array(
			'posts_per_page' => 5,
			'post_type'      => 'page',
			'orderby'        => 'name',
			'order'          => 'ASC',
			);
		$the_query = new WP_Query( $page_args );
		if ( $the_query->have_posts() ) {
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				$page_id = get_the_ID();
				$current_menu = '';
				if(is_page($page_id)){
					$current_menu = 'current-menu-item';
				}

				the_title( '<li class="menu-item '.esc_attr($current_menu).'"><a href="' . esc_url( get_permalink() ) . '">', '</a></li>' );
			}
			wp_reset_postdata();
		}
		echo '</ul>';
	}
endif;