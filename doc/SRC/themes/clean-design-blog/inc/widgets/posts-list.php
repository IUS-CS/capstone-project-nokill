<?php
 
/**
 * Adds Clean_Design_Blog_Posts_List_Widget widget.
 */
class Clean_Design_Blog_Posts_List_Widget extends WP_Widget {
    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'clean_design_blog_posts_list_widget',
            esc_html__( 'CDB : Posts List', 'clean-design-blog' ),
            array( 'description' => __( 'A collection of posts from specific category displayed in list layout.', 'clean-design-blog' ) )
        );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        extract( $args );
        $widget_title = isset( $instance['widget_title'] ) ? $instance['widget_title'] : '';
        $posts_category = isset( $instance['posts_category'] ) ? $instance['posts_category'] : '';
        $posts_count = isset( $instance['posts_count'] ) ? $instance['posts_count'] : 3;
        $posts_cat = isset( $instance['posts_cat'] ) ? $instance['posts_cat'] : '';
        $posts_excerpt = isset( $instance['posts_excerpt'] ) ? $instance['posts_excerpt'] : '';
        $posts_excerpt_count = isset( $instance['posts_excerpt_count'] ) ? $instance['posts_excerpt_count'] : 10;
        
        echo wp_kses_post( $before_widget );
            if ( ! empty( $widget_title ) ) {
                echo wp_kses_post( $before_title ) . esc_html( $widget_title ) . wp_kses_post( $after_title );
            }
    ?>
            <div class="posts-wrap posts-list-wrap">
                <?php
                    $post = new WP_Query( 
                        array( 
                            'category_name'    => esc_html( $posts_category ),
                            'posts_per_page' => absint( $posts_count ),
                            'meta_query' => array(
                                array(
                                    'key' => '_thumbnail_id',
                                    'compare' => 'EXISTS'
                                ),
                            )
                        )
                    );
                    if( $post->have_posts() ) :
                        while( $post->have_posts() ) : $post->the_post();
                            $thumbnail_url = get_the_post_thumbnail_url();
                            $categories = get_the_category();
                    ?>
                            <div class="post-item">
                                <div class="post_thumb_image bmm-post-thumb">
                                    <img src="<?php echo esc_url( $thumbnail_url ); ?>">
                                </div>
                                <div class="post-content-wrap">
                                    <?php
                                        if( $posts_cat ) {
                                            echo '<span class="post-cats-wrap">';
                                                foreach( $categories as $single_cat ) {
                                                    echo '<span class="bmm-post-cat bmm-cat-' .esc_attr( $single_cat->cat_ID ). '"><a href="' .esc_url( get_term_link( $single_cat->cat_ID ) ). '">' .esc_html( $single_cat->name ). '</a></span>';
                                                }
                                            echo '</span>';
                                        }

                                        echo '<h2 class="bmm-post-title post-title"><a href="' .esc_url( get_the_permalink() ). '">' .wp_kses_post( get_the_title() ).'</a></h2>';

                                        

                                        if( $posts_excerpt ) {
                                            echo '<span class="post-content">' .esc_html( wp_trim_words( get_the_excerpt(), $posts_excerpt_count ) ). '</span>';
                                        }
                                    ?>
                                </div>
                            </div>
                    <?php
                        endwhile;
                    endif;
                ?>
            </div>
    <?php
        echo wp_kses_post( $after_widget );
    }

    /**
     * Widgets fields
     * 
     */
    function widget_fields() {
        $categories = get_categories();
        $categories_options[''] = esc_html__( 'Select category', 'clean-design-blog' );
        foreach( $categories as $category ) :
            $categories_options[$category->slug] = $category->name. ' (' .$category->count. ') ';
        endforeach;
        return array(
                array(
                    'name'      => 'widget_title',
                    'type'      => 'text',
                    'title'     => esc_html__( 'Widget Title', 'clean-design-blog' ),
                    'description'=> esc_html__( 'Add the widget title here', 'clean-design-blog' ),
                    'default'   => esc_html__( 'Posts List', 'clean-design-blog' )
                ),
                array(
                    'name'      => 'posts_category',
                    'type'      => 'select',
                    'title'     => esc_html__( 'Categories', 'clean-design-blog' ),
                    'description'=> esc_html__( 'Choose the category to display list of posts', 'clean-design-blog' ),
                    'options'   => $categories_options
                ),
                array(
                    'name'      => 'posts_count',
                    'type'      => 'number',
                    'title'     => esc_html__( 'Number of posts to show', 'clean-design-blog' ),
                    'default'   => 3
                ),
                array(
                    'name'      => 'posts_cat',
                    'type'      => 'checkbox',
                    'title'     => esc_html__( 'Show post categories', 'clean-design-blog' ),
                    'default'   => true
                ),
                array(
                    'name'      => 'posts_excerpt',
                    'type'      => 'checkbox',
                    'title'     => esc_html__( 'Show post excerpt content', 'clean-design-blog' ),
                    'default'   => false
                ),
                array(
                    'name'      => 'posts_excerpt_count',
                    'type'      => 'number',
                    'title'     => esc_html__( 'Excerpt Length', 'clean-design-blog' ),
                    'default'   => 10
                ),
            );
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
        $widget_fields = $this->widget_fields();
        foreach( $widget_fields as $widget_field ) :
            if ( isset( $instance[ $widget_field['name'] ] ) ) {
                $field_value = $instance[ $widget_field['name'] ];
            } else if( isset( $widget_field['default'] ) ) {
                $field_value = $widget_field['default'];
            } else {
                $field_value = '';
            }
            clean_design_blog_widget_fields( $this, $widget_field, $field_value );
        endforeach;
    }
 
    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $widget_fields = $this->widget_fields();
        if( ! is_array( $widget_fields ) ) {
            return $instance;
        }
        foreach( $widget_fields as $widget_field ) :
            $instance[$widget_field['name']] = clean_design_blog_sanitize_widget_fields( $widget_field, $new_instance );
        endforeach;

        return $instance;
    }
 
} // class Clean_Design_Blog_Posts_List_Widget