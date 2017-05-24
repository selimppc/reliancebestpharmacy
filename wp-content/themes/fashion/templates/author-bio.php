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
<div class="title">
	<h4 class="author-title">
		<?php echo __( 'About the Author :', 'fashion' ); ?>
		<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
			<?php echo get_the_author(); ?>
		</a>
	</h4>
</div>

<div class="author-about-container clearfix">
	<div class="avatar-img">
		<?php echo get_avatar( get_the_author_meta( 'user_email' ),72 ); ?>
	</div>
	<!-- .author-avatar -->
	<div class="description">
		<?php the_author_meta( 'description' ); ?>
	</div>
</div>
