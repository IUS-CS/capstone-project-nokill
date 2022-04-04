<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
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
					<?php
					if ( have_posts() ) :

						if ( is_home() && ! is_front_page() ) :
							?>
							<header>
								<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
							</header>
							<?php
						endif;

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

							endwhile;
						echo '</div><!-- .bmm-post-wrapper -->';

						/**
						 * hook - clean_design_blog_pagination_link_hook
						 * 
						 * @hooked - clean_design_blog_pagination_fnc
						 */
						do_action( 'clean_design_blog_pagination_link_hook' );
					else :

						get_template_part( 'template-parts/content', 'none' );

					endif;
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
