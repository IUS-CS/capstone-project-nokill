<?php
/**
 * Site settings
 * 
 * @package Clean Design Blog
 * @since 1.0.0
 */

add_action( 'customize_register', 'clean_design_blog_customize_general_section_register', 10 );
/**
 * Add settings for site in the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function clean_design_blog_customize_general_section_register( $wp_customize ) {
    /**
     * Site Section
     * 
     * panel - clean_design_blog_theme_panel
     */
    $wp_customize->add_section( 'general_section', array(
      'title' => esc_html__( 'General Settings', 'clean-design-blog' ),
      'panel' => 'clean_design_blog_theme_panel',
      'priority'  => 5,
    ));
    
    /**
     * Sticky Header Settings Heading
     * 
     */
    $wp_customize->add_setting( 'sticky_header_settings_header', array(
        'sanitize_callback' => 'sanitize_text_field'
      ));

    $wp_customize->add_control( 
        new Clean_Design_Blog_WP_Section_Heading_Control( $wp_customize, 'sticky_header_settings_header', array(
            'label'	      => esc_html__( 'Sticky Header Setting', 'clean-design-blog' ),
            'section'     => 'general_section',
            'settings'    => 'sticky_header_settings_header',
            'type'        => 'section-heading',
        ))
    );

    /**
     * Sticky Header On Scroll down
     * 
     */
    $wp_customize->add_setting( 'sticky_header_option', array(
        'default'           => true,
        'sanitize_callback' => 'clean_design_blog_sanitize_toggle_control',
    ));

    $wp_customize->add_control( 
        new Clean_Design_Blog_WP_Toggle_Control( $wp_customize, 'sticky_header_option', array(
            'label'	      => esc_html__( 'Enable Header Sticky', 'clean-design-blog' ),
            'section'     => 'general_section',
            'settings'    => 'sticky_header_option',
            'type'        => 'toggle',
        ))
    );

    /**
     * Sticky Sidebar Settings Heading
     * 
     */
    $wp_customize->add_setting( 'sticky_sidebar_settings_header', array(
        'sanitize_callback' => 'sanitize_text_field'
      ));

    $wp_customize->add_control( 
        new Clean_Design_Blog_WP_Section_Heading_Control( $wp_customize, 'sticky_sidebar_settings_header', array(
            'label'	      => esc_html__( 'Sticky Sidebar', 'clean-design-blog' ),
            'section'     => 'general_section',
            'settings'    => 'sticky_sidebar_settings_header',
            'type'        => 'section-heading',
        ))
    );

    /**
     * Sticky Sidebar on site
     * 
     */
    $wp_customize->add_setting( 'sticky_sidebar_option', array(
        'default'           => true,
        'sanitize_callback' => 'clean_design_blog_sanitize_toggle_control',
    ));

    $wp_customize->add_control( 
        new Clean_Design_Blog_WP_Toggle_Control( $wp_customize, 'sticky_sidebar_option', array(
            'label'	      => esc_html__( 'Enable Sticky Sidebar', 'clean-design-blog' ),
            'description' => esc_html__( 'Enable to make sidebars sticky that appears in the site. Applied to all the pages', 'clean-design-blog' ),
            'section'     => 'general_section',
            'settings'    => 'sticky_sidebar_option',
            'type'        => 'toggle',
        ))
    );

    /**
     * Scroll To Top Settings Heading
     * 
     */
    $wp_customize->add_setting( 'scroll_to_top_settings_header', array(
        'sanitize_callback' => 'sanitize_text_field'
      ));

    $wp_customize->add_control( 
        new Clean_Design_Blog_WP_Section_Heading_Control( $wp_customize, 'scroll_to_top_settings_header', array(
            'label'	      => esc_html__( 'Scroll To Top Setting', 'clean-design-blog' ),
            'section'     => 'general_section',
            'settings'    => 'scroll_to_top_settings_header',
            'type'        => 'section-heading',
        ))
    );

    /**
     * Scroll To Top Option
     * 
     */
    $wp_customize->add_setting( 'scroll_to_top_option', array(
        'default'           => true,
        'sanitize_callback' => 'clean_design_blog_sanitize_toggle_control',
    ));

    $wp_customize->add_control( 
        new Clean_Design_Blog_WP_Toggle_Control( $wp_customize, 'scroll_to_top_option', array(
            'label'	      => esc_html__( 'Enable Scroll To Top', 'clean-design-blog' ),
            'section'     => 'general_section',
            'settings'    => 'scroll_to_top_option',
            'type'        => 'toggle',
        ))
    );
}