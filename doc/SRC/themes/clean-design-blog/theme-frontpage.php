<?php
/**
 * 
 * 
 * @package Clean Design Blog
 * @since 1.0.0
 * 
 */
get_header();
?>
<section class="clean_design_blog_front_page_sections">
    <div class="container">
        <div class="row">
            <?php
            /**
             * hook - clean_design_blog_frontpage_section_hook
             * 
             * @hooked - 
             * 
             */
                if( has_action( 'clean_design_blog_frontpage_section_hook' ) ) {
                    do_action( 'clean_design_blog_frontpage_section_hook' );
                } 
            ?>
        </div>
    </div>
</section>
<?php
get_footer();