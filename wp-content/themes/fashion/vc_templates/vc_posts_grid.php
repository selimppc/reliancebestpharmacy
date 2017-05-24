<?php
$grid_link = $grid_layout_mode = $title = $filter= '';
$posts = array();
$atts = ( vc_map_get_attributes(  str_replace('.php','',basename(__FILE__)) , $atts ) );
extract( $atts );
if(empty($loop)) return;
$this->getLoop($loop);
$my_query = $this->query;
$args = $this->loop_args;
$teaser_blocks = vc_sorted_list_parse_value($layout);

$grid_columns_count = 4;
$column = 12/$grid_columns_count;
$_count =0;
$pull ='right';
?>
<div class="grid-post">
    <div class="row">
        <?php while ( $my_query->have_posts() ): $my_query->the_post(); ?>
        <?php
            if($_count%$grid_columns_count==0){
                if($pull=='right') $pull='left';
                else $pull='right';
            }
        ?>
        <div class="col-md-<?php echo $column; ?> col-sm-6 col-xs-12 blog-col">
            <div class="blog-lastest pavblock <?php echo $pull; ?>">                
                <div class="group-blog">
                    <div class="blog-heading">
                        <div class="left pull-left">
                            <div class="date"><?php the_time( 'd M Y' ); ?></div>
                            <div class="blog-title"><?php the_title(); ?></div>
                        </div>
                        <div class="images">
                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('blog-home-image'); ?></a>
                        </div>
                    </div>
                    <div class="box-content">                        
                        <div class="summary"><?php echo wpo_excerpt(20,'...'); ?></div>
                        <a class="readmore btn-arrow-right" href="<?php the_permalink(); ?>"><?php echo __('Read more', 'fashion'); ?></a>
                    </div>
                </div>
            </div>
        </div>
        <?php $_count++; ?>
        <?php endwhile; ?>
    </div>
</div>
<?php
wp_reset_query();


