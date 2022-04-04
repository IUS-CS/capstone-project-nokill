<?php
/**
 * Frontpage sections hooks
 * 
 */
if( ! function_exists( 'clean_design_blog_top_full_width_sec' )  ) :
    /**
     * Top Full Width Section
     * 
     */
    function clean_design_blog_top_full_width_sec() {
        $frontpage_top_full_width_blocks = get_theme_mod( 'frontpage_top_full_width_blocks', json_encode(array(
                    array(
                        'name'      => 'posts-carousel',
                        'option'    => true,
                        'blockTitle'=> esc_html__( 'Posts Carousel', 'clean-design-blog' ),
                        'category'  => '',
                        'count'     => 6,
                        'dateOption'     => true,
                        'commentOption'  => true,
                        'layout'    => 'three'
                    ),
                    array(
                        'name'      => 'categories-collection',
                        'option'    => false,
                        'blockTitle'=> esc_html__( 'Category Collection', 'clean-design-blog' ),
                        'categories'  => '[]',
                        'countOption'     => true,
                        'layout'    => 'one'
                    )
                )
            )
        );
        if( ! $frontpage_top_full_width_blocks ) {
            return;
        }
        $decoded_blocks = json_decode( $frontpage_top_full_width_blocks );
        if( ! in_array( true, array_column( $decoded_blocks, 'option' ) ) ) {
            return;
        }
        echo '<section id="clean-design-blog-top-full-width-section">';
            $decoded_blocks = json_decode( $frontpage_top_full_width_blocks );
            foreach( $decoded_blocks as $block ) :
                $option = $block->option;
                if( $option ) {
                    $block_name = $block->name;
                    $layout = isset( $block->layout ) ? $block->layout : 'one';
                    get_template_part( 'template-parts/frontpage-sections/' .$block_name. '/layout', $layout, $block );
                }
            endforeach;
        echo '</section><!-- #clean-design-blog-top-full-width-section -->';
    }
endif;

if( ! function_exists( 'clean_design_blog_middle_left_content_sec' )  ) :
    /**
     * Middle Left Content Section
     * 
     */
    function clean_design_blog_middle_left_content_sec() {
        $frontpage_middle_left_content_blocks = get_theme_mod( 'frontpage_middle_left_content_blocks', json_encode(array(
                    array(
                        'name'      => 'posts-grid-alter',
                        'option'    => true,
                        'blockTitle'=> esc_html__( 'Posts Grid Alter', 'clean-design-blog' ),
                        'category'  => '',
                        'count'     => 3,
                        'dateOption'     => false,
                        'commentOption'  => false,
                        'layout'    => 'one'
                    ),
                    array(
                        'name'      => 'posts-grid',
                        'option'    => false,
                        'blockTitle'=> esc_html__( 'Posts Grid', 'clean-design-blog' ),
                        'category'  => '',
                        'count'     => 3,
                        'contentOption'  => false,
                        'layout'    => 'one'
                    ),
                    array(
                        'name'      => 'posts-list',
                        'option'    => false,
                        'blockTitle'=> esc_html__( 'Posts List', 'clean-design-blog' ),
                        'category'  => '',
                        'count'     => 3,
                        'dateOption'  => true,
                        'commentOption'  => true,
                        'contentOption'  => false,
                        'layout'    => 'one'
                    )
                )
            )
        );
        if( ! $frontpage_middle_left_content_blocks ) {
            return;
        }
        $decoded_blocks = json_decode( $frontpage_middle_left_content_blocks );
        if( ! in_array( true, array_column( $decoded_blocks, 'option' ) ) ) {
            return;
        }
        echo '<section id="clean-design-blog-middle-left-content-section">';
            echo '<div class="primary-section">';
                $decoded_blocks = json_decode( $frontpage_middle_left_content_blocks );
                foreach( $decoded_blocks as $block ) :
                    $option = $block->option;
                    if( $option ) {
                        $block_name = $block->name;
                        $layout = isset( $block->layout ) ? $block->layout : 'one';
                        get_template_part( 'template-parts/frontpage-sections/' .$block_name. '/layout', $layout, $block );
                    }
                endforeach;
            echo '</div><!-- .primary-section -->';

            echo '<div class="secondary-section">';
                if( is_active_sidebar( 'frontpage-middle-right-sidebar' ) ) {
                    dynamic_sidebar( 'frontpage-middle-right-sidebar' );
                }
            echo '</div>';
        echo '</section><!-- #clean-design-blog-top-full-width-section -->';
    }
endif;

if( ! function_exists( 'clean_design_blog_middle_right_content_sec' )  ) :
    /**
     * Middle Right Content Section
     * 
     */
    function clean_design_blog_middle_right_content_sec() {
        $frontpage_middle_right_content_blocks = get_theme_mod( 'frontpage_middle_right_content_blocks', json_encode(array(
                    array(
                        'name'      => 'posts-grid',
                        'option'    => false,
                        'blockTitle'=> esc_html__( 'Posts Grid', 'clean-design-blog' ),
                        'category'  => '',
                        'count'     => 3,
                        'contentOption'  => false,
                        'layout'    => 'one'
                    ),
                    array(
                        'name'      => 'posts-list',
                        'option'    => false,
                        'blockTitle'=> esc_html__( 'Posts List', 'clean-design-blog' ),
                        'category'  => '',
                        'count'     => 3,
                        'dateOption'  => true,
                        'commentOption'  => true,
                        'contentOption'  => true,
                        'layout'    => 'one'
                    ),
                    array(
                        'name'      => 'posts-grid-alter',
                        'option'    => false,
                        'blockTitle'=> esc_html__( 'Posts Grid Alter', 'clean-design-blog' ),
                        'category'  => '',
                        'count'     => 3,
                        'dateOption'     => false,
                        'commentOption'  => false,
                        'layout'    => 'one'
                    )
                )
            )
        );
        if( ! $frontpage_middle_right_content_blocks ) {
            return;
        }
        $decoded_blocks = json_decode( $frontpage_middle_right_content_blocks );
        if( ! in_array( true, array_column( $decoded_blocks, 'option' ) ) ) {
            return;
        }
        echo '<section id="clean-design-blog-middle-right-content-section">';
            echo '<div class="secondary-section">';
                if( is_active_sidebar( 'frontpage-middle-left-sidebar' ) ) {
                    dynamic_sidebar( 'frontpage-middle-left-sidebar' );
                }
            echo '</div>';
            echo '<div class="primary-section">';
                $decoded_blocks = json_decode( $frontpage_middle_right_content_blocks );
                foreach( $decoded_blocks as $block ) :
                    $option = $block->option;
                    if( $option ) {
                        $block_name = $block->name;
                        $layout = isset( $block->layout ) ? $block->layout : 'one';
                        get_template_part( 'template-parts/frontpage-sections/' .$block_name. '/layout', $layout, $block );
                    }
                endforeach;
            echo '</div>';
        echo '</section><!-- #clean-design-blog-top-full-width-section -->';
    }
endif;

if( ! function_exists( 'clean_design_blog_bottom_full_width_sec' )  ) :
    /**
     * Bottom Full Width Section
     * 
     */
    function clean_design_blog_bottom_full_width_sec() {
        $frontpage_bottom_full_width_blocks = get_theme_mod( 'frontpage_bottom_full_width_blocks', json_encode(array(
                array(
                    'name'      => 'posts-carousel',
                    'option'    => true,
                    'blockTitle'=> esc_html__( 'Posts Carousel', 'clean-design-blog' ),
                    'category'  => '',
                    'count'     => 6,
                    'dateOption'     => true,
                    'commentOption'  => true,
                    'layout'    => 'one'
                ),
                array(
                    'name'      => 'categories-collection',
                    'option'    => false,
                    'blockTitle'=> esc_html__( 'Category Collection', 'clean-design-blog' ),
                    'categories'  => '[]',
                    'countOption'     => true,
                    'layout'    => 'one'
                ),
                array(
                    'name'      => 'posts-featured',
                    'option'    => false,
                    'blockTitle'=> esc_html__( 'Posts Featured', 'clean-design-blog' ),
                    'category'  => '',
                    'dateOption'     => false,
                    'commentOption'  => false,
                    'layout'    => 'one'
                )
            )
        )
        );
        if( ! $frontpage_bottom_full_width_blocks ) {
            return;
        }
        $decoded_blocks = json_decode( $frontpage_bottom_full_width_blocks );
        if( ! in_array( true, array_column( $decoded_blocks, 'option' ) ) ) {
            return;
        }
        echo '<section id="clean-design-blog-bottom-full-width-section">';
            $decoded_blocks = json_decode( $frontpage_bottom_full_width_blocks );
            foreach( $decoded_blocks as $block ) :
                $option = $block->option;
                if( $option ) {
                    $block_name = $block->name;
                    $layout = isset( $block->layout ) ? $block->layout : 'one';
                    get_template_part( 'template-parts/frontpage-sections/' .$block_name. '/layout', $layout, $block );
                }
            endforeach;
        echo '</section><!-- #clean-design-blog-bottom-full-width-section -->';
    }
endif;

add_action( 'clean_design_blog_frontpage_section_hook', 'clean_design_blog_top_full_width_sec', 10 );
add_action( 'clean_design_blog_frontpage_section_hook', 'clean_design_blog_middle_left_content_sec', 20 );
add_action( 'clean_design_blog_frontpage_section_hook', 'clean_design_blog_middle_right_content_sec', 30 );
add_action( 'clean_design_blog_frontpage_section_hook', 'clean_design_blog_bottom_full_width_sec', 40 );