<?php
$output = $title = $tab_id = $tabicon = '';
extract(shortcode_atts($this->predefined_atts, $atts));
global $wpo_tab_item;
$wpo_tab_item[] = array('tab-id'=>$tab_id,'title'=>$title,'tabicon'=>$atts['tabicon'],'content'=>wpb_js_remove_wpautop($content));