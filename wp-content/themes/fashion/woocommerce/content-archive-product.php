<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>
    <?php do_action( 'woocommerce_archive_description' ); ?>
    <?php if ( have_posts() ) : ?>
        <div id="wpo-filter" class="product-filter clearfix wrapper">
            <?php do_action('wpo_button_display'); ?>

            <?php
            /**
             * woocommerce_before_shop_loop hook
             *
             * @hooked woocommerce_result_count - 20
             * @hooked woocommerce_catalog_ordering - 30
             */
            //woocommerce_show_messages();
            woocommerce_catalog_ordering();
            ?>
        </div>
        <?php woocommerce_product_loop_start(); ?>

        <?php woocommerce_product_subcategories(); ?>
        <?php
        if (isset($_COOKIE['wpo_cookie_layout']) && $_COOKIE['wpo_cookie_layout']=='list') {
            $layout = 'product-list';
        }else{
            $layout = 'product';
        }
        ?>
        <?php while ( have_posts() ) : the_post(); ?>
            <?php
            wc_get_template_part( 'content', $layout );
            ?>
        <?php endwhile; // end of the loop. ?>

        

        <div class="wrapper clearfix product-bottom">
            <?php
                /**
                 * woocommerce_after_shop_loop hook
                 *
                 * @hooked woocommerce_pagination - 10
                 */

                add_action( 'woocommerce_after_shop_loop','woocommerce_result_count' ,20);
                do_action( 'woocommerce_after_shop_loop' );
            ?>
        </div> 
    <?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

        <?php wc_get_template( 'loop/no-products-found.php' ); ?>

    <?php endif; ?>

