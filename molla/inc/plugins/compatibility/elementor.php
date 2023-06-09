<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Molla_Compatibility_Elementor' ) ) :

	/**
	 * Compatibility Class for Elementor
	 */

	class Molla_Compatibility_Elementor {

		public function __construct() {
			if ( ! defined( 'ELEMENTOR_VERSION' ) ) {
				return;
			}

			if ( defined( 'ELEMENTOR_PRO_VERSION' ) ) {
				// Do header.php actions when elementor's header is using.
				add_action( 'elementor/theme/before_do_header', array( $this, 'before_elementor_header' ) );
				add_action( 'elementor/theme/after_do_header', array( $this, 'after_elementor_header' ) );

				// Do footer.php actions when elementor's footer is using.
				add_action( 'elementor/theme/before_do_footer', array( $this, 'before_elementor_footer' ) );
				add_action( 'elementor/theme/after_do_footer', array( $this, 'after_elementor_footer' ) );
			}

			// Initialize elementor global settings as theme settings.
			add_action( 'molla_demo_imported', array( $this, 'init_options' ), 99 );
			add_action( 'customize_save_after', array( $this, 'init_options' ), 99 );
		}

		/**
		 * Before Elementor Header
		 */
		public function before_elementor_header() {

			wp_body_open();
			do_action( 'molla_body_after_start' );

			if ( molla_option( 'loading_overlay' ) ) : ?>
				<div class="loading-overlay">
					<div class="bounce-loader">
						<div class="bounce1"></div>
						<div class="bounce2"></div>
						<div class="bounce3"></div>
					</div>
				</div>
			<?php endif; ?>

			<div class="page-wrapper">
			<?php
		}

		/**
		 * After Elementor Header
		 */
		public function after_elementor_header() {
			?>
			<div class="main">
				<?php do_action( 'page_content_before' ); ?>
				<div class="page-content<?php echo esc_attr( ' ' . apply_filters( 'molla_page_content_class', '' ) ); ?>"<?php echo esc_attr( apply_filters( 'molla_page_content_attrs', '' ) ); ?>>
					<?php
					do_action( 'page_container_before', 'top' );
		}

		/**
		 * Before Elementor Footer
		 */
		public function before_elementor_footer() {

			if ( isset( $_POST['ajax_loadmore'] ) && $_POST['ajax_loadmore'] ) {
				return;
			}

			do_action( 'page_container_after', 'bottom' );
			?>
			</div>
			<?php get_template_part( 'template-parts/partials/scroll', 'top' ); ?>
			</div>
			<?php
		}

		/**
		 * After Elementor Footer
		 */
		public function after_elementor_footer() {
			echo '</div>';

			get_template_part( 'template-parts/header/header', 'mobile' );

			add_action( 'wp_footer', array( $this, 'after_wp_footer' ) );
		}

		/**
		 * After Elementor's wp_footer
		 */
		public function after_wp_footer() {
			do_action( 'molla_body_before_end' );
		}

		/**
		 * After theme options published.
		 */
		public function init_options( $add_kit = false ) {
			if ( version_compare( ELEMENTOR_VERSION, '3.0' ) < 0 ) {
				if ( '992' != get_option( 'elementor_viewport_lg', '1025' ) ) {
					update_option( 'elementor_viewport_lg', '992' );
					$changed = true;
				}
			} else {
				$default_kit = false;
				$kit         = Elementor\Plugin::$instance->kits_manager->get_active_kit();
				if ( ! $kit->get_id() && $add_kit ) {
					// Create elementor default kit
					$default_kit = Elementor\Plugin::$instance->kits_manager->create_default();
					if ( $default_kit ) {
						update_option( Elementor\Core\Kits\Manager::OPTION_ACTIVE, $default_kit );
					}
				} elseif ( $kit->get_id() ) {
					$default_kit = $kit->get_id();
				}

				if ( $default_kit ) {
					$general_settings = get_post_meta( $default_kit, '_elementor_page_settings', true );
					if ( empty( $general_settings ) ) {
						$general_settings = array();
					}
					$gutter          = molla_option( 'grid_gutter_width' );
					$container_width = molla_option( 'container_width' );
					$base_font       = molla_option( 'font_base' );
					if ( empty( $container_width ) ) {
						$container_width = '1188';
					}

					if ( ! empty( $base_font ) && isset( $base_font['font-family'] ) && ( ! isset( $general_settings['default_generic_fonts'] ) || $general_settings['default_generic_fonts'] != $base_font['font-family'] ) ) {
						$general_settings['default_generic_fonts'] = sanitize_text_field( $base_font['font-family'] );
						$changed                                   = true;
					}

					if ( ! empty( $container_width ) && ( empty( $general_settings['container_width'] ) || ! isset( $general_settings['container_width']['size'] ) || $general_settings['container_width']['size'] != $container_width ) ) {
						$general_settings['container_width'] = array(
							'size'  => (int) $container_width,
							'unit'  => 'px',
							'sizes' => array(),
						);
						$changed                             = true;
					}

					if ( ! get_option( '_molla_elementor_settings' ) && ! empty( $gutter ) && ( empty( $general_settings['space_between_widgets'] ) || ! isset( $general_settings['space_between_widgets']['size'] ) || $general_settings['space_between_widgets']['size'] != $gutter ) ) {
						$general_settings['space_between_widgets'] = array(
							'size'  => (int) $gutter,
							'unit'  => 'px',
							'sizes' => array(),
						);
						$changed                                   = true;
					}

					if ( ! isset( $general_settings['page_title_selector'] ) || 'h1.page-title' != $general_settings['page_title_selector'] ) {
						$general_settings['page_title_selector'] = 'h1.page-title';
						$changed                                 = true;
					}

					if ( ! isset( $general_settings['viewport_tablet'] ) || '991' != $general_settings['viewport_tablet'] || '991' != get_option( 'elementor_viewport_lg', '1025' ) ) {
						$general_settings['viewport_tablet'] = '991';
						update_option( 'elementor_viewport_lg', '991' );
						$changed = true;
					}

					if ( $changed ) {
						update_post_meta( $default_kit, '_elementor_page_settings', $general_settings );
					}
				}
			}

			if ( $changed ) {
				if ( ! get_option( '_molla_elementor_settings' ) ) {
					update_option( '_molla_elementor_settings', true );
				}
				try {
					\Elementor\Plugin::$instance->files_manager->clear_cache();
				} catch ( Exception $e ) {
				}
			}
		}
	}

	new Molla_Compatibility_Elementor;

endif;
