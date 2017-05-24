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

$atts = ( vc_map_get_attributes(  str_replace('.php','',basename(__FILE__)) , $atts ) );
extract( $atts );
// echo $atts['columns_count'];
// die;
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
$_id = wpo_makeid();
if($category=='') return;
$_count = 1;
$loop = wpo_woocommerce_query('',$number,$category);

if ( $loop->have_posts() ) : ?>
	<div class="woocommerce">
		<?php if($title!=''){ ?>
		<div class="box-heading">
			<span><?php echo $title; ?></span>
		</div>
		<?php } ?>
		
		<?php wc_get_template( 'widget-products/'.$style.'.php' , array( 'loop'=>$loop,'columns_count'=>$columns_count,'class_column'=>$class_column,'posts_per_page'=>$number,'carousel_row'=>$carousel_row ) ); ?>

	</div>
<?php endif; ?>

<?php wp_reset_postdata(); ?>


