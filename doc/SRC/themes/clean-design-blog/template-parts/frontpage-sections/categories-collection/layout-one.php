<?php
/**
 * Template parts - layout one "Categories Collection"
 */
$blockTitle = $args->blockTitle;
$categories = $args->categories;
$countOption = $args->countOption;
?>
<div class="bmm-categories-collection-block bmm-block bmm-block-categories-collection--layout-one">
    <?php
        if( $blockTitle ) {
            echo '<h3 class="bmm-block-title"><span>'.esc_html( $blockTitle ).'</span></h3>';
        }
    ?>
    <div class="categories-wrap">
        <?php
        if( $categories != '[]' ) {
            $categories = get_categories( array( 'slug' => explode( ",", $categories ) ) );
        } else {
            $categories = get_categories();
        }
            foreach( $categories as $singleCat ) :
                $cat_name = $singleCat->name;
                $cat_count = $singleCat->count;
                $cat_slug = $singleCat->slug;
                $singleCat_id = $singleCat->cat_ID;
                $block_post = new WP_Query( 
                    array( 
                        'category_name'    => esc_html( $cat_slug ),
                        'posts_per_page' => 1,
                        'meta_query' => array(
                            array(
                                'key' => '_thumbnail_id',
                                'compare' => 'EXISTS'
                            ),
                        )
                    )
                );
                if( $block_post->have_posts() ) :
                    while( $block_post->have_posts() ) : $block_post->the_post();
                        $thumbnail_url = get_the_post_thumbnail_url( get_the_ID(), 'clean-design-blog-medium' );
                    endwhile;
                endif;
        ?>
                <div class="category-item cat-<?php echo esc_attr( $singleCat_id ); ?>">
                    <div class="category-thumb-wrap bmm-post-thumb">
                        <a href="<?php echo esc_url( get_term_link( $singleCat_id ) ); ?>">
                            <img src="<?php echo esc_url( $thumbnail_url ); ?>">
                        </a>
                    </div>
                    <div class="cat-meta bmm-post-title">
                        <?php
                            echo '<span class="category-name"><a href="' .esc_url( get_term_link( $singleCat_id ) ). '">' .esc_html( $cat_name ).'</a></span>';

                            if( $countOption ) {
                                echo '<span class="category-count">( ' .absint( $cat_count ). ' )</span>';
                            }
                        ?>
                    </div>
                </div>
        <?php
            endforeach;
        ?>
    </div>
</div>