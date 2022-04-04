<?php
/**
 * Handle the wigets files and hooks
 * 
 * @package Clean Design Blog
 * 
 */
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function clean_design_blog_widgets_init() {
	// Header toggle sidebar
	register_sidebar(
		array(
			'name'          => esc_html__( 'Header Toggle Sidebar', 'clean-design-blog' ),
			'id'            => 'sidebar-header-toggle',
			'description'   => esc_html__( 'Add widgets here.', 'clean-design-blog' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title bmm-block-title"><span>',
			'after_title'   => '</span></h3>',
		)
	);

	// default sidebar
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'clean-design-blog' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'clean-design-blog' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title bmm-block-title"><span>',
			'after_title'   => '</span></h3>',
		)
	);

	// sidebar Page
	register_sidebar(
		array(
			'name'          => esc_html__( 'Page Sidebar', 'clean-design-blog' ),
			'id'            => 'sidebar-page',
			'description'   => esc_html__( 'Add widgets here.', 'clean-design-blog' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title bmm-block-title"><span>',
			'after_title'   => '</span></h3>',
		)
	);

	// frontpage middle right sidebar
	register_sidebar(
		array(
			'name'          => esc_html__( 'Frontpage Middle - Right Sidebar', 'clean-design-blog' ),
			'id'            => 'frontpage-middle-right-sidebar',
			'description'   => esc_html__( 'Add widgets here.', 'clean-design-blog' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title bmm-block-title"><span>',
			'after_title'   => '</span></h3>',
		)
	);

	// frontpage middle left sidebar
	register_sidebar(
		array(
			'name'          => esc_html__( 'Frontpage Middle - Left Sidebar', 'clean-design-blog' ),
			'id'            => 'frontpage-middle-left-sidebar',
			'description'   => esc_html__( 'Add widgets here.', 'clean-design-blog' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title bmm-block-title"><span>',
			'after_title'   => '</span></h3>',
		)
	);

	// footer sidebars
	register_sidebars( 4, array(
			'name'          => esc_html__( 'Footer Column %d', 'clean-design-blog' ),
			'id'            => 'footer-column',
			'description'   => esc_html__( 'Add widgets here.', 'clean-design-blog' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title bmm-block-title"><span>',
			'after_title'   => '</span></h3>',
		)
	);

	if ( class_exists( 'WooCommerce' ) ) {
		// shop sidebar
		register_sidebar(
			array(
				'name'          => esc_html__( 'Shop Sidebar', 'clean-design-blog' ),
				'id'            => 'shop-sidebar',
				'description'   => esc_html__( 'Add widgets here.', 'clean-design-blog' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h3 class="widget-title bmm-block-title"><span>',
				'after_title'   => '</span></h3>',
			)
		);	
	}

    // Register custom widgets
    register_widget( 'Clean_Design_Blog_Category_Collection_Widget' ); // category collection widget
	register_widget( 'Clean_Design_Blog_Posts_List_Widget' ); // posts list widget
	register_widget( 'Clean_Design_Blog_Author_Info_Widget' ); // author widget
	register_widget( 'Clean_Design_Blog_Social_Icons_Widget' ); // social icons widget
}
add_action( 'widgets_init', 'clean_design_blog_widgets_init' );

// includes files
require CLEAN_DESIGN_BLOG_INCLUDES_PATH .'widgets/widget-fields.php';
require CLEAN_DESIGN_BLOG_INCLUDES_PATH .'widgets/category-collection.php';
require CLEAN_DESIGN_BLOG_INCLUDES_PATH .'widgets/posts-list.php';
require CLEAN_DESIGN_BLOG_INCLUDES_PATH .'widgets/author-info.php';
require CLEAN_DESIGN_BLOG_INCLUDES_PATH .'widgets/social-icons.php';

function clean_design_blog_widget_scripts($hook) {
    if( $hook !== "widgets.php" ) {
        return;
    }
    wp_enqueue_style( 'clean-design-blog-widget', get_template_directory_uri() . '/inc/widgets/assets/widgets.css', array(), CLEAN_DESIGN_BLOG_VERSION );

	wp_enqueue_media();
	wp_enqueue_script( 'clean-design-blog-widget', get_template_directory_uri() . '/inc/widgets/assets/widgets.js', array( 'jquery' ), CLEAN_DESIGN_BLOG_VERSION, true );
}
add_action( 'admin_enqueue_scripts', 'clean_design_blog_widget_scripts' );