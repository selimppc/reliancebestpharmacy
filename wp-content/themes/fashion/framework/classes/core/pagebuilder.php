<?php
/**
 * $Desc
 *
 * @version    $Id$
 * @package    wpbase
 * @author     Opal  Team <opalwordpressl@gmail.com >
 * @copyright  Copyright (C) 2014 wpopal.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @website  http://www.wpopal.com
 * @support  http://www.wpopal.com/support/forum.html
 */

abstract class WPO_PageBuilder_Base{

	protected $cssAnimation;
	protected $textdomain;
	
	public function __construct(){
		add_filter( 'vc_shortcodes_css_class',array($this,'customColumnBuilder'),10,2);
		$this->textdomain = get_option( 'stylesheet' );
    	$this->textdomain = preg_replace("/\W/", "_", strtolower($this->textdomain) );

		vc_add_shortcode_param('hidden',array($this,'parramHidden'));

		// Add Param Mega Post
		vc_add_shortcode_param('megalayout',array($this,'parramMegaLayout'),WPO_FRAMEWORK_ADMIN_STYLE_URI.'js/pagebuilder/megapost.js');


		$this->setValueCssAnimationInput();
		$this->updateCssAnimationInput();

	}

	protected function deleteParam($name,$element){
		if(is_array($element)){
			foreach ($element as $value) {
				vc_remove_param($name,$value);
			}
		}else{
			vc_remove_param($name,$element);
		}
	}

	public function customColumnBuilder($class_string,$tag){
		if ($tag=='vc_row' || $tag=='vc_row_inner') {
			$class_string = str_replace('vc_row-fluid', 'row', $class_string);
			$class_string = str_replace('wpb_row ', '', $class_string);
		}
		if ($tag=='vc_column' || $tag=='vc_column_inner') {
			$class_string = preg_replace('/vc_span(\d{1,2})/', 'col-md-$1', $class_string);
			$class_string = str_replace('wpb_column', '', $class_string);
			$class_string = str_replace('column_container', '', $class_string);
		}
		return $class_string;
	}


	/**
	 * Parram input hidden
	 */
	public function parramHidden($settings, $value) {
	    $dependency = vc_generate_dependencies_attributes($settings);
	    return '<input name="'.$settings['param_name']
				.'" class="wpb_vc_param_value wpb-textinput '
				.$settings['param_name'].' '.$settings['type'].'_field" type="text" value="'
				.$value.'" ' . $dependency . '/>';
	}

	public function parramMegaLayout($settings,$value){
		$dependency = vc_generate_dependencies_attributes($settings);
		ob_start();
		?>
			<div class="layout_images">
				<?php foreach ($settings['layout_images'] as $key => $image) {
					echo '<img src="'.$image.'" data-layout="'.$key.'" class="'.$key.' '.(($key==$value)?'active':'').'">';
				} ?>
			</div>
			<input 	type="hidden" 
					name="<?php echo $settings['param_name']; ?>" 
					class="layout_image_field wpb_vc_param_value wpb-textinput <?php echo $settings['param_name'].' '.$settings['type'].'_field'; ?>" 
					value="<?php echo $value; ?>" <?php echo $dependency; ?>>
		<?php
		return ob_get_clean();
	}



	/**
	 * override input CSS Animation
	 */
	private function updateCssAnimationInput(){
		$elements = array(
						'vc_column_text',
						'vc_single_image',
						'vc_message',
						'vc_toggle',
						'vc_single_image'
					);
		foreach ($elements as $value) {
			$param = WPBMap::getParam( $value , 'css_animation');
			$param['value']=$this->cssAnimation;
			WPBMap::mutateParam( $value , $param);
		}
	}

	private function setValueCssAnimationInput(){
		$this->cssAnimation = array(
								__("No", 'fashion') => '',
								__("Top to bottom", 'fashion') => "top-to-bottom",
								__("Bottom to top", 'fashion') => "bottom-to-top",
								__("Left to right", 'fashion') => "left-to-right",
								__("Right to left", 'fashion') => "right-to-left",
								__("Appear from center", 'fashion') => "appear",
								'bounce' => 'bounce',
								'flash' => 'flash',
								'pulse' => 'pulse',
								'rubberBand' => 'rubberBand',
								'shake' => 'shake',
								'swing' => 'swing',
								'tada' => 'tada',
								'wobble' => 'wobble',
								'bounceIn' => 'bounceIn',
								'fadeIn' => 'fadeIn',
								'fadeInDown' => 'fadeInDown',
								'fadeInDownBig' => 'fadeInDownBig',
								'fadeInLeft' => 'fadeInLeft',
								'fadeInLeftBig' => 'fadeInLeftBig',
								'fadeInRight' => 'fadeInRight',
								'fadeInRightBig' => 'fadeInRightBig',
								'fadeInUp' => 'fadeInUp',
								'fadeInUpBig' => 'fadeInUpBig',
								'flip' => 'flip',
								'flipInX' => 'flipInX',
								'flipInY' => 'flipInY',
								'lightSpeedIn' => 'lightSpeedIn',
								'rotateInrotateIn' => 'rotateIn',
								'rotateInDownLeft' => 'rotateInDownLeft',
								'rotateInDownRight' => 'rotateInDownRight',
								'rotateInUpLeft' => 'rotateInUpLeft',
								'rotateInUpRight' => 'rotateInUpRight',
								'slideInDown' => 'slideInDown',
								'slideInLeft' => 'slideInLeft',
								'slideInRight' => 'slideInRight',
								'rollIn' => 'rollIn'
							);
	}
}