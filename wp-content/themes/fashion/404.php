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
?>

<?php get_header( get_header_layout() ); ?>

<section class="container">
	<div class="page_not_found text-center clearfix">
		<h1>
			<?php echo __('page not found', 'fashion'); ?>		
		</h1>
		<div class="bigtext"><?php echo __('404', 'fashion'); ?></div>	
		<div class="col-sm-6 col-sm-offset-3">
			<?php echo of_get_option('404','Can\'t find what you need? Take a moment and do a search below!'); ?>
			<?php get_search_form(); ?>
			<div class="clearfix"></div>
			<a class="btn btn-default" href="#"><i class="fa-fw fa fa-home"></i><?php _e('Back to Home', 'fashion'); ?> </a>
			
		</div>
	</div>
</section>

<?php get_footer(); ?>