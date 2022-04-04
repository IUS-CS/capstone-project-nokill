<?php
/**
 * Footer settings
 * 
 * @package Clean Design Blog
 * @since 1.0.0
 */

add_action( 'customize_register', 'clean_design_blog_customize_footer_section_register', 10 );
/**
 * Add settings for footer in the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function clean_design_blog_customize_footer_section_register( $wp_customize ) {
    /**
     * Footer Section
     * 
     * panel - clean_design_blog_footer_settings_panel
     */
    $wp_customize->add_section( 'footer_section', array(
      'title' => esc_html__( 'Main', 'clean-design-blog' ),
      'panel' => 'clean_design_blog_footer_settings_panel'
    ));

    /**
     * Footer General Settings Heading
     * 
     */
    $wp_customize->add_setting( 'footer_general_setting', array(
      'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control( 
        new Clean_Design_Blog_WP_Section_Heading_Control( $wp_customize, 'footer_general_setting', array(
            'label'	      => esc_html__( 'General', 'clean-design-blog' ),
            'section'     => 'footer_section',
            'settings'    => 'footer_general_setting',
            'type'        => 'section-heading',
            'active_callback' => 'footer_option_callback'
        ))
    );

    /**
     * Footer Option
     * 
     */
    $wp_customize->add_setting( 'footer_option', array(
      'default'           => true,
      'sanitize_callback' => 'clean_design_blog_sanitize_toggle_control',
    ));

    $wp_customize->add_control( 
        new Clean_Design_Blog_WP_Toggle_Control( $wp_customize, 'footer_option', array(
          'label'	      => esc_html__( 'Show/Hide footer section', 'clean-design-blog' ),
          'section'     => 'footer_section',
          'settings'    => 'footer_option',
          'type'        => 'toggle',
      ))
    );
    
    /**
     * Footer Style Settings Heading
     * 
     */
    $wp_customize->add_setting( 'footer_style_setting', array(
      'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control( 
        new Clean_Design_Blog_WP_Section_Heading_Control( $wp_customize, 'footer_style_setting', array(
          'label'	      => esc_html__( 'Style', 'clean-design-blog' ),
          'section'     => 'footer_section',
          'settings'    => 'footer_style_setting',
          'type'        => 'section-heading',
          'active_callback' => 'footer_option_callback'
      ))
    );

    /**
     * Footer Bg Color
     * 
     */
    $wp_customize->add_setting( 'footer_bg_color', array(
      'default' => '#2c2c2c',
      'sanitize_callback' => 'sanitize_hex_color'
    ));

    $wp_customize->add_control( 
      new WP_Customize_Color_Control( $wp_customize, 'footer_bg_color', array(
          'label'      => __( 'Background Color', 'clean-design-blog' ),
          'section'    => 'footer_section',
          'settings'   => 'footer_bg_color',
          'active_callback' => 'footer_option_callback'
      ))
    );

    /**
     * Footer Text Color
     * 
     */
    $wp_customize->add_setting( 'footer_text_color', array(
      'default' => '#ffffff',
      'sanitize_callback' => 'sanitize_hex_color'
    ) );

    $wp_customize->add_control( 
      new WP_Customize_Color_Control( $wp_customize, 'footer_text_color', array(
          'label'      => __( 'Text Color', 'clean-design-blog' ),
          'section'    => 'footer_section',
          'settings'   => 'footer_text_color',
          'active_callback' => 'footer_option_callback'
      ))
    );

    /*--------------------------------------------------------- Bottom Footer Section -------------------------------------------------*/
    /**
     * Bottom Footer Section
     * 
     * panel - clean_design_blog_footer_settings_panel
     */
    $wp_customize->add_section( 'bottom_footer_section', array(
      'title' => esc_html__( 'Bottom Footer', 'clean-design-blog' ),
      'panel' => 'clean_design_blog_footer_settings_panel'
    ));
    
    /**
     * Bottom Footer Style Settings Heading
     * 
     */
    $wp_customize->add_setting( 'bottom_footer_style_setting', array(
      'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control( 
        new Clean_Design_Blog_WP_Section_Heading_Control( $wp_customize, 'bottom_footer_style_setting', array(
          'label'	      => esc_html__( 'Style', 'clean-design-blog' ),
          'section'     => 'bottom_footer_section',
          'settings'    => 'bottom_footer_style_setting',
          'type'        => 'section-heading'
      ))
    );

    /**
     * Bottom Footer Bg Color
     * 
     */
    $wp_customize->add_setting( 'bottom_footer_bg_color', array(
      'default' => '#f7f7f7',
      'sanitize_callback' => 'sanitize_hex_color'
    ) );

    $wp_customize->add_control( 
      new WP_Customize_Color_Control( $wp_customize, 'bottom_footer_bg_color', array(
          'label'      => __( 'Background Color', 'clean-design-blog' ),
          'section'    => 'bottom_footer_section',
          'settings'   => 'bottom_footer_bg_color'
      ))
    );

    /**
     * Bottom Footer Text Color
     * 
     */
    $wp_customize->add_setting( 'bottom_footer_text_color', array(
      'default' => '#020202',
      'sanitize_callback' => 'sanitize_hex_color'
    ) );

    $wp_customize->add_control( 
      new WP_Customize_Color_Control( $wp_customize, 'bottom_footer_text_color', array(
          'label'      => __( 'Text Color', 'clean-design-blog' ),
          'section'    => 'bottom_footer_section',
          'settings'   => 'bottom_footer_text_color'
      ))
    );
}