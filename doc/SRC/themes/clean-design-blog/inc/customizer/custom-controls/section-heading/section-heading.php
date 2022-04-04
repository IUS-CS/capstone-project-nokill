<?php
/**
 * Toggle Control
 * 
 * @package Clean Design Blog
 * @since 1.0.0
 */

if( class_exists( 'WP_Customize_Control' ) ) :
    class Clean_Design_Blog_WP_Section_Heading_Control extends \WP_Customize_Control {
        /**
         * Control type
         * 
         */
        public $type = 'section-heading';

        /**
         * Enqueue scripts/styles.
         *
         * @since 3.4.0
         */
        public function enqueue() {
            wp_enqueue_style( 'clean-design-blog-customizer-section-heading', get_template_directory_uri() . '/inc/customizer/custom-controls/section-heading/section-heading.css', array(), CLEAN_DESIGN_BLOG_VERSION, 'all' );
        }

        /**
         * Render the control's content.
         *
         */
        public function render_content() {
    ?>
            <div class="customize-section-heading">
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <?php if( $this->description ) {
                    echo '<p class="customize-control-description">' .wp_kses_post($this->description). '</p>';
                } ?>
            </div>
            <?php
        }
    }
endif;