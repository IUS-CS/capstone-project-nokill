<?php
/**
 * Toggle Control
 * 
 * @package Clean Design Blog
 * @since 1.0.0
 */

if( class_exists( 'WP_Customize_Control' ) ) :
    class Clean_Design_Blog_WP_Toggle_Control extends \WP_Customize_Control {
        /**
         * Control type
         * 
         */
        public $type = 'toggle';

        /**
         * Enqueue scripts/styles.
         *
         * @since 3.4.0
         */
        public function enqueue() {
            wp_enqueue_style( 'clean-design-blog-customizer-toggle-buttons', get_template_directory_uri() . '/inc/customizer/custom-controls/toggle-control/toggle-control.css', array(), CLEAN_DESIGN_BLOG_VERSION, 'all' );
            wp_enqueue_script( 'clean-design-blog-toggle-control', get_template_directory_uri() . '/inc/customizer/custom-controls/toggle-control/toggle-control.js', array( 'jquery' ), CLEAN_DESIGN_BLOG_VERSION, true );
        }

        /**
         * Render the control's content.
         *
         */
        public function render_content() {
    ?>
            <label class="customize-toogle-label">
                <div class="toggle-wrap <?php if( $this->value() ) echo "checked-toggle-control"; ?>">
                    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                    <input id="clean-design-blog-toggle-<?php echo esc_attr( $this->instance_number ); ?>" type="checkbox" class="toggle toggle-<?php echo esc_html( $this->type ); ?>" value="<?php echo esc_attr( $this->value() ); ?>"
                        <?php
                            $this->link();
                            checked( $this->value() );
                        ?>
                    />
                    <label for="clean-design-blog-toggle-<?php echo esc_attr( $this->instance_number ); ?>" class="toggle-button">
                        <span class="on_off_txt_wrap">
                            <span class="on"><?php echo esc_html( 'ON', 'clean-design-blog' ); ?></span>
                            <span class="off"><?php echo esc_html( 'OFF', 'clean-design-blog' ); ?></span>
                        </span>
                    </label>
                </div>
                <?php if ( ! empty( $this->description ) ) : ?>
                    <span class="description customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
                <?php endif; ?>
            </label>
            <?php
        }
    }
endif;