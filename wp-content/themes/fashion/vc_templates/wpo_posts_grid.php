<?php
$grid_link = $grid_layout_mode = $title = $filter= '';
$posts = array();
$atts = ( vc_map_get_attributes(  str_replace('.php','',basename(__FILE__)) , $atts ) );
extract( $atts );
if(empty($loop)) return;
$this->getLoop($loop);
$args = $this->loop_args;

$loop = new WP_Query($args);
$grid_columns =4;
switch ($grid_columns) {
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

<section class="widget section-blog <?php echo (($el_class!='')?' '.$el_class:''); ?>">
    <h3 class="widget-title title_default">
        <span class="pull-left"><?php echo $title; ?></span>
        <a href="#" class="readmore pull-right"><?php echo __('View more', 'fashion'); ?> <i class="fa fa-plus"></i></a>
    </h3>
    <div class="box-content clearfix">
        <?php  if($loop->have_posts()): ?>
        <?php wpo_get_template('blog/'.$layout.'.php',array( 'loop'=> $loop , 'class_column'=> $class_column,'grid_thumb_size'=>$grid_thumb_size ) ); ?>
        <?php endif; ?>
    </div>
</section>
<?php wp_reset_query();