<?php

add_action( 'wp_enqueue_scripts', 'molla_child_css', 1001 );


// Preload and cache mobile menu - enqueue my own main.js - Ark
/* function my_theme_scripts() {
    wp_dequeue_script('molla-main'); // Dequeue the original script
    wp_enqueue_script('my-main', get_stylesheet_directory_uri() . '/js/my-main.js', array('jquery'), '1.0.0', true); // Enqueue your modified script
}
add_action('wp_enqueue_scripts', 'my_theme_scripts');
*/


// Country redirect - Ark
/// Create a new settings page under the "Settings" menu in the WordPress admin
function custom_country_redirect_menu() {
    add_options_page(
        'Country Redirect',
        'Country Redirect',
        'manage_options',
        'custom-country-redirect',
        'custom_country_redirect_options_page'
    );
}
add_action('admin_menu', 'custom_country_redirect_menu');
/// Define the HTML output for the settings page
function custom_country_redirect_options_page() {
    ?>
    <div class="wrap">
        <h1>Country Redirect Settings</h1>
        <form action="options.php" method="post">
            <?php
            settings_fields('custom_country_redirect_options');
            do_settings_sections('custom_country_redirect');
            submit_button('Save Settings');
            ?>
        </form>
    </div>
    <?php
}
/// Register settings and create the settings fields
function custom_country_redirect_settings_init() {
    register_setting('custom_country_redirect_options', 'custom_country_redirect_options');

    add_settings_section(
        'custom_country_redirect_section',
        'Manage Country Redirects',
        '',
        'custom_country_redirect'
    );

    add_settings_field(
        'restricted_countries',
        'Restricted Countries',
        'custom_country_redirect_countries_cb',
        'custom_country_redirect',
        'custom_country_redirect_section'
    );

    add_settings_field(
        'redirect_rules',
        'Redirect Rules',
        'custom_country_redirect_rules_cb',
        'custom_country_redirect',
        'custom_country_redirect_section'
    );
}
add_action('admin_init', 'custom_country_redirect_settings_init');
/// Create a callback function for the new "Restricted Countries" field
function custom_country_redirect_countries_cb() {
    $options = get_option('custom_country_redirect_options');
    $restricted_countries = isset($options['restricted_countries']) ? $options['restricted_countries'] : '';
    ?>
    <input id="restricted_countries" name="custom_country_redirect_options[restricted_countries]" type="text" value="<?php echo esc_attr($restricted_countries); ?>" size="50" />
    <p><small>Enter the restricted countries separated by commas. Example: US, DE</small></p>
    <?php
}
/// Create a callback function to output the settings fields
function custom_country_redirect_rules_cb() {
    $options = get_option('custom_country_redirect_options');
    $redirect_rules = isset($options['redirect_rules']) ? $options['redirect_rules'] : '';
    ?>
    <textarea id="redirect_rules" name="custom_country_redirect_options[redirect_rules]" rows="10" cols="80"><?php echo esc_textarea($redirect_rules); ?></textarea>
    <p><small>Enter the redirect rules in JSON format. Example: { "collection": "https://target-website.com/path/collection/" }. If there are several rules, enter them inside the same brackets and separate with commas. To redirect all other pages where rules are not specified add rule "general": "https://target-website.com/"</small></p>
    <?php
}
/// redirect using the plugin data
function custom_country_redirect() {
    $geoip = geoip_detect2_get_info_from_current_ip();
    $country_code = $geoip->raw['country']['iso_code'];

    $options = get_option('custom_country_redirect_options');
    $restricted_countries = isset($options['restricted_countries']) ? explode(',', str_replace(' ', '', $options['restricted_countries'])) : [];
    $redirect_rules = isset($options['redirect_rules']) ? json_decode($options['redirect_rules'], true) : [];

    if (in_array($country_code, $restricted_countries)) {
        $general_redirect = isset($redirect_rules['general']) ? $redirect_rules['general'] : '';
        unset($redirect_rules['general']);

        $category_redirect_triggered = false;
        foreach ($redirect_rules as $collection => $url) {
            if (has_term($collection, 'product_cat')) {
                wp_redirect($url);
                exit;
            }
        }

        // Perform the general redirect if no category-specific redirects were triggered
        if (!$category_redirect_triggered && !empty($general_redirect)) {
            wp_redirect($general_redirect);
            exit;
        }
    }
}
add_action('wp', 'custom_country_redirect');


// Disable lazy load for main banner (and other images with class skip-lazy) - Ark
add_filter('wp_get_attachment_image_attributes', function($attr, $attachment) {
    if (strpos($attr['class'], 'skip-lazy') !== false) {
        $attr['loading'] = 'eager';
    }
    return $attr;
}, 10, 2);


// Use ACF fields as shortcodes [acf_materials], [acf_structure] - Ark 
function acf_materials_shortcode() {
    global $post;

    $materials = get_field('materials', $post->ID);
    
    if ($materials) {
        $materials_list = is_array($materials) ? implode(', ', $materials) : $materials;
        
        return $materials_list;
    }
}

add_shortcode('acf_materials', 'acf_materials_shortcode');

function acf_structure_shortcode() {
    global $post;

    $structure = get_field('structure', $post->ID);
    
    if ($structure) {
        $structure_list = is_array($structure) ? implode(', ', $structure) : $structure;
        
        return $structure_list;
    }
}

add_shortcode('acf_structure', 'acf_structure_shortcode');

// Add ACF shortcode for product buttons - Ark
function acf_product_icons_dress_shortcode() {
    $global_settings_id = get_page_by_path('global-settings')->ID;
    $reusable_html = get_field('product_icons_dress', $global_settings_id);
    return $reusable_html;
}
add_shortcode('acf_product_icons_dress', 'acf_product_icons_dress_shortcode');


// Force caching - Ark
add_filter( 'litespeed_const_DONOTCACHEPAGE', '__return_false' );

// Load CSS
function molla_child_css() {
	// molla child theme styles
	wp_deregister_style( 'styles-child' );
	wp_register_style( 'styles-child', esc_url( get_stylesheet_directory_uri() ) . '/style.css' );
	wp_enqueue_style( 'styles-child' );
}

// Fix widgets error - Ark
add_filter( 'use_widgets_block_editor', '__return_false' );

// Add video.js libary - Ark
function enqueue_videojs() {
    wp_register_script( 'video-js', 'https://vjs.zencdn.net/8.3.0/video.min.js', array(), false, true );
}
add_action( 'wp_enqueue_scripts', 'enqueue_videojs' );


// Enqueue video.js - Ark
function enqueue_custom_video_js() {
    wp_enqueue_script( 'custom-video', get_stylesheet_directory_uri() . '/custom-video.js', array(), false, true );
}
add_action( 'wp_enqueue_scripts', 'enqueue_custom_video_js' );



// Add magnific popup library to play video in a window - Ark
function enqueue_magnific_popup() {
    wp_register_style( 'magnific-popup', 'https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css' );
    wp_register_script( 'magnific-popup', 'https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js', array( 'jquery' ), '1.1.0', true );
}
add_action( 'wp_enqueue_scripts', 'enqueue_magnific_popup' );


// Add tabs in product edit for videos - Ark
/// Enqueue media uploader
function av_enqueue_media_uploader() {
    if ( 'product' != get_post_type() ) {
        return;
    }
    
    wp_enqueue_media();
    wp_enqueue_script( 'av-media-uploader', get_stylesheet_directory_uri() . '/js/av-media-uploader.js', array( 'jquery' ), '1.0', true );
}
add_action( 'admin_enqueue_scripts', 'av_enqueue_media_uploader' );
/// create a new meta box 
function av_create_video_meta_box() {
    add_meta_box(
        'av_video_meta_box',
        __('Custom Product Video', 'av-test-theme'),
        'av_video_meta_box_callback',
        'product',
        'side',
        'low'
    );
}
add_action('add_meta_boxes', 'av_create_video_meta_box');
/// render the input field for the video URL in the meta box
function av_video_meta_box_callback($post) {
    $video_url = get_post_meta($post->ID, 'video_url', true);
    wp_nonce_field(basename(__FILE__), 'av_video_nonce');

    echo '<label for="av-video-url">' . __('Video URL:', 'av-test-theme') . '</label>';
    echo '<input type="text" id="av-video-url" name="av_video_url" value="' . esc_attr($video_url) . '" size="25" />';
    echo '<input type="button" id="av-video-upload-btn" class="button" value="' . __('Upload', 'av-test-theme') . '" />';
}
/// Save the video URL when the product is saved
function av_save_video_url($post_id) {
    if (!isset($_POST['av_video_nonce']) || !wp_verify_nonce($_POST['av_video_nonce'], basename(__FILE__))) {
        return $post_id;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }

    if ('product' == $_POST['post_type'] && !current_user_can('edit_product', $post_id)) {
        return $post_id;
    }

    $video_url = isset($_POST['av_video_url']) ? $_POST['av_video_url'] : '';

    update_post_meta($post_id, 'video_url', $video_url);
}
add_action('save_post', 'av_save_video_url');



// Disable WordPress' automatic image scaling feature - Ark
add_filter( 'big_image_size_threshold', '__return_false' );

//remove SKU's - Ark
function sv_remove_product_page_skus( $enabled ) {
    if ( ! is_admin() && is_product() ) {
        return false;
    }
    return $enabled;
}
add_filter( 'wc_product_sku_enabled', 'sv_remove_product_page_skus' );


// * Remove product data tabs - Ark
add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
function woo_remove_product_tabs( $tabs ) {
    unset( $tabs['additional_information'] );  	// Remove the additional information tab
    return $tabs;
}

/* Remove Categories and share buttons from Single Products */ 
// remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
// 

// * do not remove nbsp - Ark 
function dmcg_allow_nbsp_in_tinymce( $init ) {
    $init['entities'] = '160,nbsp,38,amp,60,lt,62,gt';   
    $init['entity_encoding'] = 'named';
    return $init;
}
add_filter( 'tiny_mce_before_init', 'dmcg_allow_nbsp_in_tinymce' );

// Create a global shortcode for production time - Ark
function acf_production_time_shortcode() {
    /// Get the ID of the 'Global Settings' page. Replace 'global-settings' with the slug of your page.
    $global_settings_id = get_page_by_path('global-settings')->ID;
    /// Get the production time from the 'Global Settings' page
    $production_time = get_field('production_time', $global_settings_id);
    /// Return the production time
    return $production_time;
}
add_shortcode('acf_production_time', 'acf_production_time_shortcode');


/**
 * Hide shipping rates when free shipping is available.
 * Updated to support WooCommerce 2.6 Shipping Zones.
 *
 * @param array $rates Array of rates found for the package.
 * @return array
 */
function my_hide_shipping_when_free_is_available( $rates ) {
	$free = array();
	foreach ( $rates as $rate_id => $rate ) {
		if ( 'free_shipping' === $rate->method_id ) {
			$free[ $rate_id ] = $rate;
			break;
		}
	}
	return ! empty( $free ) ? $free : $rates;
}
add_filter( 'woocommerce_package_rates', 'my_hide_shipping_when_free_is_available', 100 );


// Tracking information for when the order is completed - Ark
/// Add a custom field to the order
add_action( 'add_meta_boxes', 'tracking_info_metabox' );
function tracking_info_metabox() {
    add_meta_box(
        'woocommerce-order-my-custom',
        __( 'Tracking Information' ),
        'order_tracking_info',
        'shop_order',
        'side',
        'default'
    );
}

function order_tracking_info( $post ) {
    $tracking = get_post_meta( $post->ID, '_tracking_info', true );
    echo '<input type="text" name="tracking_info" value="' . esc_attr( $tracking ) . '">';
}

add_action( 'save_post', 'save_tracking_info' );
function save_tracking_info( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( isset( $_POST['post_type'] ) && 'shop_order' == $_POST['post_type'] ) {
        update_post_meta( $post_id, '_tracking_info', wc_clean( $_POST[ 'tracking_info' ] ) );
    }
}
/// Require the tracking link to st the order as completed
add_action( 'woocommerce_order_status_changed', 'tracking_info_required', 20, 4 );
function tracking_info_required( $order_id, $old_status, $new_status, $order ) {
    if ( $new_status == 'completed' && empty( get_post_meta( $order_id, '_tracking_info', true ) ) ) {
        $order->update_status( $old_status );
        set_transient( 'display_tracking_info_error', true, 45 );
    }
}

add_action( 'admin_notices', 'tracking_info_required_notice' );
function tracking_info_required_notice() {
    if ( get_transient( 'display_tracking_info_error' ) ) {
        ?>
        <div class="notice notice-error is-dismissible">
            <p><?php _e( 'Error: A tracking link is required to complete the order.', 'my_textdomain' ); ?></p>
        </div>
        <?php
        delete_transient( 'display_tracking_info_error' );
    }
}
/// Display the tracking information in the order details
add_action( 'woocommerce_view_order', 'display_tracking_info', 5 );
function display_tracking_info( $order_id ) {
    $tracking = get_post_meta( $order_id, '_tracking_info', true );
    if ( $tracking ) {
        echo '<p>' . __( 'Tracking Information:' ) . ' <a href="' . esc_url( $tracking ) . '" target="_blank">' . __( 'Track your order' ) . '</a></p>';
    }
}
/// Create shortcode for the tracking link (to display it in email)
add_action( 'woocommerce_email_before_order_table', 'display_tracking_info_email', 10, 4 );
function display_tracking_info_email( $order, $sent_to_admin, $plain_text, $email ) {
    if ( ! $sent_to_admin && $email->id === 'customer_completed_order' ) {
        $tracking_info = $order->get_meta( '_tracking_info' );
        if ( $tracking_info ) {
            echo '<p>' . ' <a href="' . esc_url( $tracking_info ) . '" target="_blank">' . __( 'Track Your Order', 'textdomain' ) . '</a></p>';
			echo '<p>' . __( 'Thank you again, and please feel free to contact us!', 'textdomain' ) . '</p>';
        }
    }
}
/// Custom instructions for 'cash on delivery' method
add_action( 'woocommerce_email_before_order_table', 'display_custom_instructions_email', 10, 4 );
function display_custom_instructions_email( $order, $sent_to_admin, $plain_text, $email ) {
    if ( ! $sent_to_admin && $email->id === 'customer_processing_order' ) {
        // Check if the payment method is 'cash on delivery'
        if ( $order->get_payment_method() === 'cod' ) {
            $custom_instructions = 'You have selected the split payment option for your order. We require a 50% down payment, and the remaining balance will be due when the dress is ready, before shipping. We will send you the invoice and payment details for the initial 50% within 24 hours.';
            echo '<p>' . $custom_instructions . '</p>';
        }
    }
}

// Modify default sorting to take into account both sales and views - Ark

function av_test_theme_setup() {
    if ( ! wp_next_scheduled( 'av_calculate_weighted_values' ) ) {
        wp_schedule_event( time(), 'three_hours', 'av_calculate_weighted_values' );
    }

    wp_suspend_cache_addition(true); // Disable cache before updating

    function calculate_weighted_values() {
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => -1
        );
        $products = get_posts( $args );
        foreach ( $products as $product ) {
            $product_id = $product->ID;
            $sales = get_post_meta( $product_id, 'total_sales', true );
            $views = pvc_get_post_views($product_id); // Get actual views
            $menu_order = 0.8 * $sales + 0.2 * $views;

            // Multiply by -10 to avoid decimals and invert the order
            $menu_order = $menu_order * -10;

            // Update the 'menu_order' field
            wp_update_post( array(
                'ID' => $product_id,
                'menu_order' => $menu_order
            ) );
        }
        wp_suspend_cache_addition(false); // Re-enable cache after updating
    }
    add_action( 'av_calculate_weighted_values', 'calculate_weighted_values' );
}
add_action( 'wp_loaded', 'av_test_theme_setup' );
/// Add three_hours interval
function av_add_cron_interval( $schedules ) {
    $schedules['three_hours'] = array(
        'interval' => 3*60*60, // Number of seconds, 3 hours
        'display'  => __( 'Every 3 hours' ),
    );
    return $schedules;
}
add_filter( 'cron_schedules', 'av_add_cron_interval' );

/// Disable sort 'by popularity' (number of sales)
function av_custom_woocommerce_catalog_orderby( $sortby ) {
    unset($sortby['popularity']); // Remove "Sort by popularity"
    return $sortby;
}
add_filter('woocommerce_catalog_orderby', 'av_custom_woocommerce_catalog_orderby');


// Add 'All categories' to the category filter - Ark
add_filter( 'woocommerce_product_categories_widget_args', 'modify_product_categories_widget' );

function modify_product_categories_widget( $args ) {
    $args['show_option_all'] = 'ALL COLLECTIONS';
    $args['exclude'] = array( 74, 89 ); // Exclude 'sample sale (74) and 'all collections' (89) from the filter
    return $args;
}

// Fix jQuery passive listeners issue - Ark
function jquery_passive_listeners_fix() {
    wp_enqueue_script( 'jquery_pass_listeners_fix', get_stylesheet_directory_uri() . '/js/jquery-pass-lis.js', array( 'jquery' ), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'jquery_passive_listeners_fix' );

