<?php
/**
 * Template parts - layout one "Posts Featured"
 */
$blockTitle = $args->blockTitle;
$postCategory = $args->category;
$dateOption = $args->dateOption;
$commentOption = $args->commentOption;
?>
<div class="bmm-post-post-featured-block bmm-block bmm-block-post-post-featured--layout-one">
    <?php
        if( $blockTitle ) {
            echo '<h3 class="bmm-block-title"><span>'.esc_html( $blockTitle ).'</span></h3>';
        }
    ?>
    <div class="bmm-post-wrapper">
    <?php
        $post_featured_post_args = array(
            'post_type'     => 'post',
            'posts_per_page' => 5,
            'post_status'   => 'publish'
        );
        if( !empty( $postCategory ) ) {
            $post_featured_post_args['category_name'] = $postCategory;
        }
        
        $post_featured_post_query = new WP_Query( $post_featured_post_args );
        if( ! $post_featured_post_query->have_posts() ) {
            esc_html_e( 'No posts found', 'clean-design-blog' );
        }
        $total_posts = $post_featured_post_query->post_count;
        while( $post_featured_post_query->have_posts() ) : $post_featured_post_query->the_post();
            $single_post_id = get_the_ID();
            $post_format = get_post_format( $single_post_id );
            if( empty( $post_format ) ) {
                $post_format = 'standard';
            }
            $categories = get_the_category( $single_post_id );
            $comments_number = get_comments_number( $single_post_id );

            $current_post = $post_featured_post_query->current_post;
            if( $current_post == 2 ) {
                $imageSize = 'clean-design-blog-big';
            } else {
                $imageSize = 'clean-design-blog-medium';
            }

            if( ( $current_post % 5 ) === 0 ) {
                echo '<div class="post-featured--left-block the_stickey_class">';
            } else if ( ( $current_post % 5 ) === 2 ) {
                echo '<div class="post-featured--main-block the_stickey_class">';
            } else if ( ( $current_post % 5 ) === 3 ) {
                echo '<div class="post-featured--right-block the_stickey_class">';
            }
    ?>
            <article post-id="post-<?php echo esc_attr( $single_post_id ); ?>" class="bmm-post post-format--<?php echo esc_html( $post_format ); ?>" itemscope itemtype="<?php echo esc_url( 'http://schema.org/articleBody' ); ?>">
                <?php
                    if( has_post_thumbnail() ) {
                        $image_url = get_the_post_thumbnail_url( $single_post_id, $imageSize );
                    } else {
                        $image_url = false;
                    }

                    if( $image_url ) {
                ?>
                        <div class="bmm-post-thumb">
                            <a href="<?php the_permalink(); ?>">
                                <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php the_title(); ?>"/>
                            </a>
                            <?php
                                if( $categories ) {
                                    echo '<span class="bmm-post-cats-wrap bmm-post-meta-item">';
                                    foreach( $categories as $category ) :
                                        echo '<span class="bmm-post-cat bmm-cat-'.absint( $category->term_id ).'"><a href="'.esc_url( get_term_link( $category->term_id ) ).'">'.esc_html( $category->name ).'</a></span>';
                                    endforeach;
                                    echo '</span>';
                                }
                            ?>
                        </div>
                <?php
                    }
                ?>
                    <h2 class="bmm-post-title">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </h2>

                <div class="bmm-post-meta">
                    <?php
                        if( $dateOption ) {
                            echo '<span class="bmm-post-date bmm-post-meta-item" itemprop="datePublished">';
                                echo '<a href="'.esc_url( get_day_link( get_the_time('Y'), get_the_time('m'), get_the_time('d') ) ).'">'.get_the_date().'</a>';
                            echo '</span>';
                        }

                        if( $commentOption ) {
                            echo '<span class="bmm-post-comments-wrap bmm-post-meta-item">';
                                echo '<a href="'.esc_url( get_the_permalink() ).'/#comments">';
                                    echo esc_attr( $comments_number );
                                    echo '<span class="bmm-comment-txt">'.esc_html__( "Comments", "clean-design-blog" ).'</span>';
                                echo '</a>';
                            echo '</span>';
                        }
                    ?>
                </div>
            </article>
    <?php
        if( ( $current_post % 5 ) === 1 ) {
            echo '</div><!-- .post-featured--left-block -->';
        } else if ( ( $current_post % 5 ) === 2 ) {
            echo '</div><!-- .post-featured--main-block -->';
        } else if ( ( $current_post % 5 ) === 4 ) {
            echo '</div><!-- .post-featured--right-block -->';
        } else if( $total_posts === ( $current_post + 1 ) ) {
            echo '</div><!-- .post-featured--end-wrapper/.post-featured--left-block/.post-featured--main-block/.post-featured--right-block -->';
        }
        endwhile;
        wp_reset_postdata();
    ?>
    </div><!-- .bmm-post-wrapper -->
</div>