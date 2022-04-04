/**
 * Redirect to the specific url on section and setting change
 * 
 * @package Clean Design Blog
 * @since 1.0.0
 */

 (function ( api ) {
    api.section( 'static_front_page', function( section ) {
        clean_design_blog_redirect_preview_url( section, api.settings.url.home )
    });
    api.panel( 'clean_design_blog_frontpage_sections_panel', function( section ) {
        clean_design_blog_redirect_preview_url( section, api.settings.url.home )
    });

    api.section( 'innerpages_error_page_section', function( section ) {
        clean_design_blog_redirect_preview_url( section, api.settings.url.home + '404pagenotfound' )
    });

    api.section( 'innerpages_search_page_section', function( section ) {
        clean_design_blog_redirect_preview_url( section, api.settings.url.home + '?s=a' )
    });

    function clean_design_blog_redirect_preview_url( section, url ) {
        var previousUrl, clearPreviousUrl, previewUrlValue;
        previewUrlValue = api.previewer.previewUrl;
        clearPreviousUrl = function() {
            previousUrl = null;
        };

        section.expanded.bind( function( isExpanded ) {
            if ( isExpanded ) {
                previousUrl = previewUrlValue.get();
                previewUrlValue.set( url );
                previewUrlValue.bind( clearPreviousUrl );
            } else {
                previewUrlValue.unbind( clearPreviousUrl );
                if ( previousUrl ) {
                    previewUrlValue.set( previousUrl );
                }
            }
        });
    }
} ( wp.customize ) );