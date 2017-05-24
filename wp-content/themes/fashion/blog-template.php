<?php
/*
*Template Name: Blog
*
*/
// Get Page Config
$config = $wpo->getPageConfig();

// Meta Configuration
$meta_template = get_post_meta($post->ID, 'wpo_template', TRUE);
if(!isset($meta_template['count'])) $meta_template['count']=-1;
if(is_front_page()) {
	$paged = (get_query_var('page')) ? get_query_var('page') : 1;
} else {
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
}
$args = array(
	'post_type' => 'post',
	'paged' => $paged,
	'posts_per_page'=>$meta_template['count']
);
$blog = new WP_Query($args);

?>

<?php get_header( get_header_layout() );?>

<?php
	// Show Breadcumb
	if($config['breadcrumb']){
		wpo_breadcrumb();
	}
?>

<div id="wpo-mainbody" class="container wpo-mainbody">
	<div class="row">
		<!-- MAIN CONTENT -->
		<div id="wpo-content" class="wpo-content <?php echo $config['main']['class']; ?> clearfix">
			<?php if ( $blog->have_posts() ) : ?>
				<div class="post-area">
					<?php /* The loop */ ?>
					<?php while ( $blog->have_posts() ) : $blog->the_post(); ?>
						<?php get_template_part( 'templates/blog/blog'); ?>
					<?php endwhile; ?>
				</div>
			<?php else : ?>
				<?php get_template_part( 'templates/none' ); ?>
			<?php endif; ?>
			<?php wpo_pagination($prev = '&laquo;', $next = '&raquo;', $pages=$blog->max_num_pages); ?>
		</div>
		<!-- //END MAINCONTENT -->

		<?php /******************************* SIDEBAR LEFT ************************************/ ?>
		<?php if($config['left-sidebar']['show']){ ?>
			<div class="wpo-sidebar wpo-sidebar-1 <?php echo $config['left-sidebar']['class']; ?>">
				<?php if(is_active_sidebar($config['left-sidebar']['widget'])): ?>
				<div class="sidebar-inner">
					<?php dynamic_sidebar($config['left-sidebar']['widget']); ?>
				</div>
				<?php endif; ?>
			</div>
		<?php } ?>
		<?php /******************************* END SIDEBAR LEFT *********************************/ ?>

		<?php /******************************* SIDEBAR RIGHT ************************************/ ?>
		<?php if($config['right-sidebar']['show']){ ?>
			<div class="wpo-sidebar wpo-sidebar-2 <?php echo $config['right-sidebar']['class']; ?>">
				<?php if(is_active_sidebar($config['right-sidebar']['widget'])): ?>
				<div class="sidebar-inner">
					<?php dynamic_sidebar($config['right-sidebar']['widget']); ?>
				</div>
				<?php endif; ?>
			</div>
		<?php } ?>
		<?php /******************************* END SIDEBAR RIGHT *********************************/ ?>
	</div>
</div>

<?php get_footer(); ?>