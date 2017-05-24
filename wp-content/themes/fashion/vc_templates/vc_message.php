<?php
$output = $color = $el_class = $css_animation = '';
$atts = ( vc_map_get_attributes(  str_replace('.php','',basename(__FILE__)) , $atts ) );
extract( $atts );
$el_class = $this->getExtraClass($el_class);

if($color=='alert-error'){
	$color = 'alert-danger';
}else if($color == 'alert-block'){
	$color = 'alert-warning';
}

?>
<div class="alert <?php echo $color; ?><?php echo $el_class; ?> fade in">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<?php echo wpb_js_remove_wpautop($content, true); ?>
</div>
