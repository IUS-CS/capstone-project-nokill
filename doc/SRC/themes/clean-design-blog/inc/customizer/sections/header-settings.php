<?php
/**
 * Header settings Section
 * 
 * @package Clean Design Blog
 * @since 1.0.0
 */

add_action( 'customize_register', 'clean_design_blog_customize_header_settings_register', 10 );
/**
 * Add settings for header in the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function clean_design_blog_customize_header_settings_register( $wp_customize ) {
   /*------------------------------------ Top Header Section --------------------------------------------------------*/
    /**
     * Top Header Section
     * 
     * panel - clean_design_blog_header_settings_panel
     */
    $wp_customize->add_section( 'top_header_section', array(
      'title' => esc_html__( 'Top Header', 'clean-design-blog' ),
      'panel' => 'clean_design_blog_header_settings_panel',
      'priority'  => 10,
    ));

     /**
     * Top Header Settings
     * 
     */
    $wp_customize->add_setting( 'top_header_option', array(
        'default'         => true,
        'sanitize_callback' => 'clean_design_blog_sanitize_toggle_control',
      ));
  
      $wp_customize->add_control( 
          new Clean_Design_Blog_WP_Toggle_Control( $wp_customize, 'top_header_option', array(
            'label'	      => esc_html__( 'Show top header bar', 'clean-design-blog' ),
            'section'     => 'top_header_section',
            'settings'    => 'top_header_option',
            'type'        => 'toggle',
        ))
      );
      
      /**
       * Top Header Style Settings Heading
       * 
       */
      $wp_customize->add_setting( 'top_header_style_setting_header', array(
        'sanitize_callback' => 'sanitize_text_field'
      ));
  
      $wp_customize->add_control( 
          new Clean_Design_Blog_WP_Section_Heading_Control( $wp_customize, 'top_header_style_setting_header', array(
            'label'	      => esc_html__( 'Style', 'clean-design-blog' ),
            'section'     => 'top_header_section',
            'settings'    => 'top_header_style_setting_header',
            'type'        => 'section-heading',
            'active_callback' => 'top_header_option_callback'
        ))
      );
  
      /**
       * Top Header Bg Color
       * 
       */
      $wp_customize->add_setting( 'top_header_bg_color', array(
        'default' => '#D37FB0',
        'sanitize_callback' => 'sanitize_hex_color'
      ) );
  
      $wp_customize->add_control( 
        new WP_Customize_Color_Control( $wp_customize, 'top_header_bg_color', array(
            'label'      => __( 'Background Color', 'clean-design-blog' ),
            'section'    => 'top_header_section',
            'settings'   => 'top_header_bg_color',
            'active_callback' => 'top_header_option_callback'
        ))
      );
  
      /**
       * Top Header Text Color
       * 
       */
      $wp_customize->add_setting( 'top_header_text_color', array(
        'sanitize_callback' => 'sanitize_hex_color'
      ) );
  
      $wp_customize->add_control( 
        new WP_Customize_Color_Control( $wp_customize, 'top_header_text_color', array(
            'label'      => __( 'Text Color', 'clean-design-blog' ),
            'section'    => 'top_header_section',
            'settings'   => 'top_header_text_color',
            'active_callback' => 'top_header_option_callback'
        ))
      );
      
   /*------------------------------------ Header Section --------------------------------------------------------*/
    /**
     *  Header Section
     * 
     */
    $wp_customize->add_section( 'header_section', array(
      'title' => esc_html__( 'Main', 'clean-design-blog' ),
      'panel' => 'clean_design_blog_header_settings_panel',
      'priority'  => 20,
    ));

    /**
     * Header General Settings Heading
     * 
     */
    $wp_customize->add_setting( 'header_general_setting_header', array(
      'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control( 
        new Clean_Design_Blog_WP_Section_Heading_Control( $wp_customize, 'header_general_setting_header', array(
          'label'	      => esc_html__( 'General', 'clean-design-blog' ),
          'section'     => 'header_section',
          'settings'    => 'header_general_setting_header',
          'type'        => 'section-heading'
      ))
    );

    /**
     * Header Toggle Sidebar Option
     * 
     */
    $wp_customize->add_setting( 'header_toggle_sidebar_option', array(
      'default'           => true,
      'sanitize_callback' => 'clean_design_blog_sanitize_toggle_control',
    ));

    $wp_customize->add_control( 
        new Clean_Design_Blog_WP_Toggle_Control( $wp_customize, 'header_toggle_sidebar_option', array(
          'label'	      => esc_html__( 'Show/Hide toggle sidebar', 'clean-design-blog' ),
          'section'     => 'header_section',
          'settings'    => 'header_toggle_sidebar_option',
          'type'        => 'toggle'
      ))
    );

    /**
     * Header Search Bar Option
     * 
     */
    $wp_customize->add_setting( 'header_search_bar_option', array(
      'default'         => true,
      'sanitize_callback' => 'clean_design_blog_sanitize_toggle_control',
    ));

    $wp_customize->add_control( 
        new Clean_Design_Blog_WP_Toggle_Control( $wp_customize, 'header_search_bar_option', array(
          'label'	      => esc_html__( 'Show/Hide search bar', 'clean-design-blog' ),
          'section'     => 'header_section',
          'settings'    => 'header_search_bar_option',
          'type'        => 'toggle'
      ))
    );

    /**
     * Header Style Settings Heading
     * 
     */
    $wp_customize->add_setting( 'header_style_setting_header', array(
      'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control( 
        new Clean_Design_Blog_WP_Section_Heading_Control( $wp_customize, 'header_style_setting_header', array(
          'label'	      => esc_html__( 'Style', 'clean-design-blog' ),
          'section'     => 'header_section',
          'settings'    => 'header_style_setting_header',
          'type'        => 'section-heading'
      ))
    );

    /**
     * Header Background Color
     * 
     */
    $wp_customize->add_setting( 'header_bg_color', array(
      'default' => '',
      'sanitize_callback' => 'sanitize_hex_color'
    ));

    $wp_customize->add_control( 
      new WP_Customize_Color_Control( $wp_customize, 'header_bg_color', array(
          'label'      => __( 'Header Background Color', 'clean-design-blog' ),
          'section'    => 'header_section',
          'settings'   => 'header_bg_color',
          'priority'   => 100
      ))
    );

    /**
     * Header Search Icon color
     * 
     */
    $wp_customize->add_setting( 'header_search_icon_color', array(
      'default' => '#D37FB0',
      'sanitize_callback' => 'sanitize_hex_color'
    ));

    $wp_customize->add_control( 
      new WP_Customize_Color_Control( $wp_customize, 'header_search_icon_color', array(
          'label'      => __( 'Icon Color', 'clean-design-blog' ),
          'section'    => 'header_section',
          'settings'   => 'header_search_icon_color',
          'priority'   => 110
      ))
    );

    /**
     * Header Toggle Icons Color
     * 
     */
    $wp_customize->add_setting( 'header_sidebar_toggle_icon_color', array(
      'default'        => '#D37FB0',
      'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control( 
      new WP_Customize_Color_Control( $wp_customize, 'header_sidebar_toggle_icon_color', array(
        'label'   => __( 'Toggle Icon Color', 'clean-design-blog' ),
        'section' => 'header_section',
        'settings'   => 'header_sidebar_toggle_icon_color',
        'priority'   => 120
      ))
    );
    /*------------------------------------ Social Icons Section --------------------------------------------------------*/
    /**
     *  Header Section
     * 
     */
    $wp_customize->add_section( 'header_social_icons_section', array(
      'title' => esc_html__( 'Social', 'clean-design-blog' ),
      'panel' => 'clean_design_blog_header_settings_panel',
      'priority'  => 30,
    ));
    /**
     * Top header social icons
     * 
     */
    $wp_customize->add_setting( 'site_social_icons', array(
      'sanitize_callback' => 'clean_design_blog_sanitize_repeater_control',
      'default' => json_encode(array(
        array(
          'icon_value'  => 'fab fa-facebook-square',
          'link'        => '#',
          'checkbox'    => true
        ),
        array(
          'icon_value'  => 'fab fa-twitter',
          'link'        => '#',
          'checkbox'    => true
        ),
        array(
          'icon_value'  => 'fab fa-skype',
          'link'        => '#',
          'checkbox'    => true
        )
      ))
    ));
    $wp_customize->add_control( 
      new Clean_Design_Blog_WP_Repeater_Control( $wp_customize, 'site_social_icons', array(
        'label'   => esc_html__( 'Social Icons', 'clean-design-blog' ),
        'section' => 'header_social_icons_section',
        'customizer_repeater_icon_control'  => true,
        'customizer_repeater_link_control'  => true,
        'customizer_repeater_checkbox_control' => true
      ))
    );
}