<?php
/**
 * Theme inline styles with theme dynamic field values
 * 
 * @package Clean Design Blog
 * @since 1.0.0
 */
$primary_theme_color = get_theme_mod( 'primary_theme_color', '#d37fb0' ); // theme primary color
$top_header_bg_color = get_theme_mod( 'top_header_bg_color', '#D37FB0' );
$top_header_text_color = get_theme_mod( 'top_header_text_color' );

$header_bg_color = get_theme_mod( 'header_bg_color' );
$header_bg_img = get_header_image();
$header_search_icon_color = get_theme_mod( 'header_search_icon_color', '#D37FB0' );
// category colors 
$categories = get_categories();
foreach( $categories as $category ) :
	$category_color = get_theme_mod( 'category_' .esc_attr( $category->slug ) , '#000000' );
	$category_query = get_category_by_slug( $category->slug );
	if( $category_query ) {
		echo ".bmm-block-categories-collection--layout-three .categories-wrap .category-item.cat-" .esc_attr( $category_query->cat_ID ).  "{ background-color : " .esc_attr( $category_color ). "35 }\n";
		echo ".bmm-block .bmm-post-cats-wrap .bmm-post-cat.bmm-cat-" .esc_attr( $category_query->cat_ID ). "{ background-color : " .esc_attr( $category_color ). ";}\n";
		echo ".bmm-block .bmm-post-cats-wrap .bmm-post-cat.bmm-cat-" .esc_attr( $category_query->cat_ID ). "{ color : " .esc_attr( $category_color ). ";}\n";
		echo ".bmm-post .bmm-post-cat a.bmm-cat-" .esc_attr( $category_query->cat_ID ). "{ color : " .esc_attr( $category_color ). ";}\n";
		echo ".posts-list-wrap .post-content-wrap .post-cats-wrap .bmm-post-cat.bmm-cat-" .esc_attr( $category_query->cat_ID ). "{ color : " .esc_attr( $category_color ). ";}\n";
	}
endforeach;

// footer settings
$footer_bg_color = get_theme_mod( 'footer_bg_color', '#2c2c2c' );
$footer_text_color = get_theme_mod( 'footer_text_color', '#ffffff' );
$bottom_footer_bg_color = get_theme_mod( 'bottom_footer_bg_color', '#f7f7f7' );
$bottom_footer_text_color = get_theme_mod( 'bottom_footer_text_color', '#020202' );

// main menu
	$menu_border_top = get_theme_mod( 'main_menu_border_top_color', '#D37FB0' );
	$menu_border_bottom = get_theme_mod( 'main_menu_border_bottom_color', '#d5d5d5' );
	$sidebar_toggle_icon = get_theme_mod( 'header_sidebar_toggle_icon_color', '#D37FB0' );
	$header_search_icon_color = get_theme_mod( 'header_search_icon_color', '#666666' );

	echo ".menu_search_wrap_inner { border-top: 2px solid ". esc_attr($menu_border_top) ."; border-bottom-color: ". esc_attr($menu_border_bottom)." }";
	echo "header .hamburger div { background: ". esc_attr($sidebar_toggle_icon) ."!important;}";

	echo ".header-search-bar .form-group input { border: 1px solid ". esc_attr($header_search_icon_color) .";}";

	echo ".header-search-bar .fa-search, .header_search_icon .fa-search { color: ". esc_attr($header_search_icon_color) .";}";
	echo ".menu_search_wrap_inner { box-shadow: none; }";
	// Mobile Menu
	echo "#site-navigation {border-bottom-color:" . esc_attr($menu_border_top) . "}"."\n";
	echo "/*------- Top Header color settings ------------*/\n";
	echo "#blaze-top-header{ background-color: " . esc_attr($top_header_bg_color) . "; }";

	echo "#blaze-top-header #top-header-menu li a,#blaze-top-header .top-header-date_outerwrap .top-header-date, #blaze-top-header .top-header-social-icons i,#blaze-top-header .top-header-tags a { color: ". esc_attr($top_header_text_color)." !important}";

	//echo ".top-header-social-icons i { color: ". esc_attr($top_header_text_color)." }";
	if( get_header_image() ) {
		echo ".mainsite--box-layout .site-branding-section-wrap .container .row{ background-image:url(" . esc_url( get_header_image() ) .");}";

		echo ".mainsite--full-layout .site-branding-section-wrap .container{ background-image:url(" .esc_url( get_header_image() ). ");}";
	}

	echo ".mainsite--box-layout .site-branding-section-wrap .container .row{ background-color:". esc_attr($header_bg_color).";}";
	echo ".mainsite--full-layout .site-branding-section-wrap { background-color:". esc_attr($header_bg_color).";}";
	echo ".site-branding-section-wrap .top-header-social-icons i,.site-branding-section-wrap  #top-header-menu i, .site-branding-section-wrap .top-header-social-icons i{color:" .esc_attr( $header_search_icon_color ). "}";

	// $header_middle_text_color = get_theme_mod('header_textcolor','#000000');
	// echo ".site-branding-section-wrap ul#top-header-menu {color: ".esc_attr($header_middle_text_color)."!important;}";

	$mobile_menu_toggle_background_color = get_theme_mod( 'mobile_menu_toggle_background_color', '#d37fb0' );
	$mobile_menu_toggle_bar_color = get_theme_mod( 'mobile_menu_toggle_bar_color', '#ffffff' );

	echo '#masthead button.menu-toggle{ background-color:' .esc_attr( $mobile_menu_toggle_background_color ). '; color: ' .esc_attr( $mobile_menu_toggle_bar_color ). ' }';

	echo "/*------- Footer color settings ------------*/\n";
	echo ".site-footer .widget { color:". esc_attr($footer_text_color) ."; }";
	echo ".site-footer .widget h2, .footer-inner .widget_nav_menu li a, .site-footer .widget p, .site-footer .widget a, .site-footer .widget h3  { color: ". esc_attr($footer_text_color). "!important;}";
	echo ".footer-inner .footer-widget h2:after { background-color:". esc_attr($footer_text_color). ";}";
	echo "#bottom-footer{ background-color: ".esc_attr($bottom_footer_bg_color).";}";
	echo "#bottom-footer a,#bottom-footer .bottom-footer-inner .bottom-footer-menu ul li:after,  #bottom-footer a:after, #bottom-footer i, #bottom-footer .site-info { color: ".esc_attr($bottom_footer_text_color).";}";

	// Theme color
	$primary_theme_color = get_theme_mod('primary_theme_color', '#d37fb0');
	echo '.bmm-block-banner-slider--layout-two .slick-dots li.slick-active button:before,
	figure .author-tag,
	.bmm-block-banner-slider--layout-three.bmm-banner-slider-block .slick-dots li.slick-active button:before,
	.bmm-block-banner-slider--layout-two.bmm-banner-slider-block .slick-dots li.slick-active button:before,
	body.widget-title-layout-one .bmm-block-title span:after,
	.bmm-block-post-grid-alter--layout-three .bmm-post-wrapper > article.bmm-post.no-thumb .content_meta_wrap,
	.widget_clean_design_blog_social_icons_widget .social-wrap a 
	{
    background-color: '.esc_attr($primary_theme_color).'!important;
	}';
	echo '.bmm-read-more-two a:after{ color: ' .esc_attr( $primary_theme_color ). '!important }';
	echo '.woocommerce ul.products li.product .price {color:' .esc_attr($primary_theme_color).'!important;}';

	echo '.woocommerce span.onsale, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button {
		background-color:'.esc_attr($primary_theme_color).'!important;
	}';

	echo '.header--layout-three .header-search-wrap{ border: 1px solid '.esc_attr($primary_theme_color).';
    border-top: 4px solid'.esc_attr($primary_theme_color).';}';

    echo '.header--layout-three .header-search-wrap .fa.fa-search, .container .slick-dots li.slick-active button:before {color:'.esc_attr($primary_theme_color).';}';

	echo '.banner-slider-item.no-thumb .bmm-post-slider-img { background-color: '.esc_attr($primary_theme_color).'!important;}';

	echo '.bmm-post.no-thumb .post-thumb-wrap, .bmm-block-post-carousel--layout-three .slick-track .slick-slide.no-thumb { background-color:'. esc_attr($primary_theme_color).'; border-radius: 30px; height: 50%;}';

	echo '.bmm-post-title a:hover {color: '.esc_attr($primary_theme_color).';}';

	echo 'body .bmm-banner-slider-block .prev-icon,
	body .bmm-banner-slider-block .next-icon,
	.bmm-banner-slider-block .slick-dots li.slick-active button:before,
	.bmm-post-date a:before,
	.bmm-post-comments-wrap a:before,
	.wp-block-latest-posts li a:before, .wp-block-archives li a:before, .wp-block-page-list li a:before, .widget_nav_menu ul li a:before, .widget_categories ul li a:before, .wp-block-latest-comments__comment footer:before, .widget_archive ul li a:before, .widget_recent_entries ul li a:before,
	.trail-item:before{ color:'. esc_attr($primary_theme_color) .'!important;}';

	echo '.bmm-block-title span,
	.bmm-block-banner-slider--layout-three .banner-slider-item .bmm-post-content-wrap 
	{border-color: '. esc_attr($primary_theme_color) .'!important}';