<?php
/* $Desc
 *
 * @version    $Id$
 * @package    wpbase
 * @author     WPOpal  Team <wpopal@gmail.com, support@wpopal.com>
 * @copyright  Copyright (C) 2014 wpopal.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @website  http://www.wpopal.com
 * @support  http://www.wpopal.com/support/forum.html
 */
?>
<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class('product'); ?>>
    <div id="single-product" class="row woocommerce">
        <div class="col-sm-6">
            <?php
            /**
             * woocommerce_before_single_product_summary hook
             *
             * @hooked woocommerce_show_product_sale_flash - 10
             * @hooked woocommerce_show_product_images - 20
             */
            wc_get_template( 'single-product/product-image-carousel.php' );
            ?>
        </div>
        <div class="col-sm-6">
            <div class="summary entry-summary">
                <?php
                    /**
                     * woocommerce_single_product_summary hook
                     *
                     * @hooked woocommerce_template_single_title - 5
                     * @hooked woocommerce_template_single_rating - 10
                     * @hooked woocommerce_template_single_price - 10
                     * @hooked woocommerce_template_single_excerpt - 20
                     * @hooked woocommerce_template_single_add_to_cart - 30
                     * @hooked woocommerce_template_single_meta - 40
                     * @hooked woocommerce_template_single_sharing - 50
                     */
                    woocommerce_template_single_title();
                    woocommerce_template_single_rating();
                    woocommerce_template_single_price();
                    woocommerce_template_single_excerpt();
                    ?>
                    <div class="cart">
                        <?php woocommerce_template_loop_add_to_cart(); ?>
                    </div>
                <?php
                    woocommerce_template_single_meta();
                ?>

            </div><!-- .summary -->
        </div>
    </div>
</div><!-- #product-<?php the_ID(); ?> -->