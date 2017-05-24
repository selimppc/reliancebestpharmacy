<?php
$atts = ( vc_map_get_attributes(  str_replace('.php','',basename(__FILE__)) , $atts ) );
extract( $atts );

$img_id = preg_replace( '/[^\d]/', '', $image );
$img = wpb_getImageBySize( array( 'attach_id' => $img_id, 'thumb_size' => 'full' ) );
if ( $img == NULL ) $img['thumbnail'] = '<img src="' . vc_asset_url( 'vc/no_image.png' ) . '" />';
?>

<div class="image-wrapper<?php echo ($el_class=='')?'':' '.$el_class; ?>">
	<a href="">
		<?php echo $img['thumbnail']; ?>
	</a>
</div>
<div class="content-shop">
	<?php echo $sub_title; ?>
	<div class="title-shop">
		<a href="<?php echo $link; ?>"><?php echo $title; ?></a>
	</div>
	<div class="desc">
		<?php echo $desc; ?>
	</div>
</div>