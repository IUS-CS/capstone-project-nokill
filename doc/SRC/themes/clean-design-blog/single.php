<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Clean Design Blog
 * @since 1.0.0
 */

get_header();
?>

	<main id="primary" class="site-main">
		<div class="container">
			<div class="row">
				<div class="blaze-main-content cdb-single-post-content">
					<?php
					while ( have_posts() ) :
						the_post();

						get_template_part( 'template-parts/content', 'single' );
						$prev_post = get_previous_post();
						$prev_post_thumb = $prev_post ? get_the_post_thumbnail_url( $prev_post->ID, 'medium' ) : '';
						$next_post = get_next_post();
						$next_post_thumb = $next_post ? get_the_post_thumbnail_url( $next_post->ID, 'medium' ) : '';
						the_post_navigation(
							array(
								'prev_text' => '<span class="nav-subtitle"><i class="fas fa-angle-double-left"></i>' . esc_html__( 'Previous', 'clean-design-blog' ) . '</span><span class="nav-thumb"><div class="nav_thumb_wrap"><img src="' .esc_url( $prev_post_thumb ). '"></div><span class="nav-title">%title</span></span>',
								'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next', 'clean-design-blog' ) . '<i class="fas fa-angle-double-right"></i></span><span class="nav-thumb"><span class="nav-title">%title</span><div class="nav_thumb_wrap"><img src="' .esc_url( $next_post_thumb ). '"></div></span>',
							)
						);

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

						/**
						 * hook - clean_design_blog_single_post_footer_hook
						 * 
						 * @since 1.0.0
						 * 
						 */
						do_action( 'clean_design_blog_single_post_footer_hook' );
					endwhile; // End of the loop.
					?>
				</div>
				<div class="blaze-sidebar-content">
					<?php get_sidebar(); ?>
				</div>
			</div>
		</div>
	</main><!-- #main -->

<?php
get_footer();