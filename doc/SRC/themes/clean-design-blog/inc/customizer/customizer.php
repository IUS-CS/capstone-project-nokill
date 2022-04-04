<?php
/**
 * Clean Design Blog Theme Customizer
 *
 * @package Clean Design Blog
 * @since 1.0.0
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function clean_design_blog_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->get_control( 'header_textcolor' )->section 	= 'header_section';
	$wp_customize->get_control( 'header_textcolor' )->priority 	= 90;
	
	/**
	 * Primary Theme Color
	 * 
	 */
	$wp_customize->add_setting( 'primary_theme_color', array(
		'default'	=> '#d37fb0',
		'sanitize_callback' => 'sanitize_hex_color'
	));

	$wp_customize->add_control( 
		new WP_Customize_Color_Control( $wp_customize, 'primary_theme_color', array(
			'label'      => __( 'Theme Color', 'clean-design-blog' ),
			'section'    => 'colors',
			'settings'   => 'primary_theme_color'
		))
	);
	
	/**
	 * Includes customizer files
	 * 
	 */
	require CLEAN_DESIGN_BLOG_INCLUDES_PATH . 'customizer/custom-controls/toggle-control/toggle-control.php';
	require CLEAN_DESIGN_BLOG_INCLUDES_PATH . 'customizer/custom-controls/section-heading/section-heading.php';
	require CLEAN_DESIGN_BLOG_INCLUDES_PATH . 'customizer/custom-controls/repeater/repeater.php';
	require CLEAN_DESIGN_BLOG_INCLUDES_PATH . 'customizer/custom-controls/blocks-repeater/blocks-repeater.php';
	require CLEAN_DESIGN_BLOG_INCLUDES_PATH . 'customizer/custom-controls/radio-image/radio-image.php';
	require CLEAN_DESIGN_BLOG_INCLUDES_PATH . 'customizer/custom-controls/radio-tab/radio-tab.php';

	// extend customizer section
	$wp_customize->register_control_type( 'Clean_Design_Blog_WP_Radio_Image_Control' );
	$wp_customize->register_control_type( 'Clean_Design_Blog_WP_Radio_Tab_Control' );

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'clean_design_blog_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'clean_design_blog_customize_partial_blogdescription',
			)
		);
	}

	// register 'Theme Options' panel
	$wp_customize->add_panel( 'clean_design_blog_theme_panel', array(
		'title' => esc_html__( 'Theme Options', 'clean-design-blog' ),
		'priority' => 10,
	));
	
	// register 'Header Settings' panel
	$wp_customize->add_panel( 'clean_design_blog_header_settings_panel', array(
		'title' => esc_html__( 'Header Settings', 'clean-design-blog' ),
		'priority' => 20,
	));

	// register 'Frontpage Sections' panel
	$wp_customize->add_panel( 'clean_design_blog_frontpage_sections_panel', array(
		'title' => esc_html__( 'Frontpage Sections', 'clean-design-blog' ),
		'priority' => 20,
	));
	
	// register 'Footer Settings' panel
	$wp_customize->add_panel( 'clean_design_blog_footer_settings_panel', array(
		'title' => esc_html__( 'Footer Settings', 'clean-design-blog' ),
		'priority' => 60,
	));

	// register 'Innerpages Settings' panel
	$wp_customize->add_panel( 'clean_design_blog_innerpages_settings_panel', array(
		'title' => esc_html__( 'Innerpages Settings', 'clean-design-blog' ),
		'priority' => 60,
	));

	/**
     * Frontpage Section Option
     * 
     */
    $wp_customize->add_setting( 'frontpage_sections_option', array(
		'default'           => true,
		'sanitize_callback' => 'clean_design_blog_sanitize_toggle_control',
	  ));
  
	  $wp_customize->add_control( 
		  new Clean_Design_Blog_WP_Toggle_Control( $wp_customize, 'frontpage_sections_option', array(
			'label'	      => esc_html__( 'Show frontpage sections', 'clean-design-blog' ),
			'description' => sprintf( esc_html__( 'Enabling this control will display all the frontpage sections theme provides hiding other home content. Disable this if you want default home template or if you are editing frontpage with Elementor. %1$1s Manage frontpage sections %2$2s click here %3$3s', 'clean-design-blog' ), '<br/><br/>', '<a href="' .esc_url( admin_url( 'customize.php?autofocus[panel]=clean_design_blog_frontpage_sections_panel' ) ). '">', '</a>' ),
			'section'     => 'static_front_page',
			'settings'    => 'frontpage_sections_option',
			'type'        => 'toggle',
			'priority'	  => 100
		))
	  );
}
add_action( 'customize_register', 'clean_design_blog_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function clean_design_blog_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function clean_design_blog_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function clean_design_blog_customize_preview_js() {
	wp_enqueue_script( 'clean-design-blog-customizer', get_template_directory_uri() . '/assets/js/customizer-preview.js', array( 'customize-preview' ), CLEAN_DESIGN_BLOG_VERSION, true );
}
add_action( 'customize_preview_init', 'clean_design_blog_customize_preview_js' );

// Enqueue our scripts and styles
function clean_design_blog_customize_controls_scripts() {
	wp_enqueue_script( 'clean-design-blog-customize-preview-redirects', get_template_directory_uri() . '/inc//customizer/extend-customizer/preview-redirects.js', array('customize-controls'), CLEAN_DESIGN_BLOG_VERSION, true );

	// define global object for js file.
	wp_localize_script( 'clean-design-blog-customize-preview-redirects', 'cleanDesignBlogPreviewUrls', array(
			'errorPageUrl'  => esc_url( get_home_url() . '/vebskjbkb' )
		)
	);
}
add_action( 'customize_controls_enqueue_scripts', 'clean_design_blog_customize_controls_scripts' );

// includes customizer files
require CLEAN_DESIGN_BLOG_INCLUDES_PATH . 'customizer/sanitize.php';
require CLEAN_DESIGN_BLOG_INCLUDES_PATH . 'customizer/active-callback.php';

/**
 * Includes customizer files
 * 
 */
require CLEAN_DESIGN_BLOG_INCLUDES_PATH . 'customizer/sections/general-settings.php';
require CLEAN_DESIGN_BLOG_INCLUDES_PATH . 'customizer/sections/menu.php';
require CLEAN_DESIGN_BLOG_INCLUDES_PATH . 'customizer/sections/header-settings.php';
require CLEAN_DESIGN_BLOG_INCLUDES_PATH . 'customizer/sections/footer.php';
require CLEAN_DESIGN_BLOG_INCLUDES_PATH . 'customizer/sections/sidebars.php';
require CLEAN_DESIGN_BLOG_INCLUDES_PATH . 'customizer/sections/layouts.php';
require CLEAN_DESIGN_BLOG_INCLUDES_PATH . 'customizer/sections/innerpages.php';
require CLEAN_DESIGN_BLOG_INCLUDES_PATH . 'customizer/sections/category-colors.php';
require CLEAN_DESIGN_BLOG_INCLUDES_PATH . 'customizer/sections/frontpage-sections/frontpage-top-full-width.php';
require CLEAN_DESIGN_BLOG_INCLUDES_PATH . 'customizer/sections/frontpage-sections/frontpage-middle-left-content.php';
require CLEAN_DESIGN_BLOG_INCLUDES_PATH . 'customizer/sections/frontpage-sections/frontpage-middle-right-content.php';
require CLEAN_DESIGN_BLOG_INCLUDES_PATH . 'customizer/sections/frontpage-sections/frontpage-bottom-full-width.php';
require CLEAN_DESIGN_BLOG_INCLUDES_PATH . 'admin/customizer-upsell/theme-upsell.php';