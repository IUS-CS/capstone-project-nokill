<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Clean Design Blog
 * @since 1.0.0
 */

get_header();
?>
	<main id="primary" class="site-main">
		<div class="container">
			<div class="row">
				<div class="blaze-main-content">
					<section class="error-404 not-found">
						<header class="page-header">
							<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'clean-design-blog' ); ?></h1>
						</header><!-- .page-header -->

						<div class="page-content">
							<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'clean-design-blog' ); ?></p>
							<?php
								get_search_form();
							?>
						</div><!-- .page-content -->
					</section><!-- .error-404 -->
				</div>
				<div class="blaze-sidebar-content">
					<?php get_sidebar(); ?>
				</div>
			</div>

	</main><!-- #main -->
<?php
get_footer();