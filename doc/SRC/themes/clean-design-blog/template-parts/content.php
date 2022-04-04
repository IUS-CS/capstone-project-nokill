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

<article id="post-<?php the_ID(); ?>" <?php post_class('bmm-post .bmm-block-post-list--layout-two'); ?>>
	<div class="post-elements-wrapper">
		<header class="entry-header">
			<?php
			if ( 'post' === get_post_type() ) :
				?>
				<div class="bmm-post-meta">
					<?php clean_design_blog_entry_footer(); ?>
				</div>
			<?php endif;

			if ( is_singular() ) :
				the_title( '<h1 class="bmm-post-title">', '</h1>' );
			else :
				the_title( '<h2 class="bmm-post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;

			clean_design_blog_posted_on();

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
        ?>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
