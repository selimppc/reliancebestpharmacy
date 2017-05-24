<?php 
    $_id = wpo_makeid();
    $_count = 1;
    $_total = $loop->found_posts;
    $_row = 1;
    if(isset($carousel_row)) $_row = $carousel_row;
?>
<div class="box-content">
    <div class="box-products slide" id="productcarouse-<?php echo $_id; ?>">
        <?php if($posts_per_page>($columns_count*$_row) && $_total>($columns_count*$_row)){ ?>
        <div class="carousel-controls">
            <a class="carousel-control left" href="#productcarouse-<?php echo $_id; ?>" data-slide="prev"><?php echo __('Prev', 'fashion'); ?></a>
            <a class="carousel-control right" href="#productcarouse-<?php echo $_id; ?>" data-slide="next"><?php echo __('Next', 'fashion'); ?></a>
        </div>
        <?php } ?>
        <div class="carousel-inner">
        <?php while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
        <?php
            $class_fix = ' shopcol';
            // Store loop count we're currently on
            if ( 0 == ( $_count - 1 ) % $columns_count || 1 == $columns_count )
                $class_fix .= ' first';
            if ( 0 == $_count % $columns_count )
                $class_fix .= ' last';
        ?>
            <?php if( $_count%($columns_count*$_row) == 1 ) echo '<div class="item'.(($_count==1)?" active":"").'"><div class="row">'; ?>

                <!-- Product Item -->
                <div class="<?php echo $class_column.$class_fix ?>">
                    <?php wc_get_template_part( 'content', 'product-inner' ); ?>
                </div>
                <!-- End Product Item -->

            <?php if( ($_count%($columns_count*$_row)==0 && $_count!=1) || $_count== $posts_per_page || $_count == $_total ) echo '</div></div>'; ?>
            <?php $_count++; ?>
        <?php endwhile; ?>
        </div>
    </div>
</div>

<?php wp_reset_postdata(); ?>