<?php
/**
 * Template part for displaying post grid
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Clean Design Blog
 * @since 1.0.0
 * 
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('bmm-post'); ?>>
	<div class="title-wrap">
        <h2 class="bmm-post-title">
            <a href="<?php the_permalink(); ?>">
                <?php the_title(); ?>
            </a>
        </h2>
    </div><!-- .title-wrap -->
    <div class="bmm-post-meta">
		<?php clean_design_blog_entry_footer(); ?>
		<?php clean_design_blog_posted_on(); ?>
	</div>
    <?php
		clean_design_blog_posted_by();
		if( has_post_thumbnail() ) :
    ?>
			<div class="bmm-post-thumb">
				<?php clean_design_blog_post_thumbnail(); ?>
			</div>
	<?php endif; ?>
	
	<div class="post-elements-wrapper">
		<div class="entry-content">
			<?php
				the_excerpt();
				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'clean-design-blog' ),
						'after'  => '</div>',
					)
				);
			?>
		</div><!-- .entry-content -->

		<?php
		/**
		 * hook - clean_design_blog_archive_single_post_before_article_hook
		 * 
		 * @hooked - clean_design_blog_archive_read_more_button - 10
		 * 
		 */
			if( has_action( 'clean_design_blog_archive_single_post_before_article_hook' ) ) {
				do_action( 'clean_design_blog_archive_single_post_before_article_hook' );
			}
        ?>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->