<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Clean Design Blog
 * @since 1.0.0
 * 
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('bmm-post'); ?>>
	<?php if( has_post_thumbnail() ) : ?>
		<div class="bmm-post-thumb">
			<?php clean_design_blog_post_thumbnail(); ?>
		</div>
	<?php endif; ?>
	
	<div class="post-elements-wrapper">
		<header class="entry-header">
			<?php
			if ( is_singular() ) :
				the_title( '<h1 class="bmm-post-title">', '</h1>' );
			else :
				the_title( '<h2 class="bmm-post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;

			if ( 'post' === get_post_type() ) :
				?>
				<div class="bmm-post-meta">
					<?php
						clean_design_blog_entry_footer();
						clean_design_blog_posted_on();
					?>
				</div>
			<?php endif; ?>
		</header><!-- .entry-header -->

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
			clean_design_blog_posted_by();

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