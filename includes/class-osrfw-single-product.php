<?php 

/**
 * OSRFW_Single_Product renders recommended products on the frontend.
 * 
 * @package Out_Of_Stock_Recommendations_For_WooCommerce
 * @since   1.0.0
 */

 if ( ! class_exists( 'OSRFW_Single_Product' ) ) {
     class OSRFW_Single_Product {

		/**
		 * Constructor.
		 *
		 * @since   1.0.0
		 * @version 1.0.0
		 */
		public function __construct() {
            //Display recommended products
            add_action( 'woocommerce_product_meta_start', array( $this, 'display_recommendations' ) ) ;
        }
        
        public function display_recommendations() {
            global $product, $post;

            $recommended_products = get_post_meta( $post->ID, '_out_of_stock_recommendation_ids', true );
            
            if ( ! $product->is_in_stock() ) { ?>
            
                <section class="related products">

                <?php
                $heading = apply_filters( 'woocommerce_product_osrfw_products_heading', __( 'You might like these instead', 'woocommerce' ) );
        
                if ( $heading ) :
                    ?>
                    <h2><?php echo esc_html( $heading ); ?></h2>
                <?php endif; ?>
                
                <?php woocommerce_product_loop_start(); ?>
        
                    <?php foreach ( $recommended_products as $recommended_product ) : ?>
        
                            <?php
                            $post_object = get_post( $recommended_product );
        
                            setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found
        
                            wc_get_template_part( 'content', 'product' );
                            ?>
        
                    <?php endforeach; ?>
        
                <?php woocommerce_product_loop_end(); ?>
        
            </section>
            
            <?php

            }

        }


     }

     new OSRFW_Single_Product();
 }