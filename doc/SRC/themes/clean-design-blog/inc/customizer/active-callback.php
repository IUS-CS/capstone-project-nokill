<?php
/**
 * Manage active callback functions
 * 
 * @package Clean Design Blog
 * @since 1.0.0
 */

// top header option callback
function top_header_option_callback($control) {
    if ( $control->manager->get_setting( 'top_header_option' )->value() !== false ) {
        return true;
    }
    return false;
}

// footer option callback
function footer_option_callback($control) {
    if ( $control->manager->get_setting( 'footer_option' )->value() !== false ) {
        return true;
    }
    return false;
}

// post sidebar option callback
function post_sidebar_option_callback($control) {
    if ( $control->manager->get_setting( 'post_sidebar_option' )->value() !== false ) {
        return true;
    }
    return false;
}

// page sidebar option callback
function page_sidebar_option_callback($control) {
    if ( $control->manager->get_setting( 'page_sidebar_option' )->value() !== false ) {
        return true;
    }
    return false;
}

// archive sidebar option callback
function archive_sidebar_option_callback($control) {
    if ( $control->manager->get_setting( 'archive_sidebar_option' )->value() !== false ) {
        return true;
    }
    return false;
}

// archive read more option callback
function archive_read_more_option_callback($control) {
    if ( $control->manager->get_setting( 'archive_read_more_option' )->value() !== false ) {
        return true;
    }
    return false;
}