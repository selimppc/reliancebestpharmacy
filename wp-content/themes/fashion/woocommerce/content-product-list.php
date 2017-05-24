<?php
/**
 * $Desc
 *
 * @version    $Id$
 * @package    wpbase
 * @author     WpOpal Team < opalwordpress@gmail.com>
 * @copyright  Copyright (C) 2016 http://www.wpopal.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @website  http://www.wpopal.com
 * @support  http://www.wpopal.com/questions/
 */
global $product;
$is_wishlist = class_exists('YITH_WCWL');
$is_compare = class_exists( 'YITH_Woocompare' );
?>
<div class="product-list shopcol product">
	<div class="product-image col-md-3 col-sm-3">
		<div class="image">
            <a href="<?php the_permalink(); ?>">
                <?php
                    /**
                     * woocommerce_before_shop_loop_item_title hook
                     *
                     * @hooked woocommerce_show_product_loop_sale_flash - 10
                     * @hooked woocommerce_template_loop_product_thumbnail - 10
                     */
                    do_action( 'woocommerce_before_shop_loop_item_title' );
                ?>
            </a>            
        </div>
    </div>

	<div class="product-meta col-md-6 col-sm-6">
        <h3 class="name">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>
		<?php
        /**
         * woocommerce_after_shop_loop_item_title hook
         *
         * @hooked woocommerce_template_loop_rating - 5
         * @hooked woocommerce_template_loop_price - 10
         */
        remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_rating',5);
        do_action('woocommerce_after_shop_loop_item_title');
        ?>        
        <?php woocommerce_template_single_excerpt(); ?>
        <!--quickview-->
        <?php if(of_get_option('is-quickview',true)){ ?>
        <a href="#" class="quickview text-center wpo-colorbox cboxElement"
            data-productslug="<?php echo $product->post->post_name; ?>"
            data-toggle="modal"
            data-target="#wpo_modal_quickview"
            >
            <span class="fa fa-plus"></span>
            <span><?php echo __('Quick view', 'fashion'); ?></span>
        </a>
        <?php } ?>

	</div>    
    <div class="product-action col-md-3 col-sm-3">                     
        <div class="add-to-cart">
            <?php do_action('woocommerce_after_shop_loop_item'); ?>
        </div>
        <div class="wishlist-compare">
            <?php if( $is_wishlist ) { ?>
            <a title="Add to Wish List" class="wishlist"><i class="fa-fw fa fa-heart"></i><span><?php echo __('Add to Wish List', 'fashion'); ?></span></a>
            <div class="wishlist-action" style="display:none;">
                <?php echo do_shortcode( '[yith_wcwl_add_to_wishlist]' ); ?>
            </div>                
            <?php } ?>
        </div>
        <div class="compare">
            <?php if( $is_compare ) { ?>
                <?php
                    $action_add = 'yith-woocompare-add-product';
                    $url_args = array(
                        'action' => $action_add,
                        'id' => $product->id
                    );
                ?>
                <a class="compare" href="<?php echo esc_url( wp_nonce_url( add_query_arg( $url_args ), $action_add ) ); ?>" data-product_id="<?php echo $product->id; ?>" title="Add to Compare"><i class="fa-fw fa fa-retweet"></i><span><?php echo __('Add to Compare', 'fashion'); ?></span></a>
            <?php } ?>
        </div>        
    </div>
</div>

