<?php
/**
 * Frontpage Middle Left Content Section Settings
 * 
 * @package Clean Design Blog
 * @since 1.0.0
 */

add_action( 'customize_register', 'clean_design_blog_customize_frontpage_middle_left_content_section_register', 10 );
/**
 * Add settings for frontpage middle left content section in the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function clean_design_blog_customize_frontpage_middle_left_content_section_register( $wp_customize ) {
    /**
     * Frontpage Middle Left Content Section
     * 
     * panel - clean_design_blog_frontpage_sections_panel
     */

    $wp_customize->add_section( 'frontpage_middle_left_content_section', array(
      'title' => esc_html__( 'Middle Left Content - Right Sidebar Section', 'clean-design-blog' ),
      'panel' => 'clean_design_blog_frontpage_sections_panel',
      'priority'  => 20,
    ));

    /**
     * Frontpage Middle Left Content Banner Widget Heading Settings
     * 
     */
    $wp_customize->add_setting( 'frontpage_middle_left_content_settings', array(
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control( 
        new Clean_Design_Blog_WP_Section_Heading_Control( $wp_customize, 'frontpage_middle_left_content_settings', array(
            'label'	      => esc_html__( 'Middle Left Content - Right Sidebar Blocks', 'clean-design-blog' ),
            'description' => sprintf( esc_html__( 'Manage right sidebar content in widgets area "Frontpage Middle - Right Sidebar" %1$1s manage right sidebar %2$2s', 'clean-design-blog' ), '<a target="blank" href="' .esc_url(admin_url( 'widgets.php' )). '">', '</a>' ),
            'section'     => 'frontpage_middle_left_content_section',
            'settings'    => 'frontpage_middle_left_content_settings',
            'type'        => 'section-heading',
        ))
    );
    
    $wp_customize->add_setting( 'frontpage_middle_left_content_blocks', array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'   => json_encode(array(
                array(
                    'name'      => 'posts-grid-alter',
                    'option'    => true,
                    'blockTitle'=> esc_html__( 'Posts Grid Alter', 'clean-design-blog' ),
                    'category'  => '',
                    'count'     => 3,
                    'dateOption'     => false,
                    'commentOption'  => false,
                    'layout'    => 'one'
                ),
                array(
                    'name'      => 'posts-grid',
                    'option'    => false,
                    'blockTitle'=> esc_html__( 'Posts Grid', 'clean-design-blog' ),
                    'category'  => '',
                    'count'     => 3,
                    'contentOption'  => false,
                    'layout'    => 'one'
                ),
                array(
                    'name'      => 'posts-list',
                    'option'    => false,
                    'blockTitle'=> esc_html__( 'Posts List', 'clean-design-blog' ),
                    'category'  => '',
                    'count'     => 3,
                    'dateOption'  => true,
                    'commentOption'  => true,
                    'contentOption'  => true,
                    'layout'    => 'one'
                )
            )
        )
    ));

    $wp_customize->add_control( 
        new Clean_Design_Blog_WP_Blocks_Repeater_Control( $wp_customize, 'frontpage_middle_left_content_blocks', array(
            'label'	      => esc_html__( 'Middle Left Content Blocks', 'clean-design-blog' ),
            'section'     => 'frontpage_middle_left_content_section',
            'settings'    => 'frontpage_middle_left_content_blocks'
        ))
    );
}