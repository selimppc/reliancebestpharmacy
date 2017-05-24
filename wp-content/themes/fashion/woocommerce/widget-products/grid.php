<?php 
	$_count = 1;
	$row = 1;
    if(isset($_row)) $row = $_row;
?>
<div class="box-products">
	<div class="box-content">
	<?php while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
		<div class="box <?php echo $class_column; ?>">
			<?php wc_get_template_part( 'content', 'product-inner' ); ?>
		</div>
		<?php $_count++; ?>
	<?php endwhile; ?>
	</div>
</div>
<?php wp_reset_postdata(); ?>