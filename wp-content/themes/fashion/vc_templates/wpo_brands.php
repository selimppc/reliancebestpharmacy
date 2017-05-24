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

$_id = wpo_makeid();
$args = array(
	'post_type' => 'brands',
	'posts_per_page'=>$number
);
$loop = new WP_Query($args);

if ( $loop->have_posts() ) : ?>
<?php 
	$_count = 1;
	$columns_count=6;
	switch ($columns_count) {
		case '6':
			$class_column='col-sm-2 col-md-2';
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
?>
	<section class="hidden-xs <?php echo (($el_class!='')?' '.$el_class:''); ?> wpo-brand">
		<?php if($title!=''){ ?>
		<div class="box-heading">
			<span><?php echo $title; ?></span>
		</div>
		<?php } ?>
		<div class="box-content">
			<?php if($layout=='carousel'){ ?>
			<div class="carousel wrapper slide" id="brands-<?php echo $_id; ?>">
				<a class="carousel-control left" href="#brands-<?php echo $_id; ?>" data-slide="prev"></a>
				<a class="carousel-control right" href="#brands-<?php echo $_id; ?>" data-slide="next"></a>
				<div class="carousel-inner">
				<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
					<?php if( $_count%$columns_count == 1 ) echo '<div class="row item'.(($_count==1)?" active":"").'"><div class="container brand">'; ?>
						<?php 
							$meta = get_post_meta(get_the_ID(),'wpo_brand',true);	
							$link = isset($meta['link']) ? $meta['link'] : '#';
						?>
						<!-- Product Item -->
						<div class="<?php echo $class_column; ?> item-inner">
							<a href="<?php echo $link; ?>" target="_blank">
								<?php the_post_thumbnail( 'brand-logo' ); ?>
							</a>
						</div>
						<!-- End Product Item -->

					<?php if( ($_count%$columns_count==0 && $_count!=1) || $_count== $number ) echo '</div></div>'; ?>
					<?php $_count++; ?>
				<?php endwhile; ?>
				</div>
			</div>
			<?php }else{ ?>
				<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
				<div class="<?php echo $class_column; ?> item-inner">
				<?php 
					$meta = get_post_meta(get_the_ID(),'wpo_brand',true);	
					$link = isset($meta['link']) ? $meta['link'] : '#';
				?>
					<div class="item-inner">
						<a href="<?php echo $link; ?>" target="_blank">
							<?php the_post_thumbnail( 'full' ); ?>
						</a>
					</div>
				</div>
				<?php endwhile; ?>
			<?php } ?>
		</div>
	</section>
<?php endif; ?>

<?php wp_reset_postdata(); ?>