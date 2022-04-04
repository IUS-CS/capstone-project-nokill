<?php
/**
 * Inner Pages settings
 * 
 * @package Clean Design Blog
 * @since 1.0.0
 */

add_action( 'customize_register', 'clean_design_blog_customize_innerpages_section_register', 10 );
/**
 * Add settings for innerpages in the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function clean_design_blog_customize_innerpages_section_register( $wp_customize ) {
    /**
     * Archive
     * 
     * panel - clean_design_blog_innerpages_settings_panel
     */
    $wp_customize->add_section( 'innerpages_archive_page_section', array(
        'title' => esc_html__( 'Archive', 'clean-design-blog' ),
        'panel' => 'clean_design_blog_innerpages_settings_panel',
        'priority'  => 10,
    ));

    /**
     * Archive Posts Layout settings
     * 
     */
    $wp_customize->add_setting( 'archive_posts_layout',
        array(
            'default'           => 'list-layout',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    // Add the layout control.
    $wp_customize->add_control( new Clean_Design_Blog_WP_Radio_Image_Control(
        $wp_customize,
        'archive_posts_layout',
        array(
            'label'     => esc_html__( 'Posts Layouts', 'clean-design-blog' ),
            'section'   => 'innerpages_archive_page_section',
            'choices'   => array(
                'list-layout' => array(
                'label'   => esc_html__( 'List Layout', 'clean-design-blog' ),
                'url'     => '%s/images/customizer/list_mode.jpg'
                ),
                'grid-layout' => array(
                'label'   => esc_html__( 'Grid Layout', 'clean-design-blog' ),
                'url'     => '%s/images/customizer/grid_mode.jpg'
                )
            )
        )
      )
    );

    /**
     * Archive general content settings
     * 
     */
    $wp_customize->add_setting( 'archive_general_content_setting_header', array(
        'sanitize_callback' => 'sanitize_text_field'
      ));

    $wp_customize->add_control( 
        new Clean_Design_Blog_WP_Section_Heading_Control( $wp_customize, 'archive_general_content_setting_header', array(
            'label'       => esc_html__( 'General Content Settings', 'clean-design-blog' ),
            'section'     => 'innerpages_archive_page_section',
            'settings'    => 'archive_general_content_setting_header',
            'type'        => 'section-heading',
        ))
    );
    
    /**
     * Archive Read more Option
     * 
     */
    $wp_customize->add_setting( 'archive_read_more_option', array(
        'default'         => false,
        'sanitize_callback' => 'clean_design_blog_sanitize_toggle_control',
    ));
  
    $wp_customize->add_control( 
        new Clean_Design_Blog_WP_Toggle_Control( $wp_customize, 'archive_read_more_option', array(
            'label'	      => esc_html__( 'Show/Hide read more', 'clean-design-blog' ),
            'section'     => 'innerpages_archive_page_section',
            'settings'    => 'archive_read_more_option',
            'type'        => 'toggle'
        ))
    );

    /**
     * Add read more text
     * 
     */
    $wp_customize->add_setting( 'archive_read_more_text', array(
        'default'        => esc_html__( 'Read more . . ', 'clean-design-blog' ),
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control( 'archive_read_more_text', array(
        'label'    => esc_html__( 'Read more text', 'clean-design-blog' ),
        'section'  => 'innerpages_archive_page_section',		
        'type'     => 'text',
        'active_callback' => 'archive_read_more_option_callback'
    ));

    /*-------------------------------------------------------------------------------------------------------------------------------------------*/

    /**
     *  Single Page Section
     * 
     */
    $wp_customize->add_section( 'innerpages_single_page_section', array(
        'title' => esc_html__( 'Single', 'clean-design-blog' ),
        'panel' => 'clean_design_blog_innerpages_settings_panel',
        'priority'  => 20,
    ));
    
    /**
     * Single Related Posts settings
     * 
     */
    $wp_customize->add_setting( 'single_related_posts_setting_header', array(
        'sanitize_callback' => 'sanitize_text_field'
      ));

    $wp_customize->add_control( 
        new Clean_Design_Blog_WP_Section_Heading_Control( $wp_customize, 'single_related_posts_setting_header', array(
            'label'       => esc_html__( 'Related Posts', 'clean-design-blog' ),
            'section'     => 'innerpages_single_page_section',
            'settings'    => 'single_related_posts_setting_header',
            'type'        => 'section-heading',
        ))
    );

    /**
     * Single Related Posts Section Option
     * 
     */
    $wp_customize->add_setting( 'single_post_related_posts_option', array(
        'default'         => true,
        'sanitize_callback' => 'clean_design_blog_sanitize_toggle_control',
    ));
  
    $wp_customize->add_control( 
        new Clean_Design_Blog_WP_Toggle_Control( $wp_customize, 'single_post_related_posts_option', array(
            'label'	      => esc_html__( 'Show/Hide related posts', 'clean-design-blog' ),
            'section'     => 'innerpages_single_page_section',
            'settings'    => 'single_post_related_posts_option',
            'type'        => 'toggle'
        ))
    );
}