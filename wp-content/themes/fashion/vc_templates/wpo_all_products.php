<?php
/**
 * $Desc
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

$atts = ( vc_map_get_attributes(  str_replace('.php','',basename(__FILE__)) , $atts ) );
extract( $atts );

// d( $atts );
switch ($columns_count) {
	case '6':
		$class_column='col-lg-2 col-md-2 col-sm-6 col-xs-12';
		break;
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


global $woocommerce;

$_id = wpo_makeid();
$_count = 1;
$list_query = $this->getListQuery( $atts );

$_duration = '0.6s';

?>

	<div class="tabbable tab-top wpo_all_products woocommerce<?php echo (($el_class!='')?' '.$el_class:''); ?>">
		<ul class="nav nav-tabs">
			<?php $__count=0; ?>
			<?php foreach ($list_query as $key => $li) { ?>
				<li<?php echo ($__count==0)?' class="active"':''; ?>><a href="#<?php echo $key.'-'.$_id; ?>" data-toggle="tab" data-title="<?php echo $li['title'];?>"><?php echo $li['title_tab'];?></a></li>
				<?php $__count++; ?>
			<?php } ?>
		</ul>
		<div class="tab-content">
			<?php $__count=0; ?>
			<?php foreach ($list_query as $key => $li) { ?>
				<div class="tab-pane<?php echo ($__count==0)?' active':''; ?>" id="<?php echo $key.'-'.$_id; ?>">
					<?php 
						$loop = wpo_woocommerce_query($key,$number);
						if($loop->have_posts()){
							wc_get_template( 'widget-products/carousel.php' , array( 'loop'=>$loop,'columns_count'=>$columns_count,'class_column'=>$class_column,'posts_per_page'=>$number ,'carousel_row'=>$row ) );
						}
					?>
				</div>
				<?php $__count++; ?>
			<?php } ?>
		</div>
	</div>
<?php wp_reset_query(); ?>

