<?php
/**
 * Description tab
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $post;

$heading = esc_html( apply_filters( 'woocommerce_product_description_heading', __( 'Product Description', 'fashion' ) ) );
?>

<?php if ( $heading ): ?>
  <h2 class="tab-title"><?php echo esc_attr($heading); ?></h2>
<?php endif; ?>

<?php the_content(); ?>