<?php
/**
 * Menu settings
 * 
 * @package Clean Design Blog
 * @since 1.0.0
 */

add_action( 'customize_register', 'clean_design_blog_customize_menu_section_register', 10 );
/**
 * Add settings for Menu in the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function clean_design_blog_customize_menu_section_register( $wp_customize ) {
    /**
     * Menu Section
     * 
     * panel - clean_design_blog_theme_panel
     */
    $wp_customize->add_section( 'menu_section', array(
      'title' 		=> esc_html__( 'Menu Section', 'clean-design-blog' ),
      'panel' 		=> 'clean_design_blog_theme_panel',
      'priority' 	=> 6,
    ));

    /**
     * Primary Menu Heading
     * 
     */
    $wp_customize->add_setting( 'menu_hover_style_header', array(
      'sanitize_callback' => 'sanitize_text_field'
    ));

  $wp_customize->add_control( 
      new Clean_Design_Blog_WP_Section_Heading_Control( $wp_customize, 'menu_hover_style_header', array(
          'label'       => esc_html__( 'Primary Menu Hover Effect', 'clean-design-blog' ),
          'section'     => 'menu_section',
          'settings'    => 'menu_hover_style_header',
          'type'        => 'section-heading',
      ))
  );

  /**
   * Primary Menu Hover Settings
   * 
   */
  $wp_customize->add_setting( 'menu_hover_style', array(
    'default' => 'menu_hover_1',
    'sanitize_callback' => 'clean_design_blog_sanitize_menuhover',
  ) );  
  $wp_customize->add_control( 
    'menu_hover_style', array(
      'type' 		=> 'radio',
      'section' 	=> 'menu_section',
      'choices' 	=> array(	
          'menu_hover_1' => __( 'Menu Hover Effect 1', 'clean-design-blog' ),
          'menu_hover_none' => __( 'Menu Hover Effect none', 'clean-design-blog' )
      )
    )
  );
  
    /**
     * Menu Styling Heading
     * 
     */
    $wp_customize->add_setting( 'menu_styling_header', array(
      'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control( 
        new Clean_Design_Blog_WP_Section_Heading_Control( $wp_customize, 'menu_styling_header', array(
            'label'       => esc_html__( 'Menu Styling/Colors', 'clean-design-blog' ),
            'section'     => 'menu_section',
            'settings'    => 'menu_styling_header',
            'type'        => 'section-heading',
        ))
    );
    
    // Main Menu border top
    $wp_customize->add_setting( 'main_menu_border_top_color', array(
      'default'        => '#D37FB0',
      'sanitize_callback' => 'sanitize_hex_color',
    ) );    
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'main_menu_border_top_color', array(
      'label'   => __( 'Menu Border Top', 'clean-design-blog' ),
      'section' => 'menu_section',
      'settings'   => 'main_menu_border_top_color',
    ) ) );  

    // Main Menu Border bottom
    $wp_customize->add_setting( 'main_menu_border_bottom_color', array(
      'default'        => '#e1e1e1',
      'sanitize_callback' => 'sanitize_hex_color',
    ) );    
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'main_menu_border_bottom_color', array(
      'label'   => __( 'Menu Border Bottom', 'clean-design-blog' ),
      'section' => 'menu_section',
      'settings'   => 'main_menu_border_bottom_color',
    )));

    // Main Menu Border bottom
    $wp_customize->add_setting( 'header_search_icon_color', array(
      'default'        => '#666666',
      'sanitize_callback' => 'sanitize_hex_color',
    ) );    
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_search_icon_color', array(
      'label'   => __( 'Search Icon Color', 'clean-design-blog' ),
      'section' => 'menu_section',
      'settings'   => 'header_search_icon_color',
    )));
    
    /**
     * Mobile Menu styling
     * 
     */
    $wp_customize->add_setting( 'mobile_menu_styling_header', array(
      'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control( 
        new Clean_Design_Blog_WP_Section_Heading_Control( $wp_customize, 'mobile_menu_styling_header', array(
            'label'       => esc_html__( 'Mobile Menu Styling/Colors', 'clean-design-blog' ),
            'section'     => 'menu_section',
            'settings'    => 'mobile_menu_styling_header',
            'type'        => 'section-heading',
        ))
    );

     // Toggle Background Color
    $wp_customize->add_setting( 'mobile_menu_toggle_background_color', array(
      'default'        => '#d37fb0',
      'sanitize_callback' => 'sanitize_hex_color',
    ) );    
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'mobile_menu_toggle_background_color', array(
      'label'   => __( 'Toggle Background Color', 'clean-design-blog' ),
      'section' => 'menu_section',
      'settings'   => 'mobile_menu_toggle_background_color',
    )));

    $wp_customize->add_setting( 'mobile_menu_toggle_bar_color', array(
      'default'        => '#ffffff',
      'sanitize_callback' => 'sanitize_hex_color',
    ) );    

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'mobile_menu_toggle_bar_color', array(
      'label'   => __( 'Toggle Bar Color', 'clean-design-blog' ),
      'section' => 'menu_section',
      'settings'   => 'mobile_menu_toggle_bar_color',
    )));
}