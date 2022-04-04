<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Clean Design Blog
 * @since 1.0.0
 */

if ( ! function_exists( 'clean_design_blog_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function clean_design_blog_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( '%1$1s %2$2s', 'post date', 'clean-design-blog' ),
			'', '<a href="' . esc_url( get_day_link( get_the_time('Y'), get_the_time('m'), get_the_time('d') ) ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="bmm-post-date bmm-post-meta-item">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'clean_design_blog_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function clean_design_blog_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( '%1$s %2$1s', 'post author', 'clean-design-blog' ), '',
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="bmm-post-author-name bmm-post-meta-item byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'clean_design_blog_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function clean_design_blog_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			//$categories_list = get_the_category_list( esc_html__( ', ', 'clean-design-blog' ) );
			$clean_design_blog_categories = get_the_category();
			if( $clean_design_blog_categories ) {
				$categories_list = false;
				foreach( $clean_design_blog_categories as $clean_design_blog_cat ) {
					$cat_link = get_category_link( $clean_design_blog_cat->term_id );
					$categories_list .= '<a class="bmm-post-cat bmm-cat-' .absint( $clean_design_blog_cat->term_id ). '" href="' .esc_url($cat_link). '">' .esc_html( $clean_design_blog_cat->name ). '</a> ';
				}
				if ( $categories_list ) {
					/* translators: 1: list of categories. */
					printf( '<span class="bmm-post-cat cat-links">' . esc_html__( '%1$s %2$s', 'clean-design-blog' ) . '</span>', '', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				}
			}
			
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'clean-design-blog' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="bmm-post-tags-wrap bmm-post-meta-item tags-links">' . esc_html__( '%1$s %2$s', 'clean-design-blog' ) . '</span>', '', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {

			$comments_number = get_comments_number( get_the_ID() );
			if( 1 ) {
			    echo '<span class="bmm-post-comments-wrap bmm-post-meta-item">';
			        echo '<a href="'.esc_url( get_the_permalink() ).'/#comments">';
			            echo esc_attr( $comments_number );
			            echo '<span class="bmm-comment-txt">'.esc_html__( "Comments", "clean-design-blog" ).'</span>';
			        echo '</a>';
			    echo '</span>';
			}
		}

		if( is_singular() ) :
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'clean-design-blog' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				),
				'<span class="edit-link">',
				'</span>'
			);
		endif;
	}
endif;

if ( ! function_exists( 'clean_design_blog_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function clean_design_blog_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
					the_post_thumbnail(
						'post-thumbnail',
						array(
							'alt' => the_title_attribute(
								array(
									'echo' => false,
								)
							),
						)
					);
				?>
			</a>

			<?php
		endif; // End is_singular().
	}
endif;

if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
endif;

if ( ! function_exists( 'clean_design_blog_comment' ) ) :
	/**
	 * Custom comments style
	 * 
	 * @package Clean Design Blog
	 * @since 1.0.0
	 */
	function clean_design_blog_comment( $comment, $args, $depth ) {
?>
			<li>
				<div class="comment-wrapper">
					<div class="comment-info">
						<?php echo get_avatar( $comment, 50); ?>
						<span class="comment_date">
							<cite class="fn"><?php echo get_comment_author_link(); ?></cite>			
							<p>
								<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ) ?>"><?php echo get_comment_date() . ' at ' . get_comment_time() ?></a>
								<?php edit_comment_link( esc_html__( 'Edit', 'clean-design-blog' ), '', '' ); ?>
								<?php comment_reply_link( array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']) ) ); ?>
							</p>
						</span>
					</div>
					<div id="comment-<?php echo comment_ID(); ?>" class="comment">
						<?php comment_text(); ?>
					</div>
				</div>
				<?php
					if ($comment->comment_approved == '0') : ?>
					<p><em><?php esc_html_e('Your comment is awaiting moderation.', 'clean-design-blog'); ?></em></p>
				<?php
					endif;
				?>
			</li>
<?php
	}
endif;