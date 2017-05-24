<?php
/**
 * $Desc
 *
 * @version    $Id$
 * @package    wpbase
 * @author     Opal  Team <opalwordpressl@gmail.com >
 * @copyright  Copyright (C) 2014 wpopal.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @website  http://www.wpopal.com
 * @support  http://www.wpopal.com/support/forum.html
 */
extract($atts);

switch ($columns_count) {
	case '4':
		$class_column='col-lg-3 col-md-3 col-sm-6 col-xs-12';
		break;
	case '3':
		$class_column='col-lg-4 col-md-4 col-sm-6 col-xs-12';
		break;
	case '2':
		$class_column='col-lg-6 col-md-6 col-sm-6 col-xs-12';
		break;
	default:
		$class_column='col-lg-12 col-md-12 col-sm-12 col-xs-12';
		break;
}

if($type=='') return;

global $woocommerce;
$_id = wpo_makeid();
$_count = 1;

$loop = wpo_woocommerce_query($type,$number);

if ( $loop->have_posts() ) : ?>
	<div class="woocommerce">
		<?php if($title!=''){ ?>
			<h3 class="widget-title"><?php echo $title; ?></h3>
		<?php } ?>
		<?php if($layout=='list'){ ?>
			<div class="product_list_widget">
				<?php while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
					<?php wc_get_template( 'content-widget-product.php', array( 'show_rating' => false ) ); ?>
				<?php endwhile; ?>
			</div>
		<?php }else{ ?>
			<?php $_count = 1; ?>
			<div class="box-products">
				<div class="box-content">
					<?php while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
					<?php
			            $class_fix = ' shopcol';
			            // Store loop count we're currently on
			            if ( 0 == ( $_count - 1 ) % $columns_count || 1 == $columns_count )
			                $class_fix .= ' first';
			            if ( 0 == $_count % $columns_count )
			                $class_fix .= ' last';
			        ?>
						<div class="box <?php echo $class_column.$class_fix; ?>">
							<?php wc_get_template_part( 'content', 'product-inner' ); ?>
						</div>
						<?php $_count++; ?>
					<?php endwhile; ?>
				</div>
			</div>
		<?php } ?>
		<?php wp_reset_postdata(); ?>
	</div>
<?php endif; ?>

<?php wp_reset_query(); ?>



