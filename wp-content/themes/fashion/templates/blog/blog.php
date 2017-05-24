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
$postformat = get_post_format();
$is_show = false;
switch ($postformat) {
	case 'gallery':
		$is_show = wpo_is_gallery();
		break;
	case 'audio':
		$is_show = wpo_is_embed();
		break;
	case 'video':
		$is_show = wpo_is_embed();
		break;
	default:
		$is_show = has_post_thumbnail();
		break;
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('box'); ?>>
	<div class="post-container">
		<?php if($is_show){ ?>
		<div class="post-thumb text-center">
			<?php
				if ( has_post_format( 'video' )) {
				?>
					<div class="video-responsive">
						<?php wpo_embed(); ?>
					</div>
				<?php
				}
				else if ( has_post_format( 'audio' )) {
				?>
					<div class="audio-thumb audio-responsive">
						<?php wpo_embed(); ?>
					</div>
				<?php
				}
				else if ( has_post_format( 'gallery' )) {
					$_imgs = wpo_gallery();
				?>
					<div id="post-slide-<?php the_ID(); ?>" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner">
							<?php foreach ($_imgs as $key => $_img) {
								echo '<div class="item '.(($key==0)?'active':'').'">';
									echo '<img src="'.$_img.'" alt="">';
								echo '</div>';
							} ?>
						</div>
						<div class="carousel-controls">
							<a class="carousel-control left" href="#post-slide-<?php the_ID(); ?>" data-slide="prev">Prev</a>
							<a class="carousel-control right" href="#post-slide-<?php the_ID(); ?>" data-slide="next">Next</a>
						</div>
					</div>
				<?php
				}
				else if (has_post_thumbnail()) {
				?>
				<a href="<?php the_permalink(); ?>" title="">
					<?php the_post_thumbnail('full','blog-home-image');?>
				</a>
				<?php }
			?>
		</div>
		<?php } ?>
		<div class="post-info">
			<div class="row">
				<div class="blog-meta col-lg-3 col-md-3 col-sm-4 col-xs-12">
					<ul class="entry-meta list">
						<li class="published"><?php the_time( 'M d, Y' ); ?></li>						
						<li class="comment-count">
							<?php comments_popup_link(__(' 0 comment', 'fashion'), __(' 1 comment', 'fashion'), __(' % comments', 'fashion')); ?>
						</li>						
						<li class="author-link"><?php the_author_posts_link(); ?></li>
						<?php if(is_tag()): ?>						
						<li class="tag-link"><?php the_tags('Tags: ',', '); ?></li>
						<?php endif; ?>
					</ul>
				</div>
				<div class="blog-body col-lg-9 col-md-9 col-sm-8 col-xs-12">
					<h2 class="entry-title">
						<a href="<?php the_permalink(); ?>">
							<?php the_title(); ?>
						</a>
					</h2>
					<div class="entry-content">
						<?php echo wpo_excerpt(120); ?>
					</div>
					<div class="readmore">
						<a href="<?php the_permalink(); ?>" class="btn btn-custom"><?php echo __( 'read more', 'fashion' ); ?></a>
					</div>
				</div>
			</div>							
		</div>				
	</div>
</article>