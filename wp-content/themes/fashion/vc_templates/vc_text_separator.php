<?php
$size = '';
$atts = ( vc_map_get_attributes(  str_replace('.php','',basename(__FILE__)) , $atts ) );
extract( $atts );
$class = "vc_separator wpb_content_element";

//$el_width = "90";
//$style = 'double';
//$title = '';
//$color = 'blue';

$class .= ($title_align!='') ? ' vc_'.$title_align : '';
$class .= ($el_width!='') ? ' vc_el_width_'.$el_width : ' vc_el_width_100';
$class .= ($style!='') ? ' vc_sep_'.$style : '';
if( $color!= '' && 'custom' != $color ) {
 $class .= ' vc_sep_color_' . $color;
}
$inline_css = ( 'custom' == $color && $accent_color!='') ? ' style="'.vc_get_css_color('border-color', $accent_color).'"' : '';

$class .= $this->getExtraClass($el_class);
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class, $this->settings['base'], $atts );

?>
<div class="box widget-text-separator <?php echo esc_attr(trim($css_class)); ?>">
 <span class="vc_sep_holder vc_sep_holder_l hidden"><span<?php echo $inline_css; ?> class="vc_sep_line"></span></span>
 <?php if($title!=''): ?>
        <h3 class="box-heading visual-title <?php echo $title_align.' '.$size; ?>">
            <span><?php echo $title; ?></span>
            <?php if(trim($descript)!=''){ ?>
                <span class="visual-description">
                    <?php echo $descript; ?>
                </span>
            <?php } ?>
        </h3>
    <?php endif; ?>
 <span class="vc_sep_holder vc_sep_holder_r hidden"><span<?php echo $inline_css; ?> class="vc_sep_line"></span></span>
</div>
<?php echo $this->endBlockComment('separator')."\n";