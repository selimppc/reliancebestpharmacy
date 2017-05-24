<?php
$output = $color = $size = $icon = $target = $href = $el_class = $title = $position = '';
$atts = ( vc_map_get_attributes(  str_replace('.php','',basename(__FILE__)) , $atts ) );
extract( $atts );

$el_class = $this->getExtraClass($el_class);

//echo $output . $this->endBlockComment('button') . "\n";

?>
<a target="<?php echo $target; ?>"<?php echo ($href!='')?' href="'.$href.'"':''; ?> class="btn <?php echo $color.$el_class; ?><?php echo ($size!='')?' '.$size:''; ?>">
    <?php if($icon!=''){ ?>
        <i class="<?php echo $icon; ?>"></i>
    <?php } ?>
    <?php echo $title; ?>
</a>
