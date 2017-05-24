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

$portfolio_skills = get_terms('Skills',array('orderby'=>'id'));

$args = array(
	'post_type' => 'portfolio',
	'paged' => $paged,
	'posts_per_page'=>$count
);
$portfolio = new WP_Query($args);

?>

<div class="teambox">
	<div class="he-wrap">
       <img src="http://localhost:8888/wordpress/college/wp-content/uploads/2014/01/portfolio-10.png" width="250" height="250" alt="" />
        <div class="he-view">
            <div class="bg">
                <div class="center-bar">
                    <a href="#" class="twitter"></a>
                    <a href="#" class="facebook"></a>
                    <a href="#" class="google"></a>
                </div>
            </div>
        </div>
	</div><!-- end he wrap -->
    <h3>Lara CROFT</h3>
    <p>Duis neque nisi, dapibus sed mattis et quis, rutrum accumsan sed. Suspendisse eu varius nibh. Suspendapibus sed mattis quis.</p>
</div>