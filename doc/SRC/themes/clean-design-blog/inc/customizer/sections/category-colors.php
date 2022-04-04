<?php
/**
 * Category Colors Settings
 * 
 * @package Clean Design Blog
 * @since 1.0.0
 */

add_action( 'customize_register', 'clean_design_blog_customize_category_colors_section_register', 10 );
/**
 * Add settings for category colors section in the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function clean_design_blog_customize_category_colors_section_register( $wp_customize ) {

    /**
     * Category Colors Section
     * 
     * section - colors
     */
    $wp_customize->add_section( 'category_colors_section', array(
            'title'      => esc_html__( 'Category Colors', 'clean-design-blog' ),
            'priority'   => 60
        )
    );
    
    /**
     * Category Colors
     * 
     */
    $categories = get_categories();
    foreach( $categories as $category ) :
        /**
         * Category Color
         * 
         */
        $wp_customize->add_setting( 'category_' .esc_attr( $category->slug ), array(
            'default' => '#000000',
            'sanitize_callback' => 'sanitize_hex_color'
        ) );
    
        $wp_customize->add_control( 
            new WP_Customize_Color_Control( $wp_customize, 'category_' .esc_attr( $category->slug ), array(
                'label'      => esc_html( $category->name ),
                'section'    => 'category_colors_section',
                'settings'   => 'category_' .esc_attr( $category->slug )
            ))
        );
    endforeach;
}