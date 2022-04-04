<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Clean Design Blog
 * @since 1.0.0
 */

get_header();
?>

	<main id="primary" class="site-main">
		<div class="container">
			<div class="row">
			<?php
				$clean_design_blog_archive_layout = get_theme_mod( 'archive_posts_layout', 'list-layout' );
				$clean_design_blog_layout = 'grid';
				if( $clean_design_blog_archive_layout == 'list-layout') {
					$clean_design_blog_layout_class = 'bmm-post-list-block bmm-block bmm-block-post-list--layout-two bmm-block-image-hover--none overflow--show';
					$clean_design_blog_layout = 'list';
				} else {
					$clean_design_blog_layout_class = 'bmm-post-grid-block bmm-block bmm-block-post-grid--layout-default bmm-block-image-hover--none archive-layout-selector';
				}
			?>
			<div class="blaze-main-content <?php echo esc_attr($clean_design_blog_layout_class); ?>">
				<?php if ( have_posts() ) : ?>
					<header class="page-header bmm-block-title layout--two">
						<?php
							the_archive_title( '<h2 class="bmm-post-title">', '</h2>' );
							the_archive_description( '<div class="archive-description">', '</div>' );
						?>
					</header><!-- .page-header -->

					<?php
						echo '<div class="bmm-post-wrapper">';
							/* Start the Loop */
							while ( have_posts() ) :
								the_post();
								/*
								* Include the Post-Type-specific template for the content.
								* If you want to override this in a child theme, then include a file
								* called content-___.php (where ___ is the Post Type name) and that will be used instead.
								*/
									get_template_part( 'template-parts/content', $clean_design_blog_layout );

								/**
								 * hook - clean_design_blog_archive_single_post_after_hook
								 * 
								 */
								if( has_action( 'clean_design_blog_archive_single_post_after_hook' ) ) {
									do_action( 'clean_design_blog_archive_single_post_after_hook' );
								}
							endwhile;
						echo '</div><!-- .posts-wrapper -->';

						/**
						 * hook - clean_design_blog_pagination_link_hook
						 * 
						 * @hooked - clean_design_blog_pagination_fnc
						 */
						do_action( 'clean_design_blog_pagination_link_hook' );
						
					else :
						echo '<div class="bmm-post-wrapper">';
								get_template_part( 'template-parts/content', 'none' );
						echo '</div>';
					endif;
				?>
			</div>
			<div class="blaze-sidebar-content">
				<?php get_sidebar(); ?>
			</div>
		</div> <!-- container -->
	</main><!-- #main -->

<?php
get_footer();