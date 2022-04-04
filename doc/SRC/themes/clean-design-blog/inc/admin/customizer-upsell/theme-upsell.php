<?php
/**
 * Footer settings
 * 
 * @since 1.1.0
 */

add_action( 'customize_register', 'clean_design_blog_upsell_section_register', 10 );
/**
 * Add settings for upsell links
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function clean_design_blog_upsell_section_register( $wp_customize ) {
	require get_template_directory() . '/inc/admin/customizer-upsell/upsell-section/upsell-button.php';
    require get_template_directory() . '/inc/admin/customizer-upsell/upsell-section/upsell-info.php';
    require get_template_directory() . '/inc/admin/customizer-upsell/upsell-section/upsell-control.php';
    $wp_customize->register_section_type( 'Clean_Design_Blog_Upsell_Button' );
    $wp_customize->register_control_type( 'Clean_Design_Blog_Upsell_Control' );
    /**
     * Add Upsell Button
     * 
     */
    $wp_customize->add_section(
		new Clean_Design_Blog_Upsell_Button( $wp_customize, 
            'upsell_button', [
                'button_text'   => esc_html__( 'View Premium', 'clean-design-blog' ),
                'button_url'    => esc_url( '//blazethemes.com/theme/clean-design-blog-pro/' ),
                'priority'      => 1
            ]
        )
	);

    /**
     * Add premium features listing section
     * 
     */
    $wp_customize->add_section( 'upgrade_section', array(
        'title' => esc_html__( 'Premium Features', 'clean-design-blog' ),
        'priority'  => 1,
    ));


    /**
     * List out "features" settings
     * 
     */
    $wp_customize->add_setting( 'upgrade_settings',
        array(
            'sanitize_callback' => 'wp_kses_post'
        )
    );

    $wp_customize->add_control( 
        new Clean_Design_Blog_Upsell_Control( $wp_customize, 'upgrade_settings', array(
            'section'     => 'upgrade_section',
            'description'   => esc_html__( "Upgrade To Pro", "clean-design-blog" ),
            'type'        => 'clean-design-blog-upsell',
            'features'    => array(
                esc_html__( 'Unlock more advanced features', 'clean-design-blog' ),
                esc_html__( 'Unlimited blocks - repeatable frontpage blocks', 'clean-design-blog' ),
                esc_html__( '12 + pre-built demos', 'clean-design-blog' ),
                esc_html__( 'Suitable to maximum blog categorie', 'clean-design-blog' ),
                esc_html__( 'Numerous Color Options', 'clean-design-blog' ),
                esc_html__( 'Unlimited Social Icons', 'clean-design-blog' ),
                esc_html__( 'Customize hyperlinks target', 'clean-design-blog' ),
                esc_html__( 'Show/hide post elements ( For each blocks )', 'clean-design-blog' ),
                esc_html__( 'Customize content length', 'clean-design-blog' ),
                esc_html__( 'Customize category/tags count', 'clean-design-blog' ),
                esc_html__( 'Beautiful Widgets', 'clean-design-blog' ),
                esc_html__( 'Multiple Header Layouts ( 3 )', 'clean-design-blog' ),
                esc_html__( 'Menu Colors', 'clean-design-blog' ),
                esc_html__( 'Menu Hover Colors', 'clean-design-blog' ),
                esc_html__( 'Menu Hover Effects', 'clean-design-blog' ),
                esc_html__( 'Image Hover Effects', 'clean-design-blog' ),
                esc_html__( 'AJAX pagination and load more ( load posts without page reload )', 'clean-design-blog' ),
                esc_html__( 'Breadcrumbs more settings', 'clean-design-blog' ),
                esc_html__( 'Meta prefix text changable', 'clean-design-blog' ),
                esc_html__( 'More ( post/archive/page/blog/home ) layouts ', 'clean-design-blog' ),
                esc_html__( 'More ( post/archive/page/blog/home ) sidebar layouts', 'clean-design-blog' ),
                esc_html__( 'Footer four column', 'clean-design-blog' ),
                esc_html__( 'Style Settings ( colors, fonts, variants )', 'clean-design-blog' ),
                esc_html__( 'Typography Settings ( font size, colors, font family, variants )', 'clean-design-blog' ),
                esc_html__( '600+ google fonts', 'clean-design-blog' ),
                esc_html__( 'Optimized for Speed', 'clean-design-blog' ),
                esc_html__( 'Fully Multilingual and Translation ready', 'clean-design-blog' ),
                esc_html__( 'Unlimited Support', 'clean-design-blog' ),
                sprintf( '%1$1s', esc_html__( 'many more ....', 'clean-design-blog' ) )
            )
        ))
    );

    /**
     * Add Upsell Button
     * 
     */
    $wp_customize->add_section(
        new Clean_Design_Blog_Upsell_Button( $wp_customize, 
            'demo_import_button', [
                'button_text'   => esc_html__( 'Go to Import', 'clean-design-blog' ),
                'button_url'    => esc_url( admin_url('themes.php?page=clean-design-blog-info.php') ),
                'title'         => esc_html__('Import Demo Data', 'clean-design-blog'),
                'priority'  => 1000,
            ]
        )
    );

    // Upgrade infos
    $wp_customize->add_setting( 'top_header_upgrade_text', array(
        'sanitize_callback' => 'sanitize_text_field'
    ));
    
    $wp_customize->add_control(new Clean_Design_Blog_Upsell_Info_Control($wp_customize, 'top_header_upgrade_text', array(
        'section' => 'top_header_section',
        'label' => esc_html__('For more top header settings,', 'clean-design-blog'),
        'choices' => array(
            esc_html__( 'Toggle date option', 'clean-design-blog' ),
            esc_html__( 'Date format selection dropdown option', 'clean-design-blog' ),
            esc_html__( 'Toggle top header menu option', 'clean-design-blog' )
        ),
        'priority' => 150
    )));

    $wp_customize->add_setting( 'header_upgrade_text', array(
        'sanitize_callback' => 'sanitize_text_field'
    ));
    
    $wp_customize->add_control(new Clean_Design_Blog_Upsell_Info_Control($wp_customize, 'header_upgrade_text', array(
        'section' => 'header_section',
        'label' => esc_html__('For more header settings,', 'clean-design-blog'),
        'choices' => array(
            esc_html__( 'More header layouts ( 3 )', 'clean-design-blog' )
        ),
        'priority' => 150
    )));

    $wp_customize->add_setting( 'social_upgrade_text', array(
        'sanitize_callback' => 'sanitize_text_field'
    ));
    
    $wp_customize->add_control(new Clean_Design_Blog_Upsell_Info_Control($wp_customize, 'social_upgrade_text', array(
        'section' => 'header_social_icons_section',
        'label' => esc_html__('For unlimited social icons options,', 'clean-design-blog'),
        'priority' => 150
    )));

    // Upgrade infos
    $wp_customize->add_setting( 'full_width_upgrade_text', array(
        'sanitize_callback' => 'sanitize_text_field'
    ));
    
    $wp_customize->add_control(new Clean_Design_Blog_Upsell_Info_Control($wp_customize, 'full_width_upgrade_text', array(
        'section' => 'frontpage_top_full_width_section',
        'label' => esc_html__('For more advanced options,', 'clean-design-blog'),
        'choices' => array(
            esc_html__( '3 layouts in each block', 'clean-design-blog' ),
            esc_html__( '20+ total layouts', 'clean-design-blog' ),
            esc_html__( 'Carousel/Slider options', 'clean-design-blog' ),
            esc_html__( 'Content Length field', 'clean-design-blog' ),
            esc_html__( 'Show/hide options for post meta date, comments, author, tags, categories', 'clean-design-blog' ),
            esc_html__( 'Read more button show/hide option with text field', 'clean-design-blog' )
        ),
        'priority' => 150
    )));

    $wp_customize->add_setting( 'middle_left_width_upgrade_text', array(
        'sanitize_callback' => 'sanitize_text_field'
    ));
    
    $wp_customize->add_control(new Clean_Design_Blog_Upsell_Info_Control($wp_customize, 'middle_left_width_upgrade_text', array(
        'section' => 'frontpage_middle_left_content_section',
        'label' => esc_html__('For more advanced options,', 'clean-design-blog'),
        'choices' => array(
            esc_html__( '3 layouts in each block', 'clean-design-blog' ),
            esc_html__( '20+ total layouts', 'clean-design-blog' ),
            esc_html__( 'Carousel/Slider options', 'clean-design-blog' ),
            esc_html__( 'Content Length field', 'clean-design-blog' ),
            esc_html__( 'Show/hide options for post meta date, comments, author, tags, categories', 'clean-design-blog' ),
            esc_html__( 'Read more button show/hide option with text field', 'clean-design-blog' )
        ),
        'priority' => 150
    )));

    $wp_customize->add_setting( 'middle_right_width_upgrade_text', array(
        'sanitize_callback' => 'sanitize_text_field'
    ));
    
    $wp_customize->add_control(new Clean_Design_Blog_Upsell_Info_Control($wp_customize, 'middle_right_width_upgrade_text', array(
        'section' => 'frontpage_middle_right_content_section',
        'label' => esc_html__('For more advanced options,', 'clean-design-blog'),
        'choices' => array(
            esc_html__( '3 layouts in each block', 'clean-design-blog' ),
            esc_html__( '20+ total layouts', 'clean-design-blog' ),
            esc_html__( 'Carousel/Slider options', 'clean-design-blog' ),
            esc_html__( 'Content Length field', 'clean-design-blog' ),
            esc_html__( 'Show/hide options for post meta date, comments, author, tags, categories', 'clean-design-blog' ),
            esc_html__( 'Read more button show/hide option with text field', 'clean-design-blog' )
        ),
        'priority' => 150
    )));

    $wp_customize->add_setting( 'bottom_full_width_upgrade_text', array(
        'sanitize_callback' => 'sanitize_text_field'
    ));
    
    $wp_customize->add_control(new Clean_Design_Blog_Upsell_Info_Control($wp_customize, 'bottom_full_width_upgrade_text', array(
        'section' => 'frontpage_bottom_full_width_section',
        'label' => esc_html__('For more advanced options,', 'clean-design-blog'),
        'choices' => array(
            esc_html__( '3 layouts in each block', 'clean-design-blog' ),
            esc_html__( '20+ total layouts', 'clean-design-blog' ),
            esc_html__( 'Carousel/Slider options', 'clean-design-blog' ),
            esc_html__( 'Content Length field', 'clean-design-blog' ),
            esc_html__( 'Show/hide options for post meta date, comments, author, tags, categories', 'clean-design-blog' ),
            esc_html__( 'Read more button show/hide option with text field', 'clean-design-blog' )
        ),
        'priority' => 150
    )));

    $wp_customize->add_setting( 'archive_upgrade_text', array(
        'sanitize_callback' => 'sanitize_text_field'
    ));
    
    $wp_customize->add_control(new Clean_Design_Blog_Upsell_Info_Control($wp_customize, 'archive_upgrade_text', array(
        'section' => 'innerpages_archive_page_section',
        'label' => esc_html__('For more options,', 'clean-design-blog'),
        'choices' => array(
            esc_html__( 'Ajax pagination type ', 'clean-design-blog' ),
            esc_html__( 'Content Length field', 'clean-design-blog' ),
            esc_html__( 'Show/hide options for post meta date, comments, author, tags, categories', 'clean-design-blog' ),
            esc_html__( 'Prefix for post meta date, comments, author', 'clean-design-blog' ),
            esc_html__( 'Read more button show/hide option with text field', 'clean-design-blog' )
        ),
        'priority' => 150
    )));

    $wp_customize->add_setting( 'single_upgrade_text', array(
        'sanitize_callback' => 'sanitize_text_field'
    ));
    
    $wp_customize->add_control(new Clean_Design_Blog_Upsell_Info_Control($wp_customize, 'single_upgrade_text', array(
        'section' => 'innerpages_single_page_section',
        'label' => esc_html__('For more options,', 'clean-design-blog'),
        'choices' => array(
            esc_html__( 'Show/hide options for post meta date, comments, author, tags, categories', 'clean-design-blog' ),
            esc_html__( 'Prefix for post meta date, comments, author', 'clean-design-blog' ),
            esc_html__( 'Show/hide author box ', 'clean-design-blog' ),
            esc_html__( 'Related posts title and post count options', 'clean-design-blog' )
        ),
        'priority' => 150
    )));

    $wp_customize->add_setting( 'footer_upgrade_text', array(
        'sanitize_callback' => 'sanitize_text_field'
    ));
    
    $wp_customize->add_control(new Clean_Design_Blog_Upsell_Info_Control($wp_customize, 'footer_upgrade_text', array(
        'section' => 'footer_section',
        'label' => esc_html__('For more options,', 'clean-design-blog'),
        'choices' => array(
            esc_html__( 'Footer column layouts', 'clean-design-blog' ),
            esc_html__( 'Background Image field', 'clean-design-blog' )
        ),
        'priority' => 150
    )));

    $wp_customize->add_setting( 'bottom_upgrade_text', array(
        'sanitize_callback' => 'sanitize_text_field'
    ));
    
    $wp_customize->add_control(new Clean_Design_Blog_Upsell_Info_Control($wp_customize, 'bottom_upgrade_text', array(
        'section' => 'bottom_footer_section',
        'label' => esc_html__('For more options,', 'clean-design-blog'),
        'choices' => array(
            esc_html__( 'Show/hide bottom footer', 'clean-design-blog' ),
            esc_html__( 'Footer logo field', 'clean-design-blog' ),
            esc_html__( 'Show/hide footer menu, social icons', 'clean-design-blog' ),
            esc_html__( 'Custom copy right text', 'clean-design-blog' )
        ),
        'priority' => 150
    )));

    $wp_customize->add_setting( 'general_upgrade_text', array(
        'sanitize_callback' => 'sanitize_text_field'
    ));
    
    $wp_customize->add_control(new Clean_Design_Blog_Upsell_Info_Control($wp_customize, 'general_upgrade_text', array(
        'section' => 'general_section',
        'label' => esc_html__('For more options,', 'clean-design-blog'),
        'choices' => array(
            esc_html__( 'Animation options', 'clean-design-blog' ),
            esc_html__( 'Scroll to top layouts and align options', 'clean-design-blog' ),
            esc_html__( '4 image hover effects', 'clean-design-blog' )
        ),
        'priority' => 150
    )));

    $wp_customize->add_setting( 'menu_upgrade_text', array(
        'sanitize_callback' => 'sanitize_text_field'
    ));
    
    $wp_customize->add_control(new Clean_Design_Blog_Upsell_Info_Control($wp_customize, 'menu_upgrade_text', array(
        'section' => 'menu_section',
        'label' => esc_html__('For more options,', 'clean-design-blog'),
        'choices' => array(
            esc_html__( '5 menu hover effects', 'clean-design-blog' ),
            esc_html__( 'Menu margin button number field', 'clean-design-blog' ),
            esc_html__( 'Active menu, sub menu, hover menu color options', 'clean-design-blog' )
        ),
        'priority' => 150
    )));
}

/**
 * Enqueue theme upsell controls scripts
 * 
 */
function clean_design_blog_upsell_scripts() {
    wp_enqueue_style( 'clean-design-blog-upsell', get_template_directory_uri() . '/inc/admin/customizer-upsell/upsell-section/upsell.css', array(), '1.0.0', 'all' );
    wp_enqueue_script( 'clean-design-blog-upsell', get_template_directory_uri() . '/inc/admin/customizer-upsell/upsell-section/upsell.js', array(), '1.0.0', 'all' );
}
add_action( 'customize_controls_enqueue_scripts', 'clean_design_blog_upsell_scripts' );