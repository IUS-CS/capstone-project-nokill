<?php
/**
 * Template parts - layout one "Posts Grid"
 */
$blockTitle = $args->blockTitle;
$postCategory = $args->category;
$postCount = $args->count;
$contentOption = $args->contentOption;
?>
<div class="bmm-post-grid-block bmm-block bmm-block-post-grid--layout-one">
    <?php
        if( $blockTitle ) {
            echo '<h3 class="bmm-block-title"><span>'.esc_html( $blockTitle ).'</span></h3>';
        }
    ?>
    <div class="bmm-post-wrapper">
        <?php
            $grid_post_args = array(
                'post_type'     => 'post',
                'posts_per_page' => esc_attr( $postCount ),
                'post_status'   => 'publish'
            );
            if( !empty( $postCategory ) ) {
                $grid_post_args['category_name'] = $postCategory;
            }

            $grid_post_query = new WP_Query( $grid_post_args );
            if( ! $grid_post_query->have_posts() ) {
                esc_html_e( 'No posts found', 'clean-design-blog' );
            }
            while( $grid_post_query->have_posts() ) : $grid_post_query->the_post();
                $single_post_id = get_the_ID();
                $post_format = get_post_format( $single_post_id );
                if( empty( $post_format ) ) {
                    $post_format = 'standard';
                }
                $categories = get_the_category( $single_post_id );
                $image_url = false;
        ?>
                <article post-id="post-<?php echo esc_attr( $single_post_id ); ?>" class="bmm-post post-format--<?php echo esc_html( $post_format ); ?> <?php if( ! has_post_thumbnail() ) echo 'no-thumb'; ?>" itemscope itemtype="<?php echo esc_url( 'http://schema.org/articleBody' ); ?>">
                    <div class="post-thumb-wrap">
                        <?php
                            if( has_post_thumbnail() ) {
                                $image_url = get_the_post_thumbnail_url( $single_post_id, 'clean-design-blog-medium' );
                            }
                            if( $image_url ) {
                        ?>
                                <div class="bmm-post-thumb">
                                    <a href="<?php the_permalink(); ?>">
                                        <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php the_title(); ?>"/>
                                    </a>
                                </div>
                        <?php
                            }
                            
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
                    <?php if( $contentOption ) { ?>
                            <div class="bmm-post-content" itemprop="description">
                                <?php the_excerpt(); ?>
                            </div>
                    <?php
                        }
                    ?>
                </article>
        <?php
            endwhile;
            wp_reset_postdata();
        ?>
    </div><!-- .bmm-post-wrapper -->
</div>