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


<?php
/**
 * woocommerce_before_main_content hook
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 */
do_action( 'woocommerce_before_main_content' );
?>
    <section class="wpo-content-product content-product">
        
            <div class="row">        
                <section class="<?php echo $config['main']['class']; ?>">
                    <div id="wpo-main-content" class="wpo-content">
                        <?php
                        if (is_product_category()) {
                            global $wp_query;
                            // get the query object
                            $cat = $wp_query->get_queried_object();
                            // get the thumbnail id user the term_id
                            $thumbnail_id = get_woocommerce_term_meta($cat->term_id, 'thumbnail_id', true);
                            if($thumbnail_id!=0){
                                // get the image URL
                                $image = wp_get_attachment_link($thumbnail_id, 'category-image');

                        ?>
                        <div class="category-image">
                            <?php echo $image; ?>
                        </div>
                        <?php } ?>
                        <?php } ?>

                        <?php wc_get_template_part( 'content', 'archive-product' ); ?>

                    
                    </div>  
                </section>
                <?php if($config['left-sidebar']['show']){ ?>
                    <div class="wpo-sidebar wpo-sidebar-1 <?php echo $config['left-sidebar']['class']; ?>">
                        <?php if(is_active_sidebar(of_get_option('woocommerce-archive-left-sidebar'))): ?>
                            <div class="sidebar-inner">
                                <?php dynamic_sidebar(of_get_option('woocommerce-archive-left-sidebar')); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php } ?>

                <?php if($config['right-sidebar']['show']){ ?>
                    <div class="wpo-sidebar wpo-sidebar-2 <?php echo $config['right-sidebar']['class']; ?>">
                        <?php if(is_active_sidebar(of_get_option('woocommerce-archive-right-sidebar'))): ?>
                            <div class="sidebar-inner">
                                <?php dynamic_sidebar(of_get_option('woocommerce-archive-right-sidebar')); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php } ?>
                <?php woocommerce_product_loop_end(); ?>
            </div>
      
    </section>
<?php
/**
 * woocommerce_after_main_content hook
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );
?>