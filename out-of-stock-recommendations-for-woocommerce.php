<?php

/**
 * Plugin Name: Out of Stock Recommendations for WooCommerce
 * Plugin URI: https://github.com/mdmoore/out-of-stock-recommendatons-for-woocommerce
 * Description: Recommend a specific product when a product is out of stock
 * Author: Mike Moore
 * Author URI: https://github.com/mdmoore
 * Text Domain: out-of-stock-recommendations-for-woo
 * Version: 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Out_Of_Stock_Recommendations_For_WooCommerce' ) ) {
	/**
	 * Main class.
	 *
	 * @package Out_Of_Stock_Recommendations_For_WooCommerce
	 * @since   1.0.0
	 */
	class Out_Of_Stock_Recommendations_For_WooCommerce {

        /**
		 * Constructor.
		 * 
		 * @since   1.0.0
		 * @version 1.0.0
		 */
        public function __construct() {
            add_action( 'init', array( $this, 'includes' ) );
        }

        /**
         * Includes needed files
         * 
         * @since 1.0.0
         * @version 1.1.3
         */
        public function includes() {

            if ( is_admin() ) {
                require_once( dirname( __FILE__ ) .'/includes/class-osrfw-admin-product-meta.php' );
            }
        }

    }

    new Out_Of_Stock_Recommendations_For_WooCommerce();
}