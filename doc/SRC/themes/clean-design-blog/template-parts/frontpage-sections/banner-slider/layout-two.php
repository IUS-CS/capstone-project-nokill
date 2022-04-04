<?php
/**
 * Template parts - layout two "Banner slider"
 * 
 * @package Clean Design Blog Pro
 * @since 1.0.0
 * 
 */
$postCategory = $args->category;
$postCount = $args->count;
$sliderAttr = 'data-loop=false data-controls=true data-dots=false data-auto=false data-fade=false data-speed=300';
$contentOption = $args->contentOption;
?>
<div class="bmm-banner-slider-block bmm-block bmm-block-banner-slider--layout-two" <?php echo esc_attr( $sliderAttr ); ?>>
    <?php
        $banner_slider_posts = new WP_Query( array(
            'category_name'     => esc_html( $postCategory ),
            'posts_per_page'    => esc_html( $postCount )      
        ));
        if( $banner_slider_posts->have_posts() ) :
            while( $banner_slider_posts->have_posts() ) : $banner_slider_posts->the_post();
            $categories = get_the_category();
        ?>
                <div class="banner-slider-item <?php if( ! has_post_thumbnail() ) echo 'no-thumb'; ?>" style="background : url( <?php echo esc_url( get_the_post_thumbnail_url() ); ?> )">
                    <div class="bmm-post-slider-img">
                        <?php if( has_post_thumbnail() ) { ?>
                            <img src="<?php echo esc_url( get_the_post_thumbnail_url() ); ?>">
                        <?php } ?>
                    </div>
                    <div class="bmm-post-content-wrap">
                        <div class="bmm-post-cats-wrap bmm-post-meta-item">
                            <?php
                                foreach( $categories as $category ) :
                            ?>
                                    <span class="bmm-post-cat bmm-cat-<?php echo absint( $category->term_id ); ?>"><a href="<?php echo esc_url( get_term_link( $category->term_id ) ); ?>"><?php echo esc_html( $category->name ); ?></a></span>
                            <?php
                                endforeach;
                            ?>
                        </div>
                        <h2 class="bmm-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <?php
                            if( $contentOption ) {
                        ?>
                                <div class="bmm-post-content">
                                    <?php echo esc_html( get_the_excerpt() ); ?>
                                </div>
                        <?php } ?>
                    </div>
                </div>
        <?php
            endwhile;
            wp_reset_postdata();
        endif;
    ?>
</div>