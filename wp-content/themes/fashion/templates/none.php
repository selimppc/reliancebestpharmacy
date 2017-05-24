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
<div class="page-found text-center clearfix">
	<h1 class="entry-title"><?php echo __( 'Nothing Found', 'fashion' ); ?></h1>
	<article class="wrapper">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

		<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'fashion' ), admin_url( 'post-new.php' ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

		<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'fashion' ); ?></p>
		<div class="col-sm-6 col-sm-offset-3">
			<?php get_search_form(); ?>
			<div class="clearfix"></div>
			<a class="btn btn-default" href="#"><i class="fa-fw fa fa-home"></i><?php _e('Back to Home', 'fashion'); ?> </a>
		</div>

		<?php else : ?>

		<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'fashion' ); ?></p>
		<div class="col-sm-6 col-sm-offset-3"><?php get_search_form(); ?></div>

		<?php endif; ?>
	</article>
</div>