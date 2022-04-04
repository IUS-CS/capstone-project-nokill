<?php
/**
 * Header Template - layout three
 * 
 * @since 1.0.0
 * 
 */
    $top_header_option = get_theme_mod( 'top_header_option', true );
    if( $top_header_option ) :
?>
        <div id="blaze-top-header">
            <div class="container">
                <div class="row align-items-center top_header_inner_wrap">
                    <div class="top-header-date_outerwrap">
                        <div class="top-header-date has_dot ">
                            <?php
                                echo esc_attr( date( str_replace( '-', ' ',  esc_attr( 'l-M-d,-Y' ) ) ) );
                            ?>
                        </div>
                    </div>
                </div><!-- .row -->
            </div><!-- .container -->
        </div><!-- #blaze-top-header -->
<?php
    endif;
?>
<header id="masthead" class="site-header">
    <div class="site-branding-section-wrap">
        <div class='container'>
            <div class="row align-items-center site-branding-inner-wrap">
                <div class="top-header-social-icons_outerwrap">
                    <div class="top-header-social-icons">
                        <?php
                            $site_social_icons =  get_theme_mod( 'site_social_icons', json_encode(array(
                                    array(
                                        'icon_value'    => 'fab fa-facebook-square',
                                        'link'          => '#',
                                        'checkbox'      => true
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
                                    $checkbox = $social_icon->checkbox;
                                    $target = '_self';
                                    if( $checkbox === '1' ) {
                                        $target = '_blank';
                                    }
                                    echo '<a href="'.esc_url( $icon_link ).'" target="' .esc_html( $target ). '" rel="noopener"><i class="' .esc_attr( $icon_class ). '"></i></a>';
                                }
                            }
                        ?>
                    </div>
                </div>
                <div class="site-branding">
                    <?php
                        the_custom_logo();
                    if ( is_front_page() && is_home() ) :
                        ?>
                        <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                        <?php
                    else :
                        ?>
                        <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                        <?php
                    endif;
                    $clean_design_blog_description = get_bloginfo( 'description', 'display' );
                    if ( $clean_design_blog_description || is_customize_preview() ) :
                        ?>
                        <p class="site-description"><?php echo wp_kses_post( $clean_design_blog_description ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
                    <?php endif; ?>
                </div><!-- .site-branding -->
                
                <div class="top-header-menu_outerwrap">
                    <div class="top-header-menu_wrap">
                        <?php
                            wp_nav_menu(array(
                                'theme_location' => 'menu-2',
                                'menu_id'        => 'top-header-menu',
                                'depth'           => 1,
                                'fallback_cb'     => false
                            ));
                        ?>
                    </div>
                </div>
            </div><!-- .row-->
        </div><!-- .container -->
    </div><!-- .site-branding-section-wrap -->
    <div class="main-navigation-section-wrap">
        <div class="container">
            <div class="row align-items-center menu_search_wrap_inner">
                <?php
                    $header_toggle_sidebar_option = get_theme_mod( 'header_toggle_sidebar_option', true );
                    if( $header_toggle_sidebar_option ) {
                ?>
                        <div class="header-toggle-sidebar-wrap">
                            <a class="header-sidebar-trigger hamburger" href="javascript:void(0)">
                                <div class="top-bun"></div>
                                <div class="meat"></div>
                                <div class="bottom-bun"></div>
                            </a>
                            <div class="header-sidebar-content">
                                <div class="header_sidebar-content-inner-wrap">
                                    <a class="header-sidebar-trigger-close" href="javascript:void(0)"><i class="far fa-window-close"></i></a>
                                    <?php 
                                        if( is_active_sidebar('sidebar-header-toggle') ) {
                                                dynamic_sidebar('sidebar-header-toggle');
                                        } else {
                                            echo '<div class="four-zero-four-sidebar-message">' .esc_html__( 'No widgets are assigned to this sidebar. Go to your Dashboard > Widgets > Assign widgets to Header Toggle Sidebar', 'clean-design-blog' ). '</div>';
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                ?>
                <div class="main-navigation-wrap">
                    <nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'clean-design-blog' ); ?>">
                        <button id="menu-toggle" class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                        <i class="fas fa-bars"></i><i class="fas fa-times"></i>
                        </button>
                        <div id="site-header-menu" class="site-header-menu">
                                <?php
                                    wp_nav_menu(
                                        array(
                                            'theme_location'=> 'menu-1',
                                            'menu_class'    => 'primary-menu',
                                            'fallback_cb'   => 'clean_design_blog_primary_navigation_fallback'
                                        )
                                    );
                                ?>
                        </div>
                    </nav><!-- #site-navigation -->
                </div>
                <?php
                    $header_search_bar_option = get_theme_mod( 'header_search_bar_option', true );
                    if( $header_search_bar_option ) {
                    ?>
                        <div class="header_search_icon">
                            <a href="javascript:void(0)" class="main_search_icon"><i class="fas fa-search main_search_icon"></i></a>
                            <div class="header-search-wrap">
                                <div class="header-search-bar">
                                    <?php
                                        get_search_form();
                                    ?>
                                </div><!-- !header-search-bar -->
                            </div>

                        </div>
            
                        
                <?php
                    }
                ?>
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .main-navigation-section-wrap -->

</header><!-- #masthead -->