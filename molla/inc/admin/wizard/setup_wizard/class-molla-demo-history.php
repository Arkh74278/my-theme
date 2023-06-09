<?php

/**
 * Manages Imported Demo content
 *
 * @since 1.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Molla_Demo_History {

	/**
	 * Constructor
	 *
	 * @access public
	 * @since 6.1.0
	 */
	public function __construct() {

		add_action( 'molla_importer_update_post', array( $this, 'add_import_symbol' ), 10, 2 );
		add_action( 'wp_import_insert_post', array( $this, 'add_import_symbol' ), 10, 2 );
		add_action( 'molla_importer_insert_attachment', array( $this, 'add_import_symbol' ), 10, 2 );
		add_action( 'molla_importer_insert_nav_menu_item', array( $this, 'add_import_symbol' ), 10, 2 );

		add_action( 'molla_importer_insert_term', array( $this, 'add_term_import_symbol' ), 10, 2 );
		add_action( 'molla_importer_update_term', array( $this, 'add_term_import_symbol' ), 10, 2 );
	}

	/**
	 * Add a meta value which indicates that this post wass imported from Molla demo sites
	 */
	public function add_import_symbol( $post_id, $old_id = false ) {
		$demo = ( isset( $_POST['demo'] ) && $_POST['demo'] ) ? $_POST['demo'] : '';
		update_post_meta( $post_id, '_molla_demo', sanitize_text_field( $demo ) . ( $old_id ? '#' . (int) $old_id : '' ) );
	}

	public function add_term_import_symbol( $term_id, $old_id = false ) {
		$demo = ( isset( $_POST['demo'] ) && $_POST['demo'] ) ? $_POST['demo'] : '';
		update_term_meta( $term_id, '_molla_demo', sanitize_text_field( $demo ) . ( $old_id ? '#' . (int) $old_id : '' ) );
	}
}
