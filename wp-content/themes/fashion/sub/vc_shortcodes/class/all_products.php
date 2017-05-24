<?php  
// require_once vc_path_dir('SHORTCODES_DIR', 'vc-posts-grid.php');
class WPBakeryShortCode_Wpo_All_Products extends WPBakeryShortCode {

	public function getListQuery( $atts ){
		$list_query = array();
		$this->atts  = $atts;
		$types = explode(',', $this->atts['show_tab']);
		foreach ($types as $type) {
			$list_query[$type] = $this->getTabTitle($type);
		}
		return $list_query;
	}

	public function getTabTitle($type){
		switch ($type) {
			case 'recent':
				return array('title'=>__('Latest Products', 'fashion'),'title_tab'=>__('Latest', 'fashion'));
			case 'featured_product':
				return array('title'=>__('Featured Products', 'fashion'),'title_tab'=>__('Featured', 'fashion'));
			case 'top_rate':
				return array('title'=> __('Top Rated Products', 'fashion'),'title_tab'=>__('Top Rated', 'fashion'));
			case 'best_selling':
				return array('title'=>__('BestSeller Products', 'fashion'),'title_tab'=>__('BestSeller', 'fashion'));
			case 'on_sale':
				return array('title'=>__('Special Products', 'fashion'),'title_tab'=>__('Special', 'fashion'));
		}
	}
}