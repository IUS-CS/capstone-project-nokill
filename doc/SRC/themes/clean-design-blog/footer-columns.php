<?php
/**
 * Footer section
 * 
 * @package Clean Design Blog
 * @since 1.0.0
 */
$footer_option = get_theme_mod( 'footer_option', true );
if( !$footer_option ) {
    return;
}
?>
    <div class="footer-widget">
        <?php is_active_sidebar( 'footer-column' ) ? dynamic_sidebar( 'footer-column' ) : ''; ?>
    </div>

    <div class="footer-widget">
        <?php
            is_active_sidebar( 'footer-column-2' ) ? dynamic_sidebar( 'footer-column-2' ) : '';
        ?>
    </div>

    <div class="footer-widget">
        <?php
            is_active_sidebar( 'footer-column-3' ) ? dynamic_sidebar( 'footer-column-3' ) : '';
        ?>
    </div>

    <div class="footer-widget">
        <?php
            is_active_sidebar( 'footer-column-4' ) ? dynamic_sidebar( 'footer-column-4' ) : '';
        ?>
    </div>