<?php
/**
 * Sanitize functions
 * 
 * @package Clean Design Blog
 * @since 1.0.0
 */

 if( !function_exists( 'clean_design_blog_sanitize_toggle_control' )  ) :
    /**
     * Sanitize toggle control value
     * 
     */
    function clean_design_blog_sanitize_toggle_control( $value ) {
        return rest_sanitize_boolean( $value );
    }
 endif;

 if( !function_exists( 'clean_design_blog_sanitize_repeater_control' ) ) :
    /**
     * Sanitize repeater field
     * 
     */
    function clean_design_blog_sanitize_repeater_control( $input ) {
        $input_decoded = json_decode( $input, true );
        if( !empty( $input_decoded ) ) {
            foreach( $input_decoded as $boxk => $box ) {
                foreach ( $box as $key => $value ) {
                    $input_decoded[$boxk][$key] = wp_kses_post( force_balance_tags( $value ) );
                }
            }
            return json_encode($input_decoded);
        }
        return $input;
    }
 endif;

 if( !function_exists( 'clean_design_blog_sanitize_select_control' ) ) :
    /**
     * Sanitize select control value
     * 
     */
    function clean_design_blog_sanitize_select_control( $input, $setting ) {
        // Ensure input is a slug.
        $input = sanitize_key( $input );
        // Get list of choices from the control associated with the setting.
        $choices = $setting->manager->get_control( $setting->id )->choices;
        // If the input is a valid key, return it; otherwise, return the default.
        return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
    }
endif;

// adds sanitization callback function for header menu hover
if ( ! function_exists( 'clean_design_blog_sanitize_menuhover' ) ) :
  function clean_design_blog_sanitize_menuhover( $value ) {
    $menu_hover_effect = array( 'menu_hover_1', 'menu_hover_none' );
    if ( ! in_array( $value, $menu_hover_effect ) ) {
      $value = 'menu_hover_1';
    }
    return $value;
  }
endif;

// adds sanitization callback function for site image hover
if ( ! function_exists( 'clean_design_blog_sanitize_image_hover' ) ) :
    function clean_design_blog_sanitize_image_hover( $value ) {
        $menu_hover_effect = array( 'hover-none', 'hover-one', 'hover-two', 'hover-three', 'hover-four' , 'hover-five' );
        if ( ! in_array( $value, $menu_hover_effect ) ) {
            $value = 'hover-none';
        }
        return $value;
    }
endif;

if( !function_exists( 'clean_design_blog_sanitize_number_absint' ) ) :
    /**
     * Sanitize number control value
     * 
     */
    function clean_design_blog_sanitize_number_absint( $number, $setting ) {
        // Ensure $number is an absolute integer (whole number, zero or greater).
        $number = absint( $number );
    
        // If the input is an absolute integer, return it; otherwise, return the default
        return ( $number ? $number : $setting->default );
    }
endif;

// adds sanitization callback function for numeric data : number
if ( ! function_exists( 'clean_design_blog_sanitize_number' ) ) :
    function clean_design_blog_sanitize_number( $value ) {
        $value = (int) $value; // Force the value into integer type.
        return ( 0 < $value ) ? $value : null;
    }
endif;