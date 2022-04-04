<?php
 
/**
 * Adds Clean_Design_Blog_Category_Collection_Widget widget.
 */
class Clean_Design_Blog_Category_Collection_Widget extends WP_Widget {
    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'clean_design_blog_category_collection_widget',
            esc_html__( 'CDB : Category Collection', 'clean-design-blog' ),
            array( 'description' => __( 'A collection of post categories.', 'clean-design-blog' ) )
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
        $posts_categories = isset( $instance['posts_categories'] ) ? $instance['posts_categories'] : '';
        $categories_title = isset( $instance['categories_title'] ) ? $instance['categories_title'] : true;
        $categories_count = isset( $instance['categories_count'] ) ? $instance['categories_count'] : true;

        echo wp_kses_post( $before_widget );
            if ( ! empty( $widget_title ) ) {
                echo wp_kses_post( $before_title ) . esc_html( $widget_title ) . wp_kses_post( $after_title );
            }
    ?>
            <div class="categories-wrap">
                <?php
                if( $posts_categories != '[]' ) {
                    $categories = get_categories( array( 'slug' => explode( ",", $posts_categories ) ) );
                } else {
                    $categories = get_categories();
                }
                    foreach( $categories as $single_cat ) :
                        $cat_name = $single_cat->name;
                        $cat_count = $single_cat->count;
                        $cat_slug = $single_cat->slug;
                        $cat_id = $single_cat->cat_ID;
                        $widget_post = new WP_Query( 
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
                        if( $widget_post->have_posts() ) :
                            while( $widget_post->have_posts() ) : $widget_post->the_post();
                                $thumbnail_url = get_the_post_thumbnail_url();
                            endwhile;
                        endif;
                ?>
                        <div class="bmm-post-thumb category-item cat-<?php echo esc_attr( $cat_id ); ?>">
                            <img src="<?php echo esc_url( $thumbnail_url ); ?>">
                            <a class="cat-meta-wrap" href="<?php echo esc_url( get_term_link( $cat_id ) ); ?>">
                                <div class="cat-meta bmm-post-title">
                                    <?php
                                        if( $categories_title ) {
                                            echo '<span class="category-name">'.esc_html( $cat_name ).'</span>';
                                        }

                                        if( $categories_count ) {
                                            echo '<span class="category-count">' .absint( $cat_count ). '</span>';
                                        }
                                    ?>
                                </div>
                            </a>
                        </div>
                <?php
                    endforeach;
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
        foreach( $categories as $category ) :
            $categories_options[$category->slug] = $category->name. ' (' .$category->count. ') ';
        endforeach;
        return array(
                array(
                    'name'      => 'widget_title',
                    'type'      => 'text',
                    'title'     => esc_html__( 'Widget Title', 'clean-design-blog' ),
                    'description'=> esc_html__( 'Add the widget title here', 'clean-design-blog' ),
                    'default'   => esc_html__( 'Category Collection', 'clean-design-blog' )
                ),
                array(
                    'name'      => 'posts_categories',
                    'type'      => 'multicheckbox',
                    'title'     => esc_html__( 'Post Categories', 'clean-design-blog' ),
                    'description'=> esc_html__( 'Choose the categories to display', 'clean-design-blog' ),
                    'options'   => $categories_options
                ),
                array(
                    'name'      => 'categories_title',
                    'type'      => 'checkbox',
                    'title'     => esc_html__( 'Show categories title', 'clean-design-blog' ),
                    'default'   => true
                ),
                array(
                    'name'      => 'categories_count',
                    'type'      => 'checkbox',
                    'title'     => esc_html__( 'Show categories count', 'clean-design-blog' ),
                    'default'   => true
                )
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
 
} // class Clean_Design_Blog_Category_Collection_Widget