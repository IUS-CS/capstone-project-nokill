<?php
/**
 * Handles hooks for the footer area of the themes
 * 
 * @package Clean Design Blog
 * @since 1.0.0
 * 
 */

if( !function_exists( 'clean_design_blog_footer_start' ) ) {
    /**
     * Footer start
     */
   function clean_design_blog_footer_start() {
      $footer_option = get_theme_mod( 'footer_option', true );
      if( ! $footer_option ) {
          return;
      }
        echo '<footer id="colophon" class="site-footer">';
      echo '<div class="container footer-inner">';
   }
}

if( !function_exists( 'clean_design_blog_footer_widget_content' ) ) :
  /**
   * Footer widget content
   * 
   */
  function clean_design_blog_footer_widget_content() {
    get_template_part( '/footer-columns' );
  }
endif;
if( !function_exists( 'clean_design_blog_footer_close' ) ) {
  /**
   * Footer close
   */
 function clean_design_blog_footer_close() {
    $footer_option = get_theme_mod( 'footer_option', true );
    if( ! $footer_option ) {
        return;
    }
      echo '</div><!-- .container -->';
    echo '</footer><!-- #colophon -->';
 }
}

add_action( 'clean_design_blog_footer_hook', 'clean_design_blog_footer_start', 5 );
add_action( 'clean_design_blog_footer_hook', 'clean_design_blog_footer_widget_content', 10 );
add_action( 'clean_design_blog_footer_hook', 'clean_design_blog_footer_close', 100 );

/************************************ 
 * Bottom Footer Hook *
 * ***********************************/
if( !function_exists( 'clean_design_blog_bottom_footer_start' ) ) {
  /**
   * Bottom Footer start
   */
 function clean_design_blog_bottom_footer_start() {
  echo '<div id="bottom-footer">';
  echo '<div class="container bottom-footer-inner">';
 }
}

if( !function_exists( 'clean_design_blog_bottom_footer_menu' ) ) :
  /**
   * Bottom Footer navigation Info
   * 
   */
  function clean_design_blog_bottom_footer_menu() {
    ?>
      <div class="bottom-footer-menu">
        <?php
          wp_nav_menu(
            array(
              'theme_location'  => 'menu-3',
              'menu_id'         => 'bottom-footer-menu',
              'depth'           => 1,
              'fallback_cb'     => false
            )
          );
        ?>
      </div>
    <?php
  }
endif;

if( !function_exists( 'clean_design_blog_bottom_footer_social_icons' ) ) :
  /**
   * Bottom Footer Social Icons
   * 
   */
  function clean_design_blog_bottom_footer_social_icons() {
    ?>
      <div class="bottom-footer-social-icons-wrap">
        <?php
          $site_social_icons =  get_theme_mod( 'site_social_icons', json_encode( array(
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
          );
          $site_social_icons_decoded = json_decode( $site_social_icons );
          if( $site_social_icons_decoded ) {
              foreach( $site_social_icons_decoded as $social_icon ) {
                  $icon_class = $social_icon->icon_value;
                  $icon_link = $social_icon->link;
                  echo '<a href="'.esc_url( $icon_link ).'"><i class="' .esc_attr( $icon_class ). '"></i></a>';
              }
          }
        ?>
      </div>
    <?php
  }
endif;

if( !function_exists( 'clean_design_blog_bottom_footer_site_info' ) ) :
  /**
   * Site Info
   * 
   */
  function clean_design_blog_bottom_footer_site_info() {
    $bottom_footer_site_info = sprintf( 'Copyright | Clean Design Blog by %s', '<a href="' .esc_url( 'https://blazethemes.com/' ). '">Blazethemes</a>' );
    if( empty( $bottom_footer_site_info ) ) { 
      return;
    }
    ?>
      <div class="site-info">
          <?php
            echo wp_kses_post( $bottom_footer_site_info );
          ?>
      </div><!-- .site-info -->
    <?php
  }
endif;

if( !function_exists( 'clean_design_blog_bottom_footer_close' ) ) :
  /**
   * Bottom Footer close
   */
  function clean_design_blog_bottom_footer_close() {
      echo '</div><!-- .container -->';
    echo '</div><!-- #bottom-footer -->';
  }
endif;

add_action( 'clean_design_blog_bottom_footer_hook', 'clean_design_blog_bottom_footer_start', 5 );
add_action( 'clean_design_blog_bottom_footer_hook', 'clean_design_blog_bottom_footer_menu', 30 );
add_action( 'clean_design_blog_bottom_footer_hook', 'clean_design_blog_bottom_footer_social_icons', 40 );
add_action( 'clean_design_blog_bottom_footer_hook', 'clean_design_blog_bottom_footer_site_info', 50 );
add_action( 'clean_design_blog_bottom_footer_hook', 'clean_design_blog_bottom_footer_close', 100 );