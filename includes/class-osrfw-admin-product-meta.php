<?php 

if ( ! class_exists( 'OSRFW_Admin_Product_Meta' ) ) {
    class OSRFW_Admin_Product_Meta {

        /**
		 * Constructor.
		 *
		 * @since   1.0.0
		 * @version 1.0.0
		 */
		public function __construct() {
            // Display the custom fields in the "Linked Products" section
            add_action( 'woocommerce_product_options_related', array( $this, 'woocom_linked_products_data_custom_field' ) );

            // Save to custom fields
            add_action( 'woocommerce_process_product_meta', array( $this, 'woocom_linked_products_data_custom_field_save' ) );
        }


        // Function to generate the custom fields
        public function woocom_linked_products_data_custom_field() {
            global $woocommerce, $post;
        ?>
        <p class="form-field">
            <label for="out_of_stock_recommendation"><?php _e( 'Out of Stock Recommendation', 'woocommerce' ); ?></label>
            <select class="wc-product-search" multiple="multiple" style="width: 50%;" id="out_of_stock_recommendation" name="out_of_stock_recommendation[]" data-placeholder="<?php esc_attr_e( 'Search for a product&hellip;', 'woocommerce' ); ?>" data-action="woocommerce_json_search_products_and_variations" data-exclude="<?php echo intval( $post->ID ); ?>">
                <?php
                    $product_ids = get_post_meta( $post->ID, '_out_of_stock_recommendation_ids', true );

                    foreach ( $product_ids as $product_id ) {
                        $product = wc_get_product( $product_id );
                        if ( is_object( $product ) ) {
                            echo '<option value="' . esc_attr( $product_id ) . '"' . selected( true, true, false ) . '>' . wp_kses_post( $product->get_formatted_name() ) . '</option>';
                        }
                    }
                ?>
            </select> <?php echo wc_help_tip( __( 'Select product(s) to appear as recommendations on single product pages when the product is out of stock.', 'woocommerce' ) ); ?>
        </p>

        <?php
        }

        // Function the save the custom fields
        public function woocom_linked_products_data_custom_field_save( $post_id ){
            $product_field_type =  $_POST['out_of_stock_recommendation'];
            update_post_meta( $post_id, '_out_of_stock_recommendation_ids', $product_field_type );
        }
    }

    new OSRFW_Admin_Product_Meta();
}
