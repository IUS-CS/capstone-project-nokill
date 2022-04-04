<?php
/**
 * Blocks Repeater Control
 * 
 * @package Clean Design Blog
 * @since 1.0.0
 */
if( class_exists( 'WP_Customize_Control' ) ) :
    class Clean_Design_Blog_WP_Blocks_Repeater_Control extends WP_Customize_Control {
        /**
         * constructor
         * 
         */
        public function __construct( $manager, $id, $args ) {
            parent::__construct( $manager, $id, $args );
        }

        /**
         * Enqueue scripts and styles
         * 
         */
        public function enqueue() {
            wp_enqueue_style( 'clean-design-blog-blocks-repeater', get_template_directory_uri() . '/inc/customizer/custom-controls/blocks-repeater/control.css', array(), CLEAN_DESIGN_BLOG_VERSION );
            wp_enqueue_script( 'clean-design-blog-blocks-repeater', get_template_directory_uri() . '/inc/customizer/custom-controls/blocks-repeater/control.js', array( 'jquery' ), CLEAN_DESIGN_BLOG_VERSION, true );
        }

        /**
         * Render content
         * 
         */
        public function render_content() {
            $defaults = json_decode( $this->setting->default ); // defaults
            $values = json_decode( $this->value() ); // values
    ?>
            <div class="blocks-repeater-control-wrap">
                <?php
                    $open = true;
                    $categories = get_categories();
                    foreach( $values as $control_key => $control ) :
                        switch( $control->name ) {
                            case 'banner-slider' : ?>
                                                    <div class="clean-design-blog-block banner-slider-block-wrap<?php if( isset( $open ) ) echo ' open'; ?>" block-name="banner-slider">
                                                        <div class="block-header content-trigger">
                                                            <h2 class="block-header-title"><?php esc_html_e( 'Banner Slider', 'clean-design-blog' ); ?></h2>
                                                            <span class="block-header-icon"><i class="fas fa-chevron-<?php if( isset( $open ) ) { echo 'up'; } else {  echo 'down'; } ?>"></i></span>
                                                        </div>
                                                        <div class="block-content-wrap">
                                                            <div class="customize-select-field">
                                                                <label><?php esc_html_e( 'Category', 'clean-design-blog' ) ?></label>
                                                                <select class="block-repeater-control-field" data-name="category">
                                                                    <option value="" <?php if( empty( $control->category ) ) echo 'selected'; ?>><?php esc_html_e( 'Select Category', 'clean-design-blog' ); ?></option>
                                                                    <?php
                                                                        foreach( $categories as $cat ) {
                                                                    ?>
                                                                            <option value="<?php echo esc_attr( $cat->slug ); ?>" <?php if( $control->category === $cat->slug ) echo 'selected'; ?>><?php echo esc_html( $cat->name .' (' .$cat->count. ')' ); ?></option>
                                                                    <?php
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="customize-number-field">
                                                                <label><?php esc_html_e( 'Number of posts', 'clean-design-blog' ) ?></label>
                                                                <input type="number" min="-1" step="1" class="block-repeater-control-field" data-name="count" value="<?php echo esc_attr( $control->count ); ?>"/>
                                                            </div>
                                                            <div class="customize-toggle-field <?php if( $control->contentOption ) echo 'checked-toggle-control'; ?>">
                                                                <label><?php esc_html_e( 'Show post excerpt', 'clean-design-blog' ) ?></label>
                                                                <div class="toggle-button">
                                                                    <span class="on_off_txt_wrap">
                                                                        <span class="on"><?php echo esc_html( 'ON', 'clean-design-blog' ); ?></span>
                                                                        <span class="off"><?php echo esc_html( 'OFF', 'clean-design-blog' ); ?></span>
                                                                    </span>
                                                                </div>
                                                                <input type="checkbox" class="block-repeater-control-field" data-name="contentOption" <?php echo checked( $control->contentOption, true ); ?>/>
                                                            </div>
                                                            <div class="customize-radio-image-field">
                                                                <?php
                                                                    $layouts = array(
                                                                        'one'    => array(
                                                                            'label' => esc_html( 'Layout One' ),
                                                                            'img' => get_template_directory_uri() . '/images/customizer/layout_one_sample.jpg'
                                                                        ),
                                                                        'two'    => array(
                                                                            'label' => esc_html( 'Layout Two' ),
                                                                            'img' => get_template_directory_uri() . '/images/customizer/layout_two_sample.jpg'
                                                                        )
                                                                    );
                                                                    $control->layout = isset( $control->layout ) ? $control->layout : 'one';
                                                                ?>
                                                                <label><?php esc_html_e( 'Block Layouts', 'clean-design-blog' ) ?></label>
                                                                <p class="description"><?php esc_html_e( 'Choose from available layouts', 'clean-design-blog' ) ?></p>
                                                                <?php
                                                                    foreach( $layouts as $layout_key => $layout ) :
                                                                ?>
                                                                        <label class="radio-image-single <?php if( $control->layout === $layout_key ) echo 'selected'; ?>" data-value="<?php echo esc_html($layout_key); ?>">
                                                                            <img src="<?php echo esc_url( $layout['img'] ); ?>"/>
                                                                        </label>
                                                                <?php
                                                                    endforeach;
                                                                ?>
                                                                <input type="hidden" class="block-repeater-control-field" data-name="layout" value="<?php echo esc_html( $control->layout ); ?>"/>
                                                            </div>
                                                            <div class="customize-toggle-field <?php if( $control->option ) echo 'checked-toggle-control'; ?>">
                                                                <label><?php esc_html_e( 'Section Show/Hide', 'clean-design-blog' ) ?></label>
                                                                <div class="toggle-button">
                                                                    <span class="on_off_txt_wrap">
                                                                        <span class="on"><?php echo esc_html( 'ON', 'clean-design-blog' ); ?></span>
                                                                        <span class="off"><?php echo esc_html( 'OFF', 'clean-design-blog' ); ?></span>
                                                                    </span>
                                                                </div>
                                                                <input type="checkbox" class="block-repeater-control-field" data-name="option" <?php echo checked( $control->option, true ); ?>/>
                                                            </div>
                                                            <div class="action-buttons">
                                                                <div class="close-block"><?php esc_html_e( 'Close', 'clean-design-blog' ); ?></div>
                                                                <div class="red-button remove-block" <?php if( isset( $open ) ) echo 'style="display:none"';?>><?php esc_html_e( 'Remove', 'clean-design-blog' ); ?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                            <?php
                                                    break;
                                case 'categories-collection' : ?>
                                                        <div class="clean-design-blog-block categories-collection-block-wrap<?php if( isset( $open ) ) echo ' open'; ?>" block-name="categories-collection">
                                                            <div class="block-header content-trigger">
                                                                <h2 class="block-header-title"><?php esc_html_e( 'Categories Collection', 'clean-design-blog' ); ?></h2>
                                                                <span class="block-header-icon"><i class="fas fa-chevron-<?php if( isset( $open ) ) { echo 'up'; } else {  echo 'down'; } ?>"></i></span>
                                                            </div>
                                                            <div class="block-content-wrap">
                                                                <div class="customize-text-field">
                                                                    <label><?php esc_html_e( 'Block Title', 'clean-design-blog' ) ?></label>
                                                                    <p class="description"><?php esc_html_e( 'Leave blank to hide title', 'clean-design-blog' ) ?></p>
                                                                    <input type="text" class="block-repeater-control-field" data-name="blockTitle" value="<?php echo esc_html( $control->blockTitle ); ?>"/>
                                                                </div>
                                                                <div class="customize-multicheckbox-field">
                                                                    <label><?php esc_html_e( 'Posts Categories', 'clean-design-blog' ) ?></label>
                                                                    <div class="multicheckbox-content">
                                                                        <?php
                                                                            $control_value = json_decode( $control->categories, true );
                                                                            foreach( $categories as $cat ) :
                                                                        ?>
                                                                                <div class="multicheckbox-single-item">
                                                                                    <label>
                                                                                        <input type="checkbox" value="<?php echo esc_attr( $cat->slug ); ?>" <?php if( is_array( $control_value ) ) if( in_array( $cat->slug, $control_value ) ) echo 'checked'; ?>><?php echo esc_html( $cat->name ) . ' (' .absint($cat->count). ')'; ?></label>
                                                                                </div>
                                                                        <?php
                                                                            endforeach;
                                                                        ?>
                                                                    </div>
                                                                    <input class="block-repeater-control-field" data-name="categories" type="hidden" value=<?php echo json_encode( $control_value ); ?> />
                                                                </div>
                                                                <div class="customize-toggle-field <?php if( $control->countOption ) echo 'checked-toggle-control'; ?>">
                                                                    <label><?php esc_html_e( 'Show categories count', 'clean-design-blog' ) ?></label>
                                                                    <div class="toggle-button">
                                                                        <span class="on_off_txt_wrap">
                                                                            <span class="on"><?php echo esc_html( 'ON', 'clean-design-blog' ); ?></span>
                                                                            <span class="off"><?php echo esc_html( 'OFF', 'clean-design-blog' ); ?></span>
                                                                        </span>
                                                                    </div>
                                                                    <input type="checkbox" class="block-repeater-control-field" data-name="countOption" <?php echo checked( $control->countOption, true ); ?>/>
                                                                </div>
                                                                <div class="customize-radio-image-field">
                                                                    <?php
                                                                        $layouts = array(
                                                                            'one'    => array(
                                                                                'label' => esc_html( 'Layout One' ),
                                                                                'img' => get_template_directory_uri() . '/images/customizer/category-one.jpg'
                                                                            ),
                                                                            'two'    => array(
                                                                                'label' => esc_html( 'Layout Two' ),
                                                                                'img' => get_template_directory_uri() . '/images/customizer/category-two.jpg'
                                                                            )
                                                                        );
                                                                        $control->layout = isset( $control->layout ) ? $control->layout : 'one';
                                                                    ?>
                                                                    <label><?php esc_html_e( 'Block Layouts', 'clean-design-blog' ) ?></label>
                                                                    <p class="description"><?php esc_html_e( 'Choose from available layouts', 'clean-design-blog' ) ?></p>
                                                                    <?php
                                                                        foreach( $layouts as $layout_key => $layout ) :
                                                                    ?>
                                                                            <label class="radio-image-single <?php if( $control->layout === $layout_key ) echo 'selected'; ?>" data-value="<?php echo esc_html($layout_key); ?>">
                                                                                <img src="<?php echo esc_url( $layout['img'] ); ?>"/>
                                                                            </label>
                                                                    <?php
                                                                        endforeach;
                                                                    ?>
                                                                    <input type="hidden" class="block-repeater-control-field" data-name="layout" value="<?php echo esc_html( $control->layout ); ?>"/>
                                                                </div>
                                                                <div class="customize-toggle-field <?php if( $control->option ) echo 'checked-toggle-control'; ?>">
                                                                    <label><?php esc_html_e( 'Section show/hide', 'clean-design-blog' ) ?></label>
                                                                    <div class="toggle-button">
                                                                        <span class="on_off_txt_wrap">
                                                                            <span class="on"><?php echo esc_html( 'ON', 'clean-design-blog' ); ?></span>
                                                                            <span class="off"><?php echo esc_html( 'OFF', 'clean-design-blog' ); ?></span>
                                                                        </span>
                                                                    </div>
                                                                    <input type="checkbox" class="block-repeater-control-field" data-name="option" <?php echo checked( $control->option, true ); ?>/>
                                                                </div>
                                                                <div class="action-buttons">
                                                                    <div class="close-block"><?php esc_html_e( 'Close', 'clean-design-blog' ); ?></div>
                                                                    <div class="red-button remove-block" <?php if( isset( $open ) ) echo 'style="display:none"';?>><?php esc_html_e( 'Remove', 'clean-design-blog' ); ?></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php
                                                        break;
                                case 'posts-grid' : ?>
                                                    <div class="clean-design-blog-block posts-grid-block-wrap<?php if( isset( $open ) ) echo ' open'; ?>" block-name="posts-grid">
                                                        <div class="block-header content-trigger">
                                                            <h2 class="block-header-title"><?php esc_html_e( 'Posts Grid', 'clean-design-blog' ); ?></h2>
                                                            <span class="block-header-icon"><i class="fas fa-chevron-<?php if( isset( $open ) ) { echo 'up'; } else {  echo 'down'; } ?>"></i></span>
                                                        </div>
                                                        <div class="block-content-wrap">
                                                            <div class="customize-text-field">
                                                                <label><?php esc_html_e( 'Block Title', 'clean-design-blog' ) ?></label>
                                                                <p class="description"><?php esc_html_e( 'Leave blank to hide title', 'clean-design-blog' ) ?></p>
                                                                <input type="text" class="block-repeater-control-field" data-name="blockTitle" value="<?php echo esc_html( $control->blockTitle ); ?>"/>
                                                            </div>
                                                            <div class="customize-select-field">
                                                                <label><?php esc_html_e( 'Category', 'clean-design-blog' ) ?></label>
                                                                <select class="block-repeater-control-field" data-name="category">
                                                                    <option value="" <?php if( empty( $control->category ) ) echo 'selected'; ?>><?php esc_html_e( 'Select Category', 'clean-design-blog' ); ?></option>
                                                                    <?php
                                                                        foreach( $categories as $cat ) {
                                                                    ?>
                                                                            <option value="<?php echo esc_attr( $cat->slug ); ?>" <?php if( $control->category === $cat->slug ) echo 'selected'; ?>><?php echo esc_html( $cat->name .' (' .$cat->count. ')' ); ?></option>
                                                                    <?php
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="customize-number-field">
                                                                <label><?php esc_html_e( 'Number of posts', 'clean-design-blog' ) ?></label>
                                                                <input type="number" min="-1" step="1" class="block-repeater-control-field" data-name="count" value="<?php echo esc_attr( $control->count ); ?>"/>
                                                            </div>
                                                            <div class="customize-toggle-field <?php if( $control->contentOption ) echo 'checked-toggle-control'; ?>">
                                                                <label><?php esc_html_e( 'Show post content', 'clean-design-blog' ) ?></label>
                                                                <div class="toggle-button">
                                                                    <span class="on_off_txt_wrap">
                                                                        <span class="on"><?php echo esc_html( 'ON', 'clean-design-blog' ); ?></span>
                                                                        <span class="off"><?php echo esc_html( 'OFF', 'clean-design-blog' ); ?></span>
                                                                    </span>
                                                                </div>
                                                                <input type="checkbox" class="block-repeater-control-field" data-name="contentOption" <?php echo checked( $control->contentOption, true ); ?>/>
                                                            </div>
                                                            <div class="customize-radio-image-field">
                                                                <?php
                                                                    $layouts = array(
                                                                        'one'    => array(
                                                                            'label' => esc_html( 'Layout One' ),
                                                                            'img' => get_template_directory_uri() . '/images/customizer/grid-one.jpg'
                                                                        ),
                                                                        'four'    => array(
                                                                            'label' => esc_html( 'Layout Four' ),
                                                                            'img' => get_template_directory_uri() . '/images/customizer/grid-four.jpg'
                                                                        )
                                                                    );
                                                                    $control->layout = isset( $control->layout ) ? $control->layout : 'one';
                                                                ?>
                                                                <label><?php esc_html_e( 'Block Layouts', 'clean-design-blog' ) ?></label>
                                                                <p class="description"><?php esc_html_e( 'Choose from available layouts', 'clean-design-blog' ) ?></p>
                                                                <?php
                                                                    foreach( $layouts as $layout_key => $layout ) :
                                                                ?>
                                                                        <label class="radio-image-single <?php if( $control->layout === $layout_key ) echo 'selected'; ?>" data-value="<?php echo esc_html($layout_key); ?>">
                                                                            <img src="<?php echo esc_url( $layout['img'] ); ?>"/>
                                                                        </label>
                                                                <?php
                                                                    endforeach;
                                                                ?>
                                                                <input type="hidden" class="block-repeater-control-field" data-name="layout" value="<?php echo esc_html( $control->layout ); ?>"/>
                                                            </div>
                                                            <div class="customize-toggle-field <?php if( $control->option ) echo 'checked-toggle-control'; ?>">
                                                                <label><?php esc_html_e( 'Section show/hide', 'clean-design-blog' ) ?></label>
                                                                <div class="toggle-button">
                                                                    <span class="on_off_txt_wrap">
                                                                        <span class="on"><?php echo esc_html( 'ON', 'clean-design-blog' ); ?></span>
                                                                        <span class="off"><?php echo esc_html( 'OFF', 'clean-design-blog' ); ?></span>
                                                                    </span>
                                                                </div>
                                                                <input type="checkbox" class="block-repeater-control-field" data-name="option" <?php echo checked( $control->option, true ); ?>/>
                                                            </div>
                                                            <div class="action-buttons">
                                                                <div class="close-block"><?php esc_html_e( 'Close', 'clean-design-blog' ); ?></div>
                                                                <div class="red-button remove-block" <?php if( isset( $open ) ) echo 'style="display:none"';?>><?php esc_html_e( 'Remove', 'clean-design-blog' ); ?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php
                                                    break;
                                case 'posts-list' : ?>
                                                    <div class="clean-design-blog-block posts-list-block-wrap<?php if( isset( $open ) ) echo ' open'; ?>" block-name="posts-list">
                                                        <div class="block-header content-trigger">
                                                            <h2 class="block-header-title"><?php esc_html_e( 'Posts List', 'clean-design-blog' ); ?></h2>
                                                            <span class="block-header-icon"><i class="fas fa-chevron-<?php if( isset( $open ) ) { echo 'up'; } else {  echo 'down'; } ?>"></i></span>
                                                        </div>
                                                        <div class="block-content-wrap">
                                                        <div class="customize-text-field">
                                                            <label><?php esc_html_e( 'Block Title', 'clean-design-blog' ) ?></label>
                                                            <p class="description"><?php esc_html_e( 'Leave blank to hide title', 'clean-design-blog' ) ?></p>
                                                            <input type="text" class="block-repeater-control-field" data-name="blockTitle" value="<?php echo esc_html( $control->blockTitle ); ?>"/>
                                                        </div>
                                                            <div class="customize-select-field">
                                                                <label><?php esc_html_e( 'Category', 'clean-design-blog' ) ?></label>
                                                                <select class="block-repeater-control-field" data-name="category">
                                                                    <option value="" <?php if( empty( $control->category ) ) echo 'selected'; ?>><?php esc_html_e( 'Select Category', 'clean-design-blog' ); ?></option>
                                                                    <?php
                                                                        foreach( $categories as $cat ) {
                                                                    ?>
                                                                            <option value="<?php echo esc_attr( $cat->slug ); ?>" <?php if( $control->category === $cat->slug ) echo 'selected'; ?>><?php echo esc_html( $cat->name .' (' .$cat->count. ')' ); ?></option>
                                                                    <?php
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="customize-number-field">
                                                                <label><?php esc_html_e( 'Number of posts', 'clean-design-blog' ) ?></label>
                                                                <input type="number" min="-1" step="1" class="block-repeater-control-field" data-name="count" value="<?php echo esc_attr( $control->count ); ?>"/>
                                                            </div>
                                                            <div class="customize-toggle-field <?php if( $control->dateOption ) echo 'checked-toggle-control'; ?>">
                                                                <label><?php esc_html_e( 'Show date', 'clean-design-blog' ) ?></label>
                                                                <div class="toggle-button">
                                                                    <span class="on_off_txt_wrap">
                                                                        <span class="on"><?php echo esc_html( 'ON', 'clean-design-blog' ); ?></span>
                                                                        <span class="off"><?php echo esc_html( 'OFF', 'clean-design-blog' ); ?></span>
                                                                    </span>
                                                                </div>
                                                                <input type="checkbox" class="block-repeater-control-field" data-name="dateOption" <?php echo checked( $control->dateOption, true ); ?>/>
                                                            </div>
                                                            <div class="customize-toggle-field <?php if( $control->commentOption ) echo 'checked-toggle-control'; ?>">
                                                                <label><?php esc_html_e( 'Show comment', 'clean-design-blog' ) ?></label>
                                                                <div class="toggle-button">
                                                                    <span class="on_off_txt_wrap">
                                                                        <span class="on"><?php echo esc_html( 'ON', 'clean-design-blog' ); ?></span>
                                                                        <span class="off"><?php echo esc_html( 'OFF', 'clean-design-blog' ); ?></span>
                                                                    </span>
                                                                </div>
                                                                <input type="checkbox" class="block-repeater-control-field" data-name="commentOption" <?php echo checked( $control->commentOption, true ); ?>/>
                                                            </div>
                                                            <div class="customize-toggle-field <?php if( $control->contentOption ) echo 'checked-toggle-control'; ?>">
                                                                <label><?php esc_html_e( 'Show post content', 'clean-design-blog' ) ?></label>
                                                                <div class="toggle-button">
                                                                    <span class="on_off_txt_wrap">
                                                                        <span class="on"><?php echo esc_html( 'ON', 'clean-design-blog' ); ?></span>
                                                                        <span class="off"><?php echo esc_html( 'OFF', 'clean-design-blog' ); ?></span>
                                                                    </span>
                                                                </div>
                                                                <input type="checkbox" class="block-repeater-control-field" data-name="contentOption" <?php echo checked( $control->contentOption, true ); ?>/>
                                                            </div>
                                                            <div class="customize-radio-image-field">
                                                                <?php
                                                                    $layouts = array(
                                                                        'one'    => array(
                                                                            'label' => esc_html( 'Layout One' ),
                                                                            'img' => get_template_directory_uri() . '/images/customizer/list-one.jpg'
                                                                        ),
                                                                        'two'    => array(
                                                                            'label' => esc_html( 'Layout Two' ),
                                                                            'img' => get_template_directory_uri() . '/images/customizer/list-two.jpg'
                                                                        )
                                                                    );
                                                                    $control->layout = isset( $control->layout ) ? $control->layout : 'one';
                                                                ?>
                                                                <label><?php esc_html_e( 'Block Layouts', 'clean-design-blog' ) ?></label>
                                                                <p class="description"><?php esc_html_e( 'Choose from available layouts', 'clean-design-blog' ) ?></p>
                                                                <?php
                                                                    foreach( $layouts as $layout_key => $layout ) :
                                                                ?>
                                                                        <label class="radio-image-single <?php if( $control->layout === $layout_key ) echo 'selected'; ?>" data-value="<?php echo esc_html($layout_key); ?>">
                                                                            <img src="<?php echo esc_url( $layout['img'] ); ?>"/>
                                                                        </label>
                                                                <?php
                                                                    endforeach;
                                                                ?>
                                                                <input type="hidden" class="block-repeater-control-field" data-name="layout" value="<?php echo esc_html( $control->layout ); ?>"/>
                                                            </div>
                                                            <div class="customize-toggle-field <?php if( $control->option ) echo 'checked-toggle-control'; ?>">
                                                                <label><?php esc_html_e( 'Section show/hide ', 'clean-design-blog' ) ?></label>
                                                                <div class="toggle-button">
                                                                    <span class="on_off_txt_wrap">
                                                                        <span class="on"><?php echo esc_html( 'ON', 'clean-design-blog' ); ?></span>
                                                                        <span class="off"><?php echo esc_html( 'OFF', 'clean-design-blog' ); ?></span>
                                                                    </span>
                                                                </div>
                                                                <input type="checkbox" class="block-repeater-control-field" data-name="option" <?php echo checked( $control->option, true ); ?>/>
                                                            </div>
                                                            <div class="action-buttons">
                                                                <div class="close-block"><?php esc_html_e( 'Close', 'clean-design-blog' ); ?></div>
                                                                <div class="red-button remove-block" <?php if( isset( $open ) ) echo 'style="display:none"';?>><?php esc_html_e( 'Remove', 'clean-design-blog' ); ?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php
                                                    break;
                                case 'posts-grid-alter' : ?>
                                                    <div class="clean-design-blog-block posts-grid-alter-block-wrap<?php if( isset( $open ) ) echo ' open'; ?>" block-name="posts-grid-alter">
                                                        <div class="block-header content-trigger">
                                                            <h2 class="block-header-title"><?php esc_html_e( 'Posts Grid Alter', 'clean-design-blog' ); ?></h2>
                                                            <span class="block-header-icon"><i class="fas fa-chevron-<?php if( isset( $open ) ) { echo 'up'; } else {  echo 'down'; } ?>"></i></span>
                                                        </div>
                                                        <div class="block-content-wrap">
                                                            <div class="customize-text-field">
                                                                <label><?php esc_html_e( 'Block Title', 'clean-design-blog' ) ?></label>
                                                                <p class="description"><?php esc_html_e( 'Leave blank to hide title', 'clean-design-blog' ) ?></p>
                                                                <input type="text" class="block-repeater-control-field" data-name="blockTitle" value="<?php echo esc_html( $control->blockTitle ); ?>"/>
                                                            </div>
                                                            <div class="customize-select-field">
                                                                <label><?php esc_html_e( 'Category', 'clean-design-blog' ) ?></label>
                                                                <select class="block-repeater-control-field" data-name="category">
                                                                    <option value="" <?php if( empty( $control->category ) ) echo 'selected'; ?>><?php esc_html_e( 'Select Category', 'clean-design-blog' ); ?></option>
                                                                    <?php
                                                                        foreach( $categories as $cat ) {
                                                                    ?>
                                                                            <option value="<?php echo esc_attr( $cat->slug ); ?>" <?php if( $control->category === $cat->slug ) echo 'selected'; ?>><?php echo esc_html( $cat->name .' (' .$cat->count. ')' ); ?></option>
                                                                    <?php
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="customize-number-field">
                                                                <label><?php esc_html_e( 'Number of posts', 'clean-design-blog' ) ?></label>
                                                                <input type="number" min="-1" step="1" class="block-repeater-control-field" data-name="count" value="<?php echo esc_attr( $control->count ); ?>"/>
                                                            </div>
                                                            <div class="customize-toggle-field <?php if( $control->dateOption ) echo 'checked-toggle-control'; ?>">
                                                                <label><?php esc_html_e( 'Show date', 'clean-design-blog' ) ?></label>
                                                                <div class="toggle-button">
                                                                    <span class="on_off_txt_wrap">
                                                                        <span class="on"><?php echo esc_html( 'ON', 'clean-design-blog' ); ?></span>
                                                                        <span class="off"><?php echo esc_html( 'OFF', 'clean-design-blog' ); ?></span>
                                                                    </span>
                                                                </div>
                                                                <input type="checkbox" class="block-repeater-control-field" data-name="dateOption" <?php echo checked( $control->dateOption, true ); ?>/>
                                                            </div>
                                                            <div class="customize-toggle-field <?php if( $control->commentOption ) echo 'checked-toggle-control'; ?>">
                                                                <label><?php esc_html_e( 'Show comment', 'clean-design-blog' ) ?></label>
                                                                <div class="toggle-button">
                                                                    <span class="on_off_txt_wrap">
                                                                        <span class="on"><?php echo esc_html( 'ON', 'clean-design-blog' ); ?></span>
                                                                        <span class="off"><?php echo esc_html( 'OFF', 'clean-design-blog' ); ?></span>
                                                                    </span>
                                                                </div>
                                                                <input type="checkbox" class="block-repeater-control-field" data-name="commentOption" <?php echo checked( $control->commentOption, true ); ?>/>
                                                            </div>
                                                            <div class="customize-radio-image-field">
                                                                <?php
                                                                    $layouts = array(
                                                                        'one'    => array(
                                                                            'label' => esc_html( 'Layout One' ),
                                                                            'img' => get_template_directory_uri() . '/images/customizer/grid-alter-one.jpg'
                                                                        ),
                                                                        'two'    => array(
                                                                            'label' => esc_html( 'Layout Two' ),
                                                                            'img' => get_template_directory_uri() . '/images/customizer/grid-alter-two.jpg'
                                                                        )
                                                                    );
                                                                    $control->layout = isset( $control->layout ) ? $control->layout : 'one';
                                                                ?>
                                                                <label><?php esc_html_e( 'Block Layouts', 'clean-design-blog' ) ?></label>
                                                                <p class="description"><?php esc_html_e( 'Choose from available layouts', 'clean-design-blog' ) ?></p>
                                                                <?php
                                                                    foreach( $layouts as $layout_key => $layout ) :
                                                                ?>
                                                                        <label class="radio-image-single <?php if( $control->layout === $layout_key ) echo 'selected'; ?>" data-value="<?php echo esc_html($layout_key); ?>">
                                                                            <img src="<?php echo esc_url( $layout['img'] ); ?>"/>
                                                                        </label>
                                                                <?php
                                                                    endforeach;
                                                                ?>
                                                                <input type="hidden" class="block-repeater-control-field" data-name="layout" value="<?php echo esc_html( $control->layout ); ?>"/>
                                                            </div>
                                                            <div class="customize-toggle-field <?php if( $control->option ) echo 'checked-toggle-control'; ?>">
                                                                <label><?php esc_html_e( 'Section show/hide', 'clean-design-blog' ) ?></label>
                                                                <div class="toggle-button">
                                                                    <span class="on_off_txt_wrap">
                                                                        <span class="on"><?php echo esc_html( 'ON', 'clean-design-blog' ); ?></span>
                                                                        <span class="off"><?php echo esc_html( 'OFF', 'clean-design-blog' ); ?></span>
                                                                    </span>
                                                                </div>
                                                                <input type="checkbox" class="block-repeater-control-field" data-name="option" <?php echo checked( $control->option, true ); ?>/>
                                                            </div>
                                                            <div class="action-buttons">
                                                                <div class="close-block"><?php esc_html_e( 'Close', 'clean-design-blog' ); ?></div>
                                                                <div class="red-button remove-block" <?php if( isset( $open ) ) echo 'style="display:none"';?>><?php esc_html_e( 'Remove', 'clean-design-blog' ); ?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php
                                                    break;
                                case 'posts-carousel' : ?>
                                                    <div class="clean-design-blog-block posts-carousel-block-wrap<?php if( isset( $open ) ) echo ' open'; ?>" block-name="posts-carousel">
                                                        <div class="block-header content-trigger">
                                                            <h2 class="block-header-title"><?php esc_html_e( 'Posts Carousel', 'clean-design-blog' ); ?></h2>
                                                            <span class="block-header-icon"><i class="fas fa-chevron-<?php if( isset( $open ) ) { echo 'up'; } else {  echo 'down'; } ?>"></i></span>
                                                        </div>
                                                        <div class="block-content-wrap">
                                                            <div class="customize-text-field">
                                                                <label><?php esc_html_e( 'Block Title', 'clean-design-blog' ) ?></label>
                                                                <p class="description"><?php esc_html_e( 'Leave blank to hide title', 'clean-design-blog' ) ?></p>
                                                                <input type="text" class="block-repeater-control-field" data-name="blockTitle" value="<?php echo esc_html( $control->blockTitle ); ?>"/>
                                                            </div>
                                                            <div class="customize-select-field">
                                                                <label><?php esc_html_e( 'Category', 'clean-design-blog' ) ?></label>
                                                                <select class="block-repeater-control-field" data-name="category">
                                                                    <option value="" <?php if( empty( $control->category ) ) echo 'selected'; ?>><?php esc_html_e( 'Select Category', 'clean-design-blog' ); ?></option>
                                                                    <?php
                                                                        foreach( $categories as $cat ) {
                                                                    ?>
                                                                            <option value="<?php echo esc_attr( $cat->slug ); ?>" <?php if( $control->category === $cat->slug ) echo 'selected'; ?>><?php echo esc_html( $cat->name .' (' .$cat->count. ')' ); ?></option>
                                                                    <?php
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="customize-number-field">
                                                                <label><?php esc_html_e( 'Number of posts', 'clean-design-blog' ) ?></label>
                                                                <input type="number" min="-1" step="1" class="block-repeater-control-field" data-name="count" value="<?php echo esc_attr( $control->count ); ?>"/>
                                                            </div>
                                                            <div class="customize-toggle-field <?php if( $control->dateOption ) echo 'checked-toggle-control'; ?>">
                                                                <label><?php esc_html_e( 'Show date', 'clean-design-blog' ) ?></label>
                                                                <div class="toggle-button">
                                                                    <span class="on_off_txt_wrap">
                                                                        <span class="on"><?php echo esc_html( 'ON', 'clean-design-blog' ); ?></span>
                                                                        <span class="off"><?php echo esc_html( 'OFF', 'clean-design-blog' ); ?></span>
                                                                    </span>
                                                                </div>
                                                                <input type="checkbox" class="block-repeater-control-field" data-name="dateOption" <?php echo checked( $control->dateOption, true ); ?>/>
                                                            </div>
                                                            <div class="customize-toggle-field <?php if( $control->commentOption ) echo 'checked-toggle-control'; ?>">
                                                                <label><?php esc_html_e( 'Show comment', 'clean-design-blog' ) ?></label>
                                                                <div class="toggle-button">
                                                                    <span class="on_off_txt_wrap">
                                                                        <span class="on"><?php echo esc_html( 'ON', 'clean-design-blog' ); ?></span>
                                                                        <span class="off"><?php echo esc_html( 'OFF', 'clean-design-blog' ); ?></span>
                                                                    </span>
                                                                </div>
                                                                <input type="checkbox" class="block-repeater-control-field" data-name="commentOption" <?php echo checked( $control->commentOption, true ); ?>/>
                                                            </div>
                                                            <div class="customize-radio-image-field">
                                                                <?php
                                                                    $layouts = array(
                                                                        'one'    => array(
                                                                            'label' => esc_html( 'Layout One' ),
                                                                            'img' => get_template_directory_uri() . '/images/customizer/carousel-one.jpg'
                                                                        ),
                                                                        'three'    => array(
                                                                            'label' => esc_html( 'Layout Three' ),
                                                                            'img' => get_template_directory_uri() . '/images/customizer/carousel-three.jpg'
                                                                        )
                                                                    );
                                                                ?>
                                                                <label><?php esc_html_e( 'Block Layouts', 'clean-design-blog' ) ?></label>
                                                                <p class="description"><?php esc_html_e( 'Choose from available layouts', 'clean-design-blog' ) ?></p>
                                                                <?php
                                                                    $control->layout = isset( $control->layout ) ? $control->layout : 'one';
                                                                    foreach( $layouts as $layout_key => $layout ) :
                                                                ?>
                                                                        <label class="radio-image-single <?php if( $control->layout === $layout_key ) echo 'selected'; ?>" data-value="<?php echo esc_html($layout_key); ?>">
                                                                            <img src="<?php echo esc_url( $layout['img'] ); ?>"/>
                                                                        </label>
                                                                <?php
                                                                    endforeach;
                                                                ?>
                                                                <input type="hidden" class="block-repeater-control-field" data-name="layout" value="<?php echo esc_html( $control->layout ); ?>"/>
                                                            </div>
                                                            <div class="customize-toggle-field <?php if( $control->option ) echo 'checked-toggle-control'; ?>">
                                                                <label><?php esc_html_e( 'Section show/hide', 'clean-design-blog' ) ?></label>
                                                                <div class="toggle-button">
                                                                    <span class="on_off_txt_wrap">
                                                                        <span class="on"><?php echo esc_html( 'ON', 'clean-design-blog' ); ?></span>
                                                                        <span class="off"><?php echo esc_html( 'OFF', 'clean-design-blog' ); ?></span>
                                                                    </span>
                                                                </div>
                                                                <input type="checkbox" class="block-repeater-control-field" data-name="option" <?php echo checked( $control->option, true ); ?>/>
                                                            </div>
                                                            <div class="action-buttons">
                                                                <div class="close-block"><?php esc_html_e( 'Close', 'clean-design-blog' ); ?></div>
                                                                <div class="red-button remove-block" <?php if( isset( $open ) ) echo 'style="display:none"';?>><?php esc_html_e( 'Remove', 'clean-design-blog' ); ?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php
                                                    break;
                                case 'posts-featured' : ?>
                                                    <div class="clean-design-blog-block posts-featured-block-wrap<?php if( isset( $open ) ) echo ' open'; ?>" block-name="posts-featured">
                                                        <div class="block-header content-trigger">
                                                            <h2 class="block-header-title"><?php esc_html_e( 'Posts Featured', 'clean-design-blog' ); ?></h2>
                                                            <span class="block-header-icon"><i class="fas fa-chevron-<?php if( isset( $open ) ) { echo 'up'; } else {  echo 'down'; } ?>"></i></span>
                                                        </div>
                                                        <div class="block-content-wrap">
                                                        <div class="customize-text-field">
                                                            <label><?php esc_html_e( 'Block Title', 'clean-design-blog' ) ?></label>
                                                            <p class="description"><?php esc_html_e( 'Leave blank to hide title', 'clean-design-blog' ) ?></p>
                                                            <input type="text" class="block-repeater-control-field" data-name="blockTitle" value="<?php echo esc_html( $control->blockTitle ); ?>"/>
                                                        </div>
                                                            <div class="customize-select-field">
                                                                <label><?php esc_html_e( 'Category', 'clean-design-blog' ) ?></label>
                                                                <select class="block-repeater-control-field" data-name="category">
                                                                    <option value="" <?php if( empty( $control->category ) ) echo 'selected'; ?>><?php esc_html_e( 'Select Category', 'clean-design-blog' ); ?></option>
                                                                    <?php
                                                                        foreach( $categories as $cat ) {
                                                                    ?>
                                                                            <option value="<?php echo esc_attr( $cat->slug ); ?>" <?php if( $control->category === $cat->slug ) echo 'selected'; ?>><?php echo esc_html( $cat->name .' (' .$cat->count. ')' ); ?></option>
                                                                    <?php
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="customize-toggle-field <?php if( $control->dateOption ) echo 'checked-toggle-control'; ?>">
                                                                <label><?php esc_html_e( 'Show date', 'clean-design-blog' ) ?></label>
                                                                <div class="toggle-button">
                                                                    <span class="on_off_txt_wrap">
                                                                        <span class="on"><?php echo esc_html( 'ON', 'clean-design-blog' ); ?></span>
                                                                        <span class="off"><?php echo esc_html( 'OFF', 'clean-design-blog' ); ?></span>
                                                                    </span>
                                                                </div>
                                                                <input type="checkbox" class="block-repeater-control-field" data-name="dateOption" <?php echo checked( $control->dateOption, true ); ?>/>
                                                            </div>
                                                            <div class="customize-toggle-field <?php if( $control->commentOption ) echo 'checked-toggle-control'; ?>">
                                                                <label><?php esc_html_e( 'Show comment', 'clean-design-blog' ) ?></label>
                                                                <div class="toggle-button">
                                                                    <span class="on_off_txt_wrap">
                                                                        <span class="on"><?php echo esc_html( 'ON', 'clean-design-blog' ); ?></span>
                                                                        <span class="off"><?php echo esc_html( 'OFF', 'clean-design-blog' ); ?></span>
                                                                    </span>
                                                                </div>
                                                                <input type="checkbox" class="block-repeater-control-field" data-name="commentOption" <?php echo checked( $control->commentOption, true ); ?>/>
                                                            </div>
                                                            <div class="customize-radio-image-field">
                                                                <?php
                                                                    $layouts = array(
                                                                        'one'    => array(
                                                                            'label' => esc_html( 'Layout One' ),
                                                                            'img' => get_template_directory_uri() . '/images/customizer/feature-post-one.jpg'
                                                                        ),
                                                                        'two'    => array(
                                                                            'label' => esc_html( 'Layout Two' ),
                                                                            'img' => get_template_directory_uri() . '/images/customizer/feature-post-two.jpg'
                                                                        )
                                                                    );
                                                                    $control->layout = isset( $control->layout ) ? $control->layout : 'one';
                                                                ?>
                                                                <label><?php esc_html_e( 'Block Layouts', 'clean-design-blog' ) ?></label>
                                                                <p class="description"><?php esc_html_e( 'Choose from available layouts', 'clean-design-blog' ) ?></p>
                                                                <?php
                                                                    foreach( $layouts as $layout_key => $layout ) :
                                                                ?>
                                                                        <label class="radio-image-single <?php if( $control->layout === $layout_key ) echo 'selected'; ?>" data-value="<?php echo esc_html($layout_key); ?>">
                                                                            <img src="<?php echo esc_url( $layout['img'] ); ?>"/>
                                                                        </label>
                                                                <?php
                                                                    endforeach;
                                                                ?>
                                                                <input type="hidden" class="block-repeater-control-field" data-name="layout" value="<?php echo esc_html( $control->layout ); ?>"/>
                                                            </div>
                                                            <div class="customize-toggle-field <?php if( $control->option ) echo 'checked-toggle-control'; ?>">
                                                                <label><?php esc_html_e( 'Section show/hide', 'clean-design-blog' ) ?></label>
                                                                <div class="toggle-button">
                                                                    <span class="on_off_txt_wrap">
                                                                        <span class="on"><?php echo esc_html( 'ON', 'clean-design-blog' ); ?></span>
                                                                        <span class="off"><?php echo esc_html( 'OFF', 'clean-design-blog' ); ?></span>
                                                                    </span>
                                                                </div>
                                                                <input type="checkbox" class="block-repeater-control-field" data-name="option" <?php echo checked( $control->option, true ); ?>/>
                                                            </div>
                                                            <div class="action-buttons">
                                                                <div class="close-block"><?php esc_html_e( 'Close', 'clean-design-blog' ); ?></div>
                                                                <div class="red-button remove-block" <?php if( isset( $open ) ) echo 'style="display:none"';?>><?php esc_html_e( 'Remove', 'clean-design-blog' ); ?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                        break;
                            default : esc_html_e( 'No block defined ', 'clean-design-blog' );
                        }
                        unset($open);
                    endforeach;
                ?>
                <div class="button clone-block"><?php esc_html_e( 'Clone Block', 'clean-design-blog' ); ?></div>
                <div class="button add-new-block"><span><span class="dashicons dashicons-plus"></span><?php esc_html_e( 'New Block', 'clean-design-blog' ); ?></span><span style="display:none"><span class="dashicons dashicons-no"></span><?php esc_html_e( 'Close', 'clean-design-blog' ); ?></span></div>
                <ul class="block-name-list">
                    <li class="banner-slider"><?php esc_html_e( 'Banner Slider', 'clean-design-blog' ); ?></li>
                    <div class="clean-design-blog-block banner-slider-block-wrap open" block-name="banner-slider">
                        <div class="block-header content-trigger">
                            <h2 class="block-header-title"><?php esc_html_e( 'Banner Slider', 'clean-design-blog' ); ?></h2>
                            <span class="block-header-icon"><i class="fas fa-chevron-up"></i></span>
                        </div>
                        <div class="block-content-wrap">
                            <div class="customize-select-field">
                                <label><?php esc_html_e( 'Category', 'clean-design-blog' ) ?></label>
                                <select class="block-repeater-control-field" data-name="category">
                                    <option value="" selected><?php esc_html_e( 'Select Category', 'clean-design-blog' ); ?></option>
                                    <?php
                                        foreach( $categories as $cat ) {
                                    ?>
                                            <option value="<?php echo esc_attr( $cat->slug ); ?>"><?php echo esc_html( $cat->name .' (' .$cat->count. ')' ); ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="customize-number-field">
                                <label><?php esc_html_e( 'Number of posts', 'clean-design-blog' ) ?></label>
                                <input type="number" min="-1" step="1" class="block-repeater-control-field" data-name="count" value="3"/>
                            </div>
                            <div class="customize-toggle-field">
                                <label><?php esc_html_e( 'Show post excerpt', 'clean-design-blog' ) ?></label>
                                
                                <div class="toggle-button">
                                    <span class="on_off_txt_wrap">
                                        <span class="on"><?php echo esc_html( 'ON', 'clean-design-blog' ); ?></span>
                                        <span class="off"><?php echo esc_html( 'OFF', 'clean-design-blog' ); ?></span>
                                    </span>
                                </div>
                                <input type="checkbox" class="block-repeater-control-field" data-name="contentOption"/>
                            </div>
                            <div class="customize-radio-image-field">
                                <?php
                                    $layouts = array(
                                        'one'    => array(
                                            'label' => esc_html( 'Layout One' ),
                                            'img' => get_template_directory_uri() . '/images/customizer/layout_one_sample.jpg'
                                        ),
                                        'two'    => array(
                                            'label' => esc_html( 'Layout Two' ),
                                            'img' => get_template_directory_uri() . '/images/customizer/layout_two_sample.jpg'
                                        )
                                    );
                                ?>
                                <label><?php esc_html_e( 'Block Layouts', 'clean-design-blog' ) ?></label>
                                <p class="description"><?php esc_html_e( 'Choose from available layouts', 'clean-design-blog' ) ?></p>
                                <?php
                                    foreach( $layouts as $layout_key => $layout ) :
                                ?>
                                        <label class="radio-image-single <?php if( 'one' === $layout_key ) echo 'selected'; ?>" data-value="<?php echo esc_html($layout_key); ?>">
                                            <img src="<?php echo esc_url( $layout['img'] ); ?>"/>
                                        </label>
                                <?php
                                    endforeach;
                                ?>
                                <input type="hidden" class="block-repeater-control-field" data-name="layout" value="one"/>
                            </div>
                            <div class="customize-toggle-field <?php if( $control->option ) echo 'checked-toggle-control'; ?>">
                                <label><?php esc_html_e( 'Section show/hide', 'clean-design-blog' ) ?></label>
                                <div class="toggle-button">
                                    <span class="on_off_txt_wrap">
                                        <span class="on"><?php echo esc_html( 'ON', 'clean-design-blog' ); ?></span>
                                        <span class="off"><?php echo esc_html( 'OFF', 'clean-design-blog' ); ?></span>
                                    </span>
                                </div>
                                <input type="checkbox" class="block-repeater-control-field" data-name="option" checked/>
                            </div>
                            <div class="action-buttons">
                                <div class="close-block"><?php esc_html_e( 'Close', 'clean-design-blog' ); ?></div>
                                <div class="red-button remove-block"><?php esc_html_e( 'Remove', 'clean-design-blog' ); ?></div>
                            </div>
                        </div>
                    </div>
                    <li class="categories-collection"><?php esc_html_e( 'Categories Collection', 'clean-design-blog' ); ?></li>
                    <div class="clean-design-blog-block categories-collection-block-wrap open" block-name="categories-collection">
                        <div class="block-header content-trigger">
                            <h2 class="block-header-title"><?php esc_html_e( 'Categories Collection', 'clean-design-blog' ); ?></h2>
                            <span class="block-header-icon"><i class="fas fa-chevron-up"></i></span>
                        </div>
                        <div class="block-content-wrap">
                            <div class="customize-text-field">
                                <label><?php esc_html_e( 'Block Title', 'clean-design-blog' ) ?></label>
                                <p class="description"><?php esc_html_e( 'Leave blank to hide title', 'clean-design-blog' ) ?></p>
                                <input type="text" class="block-repeater-control-field" data-name="blockTitle" value="<?php esc_attr_e( 'Categories Collection', 'clean-design-blog' ); ?>"/>
                            </div>
                            <div class="customize-multicheckbox-field">
                                <label><?php esc_html_e( 'Posts Categories', 'clean-design-blog' ) ?></label>
                                <div class="multicheckbox-content">
                                    <?php
                                        foreach( $categories as $cat ) :
                                    ?>
                                            <div class="multicheckbox-single-item">
                                                <label>
                                                    <input type="checkbox" value="<?php echo esc_attr( $cat->slug ); ?>"><?php echo esc_html( $cat->name ) . ' (' .absint($cat->count). ')'; ?></label>
                                            </div>
                                    <?php
                                        endforeach;
                                    ?>
                                </div>
                                <input class="block-repeater-control-field" data-name="categories" type="hidden" value="[]"/>
                            </div>
                            <div class="customize-toggle-field checked-toggle-control">
                                <label><?php esc_html_e( 'Show categories title', 'clean-design-blog' ) ?></label>
                                <div class="toggle-button">
                                    <span class="on_off_txt_wrap">
                                        <span class="on"><?php echo esc_html( 'ON', 'clean-design-blog' ); ?></span>
                                        <span class="off"><?php echo esc_html( 'OFF', 'clean-design-blog' ); ?></span>
                                    </span>
                                </div>
                                <input type="checkbox" class="block-repeater-control-field" data-name="titleOption" checked/>
                            </div>
                            <div class="customize-toggle-field checked-toggle-control">
                                <label><?php esc_html_e( 'Show categories count', 'clean-design-blog' ) ?></label>
                                <div class="toggle-button">
                                    <span class="on_off_txt_wrap">
                                        <span class="on"><?php echo esc_html( 'ON', 'clean-design-blog' ); ?></span>
                                        <span class="off"><?php echo esc_html( 'OFF', 'clean-design-blog' ); ?></span>
                                    </span>
                                </div>
                                <input type="checkbox" class="block-repeater-control-field" data-name="countOption" checked/>
                            </div>
                            <div class="customize-radio-image-field">
                                <?php
                                    $layouts = array(
                                        'one'    => array(
                                            'label' => esc_html( 'Layout One' ),
                                            'img' => get_template_directory_uri() . '/images/customizer/category-one.jpg'
                                        ),
                                        'two'    => array(
                                            'label' => esc_html( 'Layout Two' ),
                                            'img' => get_template_directory_uri() . '/images/customizer/category-two.jpg'
                                        )
                                    );
                                ?>
                                <label><?php esc_html_e( 'Block Layouts', 'clean-design-blog' ) ?></label>
                                <p class="description"><?php esc_html_e( 'Choose from available layouts', 'clean-design-blog' ) ?></p>
                                <?php
                                    foreach( $layouts as $layout_key => $layout ) :
                                ?>
                                        <label class="radio-image-single <?php if( 'one' === $layout_key ) echo 'selected'; ?>" data-value="<?php echo esc_html($layout_key); ?>">
                                            <img src="<?php echo esc_url( $layout['img'] ); ?>"/>
                                        </label>
                                <?php
                                    endforeach;
                                ?>
                                <input type="hidden" class="block-repeater-control-field" data-name="layout" value="one"/>
                            </div>
                            <div class="customize-toggle-field checked-toggle-control">
                                <label><?php esc_html_e( 'Section show/hide', 'clean-design-blog' ) ?></label>
                                <div class="toggle-button">
                                    <span class="on_off_txt_wrap">
                                        <span class="on"><?php echo esc_html( 'ON', 'clean-design-blog' ); ?></span>
                                        <span class="off"><?php echo esc_html( 'OFF', 'clean-design-blog' ); ?></span>
                                    </span>
                                </div>
                                <input type="checkbox" class="block-repeater-control-field" data-name="option" checked/>
                            </div>
                            <div class="action-buttons">
                                <div class="close-block"><?php esc_html_e( 'Close', 'clean-design-blog' ); ?></div>
                                <div class="red-button remove-block"><?php esc_html_e( 'Remove', 'clean-design-blog' ); ?></div>
                            </div>
                        </div>
                    </div>
                    <li class="posts-grid"><?php esc_html_e( 'Posts Grid', 'clean-design-blog' ); ?></li>
                    <div class="clean-design-blog-block posts-grid-block-wrap open" block-name="posts-grid">
                        <div class="block-header content-trigger">
                            <h2 class="block-header-title"><?php esc_html_e( 'Posts Grid', 'clean-design-blog' ); ?></h2>
                            <span class="block-header-icon"><i class="fas fa-chevron-up"></i></span>
                        </div>
                        <div class="block-content-wrap">
                            <div class="customize-text-field">
                                <label><?php esc_html_e( 'Block Title', 'clean-design-blog' ) ?></label>
                                <p class="description"><?php esc_html_e( 'Leave blank to hide title', 'clean-design-blog' ) ?></p>
                                <input type="text" class="block-repeater-control-field" data-name="blockTitle" value="<?php echo esc_attr__( 'Posts Grid', 'clean-design-blog' ); ?>"/>
                            </div>
                            <div class="customize-select-field">
                                <label><?php esc_html_e( 'Category', 'clean-design-blog' ) ?></label>
                                <select class="block-repeater-control-field" data-name="category">
                                    <option value="" selected><?php esc_html_e( 'Select Category', 'clean-design-blog' ); ?></option>
                                    <?php
                                        foreach( $categories as $cat ) {
                                    ?>
                                            <option value="<?php echo esc_attr( $cat->slug ); ?>"><?php echo esc_html( $cat->name .' (' .$cat->count. ')' ); ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="customize-number-field">
                                <label><?php esc_html_e( 'Number of posts', 'clean-design-blog' ) ?></label>
                                <input type="number" min="-1" step="1" class="block-repeater-control-field" data-name="count" value="3"/>
                            </div>
                            <div class="customize-toggle-field">
                                <label><?php esc_html_e( 'Show post content', 'clean-design-blog' ) ?></label>
                                <div class="toggle-button">
                                    <span class="on_off_txt_wrap">
                                        <span class="on"><?php echo esc_html( 'ON', 'clean-design-blog' ); ?></span>
                                        <span class="off"><?php echo esc_html( 'OFF', 'clean-design-blog' ); ?></span>
                                    </span>
                                </div>
                                <input type="checkbox" class="block-repeater-control-field" data-name="contentOption"/>
                            </div>
                            <div class="customize-radio-image-field">
                                <?php
                                    $layouts = array(
                                        'one'    => array(
                                            'label' => esc_html( 'Layout One' ),
                                            'img' => get_template_directory_uri() . '/images/customizer/grid-one.jpg'
                                        ),
                                        'four'    => array(
                                            'label' => esc_html( 'Layout Four' ),
                                            'img' => get_template_directory_uri() . '/images/customizer/grid-four.jpg'
                                        )
                                    );
                                ?>
                                <label><?php esc_html_e( 'Block Layouts', 'clean-design-blog' ) ?></label>
                                <p class="description"><?php esc_html_e( 'Choose from available layouts', 'clean-design-blog' ) ?></p>
                                <?php
                                    foreach( $layouts as $layout_key => $layout ) :
                                ?>
                                        <label class="radio-image-single <?php if( 'one' === $layout_key ) echo 'selected'; ?>" data-value="<?php echo esc_html($layout_key); ?>">
                                            <img src="<?php echo esc_url( $layout['img'] ); ?>"/>
                                        </label>
                                <?php
                                    endforeach;
                                ?>
                                <input type="hidden" class="block-repeater-control-field" data-name="layout" value="one"/>
                            </div>
                            <div class="customize-toggle-field checked-toggle-control">
                                <label><?php esc_html_e( 'Section show/hide', 'clean-design-blog' ) ?></label>
                                <div class="toggle-button">
                                    <span class="on_off_txt_wrap">
                                        <span class="on"><?php echo esc_html( 'ON', 'clean-design-blog' ); ?></span>
                                        <span class="off"><?php echo esc_html( 'OFF', 'clean-design-blog' ); ?></span>
                                    </span>
                                </div>
                                <input type="checkbox" class="block-repeater-control-field" data-name="option" checked/>
                            </div>
                            <div class="action-buttons">
                                <div class="close-block"><?php esc_html_e( 'Close', 'clean-design-blog' ); ?></div>
                                <div class="red-button remove-block"><?php esc_html_e( 'Remove', 'clean-design-blog' ); ?></div>
                            </div>
                        </div>
                    </div>
                    <li class="posts-list"><?php esc_html_e( 'Posts List', 'clean-design-blog' ); ?></li>
                    <div class="clean-design-blog-block posts-list-block-wrap open" block-name="posts-list">
                        <div class="block-header content-trigger">
                            <h2 class="block-header-title"><?php esc_html_e( 'Posts List', 'clean-design-blog' ); ?></h2>
                            <span class="block-header-icon"><i class="fas fa-chevron-up"></i></span>
                        </div>
                        <div class="block-content-wrap">
                            <div class="customize-text-field">
                                <label><?php esc_html_e( 'Block Title', 'clean-design-blog' ) ?></label>
                                <p class="description"><?php esc_html_e( 'Leave blank to hide title', 'clean-design-blog' ) ?></p>
                                <input type="text" class="block-repeater-control-field" data-name="blockTitle" value="<?php echo esc_attr__( 'Posts List', 'clean-design-blog' ); ?>"/>
                            </div>
                            <div class="customize-select-field">
                                <label><?php esc_html_e( 'Category', 'clean-design-blog' ) ?></label>
                                <select class="block-repeater-control-field" data-name="category">
                                    <option value="" selected><?php esc_html_e( 'Select Category', 'clean-design-blog' ); ?></option>
                                    <?php
                                        foreach( $categories as $cat ) {
                                    ?>
                                            <option value="<?php echo esc_attr( $cat->slug ); ?>"><?php echo esc_html( $cat->name .' (' .$cat->count. ')' ); ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="customize-number-field">
                                <label><?php esc_html_e( 'Number of posts', 'clean-design-blog' ) ?></label>
                                <input type="number" min="-1" step="1" class="block-repeater-control-field" data-name="count" value="3"/>
                            </div>
                            <div class="customize-toggle-field checked-toggle-control">
                                <label><?php esc_html_e( 'Show date', 'clean-design-blog' ) ?></label>
                                <div class="toggle-button">
                                    <span class="on_off_txt_wrap">
                                        <span class="on"><?php echo esc_html( 'ON', 'clean-design-blog' ); ?></span>
                                        <span class="off"><?php echo esc_html( 'OFF', 'clean-design-blog' ); ?></span>
                                    </span>
                                </div>
                                <input type="checkbox" class="block-repeater-control-field" data-name="dateOption" checked/>
                            </div>
                            <div class="customize-toggle-field">
                                <label><?php esc_html_e( 'Show comment', 'clean-design-blog' ) ?></label>
                                <div class="toggle-button">
                                    <span class="on_off_txt_wrap">
                                        <span class="on"><?php echo esc_html( 'ON', 'clean-design-blog' ); ?></span>
                                        <span class="off"><?php echo esc_html( 'OFF', 'clean-design-blog' ); ?></span>
                                    </span>
                                </div>
                                <input type="checkbox" class="block-repeater-control-field" data-name="commentOption"/>
                            </div>
                            <div class="customize-toggle-field checked-toggle-control">
                                <label><?php esc_html_e( 'Show post content', 'clean-design-blog' ) ?></label>
                                <div class="toggle-button">
                                    <span class="on_off_txt_wrap">
                                        <span class="on"><?php echo esc_html( 'ON', 'clean-design-blog' ); ?></span>
                                        <span class="off"><?php echo esc_html( 'OFF', 'clean-design-blog' ); ?></span>
                                    </span>
                                </div>
                                <input type="checkbox" class="block-repeater-control-field" data-name="contentOption" checked/>
                            </div>
                            <div class="customize-radio-image-field">
                                <?php
                                    $layouts = array(
                                        'one'    => array(
                                            'label' => esc_html( 'Layout One' ),
                                            'img' => get_template_directory_uri() . '/images/customizer/list-one.jpg'
                                        ),
                                        'two'    => array(
                                            'label' => esc_html( 'Layout Two' ),
                                            'img' => get_template_directory_uri() . '/images/customizer/list-two.jpg'
                                        )
                                    );
                                ?>
                                <label><?php esc_html_e( 'Block Layouts', 'clean-design-blog' ) ?></label>
                                <p class="description"><?php esc_html_e( 'Choose from available layouts', 'clean-design-blog' ) ?></p>
                                <?php
                                    foreach( $layouts as $layout_key => $layout ) :
                                ?>
                                        <label class="radio-image-single <?php if( 'one' === $layout_key ) echo 'selected'; ?>" data-value="<?php echo esc_html($layout_key); ?>">
                                            <img src="<?php echo esc_url( $layout['img'] ); ?>"/>
                                        </label>
                                <?php
                                    endforeach;
                                ?>
                                <input type="hidden" class="block-repeater-control-field" data-name="layout" value="one"/>
                            </div>
                            <div class="customize-toggle-field checked-toggle-control">
                                <label><?php esc_html_e( 'Section show/hide', 'clean-design-blog' ) ?></label>
                                <div class="toggle-button">
                                    <span class="on_off_txt_wrap">
                                        <span class="on"><?php echo esc_html( 'ON', 'clean-design-blog' ); ?></span>
                                        <span class="off"><?php echo esc_html( 'OFF', 'clean-design-blog' ); ?></span>
                                    </span>
                                </div>
                                <input type="checkbox" class="block-repeater-control-field" data-name="option" checked/>
                            </div>
                            <div class="action-buttons">
                                <div class="close-block"><?php esc_html_e( 'Close', 'clean-design-blog' ); ?></div>
                                <div class="red-button remove-block"><?php esc_html_e( 'Remove', 'clean-design-blog' ); ?></div>
                            </div>
                        </div>
                    </div>
                    <li class="posts-grid-alter"><?php esc_html_e( 'Posts Grid Alter', 'clean-design-blog' ); ?></li>
                    <div class="clean-design-blog-block posts-grid-alter-block-wrap open" block-name="posts-grid-alter">
                        <div class="block-header content-trigger">
                            <h2 class="block-header-title"><?php esc_html_e( 'Posts Grid Alter', 'clean-design-blog' ); ?></h2>
                            <span class="block-header-icon"><i class="fas fa-chevron-up"></i></span>
                        </div>
                        <div class="block-content-wrap">
                            <div class="customize-text-field">
                                <label><?php esc_html_e( 'Block Title', 'clean-design-blog' ) ?></label>
                                <p class="description"><?php esc_html_e( 'Leave blank to hide title', 'clean-design-blog' ) ?></p>
                                <input type="text" class="block-repeater-control-field" data-name="blockTitle" value="<?php echo esc_attr__( 'Posts Grid Alter', 'clean-design-blog' ); ?>"/>
                            </div>
                            <div class="customize-select-field">
                                <label><?php esc_html_e( 'Category', 'clean-design-blog' ) ?></label>
                                <select class="block-repeater-control-field" data-name="category">
                                    <option value="" selected><?php esc_html_e( 'Select Category', 'clean-design-blog' ); ?></option>
                                    <?php
                                        foreach( $categories as $cat ) {
                                    ?>
                                            <option value="<?php echo esc_attr( $cat->slug ); ?>"><?php echo esc_html( $cat->name .' (' .$cat->count. ')' ); ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="customize-number-field">
                                <label><?php esc_html_e( 'Number of posts', 'clean-design-blog' ) ?></label>
                                <input type="number" min="-1" step="1" class="block-repeater-control-field" data-name="count" value="3"/>
                            </div>
                            <div class="customize-toggle-field checked-toggle-control">
                                <label><?php esc_html_e( 'Show date', 'clean-design-blog' ) ?></label>
                                <div class="toggle-button">
                                    <span class="on_off_txt_wrap">
                                        <span class="on"><?php echo esc_html( 'ON', 'clean-design-blog' ); ?></span>
                                        <span class="off"><?php echo esc_html( 'OFF', 'clean-design-blog' ); ?></span>
                                    </span>
                                </div>
                                <input type="checkbox" class="block-repeater-control-field" data-name="dateOption" checked/>
                            </div>
                            <div class="customize-toggle-field checked-toggle-control">
                                <label><?php esc_html_e( 'Show comment', 'clean-design-blog' ) ?></label>
                                <div class="toggle-button">
                                    <span class="on_off_txt_wrap">
                                        <span class="on"><?php echo esc_html( 'ON', 'clean-design-blog' ); ?></span>
                                        <span class="off"><?php echo esc_html( 'OFF', 'clean-design-blog' ); ?></span>
                                    </span>
                                </div>
                                <input type="checkbox" class="block-repeater-control-field" data-name="commentOption" checked/>
                            </div>
                            <div class="customize-radio-image-field">
                                <?php
                                    $layouts = array(
                                        'one'    => array(
                                            'label' => esc_html( 'Layout One' ),
                                            'img' => get_template_directory_uri() . '/images/customizer/grid-alter-one.jpg'
                                        ),
                                        'two'    => array(
                                            'label' => esc_html( 'Layout Two' ),
                                            'img' => get_template_directory_uri() . '/images/customizer/grid-alter-two.jpg'
                                        )
                                    );
                                ?>
                                <label><?php esc_html_e( 'Block Layouts', 'clean-design-blog' ) ?></label>
                                <p class="description"><?php esc_html_e( 'Choose from available layouts', 'clean-design-blog' ) ?></p>
                                <?php
                                    foreach( $layouts as $layout_key => $layout ) :
                                ?>
                                        <label class="radio-image-single <?php if( 'one' === $layout_key ) echo 'selected'; ?>" data-value="<?php echo esc_html($layout_key); ?>">
                                            <img src="<?php echo esc_url( $layout['img'] ); ?>"/>
                                        </label>
                                <?php
                                    endforeach;
                                ?>
                                <input type="hidden" class="block-repeater-control-field" data-name="layout" value="one"/>
                            </div>
                            <div class="customize-toggle-field checked-toggle-control">
                                <label><?php esc_html_e( 'Section show/hide', 'clean-design-blog' ) ?></label>
                                <div class="toggle-button">
                                    <span class="on_off_txt_wrap">
                                        <span class="on"><?php echo esc_html( 'ON', 'clean-design-blog' ); ?></span>
                                        <span class="off"><?php echo esc_html( 'OFF', 'clean-design-blog' ); ?></span>
                                    </span>
                                </div>
                                <input type="checkbox" class="block-repeater-control-field" data-name="option" checked/>
                            </div>
                            <div class="action-buttons">
                                <div class="close-block"><?php esc_html_e( 'Close', 'clean-design-blog' ); ?></div>
                                <div class="red-button remove-block"><?php esc_html_e( 'Remove', 'clean-design-blog' ); ?></div>
                            </div>
                        </div>
                    </div>
                    <li class="posts-carousel"><?php esc_html_e( 'Posts Carousel', 'clean-design-blog' ); ?></li>
                    <div class="clean-design-blog-block posts-carousel-block-wrap open" block-name="posts-carousel">
                        <div class="block-header content-trigger">
                            <h2 class="block-header-title"><?php esc_html_e( 'Posts Carousel', 'clean-design-blog' ); ?></h2>
                            <span class="block-header-icon"><i class="fas fa-chevron-up"></i></span>
                        </div>
                        <div class="block-content-wrap">
                            <div class="customize-text-field">
                                <label><?php esc_html_e( 'Block Title', 'clean-design-blog' ) ?></label>
                                <p class="description"><?php esc_html_e( 'Leave blank to hide title', 'clean-design-blog' ) ?></p>
                                <input type="text" class="block-repeater-control-field" data-name="blockTitle" value="<?php echo esc_attr__( 'Posts Carousel', 'clean-design-blog' ); ?>"/>
                            </div>
                            <div class="customize-select-field">
                                <label><?php esc_html_e( 'Category', 'clean-design-blog' ) ?></label>
                                <select class="block-repeater-control-field" data-name="category">
                                    <option value="" selected><?php esc_html_e( 'Select Category', 'clean-design-blog' ); ?></option>
                                    <?php
                                        foreach( $categories as $cat ) {
                                    ?>
                                            <option value="<?php echo esc_attr( $cat->slug ); ?>"><?php echo esc_html( $cat->name .' (' .$cat->count. ')' ); ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="customize-number-field">
                                <label><?php esc_html_e( 'Number of posts', 'clean-design-blog' ) ?></label>
                                <input type="number" min="-1" step="1" class="block-repeater-control-field" data-name="count" value="6"/>
                            </div>
                            <div class="customize-toggle-field checked-toggle-control">
                                <label><?php esc_html_e( 'Show date', 'clean-design-blog' ) ?></label>
                                <div class="toggle-button">
                                    <span class="on_off_txt_wrap">
                                        <span class="on"><?php echo esc_html( 'ON', 'clean-design-blog' ); ?></span>
                                        <span class="off"><?php echo esc_html( 'OFF', 'clean-design-blog' ); ?></span>
                                    </span>
                                </div>
                                <input type="checkbox" class="block-repeater-control-field" data-name="dateOption" checked/>
                            </div>
                            <div class="customize-toggle-field">
                                <label><?php esc_html_e( 'Show comment', 'clean-design-blog' ) ?></label>
                                <div class="toggle-button">
                                    <span class="on_off_txt_wrap">
                                        <span class="on"><?php echo esc_html( 'ON', 'clean-design-blog' ); ?></span>
                                        <span class="off"><?php echo esc_html( 'OFF', 'clean-design-blog' ); ?></span>
                                    </span>
                                </div>
                                <input type="checkbox" class="block-repeater-control-field" data-name="commentOption"/>
                            </div>
                            <div class="customize-radio-image-field">
                                <?php
                                    $layouts = array(
                                        'one'    => array(
                                            'label' => esc_html( 'Layout One' ),
                                            'img' => get_template_directory_uri() . '/images/customizer/carousel-one.jpg'
                                        ),
                                        'three'    => array(
                                            'label' => esc_html( 'Layout Three' ),
                                            'img' => get_template_directory_uri() . '/images/customizer/carousel-three.jpg'
                                        )
                                    );
                                ?>
                                <label><?php esc_html_e( 'Block Layouts', 'clean-design-blog' ) ?></label>
                                <p class="description"><?php esc_html_e( 'Choose from available layouts', 'clean-design-blog' ) ?></p>
                                <?php
                                    foreach( $layouts as $layout_key => $layout ) :
                                ?>
                                        <label class="radio-image-single <?php if( 'one' === $layout_key ) echo 'selected'; ?>" data-value="<?php echo esc_html($layout_key); ?>">
                                            <img src="<?php echo esc_url( $layout['img'] ); ?>"/>
                                        </label>
                                <?php
                                    endforeach;
                                ?>
                                <input type="hidden" class="block-repeater-control-field" data-name="layout" value="one"/>
                            </div>
                            <div class="customize-toggle-field checked-toggle-control">
                                <label><?php esc_html_e( 'Section show/hide', 'clean-design-blog' ) ?></label>
                                <div class="toggle-button">
                                    <span class="on_off_txt_wrap">
                                        <span class="on"><?php echo esc_html( 'ON', 'clean-design-blog' ); ?></span>
                                        <span class="off"><?php echo esc_html( 'OFF', 'clean-design-blog' ); ?></span>
                                    </span>
                                </div>
                                <input type="checkbox" class="block-repeater-control-field" data-name="option" checked/>
                            </div>
                            <div class="action-buttons">
                                <div class="close-block"><?php esc_html_e( 'Close', 'clean-design-blog' ); ?></div>
                                <div class="red-button remove-block"><?php esc_html_e( 'Remove', 'clean-design-blog' ); ?></div>
                            </div>
                        </div>
                    </div>
                    <li class="posts-featured"><?php esc_html_e( 'Posts Featured', 'clean-design-blog' ); ?></li>
                    <div class="clean-design-blog-block posts-featured-block-wrap open" block-name="posts-featured">
                        <div class="block-header content-trigger">
                            <h2 class="block-header-title"><?php esc_html_e( 'Posts Featured', 'clean-design-blog' ); ?></h2>
                            <span class="block-header-icon"><i class="fas fa-chevron-up"></i></span>
                        </div>
                        <div class="block-content-wrap">
                            <div class="customize-text-field">
                                <label><?php esc_html_e( 'Block Title', 'clean-design-blog' ) ?></label>
                                <p class="description"><?php esc_html_e( 'Leave blank to hide title', 'clean-design-blog' ) ?></p>
                                <input type="text" class="block-repeater-control-field" data-name="blockTitle" value="<?php echo esc_attr__( 'Posts Featured', 'clean-design-blog' ); ?>"/>
                            </div>
                            <div class="customize-select-field">
                                <label><?php esc_html_e( 'Category', 'clean-design-blog' ) ?></label>
                                <select class="block-repeater-control-field" data-name="category">
                                    <option value="" selected><?php esc_html_e( 'Select Category', 'clean-design-blog' ); ?></option>
                                    <?php
                                        foreach( $categories as $cat ) {
                                    ?>
                                            <option value="<?php echo esc_attr( $cat->slug ); ?>"><?php echo esc_html( $cat->name .' (' .$cat->count. ')' ); ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="customize-toggle-field">
                                <label><?php esc_html_e( 'Show date', 'clean-design-blog' ) ?></label>
                                <div class="toggle-button">
                                    <span class="on_off_txt_wrap">
                                        <span class="on"><?php echo esc_html( 'ON', 'clean-design-blog' ); ?></span>
                                        <span class="off"><?php echo esc_html( 'OFF', 'clean-design-blog' ); ?></span>
                                    </span>
                                </div>
                                <input type="checkbox" class="block-repeater-control-field" data-name="dateOption"/>
                            </div>
                            <div class="customize-toggle-field">
                                <label><?php esc_html_e( 'Show comment', 'clean-design-blog' ) ?></label>
                                <div class="toggle-button">
                                    <span class="on_off_txt_wrap">
                                        <span class="on"><?php echo esc_html( 'ON', 'clean-design-blog' ); ?></span>
                                        <span class="off"><?php echo esc_html( 'OFF', 'clean-design-blog' ); ?></span>
                                    </span>
                                </div>
                                <input type="checkbox" class="block-repeater-control-field" data-name="commentOption"/>
                            </div>
                            <div class="customize-radio-image-field">
                                <?php
                                    $layouts = array(
                                        'one'    => array(
                                            'label' => esc_html( 'Layout One' ),
                                            'img' => get_template_directory_uri() . '/images/customizer/feature-post-one.jpg'
                                        ),
                                        'two'    => array(
                                            'label' => esc_html( 'Layout Two' ),
                                            'img' => get_template_directory_uri() . '/images/customizer/feature-post-two.jpg'
                                        )
                                    );
                                ?>
                                <label><?php esc_html_e( 'Block Layouts', 'clean-design-blog' ) ?></label>
                                <p class="description"><?php esc_html_e( 'Choose from available layouts', 'clean-design-blog' ) ?></p>
                                <?php
                                    foreach( $layouts as $layout_key => $layout ) :
                                ?>
                                        <label class="radio-image-single <?php if( 'one' === $layout_key ) echo 'selected'; ?>" data-value="<?php echo esc_html($layout_key); ?>">
                                            <img src="<?php echo esc_url( $layout['img'] ); ?>"/>
                                        </label>
                                <?php
                                    endforeach;
                                ?>
                                <input type="hidden" class="block-repeater-control-field" data-name="layout" value="one"/>
                            </div>
                            <div class="customize-toggle-field checked-toggle-control">
                                <label><?php esc_html_e( 'Section show/hide', 'clean-design-blog' ) ?></label>
                                <div class="toggle-button">
                                    <span class="on_off_txt_wrap">
                                        <span class="on"><?php echo esc_html( 'ON', 'clean-design-blog' ); ?></span>
                                        <span class="off"><?php echo esc_html( 'OFF', 'clean-design-blog' ); ?></span>
                                    </span>
                                </div>
                                <input type="checkbox" class="block-repeater-control-field" data-name="option" checked/>
                            </div>
                            <div class="action-buttons">
                                <div class="close-block"><?php esc_html_e( 'Close', 'clean-design-blog' ); ?></div>
                                <div class="red-button remove-block"><?php esc_html_e( 'Remove', 'clean-design-blog' ); ?></div>
                            </div>
                        </div>
                    </div>
                </ul>
            </div><!-- .blocks-repeater-control-wrap -->
            <input type="hidden" <?php esc_attr($this->link()); ?> class="blocks-repeater-control" value="<?php echo esc_attr($this->value()); ?>" />
    <?php
        }
    }
endif;