<?php 
	$show_rating = ($type=='top_rate') ? true : false;
?>

<div class="product_list_widget">
	<?php while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
		<?php wc_get_template( 'content-widget-product.php', array( 'show_rating' => $show_rating ) ); ?>
	<?php endwhile; ?>
</div>
<?php wp_reset_postdata(); ?>