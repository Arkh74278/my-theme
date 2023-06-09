<?php

// Molla Default Options

$molla_locations      = get_nav_menu_locations();
$molla_main_menu_id   = isset( $molla_locations['main_menu'] ) ? $molla_locations['main_menu'] : '';
$molla_main_menu_name = '';
if ( $molla_main_menu_id ) {
	$main_menu = wp_get_nav_menu_object( $molla_main_menu_id );
	if ( $main_menu ) {
		$molla_main_menu_name = wp_get_nav_menu_object( $molla_main_menu_id )->slug;
	}
}


if ( ! function_exists( 'molla_defaults' ) ) {

	function molla_defaults( $option ) {

		global $molla_main_menu_name;

		$default_op = array(
			// Navigator
			'navigator_items'                      => array(
				'custom_css'               => array( esc_html__( 'Style / Additional CSS & Script', 'molla' ), 'section' ),
				'header_presets'           => array( esc_html__( 'Header / Header Builder', 'molla' ), 'section' ),
				'style_menu'               => array( esc_html__( 'Menu / Menu Skins', 'molla' ), 'section' ),
				'woocommerce_product_type' => array( esc_html__( 'Woocommerce / Product Type', 'molla' ), 'section' ),
				'single_product'           => array( esc_html__( 'Woocommerce / Single Product Type', 'molla' ), 'section' ),
				'share'                    => array( esc_html__( 'Share', 'molla' ), 'section' ),
				'woocommerce_advanced'     => array( esc_html__( 'Woocommerce / Advanced', 'molla' ), 'section' ),
				'performance'              => array( esc_html__( 'Advanced / Performance', 'molla' ), 'section' ),
			),

			// General
			'loading_overlay'                      => false,
			'skeleton_screen'                      => false,
			'sidebar_width'                        => 25,
			'sidebar_sticky'                       => true,
			'google_map_key'                       => '',

			// Layout
			'body_layout'                          => 'full-width',
			'page_width'                           => 'container',
			'sidebar_option'                       => 'no',
			'container_width'                      => '',
			'grid_gutter_width'                    => '20',
			'content_bg'                           => array(
				'background-color' => '#fff',
			),
			'content_box_width'                    => '',
			'content_box_padding'                  => '',
			'frame_bg'                             => '',

			// Style
			'primary_color'                        => '#c96',
			'secondary_color'                      => '#a6c76c',
			'alert_color'                          => '#d9534f',
			'dark_color'                           => '#333',
			'light_color'                          => '#fff',
			'font_base'                            => array(
				'font-family'    => 'Poppins',
				'font-weight'    => 'regular',
				'font-size'      => '10px',
				'line-height'    => '1.5',
				'letter-spacing' => '0',
				'color'          => '#777',
				'text-transform' => 'none',
			),
			'font_base_mobile'                     => array(
				'font-size'      => '9px',
				'line-height'    => '1.3',
				'letter-spacing' => '0',
			),
			'font_heading_h1'                      => array(
				'font-family'    => 'inherit',
				'font-size'      => '2.6rem',
				'line-height'    => '1.1',
				'letter-spacing' => '-0.03em',
				'color'          => '#333333',
				'text-transform' => 'none',
			),
			'font_heading_h2'                      => array(
				'font-family'    => 'inherit',
				'font-size'      => '2.3rem',
				'line-height'    => '1.1',
				'letter-spacing' => '-0.03em',
				'color'          => '#333333',
				'text-transform' => 'none',
			),
			'font_heading_h3'                      => array(
				'font-family'    => 'inherit',
				'font-size'      => '2rem',
				'line-height'    => '1.1',
				'letter-spacing' => '-0.03em',
				'color'          => '#333333',
				'text-transform' => 'none',
			),
			'font_heading_h4'                      => array(
				'font-family'    => 'inherit',
				'font-size'      => '1.8rem',
				'line-height'    => '1.1',
				'letter-spacing' => '-0.03em',
				'color'          => '#333333',
				'text-transform' => 'none',
			),
			'font_heading_h5'                      => array(
				'font-family'    => 'inherit',
				'font-size'      => '1.7rem',
				'line-height'    => '1.1',
				'letter-spacing' => '-0.025em',
				'color'          => '#333333',
				'text-transform' => 'none',
			),
			'font_heading_h6'                      => array(
				'font-family'    => 'inherit',
				'font-size'      => '1.6rem',
				'line-height'    => '1.1',
				'letter-spacing' => '-0.01em',
				'color'          => '#333333',
				'text-transform' => 'none',
			),
			'font_heading_spacing'                 => array(
				'margin-top'    => '',
				'margin-bottom' => '',
				'margin-left'   => '',
				'margin-right'  => '',
			),
			'font_paragraph'                       => array(
				'font-family'    => 'inherit',
				'font-size'      => '1.4rem',
				'line-height'    => '1.8',
				'letter-spacing' => '0',
				'color'          => '#666',
				'text-transform' => 'none',
			),
			'font_paragraph_spacing'               => array(
				'margin-top'    => '',
				'margin-bottom' => '',
				'margin-left'   => '',
				'margin-right'  => '',
			),
			'font_nav_color'                       => '#c96',
			'font_nav_spacing'                     => array(
				'padding-top'    => '',
				'padding-bottom' => '',
				'padding-left'   => '',
				'padding-right'  => '',
			),
			'font_placeholder'                     => array(
				'font-family'    => 'inherit',
				'letter-spacing' => '0',
				'color'          => '#999',
				'text-transform' => 'none',
			),
			'font_custom_1'                        => array(
				'font-family' => 'inherit',
				'font-weight' => 400,
			),
			'font_custom_2'                        => array(
				'font-family' => 'inherit',
				'font-weight' => 400,
			),
			'font_custom_3'                        => array(
				'font-family' => 'inherit',
				'font-weight' => 400,
			),

			// Header
			'hb_options'                           => array(),
			'header_divider_active'                => false,
			'header_divider_color'                 => '#ebebeb',
			'header_top_divider_color'             => '',
			'header_main_divider_color'            => '',
			'header_bottom_divider_color'          => '',
			'header_width'                         => 'container',
			'header_position_fixed'                => 0,
			'header_color'                         => '',
			'header_bg'                            => array(
				'background-color' => '#fff',
			),
			'site_logo'                            => '',
			'site_retina_logo'                     => '',
			'logo_spacing'                         => array(
				'top'    => '1.5rem',
				'bottom' => '1.5rem',
				'left'   => '0px',
				'right'  => '0px',
			),
			'logo_spacing_sticky'                  => array(
				'top'    => '1.5rem',
				'bottom' => '1.5rem',
				'left'   => '0px',
				'right'  => '0px',
			),
			'logo_width'                           => '',
			'logo_width_sticky'                    => '',
			'logo_max_width'                       => '',
			'logo_max_width_sticky'                => '',
			'header_side'                          => '',
			'header_side_menu_type'                => '',
			'header_top_divider_active'            => true,
			'header_top_divider_width'             => '',
			'header_top_height'                    => 0,
			'header_top_color'                     => '',
			'header_top_bg'                        => '',
			'header_top_bg_sticky'                 => '',
			'header_main_divider_active'           => true,
			'header_main_divider_width'            => '',
			'header_main_height'                   => 15,
			'header_main_color'                    => '',
			'header_main_bg'                       => '',
			'header_main_bg_sticky'                => '',
			'header_bottom_divider_active'         => false,
			'header_bottom_divider_width'          => 'full',
			'header_bottom_height'                 => 0,
			'header_bottom_color'                  => '',
			'header_bottom_bg'                     => '',
			'header_bottom_bg_sticky'              => '',
			'header_sticky_show'                   => 1,
			'header_top_sticky_height'             => 0,
			'header_main_sticky_height'            => 10,
			'header_bottom_sticky_height'          => 0,
			'header_top_in_sticky'                 => 0,
			'header_main_in_sticky'                => 1,
			'header_bottom_in_sticky'              => 0,
			'header_search_style'                  => 'header-search-visible',
			'search_content_type'                  => 'all',
			'search_by_categories'                 => false,
			'search_placeholder'                   => 'Search...',
			'header_search_border'                 => 1,
			'header_search_border_color'           => '#ebebeb',
			'header_search_border_width'           => array(
				'top'    => '1px',
				'bottom' => '1px',
				'left'   => '1px',
				'right'  => '1px',
			),
			'header_search_border_radius'          => 0,
			'header_search_btn_type'               => '',
			'header_search_icon_left'              => false,
			'main_menu_skin'                       => 'skin1',
			'log_icon_class'                       => '',
			'log_in_label'                         => 'Log In',
			'log_out_label'                        => 'Log Out',
			'social_login'                         => false,
			'register_label'                       => 'Register',
			'show_register_label'                  => false,
			'header_social_type'                   => 'circle',
			'header_social_size'                   => 'small',
			'header_social_links'                  => array(
				'facebook',
				'twitter',
				'instagram',
				'pinterest',
			),
			'facebook'                             => '',
			'linkedin'                             => '',
			'twitter'                              => '',
			'instagram'                            => '',
			'youtube'                              => '',
			'pinterest'                            => '',
			'tumblr'                               => '',
			'whatsapp'                             => '',
			'shop_icons'                           => array(
				'account',
				'wishlist',
				'cart',
			),
			'shop_icons_spacing'                   => '',
			'shop_icons_divider'                   => 0,
			'cart_canvas_type'                     => false,
			'cart_canvas_open'                     => '',
			'shop_icon_type'                       => 'type-full',
			'shop_icon_label_type'                 => '',
			'shop_icon_label_hide'                 => 0,
			'shop_icon_label_account'              => 'Account',
			'shop_icon_label_wishlist'             => 'Wishlist',
			'shop_icon_label_cart'                 => 'Cart',
			'shop_icon_label_compare'              => 'Compare',
			'shop_icon_class_account'              => '',
			'shop_icon_class_wishlist'             => '',
			'shop_icon_class_cart'                 => '',
			'shop_icon_cart_price_show'            => 0,
			'top_nav_items'                        => array(
				'currency_switcher',
				'lang_switcher',
				'login-form',
			),

			// Menu
			'mobile_menu_skin'                     => '',
			'mobile_menus'                         => array( $molla_main_menu_name ),
			'skin1_menu_bg'                        => '',
			'skin1_menu_dropdown_bg'               => '',
			'skin1_menu_arrow'                     => true,
			'skin1_menu_divider'                   => false,
			'skin1_menu_divider_color'             => '#ebebeb',
			'skin1_menu_effect'                    => 'scale-eff bottom-scale-eff',
			'skin1_menu_ancestor_font'             => array(
				'font-family'    => 'inherit',
				'font-size'      => '1.4rem',
				'line-height'    => '1.5',
				'letter-spacing' => '-0.01em',
				'color'          => '#333333',
				'text-transform' => 'none',
			),
			'skin1_menu_ancestor_color'            => '',
			'skin1_menu_ancestor_margin'           => array(
				'top'    => '',
				'bottom' => '',
				'left'   => '',
				'right'  => '',
			),
			'skin1_menu_ancestor_padding'          => array(
				'top'    => '',
				'bottom' => '',
				'left'   => '',
				'right'  => '',
			),
			'skin1_menu_subtitle_font'             => array(
				'font-family'    => 'inherit',
				'font-size'      => '1.4rem',
				'line-height'    => '1.5',
				'letter-spacing' => '0',
				'color'          => '#333333',
				'text-transform' => 'uppercase',
			),
			'skin1_menu_subtitle_color'            => '',
			'skin1_menu_subtitle_margin'           => array(
				'top'    => '',
				'bottom' => '',
				'left'   => '',
				'right'  => '',
			),
			'skin1_menu_subtitle_padding'          => array(
				'top'    => '',
				'bottom' => '',
				'left'   => '',
				'right'  => '',
			),
			'skin1_menu_item_font'                 => array(
				'font-family'    => 'inherit',
				'font-size'      => '1.3rem',
				'line-height'    => '1.5',
				'letter-spacing' => '0',
				'color'          => '#999',
				'text-transform' => 'none',
			),
			'skin1_menu_item_color'                => '',
			'skin1_menu_item_margin'               => array(
				'top'    => '',
				'bottom' => '',
				'left'   => '',
				'right'  => '',
			),
			'skin1_menu_item_padding'              => array(
				'top'    => '',
				'bottom' => '',
				'left'   => '',
				'right'  => '',
			),
			'skin2_menu_bg'                        => array(
				'background-color' => '#222',
			),
			'skin2_menu_dropdown_bg'               => '',
			'skin2_menu_arrow'                     => true,
			'skin1_menu_divider'                   => false,
			'skin1_menu_divider_color'             => '#ebebeb',
			'skin2_menu_effect'                    => 'scale-eff',
			'skin2_menu_ancestor_font'             => array(
				'font-family'    => 'inherit',
				'font-size'      => '1.4rem',
				'line-height'    => '1.5',
				'letter-spacing' => '-0.01em',
				'color'          => '#fff',
				'text-transform' => 'uppercase',
			),
			'skin2_menu_ancestor_color'            => '',
			'skin2_menu_ancestor_margin'           => array(
				'top'    => '',
				'bottom' => '',
				'left'   => '',
				'right'  => '',
			),
			'skin2_menu_ancestor_padding'          => array(
				'top'    => '',
				'bottom' => '',
				'left'   => '',
				'right'  => '',
			),
			'skin2_menu_subtitle_font'             => array(
				'font-family'    => 'inherit',
				'font-size'      => '1.4rem',
				'line-height'    => '1.5',
				'letter-spacing' => '0',
				'color'          => '#333333',
				'text-transform' => 'uppercase',
			),
			'skin2_menu_subtitle_color'            => '',
			'skin2_menu_subtitle_margin'           => array(
				'top'    => '',
				'bottom' => '',
				'left'   => '',
				'right'  => '',
			),
			'skin2_menu_subtitle_padding'          => array(
				'top'    => '',
				'bottom' => '',
				'left'   => '',
				'right'  => '',
			),
			'skin2_menu_item_font'                 => array(
				'font-family'    => 'inherit',
				'font-size'      => '1.3rem',
				'line-height'    => '1.5',
				'letter-spacing' => '0',
				'color'          => '#999',
				'text-transform' => 'none',
			),
			'skin2_menu_item_color'                => '',
			'skin2_menu_item_margin'               => array(
				'top'    => '',
				'bottom' => '',
				'left'   => '',
				'right'  => '',
			),
			'skin2_menu_item_padding'              => array(
				'top'    => '',
				'bottom' => '',
				'left'   => '',
				'right'  => '',
			),
			'skin3_menu_bg'                        => '',
			'skin3_menu_dropdown_bg'               => '',
			'skin3_menu_arrow'                     => 0,
			'skin1_menu_divider'                   => false,
			'skin1_menu_divider_color'             => '#ebebeb',
			'skin3_menu_effect'                    => 'scale-eff',
			'skin3_menu_ancestor_font'             => array(
				'font-family'    => 'inherit',
				'font-size'      => '1.4rem',
				'line-height'    => '1.5',
				'letter-spacing' => '-0.01em',
				'color'          => '#333333',
				'text-transform' => 'none',
			),
			'skin3_menu_ancestor_color'            => '',
			'skin3_menu_ancestor_margin'           => array(
				'top'    => '',
				'bottom' => '',
				'left'   => '',
				'right'  => '',
			),
			'skin3_menu_ancestor_padding'          => array(
				'top'    => '',
				'bottom' => '',
				'left'   => '',
				'right'  => '',
			),
			'skin3_menu_subtitle_font'             => array(
				'font-family'    => 'inherit',
				'font-size'      => '1.4rem',
				'line-height'    => '1.5',
				'letter-spacing' => '0',
				'color'          => '#333333',
				'text-transform' => 'uppercase',
			),
			'skin3_menu_subtitle_color'            => '',
			'skin3_menu_subtitle_margin'           => array(
				'top'    => '',
				'bottom' => '',
				'left'   => '',
				'right'  => '',
			),
			'skin3_menu_subtitle_padding'          => array(
				'top'    => '',
				'bottom' => '',
				'left'   => '',
				'right'  => '',
			),
			'skin3_menu_item_font'                 => array(
				'font-family'    => 'inherit',
				'font-size'      => '1.3rem',
				'line-height'    => '1.5',
				'letter-spacing' => '0',
				'color'          => '#999',
				'text-transform' => 'none',
			),
			'skin3_menu_item_color'                => '',
			'skin3_menu_item_margin'               => array(
				'top'    => '',
				'bottom' => '',
				'left'   => '',
				'right'  => '',
			),
			'skin3_menu_item_padding'              => array(
				'top'    => '',
				'bottom' => '',
				'left'   => '',
				'right'  => '',
			),

			// Page title bar
			'page_header_show'                     => true,
			'page_header_bg'                       => array(
				'background-color' => '#fafafa',
				'background-image' => esc_url( MOLLA_URI . '/assets/images/page-header-bg.jpg' ),
				'background-size'  => 'cover',
			),
			'page_header_parallax'                 => false,
			'page_header_plx_speed'                => 4,
			'page_header_content'                  => 'subtitle',
			'breadcrumb_show'                      => true,
			'breadcrumb_width'                     => '',
			'breadcrumb_divider_active'            => true,
			'breadcrumb_divider_width'             => 'full',
			'breadcrumb_divider_color'             => '#ebebeb',

			//footer
			'footer_width'                         => 'container',
			'footer_divider_color'                 => '#ebebeb',
			'footer_bg'                            => '',
			'footer_font'                          => array(
				'font-family'    => 'inherit',
				'font-size'      => '1.4rem',
				'line-height'    => '1.86',
				'letter-spacing' => '0',
				'color'          => '#777',
				'text-transform' => 'none',
			),
			'footer_font_heading'                  => array(
				'font-family'    => 'inherit',
				'font-size'      => '1.4rem',
				'line-height'    => '1.5',
				'letter-spacing' => '0',
				'color'          => '#333333',
				'text-transform' => 'uppercase',
			),
			'footer_font_paragraph'                => array(
				'font-family'    => 'inherit',
				'font-size'      => '1.4rem',
				'line-height'    => '1.5',
				'letter-spacing' => '0',
				'color'          => '#777',
				'text-transform' => 'none',
			),
			'footer_tooltip_label'                 => '',
			'scroll_top_style'                     => '',                            //radio-image
			'scroll_top_pos'                       => '',                            //radio-image
			'scroll_top_icon'                      => '',
			'footer_block_name'                    => '',
			'footer_top_divider_active'            => true,
			'footer_top_divider_width'             => '',
			'footer_top_pt'                        => 30,
			'footer_top_pb'                        => 30,
			'footer_top_bg'                        => '',
			'footer_top_cols'                      => '6 + 6',
			'footer_main_divider_active'           => false,
			'footer_main_divider_width'            => '',
			'footer_main_padding_top'              => 30,
			'footer_main_padding_bottom'           => 30,
			'footer_main_bg'                       => '',
			'footer_main_cols'                     => '3 + 3 + 3 + 3',
			'footer_bottom_divider_active'         => true,
			'footer_bottom_divider_width'          => '',
			'footer_bottom_pt'                     => 30,
			'footer_bottom_pb'                     => 30,
			'footer_bottom_bg'                     => '',
			'footer_bottom_items'                  => array(
				'custom_html',
				'payments',
				'widget',
			),
			'footer_bottom_dir'                    => '',
			'footer_custom_html'                   => '<p class="text-center">' . sprintf( esc_html__( 'Copyright &copy; %1$s. All Rights Reserved.', 'molla' ), date_i18n( __( 'Y', 'molla' ) ) ) . '</p>',
			'footer_payment'                       => '',

			// Blog
			'single_blog_page_header'              => false,
			'blog_single_page_layout'              => 'custom',
			'blog_single_page_width'               => 'container',
			'blog_single_sidebar'                  => 'right',
			'blog_single_featured_image'           => true,
			'blog_single_meta'                     => false,
			'blog_single_category'                 => true,
			'blog_single_author_box'               => true,
			'blog_single_prev_next_nav'            => true,
			'blog_single_tag'                      => true,
			'blog_single_share'                    => true,
			'blog_single_related'                  => true,
			'blog_single_featured_image_type'      => 'inner-content',
			'blog_single_share_pos'                => '',
			'related_posts_cols'                   => 3,
			'related_posts_padding'                => 20,
			'related_posts_nav'                    => 0,
			'related_posts_dot'                    => 1,
			'related_posts_loop'                   => 0,
			'blog_entry_page_layout'               => 'custom',
			'blog_entry_page_width'                => 'container',
			'blog_entry_sidebar'                   => 'right',
			'blog_entry_layout'                    => 'grid',
			'blog_entry_cols'                      => 1,
			'blog_entry_filter'                    => false,
			'blog_filter_pos'                      => 'center',
			'blog_entry_type'                      => 'list',
			'blog_entry_align'                     => 'left',
			'blog_entry_visible_op'                => array(
				'f_image',
				'category',
				'content',
				'read_more',
			),
			'blog_img_width'                       => 5,
			'blog_view_more_type'                  => 'pagination',
			'related_posts_sort_by'                => 'random',
			'related_posts_sort_order'             => 'desc',
			'blog_excerpt_unit'                    => 'word',
			'blog_excerpt_length'                  => '40',
			'blog_more_label'                      => '',
			'blog_more_icon'                       => true,
			'blog_shadow_hover'                    => true,
			'entry_body_padding'                   => array(
				'top'    => '2rem',
				'bottom' => '2.5rem',
				'left'   => '2rem',
				'right'  => '2rem',
			),
			'font_entry_meta'                      => array(
				'font-family'    => 'inherit',
				'font-size'      => '1.2rem',
				'font-weight'    => '400',
				'line-height'    => '1.5',
				'letter-spacing' => '',
				'color'          => '#999',
				'text-transform' => 'none',
			),
			'entry_meta_margin'                    => array(
				'top'    => '',
				'bottom' => '.5rem',
				'left'   => '',
				'right'  => '',
			),
			'font_entry_title'                     => array(
				'font-family'    => 'inherit',
				'font-size'      => '1.8rem',
				'line-height'    => '1.25',
				'letter-spacing' => '-0.025em',
				'color'          => '#333',
				'text-transform' => 'none',
			),
			'entry_title_margin'                   => array(
				'top'    => '',
				'bottom' => '.5rem',
				'left'   => '',
				'right'  => '',
			),
			'font_entry_cat'                       => array(
				'font-family'    => 'inherit',
				'font-size'      => '1.2rem',
				'font-weight'    => '400',
				'line-height'    => '1.5',
				'letter-spacing' => '',
				'color'          => '#999',
				'text-transform' => 'none',
			),
			'entry_cat_margin'                     => array(
				'top'    => '',
				'bottom' => '2.5rem',
				'left'   => '',
				'right'  => '',
			),
			'font_entry_excerpt'                   => array(
				'font-family'    => 'inherit',
				'font-size'      => '',
				'line-height'    => '',
				'letter-spacing' => '',
				'color'          => '',
				'text-transform' => 'none',
			),
			'entry_excerpt_margin'                 => array(
				'top'    => '',
				'bottom' => '1.5rem',
				'left'   => '',
				'right'  => '',
			),
			'font_entry_view_more'                 => array(
				'font-family'    => 'inherit',
				'font-size'      => '',
				'line-height'    => '',
				'letter-spacing' => '-0.01em',
				'color'          => '',
				'text-transform' => 'none',
			),
			'entry_view_more_margin'               => array(
				'top'    => '',
				'bottom' => '',
				'left'   => '',
				'right'  => '',
			),
			'font_single_meta'                     => array(
				'font-family'    => 'inherit',
				'font-size'      => '1.3rem',
				'font-weight'    => '400',
				'line-height'    => '1.5',
				'letter-spacing' => '',
				'color'          => '#999',
				'text-transform' => 'none',
			),
			'single_meta_margin'                   => array(
				'top'    => '',
				'bottom' => '.5rem',
				'left'   => '',
				'right'  => '',
			),
			'font_single_title'                    => array(
				'font-family'    => 'inherit',
				'font-size'      => '2.8rem',
				'line-height'    => '1.25',
				'letter-spacing' => '-0.025em',
				'color'          => '#333',
				'text-transform' => 'none',
			),
			'single_title_margin'                  => array(
				'top'    => '',
				'bottom' => '.6rem',
				'left'   => '',
				'right'  => '',
			),
			'font_single_cat'                      => array(
				'font-family'    => 'inherit',
				'font-size'      => '1.3rem',
				'font-weight'    => '400',
				'line-height'    => '1.5',
				'letter-spacing' => '',
				'color'          => '#999',
				'text-transform' => 'none',
			),
			'single_cat_margin'                    => array(
				'top'    => '',
				'bottom' => '2.5rem',
				'left'   => '',
				'right'  => '',
			),

			// Woocommerce
			'shop_page_layout'                     => 'custom',
			'shop_page_width'                      => 'container',
			'shop_sidebar_type'                    => '',
			'shop_sidebar_pos'                     => 'left',
			'post_layout'                          => 'grid',
			'post_creative_layout'                 => 1,
			'post_creative_layout_height'          => '1100',
			'woocommerce_catalog_columns'          => 6,
			'catalog_columns'                      => 3,
			'shop_view_more_type'                  => 'pagination',
			'post_product_type'                    => 'default',
			'product_align'                        => 'left',
			'product_hover'                        => true,
			'product_vertical_animate'             => 'fade-left',
			'catalog_mode'                         => false,
			'product_show_op'                      => array(
				'name',
				'cat',
				'price',
				'rating',
				'cart',
				'quickview',
				'wishlist',
				'deal',
			),
			'public_product_show_op'               => array(
				'name',
				'cat',
				'desc',
			),
			'product_show_attrs'                   => array(),
			'product_read_more'                    => true,
			'quickview_pos'                        => '',
			'wishlist_pos'                         => '',
			'quickview_style'                      => 'horizontal',
			'wishlist_style'                       => '',
			'out_stock_style'                      => '',
			'product_icon_hide'                    => false,
			'product_label_hide'                   => false,
			'disable_product_out'                  => false,
			'action_icon_top'                      => false,
			'divider_type'                         => '',
			'divider_color'                        => '#e5e5e5',
			'post_category_type'                   => 'block',
			'product_deal_type'                    => 'block',
			'product_rating_icon'                  => '',
			'product_labels'                       => array(
				'featured',
				'onsale',
				'new',
				'outstock',
			),
			'product_label_type'                   => '',
			'new_product_period'                   => '7',
			'label_sale_format'                    => 'Sale',
			'stock_limit_count'                    => 5,
			'featured_label_color_mode'            => '',
			'featured_label_color_text'            => '#fff',
			'featured_label_color'                 => '#7dd2ea',
			'new_label_color_mode'                 => 'secondary_color',
			'new_label_color_text'                 => '#fff',
			'new_label_color'                      => '#a6c76c',
			'sale_label_color_mode'                => '',
			'sale_label_color_text'                => '#fff',
			'sale_label_color'                     => '#ef837b',
			'hurry_label_color_mode'               => 'alert_color',
			'hurry_label_color_text'               => '#fff',
			'hurry_label_color'                    => '#d9534f',
			'outstock_label_color_mode'            => '',
			'outstock_label_color_text'            => '#fff',
			'outstock_label_color'                 => '#ccc',
			'product_custom_style'                 => false,
			'font_product_cat'                     => array(
				'font-family'    => 'inherit',
				'font-size'      => '1.3rem',
				'line-height'    => '1.2',
				'letter-spacing' => '-0.01em',
				'color'          => '#666',
				'text-transform' => 'none',
			),
			'product_cat_margin'                   => array(
				'top'    => '',
				'bottom' => '.3rem',
				'left'   => '',
				'right'  => '',
			),
			'font_product_title'                   => array(
				'font-family'    => 'inherit',
				'font-size'      => '1.6rem',
				'line-height'    => '1.25',
				'letter-spacing' => '-0.01em',
				'color'          => '#333',
				'text-transform' => 'none',
			),
			'product_title_margin'                 => array(
				'top'    => '',
				'bottom' => '.2rem',
				'left'   => '',
				'right'  => '',
			),
			'font_product_price'                   => array(
				'font-family'    => 'inherit',
				'font-size'      => '1.6rem',
				'line-height'    => '1.25',
				'letter-spacing' => '-0.01em',
				'color'          => '#333',
				'text-transform' => 'none',
			),
			'product_price_margin'                 => array(
				'top'    => '',
				'bottom' => '1.3rem',
				'left'   => '',
				'right'  => '',
			),
			'new_price_color'                      => '#ef837b',
			'old_price_color'                      => '#ccc',
			'product_rating_margin'                => array(
				'top'    => '',
				'bottom' => '',
				'left'   => '',
				'right'  => '',
			),
			'single_product_page_header'           => false,
			'single_product_page_layout'           => '',
			'single_product_header_width'          => 'container',
			'single_product_width'                 => 'container',
			'single_product_sidebar'               => 'no',
			'single_product_footer_width'          => 'container',
			'single_product_layout'                => '',
			'single_product_image'                 => 'horizontal',
			'single_product_layout_slug'           => '',
			'single_product_image_wrap_col'        => 6,
			'single_product_image_slider_nav'      => 'owl-nav-inside',
			'single_product_image_slider_nav_type' => '',
			'single_product_image_col'             => 3,
			'single_product_image_slider_spacing'  => 10,
			'prevent_elevatezoom'                  => false,
			'single_sticky_bar_show'               => true,
			'single_product_center'                => false,
			'single_product_data_style'            => '',
			'single_product_tab_title'             => '',
			'single_product_tab_block'             => '',
			'single_related_show'                  => true,
			'single_related_layout_type'           => 'slider',
			'single_related_cols'                  => 4,
			'single_related_count'                 => 4,

			'woo_account_background'               => array(),

			'image_swatch'                         => false,
			'woo_pre_order'                        => false,
			'woo_pre_order_label'                  => esc_html__( 'Pre-Order Now', 'molla' ),
			'woo_pre_order_msg_date'               => esc_html__( 'Available Date: %s', 'molla' ),
			'woo_pre_order_msg_nodate'             => '',

			//share
			'share_icons'                          => array(
				'facebook',
				'twitter',
				'pinterest',
				'linkedin',
			),
			'share_icon_type'                      => 'circle',
			'share_icon_size'                      => 'small',

			// Advanced
			'lazy_load_img'                        => false,
			'lazy_load_img_back'                   => '#ccc',
			'live_search'                          => false,
			'lazy_load_menu'                       => false,
			'custom_image_size'                    => array(
				'Width'  => '',
				'Height' => '',
			),

			'pagination_pos'                       => 'center',
			'show_disabled_paginate'               => true,

			'error-block-name'                     => '',
		);

		if ( class_exists( 'WooCommerce' ) ) {
			foreach ( wc_get_attribute_taxonomies() as $key => $attr ) {
				if ( 'pick' == $attr->attribute_type ) {
					$default_op['product_show_attrs'][] = 'pa_' . $attr->attribute_name;
				}
			}
		}

		// Return default option if not empty
		if ( ! empty( $default_op[ $option ] ) ) {
			return $default_op[ $option ];
		}
	}
}
