<?php
/**
 * Template parts - layout one "Posts Grid Alter"
 */
$blockTitle = $args->blockTitle;
$postCategory = $args->category;
$postCount = $args->count;
$dateOption = $args->dateOption;
$commentOption = $args->commentOption;
?>
<div class="bmm-post-grid-alter-block bmm-block bmm-block-post-grid-alter--layout-two">
    <?php
        if( $blockTitle ) {
            echo '<h3 class="bmm-block-title"><span>'.esc_html( $blockTitle ).'</span></h3>';
        }
    ?>
    <div class="bmm-post-wrapper">
        <?php
            $grid_alter_post_args = array(
                'post_type'     => 'post',
                'posts_per_page' => esc_attr( $postCount ),
                'post_status'   => 'publish'
            );
            $grid_alter_post_args['category_name'] = $postCategory;

            $grid_alter_post_query = new WP_Query( $grid_alter_post_args );
            if( !( $grid_alter_post_query->have_posts() ) ) {
                esc_html_e( 'No posts found', 'clean-design-blog' );
            }
            $total_posts = $grid_alter_post_query->post_count;
            while( $grid_alter_post_query->have_posts() ) : $grid_alter_post_query->the_post();
                $single_post_id = get_the_ID();
                $post_format = get_post_format( $single_post_id );
                if( empty( $post_format ) ) {
                    $post_format = 'standard';
                }
                $categories = get_the_category( $single_post_id );
                $comments_number = get_comments_number( $single_post_id );
                $current_post = $grid_alter_post_query->current_post;
                if( $current_post == 0 ) {
                    $imageSize = 'clean-design-blog-big';
                } else {
                    $imageSize = 'clean-design-blog-small';
                }
                
                if( $current_post === 1 ) {
                    echo '<div class="block-trailing--posts">';
                }
        ?>
                <article post-id="post-<?php echo esc_attr( $single_post_id ); ?>" class="bmm-post post-format--<?php echo esc_html( $post_format ); ?> <?php if( ! has_post_thumbnail() ) echo 'no-thumb'; ?>" itemscope itemtype="<?php echo esc_url( 'http://schema.org/articleBody' ); ?>">
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
                            </div>
                    <?php
                        }
                    ?>
                    <div class="content_meta_wrap">
                        <div class="title-wrap">
                            <h2 class="bmm-post-title">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h2>
                        </div><!-- .title-wrap -->
                        <div class="bmm-post-meta">
                            <?php
                                if( $dateOption ) {
                                    echo '<span class="bmm-post-date bmm-post-meta-item" itemprop="datePublished">';
                                        echo '<a href="'.esc_url( get_day_link( get_the_time('Y'), get_the_time('m'), get_the_time('d') ) ).'">'.get_the_date().'</a>';
                                    echo '</span>';
                                }
                                if( $categories ) {
                                    echo '<span class="bmm-post-cats-wrap bmm-post-meta-item">';
                                    foreach( $categories as $category ) :
                                        echo '<span class="bmm-post-cat bmm-cat-'.absint( $category->term_id ).'"><a href="'.esc_url( get_term_link( $category->term_id ) ).'">'.esc_html( $category->name ).'</a></span>';
                                    endforeach;
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
                    </div><!-- post meta wrap -->
                </article>
        <?php
            if( $current_post > 0 && $total_posts === ( $current_post + 1 ) ) {
                echo '</div><!-- .block-trailing--posts -->';
            }
            endwhile;
            wp_reset_postdata();
        ?>
    </div>
</div>