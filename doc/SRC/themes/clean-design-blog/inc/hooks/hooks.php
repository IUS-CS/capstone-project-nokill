<?php
/**
 * Handles hooks file and functioning for entire theme
 * 
 * @package Clean Design Blog
 * @since 1.0.0
 * 
 */
 if( !function_exists( 'clean_design_blog_archive_read_more_button' ) ) :
    /**
     * Archive read more button fnc
     * 
     */
    function clean_design_blog_archive_read_more_button() {
        $archive_read_more_option   = get_theme_mod( 'archive_read_more_option', false );
        if( !$archive_read_more_option ) {
            return;
        }
        $archive_read_more_text     = get_theme_mod( 'archive_read_more_text', esc_html__( 'Read more . . ', 'clean-design-blog' ) );
        $clean_design_blog_archive_layout = get_theme_mod( 'archive_posts_layout', 'list-layout' );

        $clean_design_blog_layout = 'grid';
        if( $clean_design_blog_archive_layout == 'list-layout') {
            $clean_design_blog_layout = 'list';
        }
        switch( $clean_design_blog_layout ) {
            case 'list' : echo '<div class="bmm-read-more-two"><a href="' . esc_url( get_the_permalink() ) . '">' . esc_html( $archive_read_more_text ) . '</a></div>';
                        break;
            default : echo '<div class="bmm-read-more-two"><a href="' . esc_url( get_the_permalink() ) . '">' . esc_html( $archive_read_more_text ) . '</a></div>';
                        break;
        }
    }
    add_action( 'clean_design_blog_archive_single_post_before_article_hook', 'clean_design_blog_archive_read_more_button', 10 );
 endif;

 if( !function_exists( 'clean_design_blog_scroll_to_top' ) ) :
    /**
     * scroll to top fnc
     * 
     */
    function clean_design_blog_scroll_to_top() {
        $scroll_to_top_option = get_theme_mod( 'scroll_to_top_option', true );
        if( !$scroll_to_top_option ) {
            return;
        }
    ?>
        <div id="clean-design-blog-scroll-to-top" class="layout-default align--right">
            <a href="#" title="<?php echo esc_attr__( 'Back to Top', 'clean-design-blog' ); ?>">
                <span class="back_txt"><?php echo esc_html__( 'Back to Top', 'clean-design-blog' ) ?></span>
                <i class="fas fa-long-arrow-alt-up"></i>
            </a>
        </div><!-- #clean-design-blog-scroll-to-top -->
    <?php
    }
    add_action( 'clean_design_blog_after_footer_hook', 'clean_design_blog_scroll_to_top' );
 endif;

 if( ! function_exists( 'clean_design_blog_pagination_fnc' ) ) :
    /**
     * Renders pagination
     * 
     */
    function clean_design_blog_pagination_fnc() {
        if( is_null( paginate_links() ) ) {
            return;
        }
        echo '<div class="bmm-pagination-links">' .wp_kses_post( paginate_links() ). '</div>';
    }
    add_action( 'clean_design_blog_pagination_link_hook', 'clean_design_blog_pagination_fnc' );
 endif;

 if( ! function_exists( 'clean_design_blog_single_tags_list' ) ) :
    /**
     * Single tags list
     * 
     */
    function clean_design_blog_single_tags_list() {
        $tags_list = get_the_tag_list();
        if ( $tags_list ) {
            /* translators: 1: list of tags. */
            printf( '<span class="bmm-post-tags-wrap bmm-post-meta-item tags-links">' . esc_html__( '%1$s %2$s', 'clean-design-blog' ) . '</span>', '', wp_kses_post( $tags_list ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        }
    }
 endif;

 if( ! function_exists( 'clean_design_blog_single_author_box' ) ) :
    /**
     * Single author box
     * 
     */
    function clean_design_blog_single_author_box() {
    ?>
        <div class="single-author-box">
            <div class="author_img_single">
                <?php echo wp_kses_post( get_avatar(get_the_author_meta('ID')) ); ?>
            </div>
            <div class="author-content-wrap">
                <h2 class="author-name"><?php echo esc_html( get_the_author() ); ?></h2>
                <?php if( get_the_author_meta('description') ) { ?>
                    <div class="author-desc"><?php echo wp_kses_post( get_the_author_meta('description') ); ?></div>
                <?php } ?>
            </div>
        </div>
    <?php
    }
 endif;
 add_action( 'clean_design_blog_single_after_content', 'clean_design_blog_single_tags_list' );
 add_action( 'clean_design_blog_single_after_content', 'clean_design_blog_single_author_box' );

 if( ! function_exists( 'clean_design_blog_single_related_posts' ) ) :
    /**
     * Single related posts
     * 
     */
    function clean_design_blog_single_related_posts() {
        $single_post_related_posts_option = get_theme_mod( 'single_post_related_posts_option', true );
        if( ! $single_post_related_posts_option ) {
            return;
        }
  ?>
            <div class="single-related-posts-section">
                <?php
                    echo '<h3 class="bmm-block-title"><span>' .esc_html__( 'Related Posts', 'clean-design-blog' ). '</span></h3>';
                    $current_post_tags = get_the_tag_list( '', ',' );
                    $related_posts_args = array(
                        'post__not_in'  => array( get_the_ID() )
                    );
                    if( $current_post_tags ) {
                        $related_posts_args['tag'] = array( wp_strip_all_tags( $current_post_tags ) );
                    }
                    $related_posts = new WP_Query( $related_posts_args );
                    if( $related_posts->have_posts() ) :
                        echo '<div class="single-related-posts-wrap">';
                            while( $related_posts->have_posts() ) : $related_posts->the_post();
                        ?>
                                <article post-id="post-<?php the_ID(); ?>" class="bmm-post">
                                    <div class="post-thumb-wrap">
                                    <?php
                    
                                        if( has_post_thumbnail() ) {
                                        ?>
                                            <div class="bmm-post-thumb">
                                                <a href="<?php the_permalink(); ?>">
                                                    <img src="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'clean-design-blog-medium' ) ); ?>" alt="<?php the_title(); ?>"/>
                                                </a>
                                            </div>
                                    <?php
                                        }

                                        $categories = get_the_category( get_the_ID() );
                                        if( $categories ) {
                                            echo '<div class="bmm-post-cats-wrap bmm-post-meta-item">';
                                            foreach( $categories as $category ) :
                                                echo '<span class="bmm-post-cat bmm-cat-'.absint( $category->term_id ).'"><a href="'.esc_url( get_term_link( $category->term_id ) ).'">'.esc_html( $category->name ).'</a></span>';
                                            endforeach;
                                            echo '</div>';
                                        }
                                            
                                    ?>
                                    </div>
                                    <h2 class="bmm-post-title">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h2>
                                </article>
                        <?php
                            endwhile;
                        echo '</div>';
                    endif;
                ?>
            </div>
    <?php
    }
 endif;
 add_action( 'clean_design_blog_single_post_footer_hook', 'clean_design_blog_single_related_posts' );
 
 /**
 * Theme Hooks
 */
require CLEAN_DESIGN_BLOG_INCLUDES_PATH . 'hooks/header-hooks.php';
require CLEAN_DESIGN_BLOG_INCLUDES_PATH . 'hooks/footer-hooks.php';
require CLEAN_DESIGN_BLOG_INCLUDES_PATH . 'hooks/frontpage-sections-hooks.php';