<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Clean Design Blog
 * @since 1.0.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php
        if ( 'post' === get_post_type() ) :
            ?>
            <div class="bmm-post-meta single-postmeta-cat">
                <?php clean_design_blog_entry_footer(); ?>
            </div>
        <?php endif;

        the_title( '<h1 class="bmm-post-title">', '</h1>' );
        ?>
        <div class="single-postmeta-wrap">
            <?php
                clean_design_blog_posted_by();
                clean_design_blog_posted_on();
                echo '<span class="bmm-post-meta-item bmm-post-comments-number"><a href="'.esc_url( get_the_permalink() ).'/#comments">' .absint( get_comments_number() ). '</a></span>';
            ?>
        </div>
        <?php
        if( has_post_thumbnail() ) :
        ?>
            <div class="bmm-post-thumb">
                <?php clean_design_blog_post_thumbnail(); ?>
            </div>
        <?php
        endif;
        ?>
    </header><!-- .entry-header -->

    <div class="entry-content">
        <?php
            the_content(
                sprintf(
                    wp_kses(
                        /* translators: %s: Name of current post. Only visible to screen readers */
                        __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'clean-design-blog' ),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    wp_kses_post( get_the_title() )
                )
            );

            /**
             * hook - clean_design_blog_single_after_content
             * 
             */

             do_action( 'clean_design_blog_single_after_content' );

            wp_link_pages(
                array(
                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'clean-design-blog' ),
                    'after'  => '</div>',
                )
            );
        ?>
    </div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->