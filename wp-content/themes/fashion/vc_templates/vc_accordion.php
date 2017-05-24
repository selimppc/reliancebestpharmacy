<?php
$output = $title = $interval = $el_class = $collapsible = $active_tab = '';
global $wpo_accordion_item;
$wpo_accordion_item = array();
//
$atts = ( vc_map_get_attributes(  str_replace('.php','',basename(__FILE__)) , $atts ) );
extract( $atts );

$id = wpo_makeid();
wpb_js_remove_wpautop($content);
// var_dump($wpo_accordion_item);
?>
<div class="panel-group" id="accordion-<?php echo $id; ?>">
	<?php
	foreach($wpo_accordion_item as $key => $acc){
		$itemid = wpo_makeid();
	?>
	<div class="panel panel-default">
		<div class="panel-heading" data-toggle="collapse" data-parent="#accordion-<?php echo $id; ?>">
			<h4 class="panel-title">
				<?php echo $acc['title']; ?>
			</h4>
		</div>
		<div id="collapse-<?php echo $itemid; ?>" class="panel-collapse collapse<?php echo ($key==0)?' in':'' ?>">
			<div class="panel-body">
				<?php echo $acc['content']; ?>
			</div>
		</div>
	</div>
	<?php } ?>
</div>