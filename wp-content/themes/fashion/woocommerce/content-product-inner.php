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
<div class="product-block product product-grid">
    <div class="product-inner">
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
            <div class="product-action">                     
                <div class="add-to-cart">                    
                    <?php do_action('woocommerce_after_shop_loop_item'); ?>
                </div>
                <div class="wishlist-compare">
                    <?php if( $is_wishlist ) { ?>
                        <a class="wishlist fa fa-heart" title="Add to Wish List"><span><?php echo __('Add to Wish List', 'fashion'); ?></span></a>
                        <div class="wishlist-action" style="display:none;">
                            <?php echo do_shortcode( '[yith_wcwl_add_to_wishlist]' ); ?>
                        </div>
                        
                    <?php } ?>
                    <?php if( $is_compare ) { ?>
                        <?php
                            $action_add = 'yith-woocompare-add-product';
                            $url_args = array(
                                'action' => $action_add,
                                'id' => $product->id
                            );
                        ?>
                        <a class="compare fa fa-retweet" href="<?php echo esc_url( wp_nonce_url( add_query_arg( $url_args ), $action_add ) ); ?>" data-product_id="<?php echo $product->id; ?>">                                    
                        </a>
                    <?php } ?>
                </div>
            </div>
    	</div>

        <div class="product-meta">
            <div class="warp-info">
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
                
                <!--quickview-->
                <?php if(of_get_option('is-quickview',true)){ ?>
                <a href="#" class="wpo-colorbox cboxElement quickview"
                    data-productslug="<?php echo $product->post->post_name; ?>"
                    data-toggle="modal"
                    data-target="#wpo_modal_quickview"
                    >
                    <span class="fa fa-plus"></span>
                    <span><?php echo __('Quick view', 'fashion'); ?></span>
                </a>
                <?php } ?>                
            </div>            
        </div>
    </div>
</div>





