<?php
/**
 * Theme admin page detail info
 * 
 * @package Clean Design Blog
 * @since 1.1.0
 */
if( !class_exists( 'Clean_Design_Blog_Theme_Info' ) ) :
    class Clean_Design_Blog_Theme_Info {
        /**
         * Variable
         */ 
        protected $theme_name;
        protected $version;
        protected $demofile;
        protected $importer_status;
        public $ajax_response = array();
        private static $_instance = null;

        /**
         * Ensures only one instance of the class is loaded or can be loaded
         * 
         * @access public
         * @static
         */
        public static function instance() {
            if( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }

        /**
         * Initial class load
         * 
         */
        function __construct() {
            $this->theme_name = esc_html( 'Clean Design Blog' );
            $this->version = '1.7.0';
            $this->demofile = include get_template_directory() . '/inc/admin/assets/demos.php';
            // some actions of welcome notice
            if( isset( $_GET['clean_design_blog_welcome_notice_dismiss'] ) ) {
                update_option( 'clean_design_blog_welcome_notice_dismiss', true );
            }
            //Add the theme page
            add_action( 'admin_menu', array( $this, 'add_theme_info_menu' ) );
            add_action( 'admin_notices', array( $this, 'add_welcome_admin_notice' ) );
            add_action( 'admin_enqueue_scripts', array( $this, 'theme_info_scripts' ) );
            add_action( 'wp_ajax_clean_design_blog_importer_plugin_action', array( $this, 'clean_design_blog_importer_plugin_action' ) );
        }

        /**
         * Enqueue scripts
         * 
         */
        function theme_info_scripts($hook) {
            $clean_design_blog_welcome_notice_dismiss = get_option( 'clean_design_blog_welcome_notice_dismiss' );
            if( !$clean_design_blog_welcome_notice_dismiss ) {
                wp_enqueue_style( 'clean-design-blog-welcome-notice', get_template_directory_uri() . '/inc/admin/assets/welcome-notice.css', array(), esc_attr( $this->version ), 'all' );
            }
            if( $hook != "appearance_page_clean-design-blog-info" ) {
                return;
            }
            wp_enqueue_style( 'clean-design-blog-info', get_template_directory_uri() . '/inc/admin/assets/info-page.css', array(), '1.1.0', 'all' );
            wp_enqueue_script( 'clean-design-blog-info', get_template_directory_uri() . '/inc/admin/assets/info-page.js', array( 'jquery' ), '1.1.0', true );
            wp_localize_script( 'clean-design-blog-info', 'articleThememInfoObject', array(
                'ajaxUrl'   => esc_url( admin_url( 'admin-ajax.php' ) ),
                '_wpnonce'  => wp_create_nonce( 'clean-design-blog-theme-info-nonce' )
            ));
        }

        /**
         * Register admin menu for theme info
         * 
         */
        function add_theme_info_menu() {
            $theme_info = add_theme_page( 
                esc_html__( 'Clean Design Blog Info', 'clean-design-blog' ), 
                esc_html__( 'Clean Design Blog Info','clean-design-blog' ), 
                'manage_options', 
                'clean-design-blog-info.php', 
                array( $this, 'info_page_callback' )
            );
        }

        /**
         * Theme info page callback
         * 
         * renders the theme info structure
         */
        function info_page_callback() {
        ?>
            <div id="theme-info-admin">
                <div class="info-container">
                    <h2 class="info-title"><?php echo esc_html( $this->theme_name ). ' - ' . esc_attr( $this->version ); ?></h2>
                    <div class="info-block">
                        <a href="<?php echo esc_url('//doc.blazethemes.com/clean-design-blog/');?>" target="_blank" class="dashicons dashicons-book-alt info-icon"></a>
                        <p class="info-text">
                            <a href="<?php echo esc_url('//doc.blazethemes.com/clean-design-blog/');?>" target="_blank"><?php esc_html_e( 'Setup Tutorials', 'clean-design-blog' ); ?></a>
                        </p>
                    </div>
                    <div class="info-block">
                        <a href="<?php echo esc_url( '//blazethemes.com/theme/clean-design-blog/?section=themesingle_support_wrap' ); ?>" target="_blank" class="dashicons dashicons-sos info-icon"></a>
                        <p class="info-text">
                            <a href="<?php echo esc_url( '//blazethemes.com/theme/clean-design-blog/?section=themesingle_support_wrap' ); ?>" target="_blank"><?php esc_html_e('Support','clean-design-blog'); ?></a>
                        </p>
                    </div>
                    <div class="info-block">
                        <a href="<?php echo esc_url( '//blazethemes.com/theme/clean-design-blog/?section=themesingle_demo_wrap' ); ?>" target="_blank" class="dashicons dashicons-desktop info-icon"></a>
                        <p class="info-text">
                            <a href="<?php echo esc_url( '//blazethemes.com/theme/clean-design-blog/?section=themesingle_demo_wrap' ); ?>" target="_blank"><?php esc_html_e('Theme demo','clean-design-blog'); ?></a>
                        </p>
                    </div>
                    <div class="info-block">
                        <a href="<?php echo esc_url( '//wordpress.org/support/theme/clean-design-blog/reviews/?filter=5' ); ?>" target="_blank" class="dashicons dashicons-thumbs-up info-icon"></a>
                        <p class="info-text">
                            <a href="<?php echo esc_url( '//wordpress.org/support/theme/clean-design-blog/reviews/?filter=5' ); ?>" target="_blank"><?php esc_html_e('Leave a review','clean-design-blog'); ?></a>
                        </p>
                    </div>
                    <div class="info-block">
                        <a href="<?php echo esc_url( '//blazethemes.com/theme/clean-design-blog/?section=themesingle_free_pro_wrap' ); ?>" target="_blank" class="dashicons dashicons-editor-table info-icon"></a>
                        <p class="info-text">
                            <a href="<?php echo esc_url( '//blazethemes.com/theme/clean-design-blog/?section=themesingle_free_pro_wrap' ); ?>" target="_blank"><?php esc_html_e('Free vs PRO','clean-design-blog'); ?></a>
                        </p>
                    </div>
                </div><!-- .info-container -->
                <div class="theme-demos-listing">
                    <h2 class="info-title"><?php esc_html_e( 'Free and Premium Demos', 'clean-design-blog' ); ?></h2>
                    <div class="demo-importer-actions">
                        <?php
                            $this->importer_status = $this->plugin_active_status('blazethemes-demo-importer/blazethemes-demo-importer.php');
                            switch( $this->importer_status ) {
                                case 'inactive' : printf( esc_html__( 'Activate Blazethemes Demo Importer Now and Import any available demo in One Click', 'clean-design-blog') . ' %s', '<button class="clean-design-blog-importer-action-trigger" data-action="activate" data-process="' .esc_html( "Activating plugin" ). '">' .esc_html( 'Activate Plugin' ). '</button>' ); 
                                                break;
                                case 'install'  : printf( esc_html__( 'Install BlazeThemes Demo Importer and Import any available demo in One Click', 'clean-design-blog') . ' %s', '<button class="clean-design-blog-importer-action-trigger" data-action="install" data-process="' .esc_html( "Installing plugin" ). '">' .esc_html( 'Install and Activate Plugin' ). '</button>' );
                                                break;
                                        default: esc_html_e( 'All Ready for demo import!! Setup your site exactly like demo', 'clean-design-blog' );
                            }
                        ?>
                    </div>
                </div>
                <?php $this->theme_display_demos(); ?>
            </div><!-- #theme-info-admin -->
        <?php
        }

        /*
         *  Display the available demos
         */

        function theme_display_demos() {
            ?>
            <div class="wrap blazethemes-demo-importer-demo-importer-wrap">
                <?php
                if (is_array($this->demofile) && !is_null($this->demofile) && !empty($this->demofile)) {
                    $tags = array();
                    foreach ($this->demofile as $demo_slug => $demo_pack) {
                        if (isset($demo_pack['tags']) && is_array($demo_pack['tags'])) {
                            foreach ($demo_pack['tags'] as $key => $tag) {
                                $tags[$key] = $tag;
                            }
                        }
                    }
                    asort($tags);
                    
                    if ( !empty( $tags ) ) {
                        ?>
                        <div class="blazethemes-demo-importer-tab-filter blazethemes-demo-importer-clearfix">
                            <?php
                                if (!empty($tags)) {
                                    ?>
                                    <div class="blazethemes-demo-importer-tab-group" data-filter-group="tag">
                                        <div class="blazethemes-demo-importer-tab blazethemes-demo-importer-active" data-filter="*">
                                            <?php esc_html_e('All', 'clean-design-blog'); ?>
                                        </div>
                                    </div>
                                    <?php
                                }
                            ?>
                        </div>
                        <?php
                    }
                    ?>

                    <div class="blazethemes-demo-importer-demo-box-wrap wp-clearfix">
                        <?php
                        // Loop through Demos
                        foreach ($this->demofile as $demo_slug => $demo_pack) {
                            $tags = $class = '';
                            if (isset($demo_pack['tags'])) {
                                $tags = implode(' ', array_keys($demo_pack['tags']));
                            }

                            $classes = $tags;

                            $type = isset($demo_pack['type']) ? $demo_pack['type'] : 'free';
                            ?>
                            <div id="<?php echo esc_attr($demo_slug); ?>" class="blazethemes-demo-importer-demo-box <?php echo esc_attr($classes); ?>">
                                <div class="blazethemes-demo-importer-demo-elements">
                                    <?php if ($type == 'pro') { ?>
                                        <div class="premium_label">
                                            <?php esc_html_e( 'Premium', 'clean-design-blog' ); ?>
                                        </div>
                                    <?php } else{ ?>
                                        <div class="free_label"><?php esc_html_e( 'Free', 'clean-design-blog' ); ?></div>
                                    <?php } ?>

                                    <img src="<?php echo esc_url($demo_pack['image']); ?> ">

                                    <div class="blazethemes-demo-importer-demo-actions">
                                        <h4><?php echo esc_html($demo_pack['name']); ?></h4>
                                        <div class="blazethemes-demo-importer-demo-buttons">
                                            <a href="<?php echo esc_url($demo_pack['preview_url']); ?>" target="_blank" class="button">
                                                <?php echo esc_html__('Preview', 'clean-design-blog'); ?>
                                            </a>
                                            <?php
                                                if ( $type == 'pro' && ! strpos( get_option('stylesheet'), 'pro' ) ) {
                                                    $buy_url = isset($demo_pack['buy_url']) ? $demo_pack['buy_url'] : '#';
                                                ?>
                                                    <a target="_blank" href="<?php echo esc_url($buy_url) ?>" class="button button-primary">
                                                        <?php echo esc_html__('Buy Now', 'clean-design-blog') ?>
                                                    </a>
                                            <?php } else {
                                                        if( $this->importer_status === 'active' ) {
                                                ?>
                                                            <a href="#blazethemes-demo-importer-modal-<?php echo esc_attr($demo_slug) ?>" class="blazethemes-demo-importer-modal-button button button-primary">
                                                                <?php echo esc_html__('Install', 'clean-design-blog') ?>
                                                            </a>
                                            <?php 
                                                        }
                                                    }
                                            ?>
                                        </div>
                                    </div>
                                    <?php
                                        if( isset( $demo_pack['pagebuilder'] ) ) {
                                            foreach( $demo_pack['pagebuilder'] as $pagebuilder ) {
                                                echo '<h4 class="pagebuilder-label">' .esc_html( $pagebuilder ). '</h4>';
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                        <?php }
                        ?>
                    </div>
            <?php } else {
                    ?>
                    <div class="blazethemes-demo-importer-demo-wrap">
                        <?php esc_html_e("It looks like the config file for the demos is missing or conatins errors!. Demo install can't go futher!", 'clean-design-blog'); ?>  
                    </div>
                <?php }
                ?>

                <?php
                /* Demo Modals */
                if (is_array($this->demofile) && !is_null($this->demofile)) {
                    foreach ($this->demofile as $demo_slug => $demo_pack) {
                        ?>
                        <div id="blazethemes-demo-importer-modal-<?php echo esc_attr($demo_slug) ?>" class="blazethemes-demo-importer-modal" style="display: none;">

                            <div class="blazethemes-demo-importer-modal-header">
                                <h2><?php printf(esc_html('Import %s Demo', 'clean-design-blog'), esc_html($demo_pack['name'])); ?></h2>
                                <div class="blazethemes-demo-importer-modal-back"><span class="dashicons dashicons-no-alt"></span></div>
                            </div>

                            <div class="blazethemes-demo-importer-modal-wrap">
                                <p><?php echo sprintf(esc_html__('We recommend you backup your website content before attempting to import the demo so that you can recover your website if something goes wrong. You can use %s plugin for it.', 'clean-design-blog'), '<a href="https://wordpress.org/plugins/all-in-one-wp-migration/" target="_blank">' . esc_html__('All in one migration', 'clean-design-blog') . '</a>'); ?></p>

                                <p><?php echo esc_html__('This process will install all the required plugins, import contents and setup customizer and theme options.', 'clean-design-blog'); ?></p>

                                <div class="blazethemes-demo-importer-modal-recommended-plugins">
                                    <h4><?php esc_html_e('Required Plugins', 'clean-design-blog'); ?></h4>
                                    <p><?php esc_html_e('For your website to look exactly like the demo,the import process will install and activate the following plugin if they are not installed or activated.', 'clean-design-blog'); ?></p>
                                    <?php
                                    $plugins = isset( $demo_pack['plugins'] ) ? $demo_pack['plugins'] : '';

                                    if (is_array( $plugins ) ) {
                                        ?>
                                        <ul class="blazethemes-demo-importer-plugin-status">
                                            <?php
                                            foreach ( $plugins as $plugin ) {
                                                $name = isset( $plugin['name'] ) ? $plugin['name'] : '';
                                                $status = $this->plugin_active_status($plugin['file_path']);
                                                if ($status == 'active') {
                                                    $plugin_class = '<span class="dashicons dashicons-yes-alt"></span>';
                                                } else if ($status == 'inactive') {
                                                    $plugin_class = '<span class="dashicons dashicons-warning"></span>';
                                                } else {
                                                    $plugin_class = '<span class="dashicons dashicons-dismiss"></span>';
                                                }
                                                ?>
                                                <li class="blazethemes-demo-importer-<?php echo esc_attr($status); ?>">
                                                    <?php
                                                    echo $plugin_class . ' ' . esc_html($name) . ' - <i>' . $this->get_plugin_status($status) . '</i>';
                                                    ?>
                                                </li>
                                            <?php }
                                            ?>
                                        </ul>
                                        <?php
                                    } else {
                                        ?>
                                        <ul>
                                            <li><?php esc_html_e('No Required Plugins Found.', 'clean-design-blog'); ?></li>
                                        </ul>
                                        <?php
                                    }
                                    ?>
                                </div>

                                <div class="blazethemes-demo-importer-reset-checkbox">
                                    <h4><?php esc_html_e('Reset Website', 'clean-design-blog') ?></h4>
                                    <p><?php esc_html_e('Reseting the website will delete all your post, pages, custom post types, categories, taxonomies, images and all other customizer and theme option settings.', 'clean-design-blog') ?></p>
                                    <p><?php esc_html_e('It is always recommended to reset the database for a complete demo import.', 'clean-design-blog') ?></p>
                                    <label class="blazethemes-demo-importer-reset-website-checkbox">
                                        <input id="checkbox-reset-<?php echo esc_attr($demo_slug); ?>" type="checkbox" value='1' checked="checked"/>
                                        <?php echo esc_html('Reset Website - Check this box only if you are sure to reset the website.', 'clean-design-blog'); ?>
                                    </label>
                                </div>

                                <a href="javascript:void(0)" data-demo-slug="<?php echo esc_attr($demo_slug) ?>" class="button button-primary blazethemes-demo-importer-import-demo"><?php esc_html_e('Import Demo', 'clean-design-blog'); ?></a>
                                <a href="javascript:void(0)" class="button blazethemes-demo-importer-modal-cancel"><?php esc_html_e('Cancel', 'clean-design-blog'); ?></a>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
                <div id="blazethemes-demo-importer-import-progress" style="display: none">
                    <h2 class="blazethemes-demo-importer-import-progress-header"><?php echo esc_html__('Demo Import Progress', 'clean-design-blog'); ?></h2>

                    <div class="blazethemes-demo-importer-import-progress-wrap">
                        <div class="blazethemes-demo-importer-import-loader">
                            <div class="blazethemes-demo-importer-loader-content">
                                <div class="blazethemes-demo-importer-loader-content-inside">
                                    <div class="blazethemes-demo-importer-loader-rotater"></div>
                                    <div class="blazethemes-demo-importer-loader-line-point"></div>
                                </div>
                            </div>
                        </div>
                        <div class="blazethemes-demo-importer-import-progress-message"></div>
                    </div>
                </div>
            </div>
            <?php
        }

        /** 
         * Check if Plugin is active or not
         */
        function plugin_active_status($file_path) {
            $status = 'install';
            $plugin_path = WP_PLUGIN_DIR . '/' . esc_attr($file_path);

            if (file_exists($plugin_path)) {
                $status = is_plugin_active($file_path) ? 'active' : 'inactive';
            }

            return $status;
        }

        public function get_plugin_status($status) {
            switch ($status) {
                case 'install':
                    $plugin_status = esc_html__('Not Installed', 'clean-design-blog');
                    break;

                case 'active':
                    $plugin_status = esc_html__('Installed and Active', 'clean-design-blog');
                    break;

                case 'inactive':
                    $plugin_status = esc_html__('Installed but Not Active', 'clean-design-blog');
                    break;
            }
            return $plugin_status;
        }

        /**
         * Activate or install importer plugin 
         * 
         */
        function clean_design_blog_importer_plugin_action() {
            check_ajax_referer( 'clean-design-blog-theme-info-nonce', '_wpnonce' );
            $_plugin_action = isset( $_REQUEST['plugin_action'] ) ? sanitize_text_field( $_REQUEST['plugin_action'] ) : '';
            $file_path = 'blazethemes-demo-importer/blazethemes-demo-importer.php';
            if( $_plugin_action === 'activate' ) {
                if( $file_path ) {
                    activate_plugin( $file_path, '', false, true );
                }
                $this->ajax_response['status'] = true;
                $this->ajax_response['message'] = esc_html__( 'Demo importer plugin activated', 'clean-design-blog' );
                $this->send_ajax_response();
            } else if( $_plugin_action === 'install' ) {
                $download_link = esc_url( 'demo.blazethemes.com/blazethemes-demo-importer/blazethemes-demo-importer.zip' );
                // Include required libs for installation
                require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
                require_once ABSPATH . 'wp-admin/includes/class-wp-ajax-upgrader-skin.php';
                require_once ABSPATH . 'wp-admin/includes/class-plugin-upgrader.php';
                $skin = new WP_Ajax_Upgrader_Skin();
                $upgrader = new Plugin_Upgrader($skin);
                $upgrader->install( $download_link );
                activate_plugin( $file_path, '', false, true );
                $this->ajax_response['status'] = true;
                $this->ajax_response['message'] = esc_html__( 'Demo importer plugin installed and activated', 'clean-design-blog' );
                $this->send_ajax_response();
            }
            $this->ajax_response['status'] = false;
            $this->ajax_response['message'] = esc_html__( 'Error while trying to install or active the plugin.', 'clean-design-blog' );
            $this->send_ajax_response();
        }

        public function send_ajax_response() {
            $json = wp_json_encode( $this->ajax_response );
            echo $json;
            die();
        }

        /**
         * Add welcome notice to the admin dashboard
         * 
         * @since 1.1.0
         */
        function add_welcome_admin_notice() {
            if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );
            $clean_design_blog_welcome_notice_dismiss = get_option( 'clean_design_blog_welcome_notice_dismiss' );
            if( $clean_design_blog_welcome_notice_dismiss ) {
                return;
            }

            if( isset( $_GET['page'] ) ) {
                if( $_GET['page'] == 'clean-design-blog-info.php' ) {
                    return;
                }
            }
        ?>
            <div class="clean-design-blog-welcome-notice notice notice-info is-dismissible">
                <h2><?php esc_html_e( 'Clean Design Blog Welcome Notice', 'clean-design-blog' ); ?></h2>
                <div class="notice-content-wrap">
                    <div class="screenshot-wrap">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/screenshot.png' ); ?>" height="200" height="200"/>
                    </div>
                    <div class="notice-content">
                        <span class="notice-highlight"><?php esc_html_e( 'You have successfully activated Clean Design Blog !! ', 'clean-design-blog' ); ?></span>
                        <p><?php esc_html_e( 'Get started with multipurpose magazine theme and give your site a new look. We recommend you to please go through the documentation to get started with theme and setup homepage quicky.', 'clean-design-blog' ); ?></p>
                        <div class="notice-actions">
                            <a class="button button-primary load-customize hide-if-no-customize" href="<?php echo esc_url( get_admin_url() . '/themes.php?page=clean-design-blog-info.php' ); ?>"><?php esc_html_e( 'Install Demos', 'clean-design-blog' ); ?></a>
                            <a class="button button-primary load-customize hide-if-no-customize" target="_blank" href="<?php echo esc_url( get_admin_url( '', 'customize.php' ) ); ?>"><?php esc_html_e( 'Customize Site', 'clean-design-blog' ); ?></a>
                            <a class="button button-primary load-customize hide-if-no-customize" target="_blank" href="<?php echo esc_url( '//doc.blazethemes.com/clean-design-blog/ '); ?>"><?php esc_html_e( 'Documentation', 'clean-design-blog' ); ?></a>
                        </div>
                    </div>
                </div><!-- .notice-content-wrap -->
                <div class="notice-dismiss-button">
                    <a class="" href="<?php echo esc_attr( '?clean_design_blog_welcome_notice_dismiss=1' ); ?>"><?php esc_html_e( 'Dismiss this notice', 'clean-design-blog' ); ?></a>
                </div>
            </div>
            <?php
        }
    }
    Clean_Design_Blog_Theme_Info::instance();
endif;