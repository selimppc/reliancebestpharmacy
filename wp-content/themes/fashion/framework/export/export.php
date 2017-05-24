<?php
 /**
  * $Desc
  *
  * @version    $Id$
  * @package    wpbase
  * @author     Wordpress Opal  Team <opalwordpress@gmail.com>
  * @copyright  Copyright (C) 2015 www.wpopal.com. All Rights Reserved.
  * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
  *
  * @website  http://www.wpopal.com
  * @support  http://www.wpopal.com/questions/
  */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PbrThemer_Export {

	/**
	 * @var Boolean $output
	 */
	public $output = 1; 

	/**
	 * Constructor
	 */
	public function __construct() {

		add_action( 'admin_menu', array( &$this, 'pbrthemer_admin_export' ) );

	}

	/**
	 * Constructor
	 */
	public function export_data_all(){
		$actions = array(
			'export_page_options',
			'export_pbrthemer_menus',
			'export_sidebars',
			'export_widgets_sidebars',
			'export_data_modes',
			'export_customizer_options'
		);

		$this->output = 0;
		foreach( $actions as $action ){
			$this->{$action}();
		}

		$theme		= get_stylesheet();  
		$dir  = get_template_directory().'/inc/import/'.$theme.'/rev_sliders'; 
		if( !is_dir($dir) ){
			mkdir( $dir, 0755 );
		}
			
		do_action( 'pbrthemer_export_all_data' );


	}

	/**
	 * Export Wordpress Content
	 */
	public function export_wordpress_content(){
		/** Load WordPress Bootstrap */
		require_once(  ABSPATH . 'wp-admin/admin.php' );
		require_once( ABSPATH . 'wp-admin/admin-header.php' );
		if ( !current_user_can('export') )
			wp_die(__('You do not have sufficient permissions to export the content of this site.', 'fashion'));

		/** Load WordPress export API */
		require_once( ABSPATH . 'wp-admin/includes/export.php' );
		$title = __('Export', 'fashion');

		$args = array();
		$args['content'] = 'all';
		/**
		 * Filter the export args.
		 *
		 * @since 3.5.0
		 *
		 * @param array $args The arguments to send to the exporter.
		 */
		$args = apply_filters( 'export_args', $args );

		export_wp( $args );
		die();
	}

	/**
	 * Export Customizer
	 */
	public function export_customizer_options() {
		 
		$mods = get_theme_mods(); 
		unset( $mods['nav_menu_locations'] );
		$output = base64_encode( serialize( $mods ) );
		$this->output_file_content( "customizer_options.txt", $output );
	}

	/**
	 * Constructor
	 */
	public function export_data_modes() {
		$pbrthemer_options = get_option( "pbr_theme_options" );
		$output            = base64_encode( serialize( $pbrthemer_options ) );
		$this->output_file_content( "options.txt", $output );
	}

	/**
	 * Constructor
	 */
	public function export_widgets_sidebars() {
		$data             = array();
		$data['sidebars'] = $this->export_sidebars();
		$data['widgets']  = $this->export_widgets();
 
		$output = base64_encode( serialize( $data ) );
		$this->output_file_content( "widgets.txt", $output );
	}

	/**
	 * Constructor
	 */
	public function export_widgets() {

		global $wp_registered_widgets;  
		$all_pbrthemer_widgets = array();

		foreach ( $wp_registered_widgets as $pbrthemer_widget_id => $widget_params ) {
			$all_pbrthemer_widgets[] = $widget_params['callback'][0]->id_base;
		}
		$widget_datas = array();
		foreach ( $all_pbrthemer_widgets as $pbrthemer_widget_id ) {
			$pbrthemer_widget_data = get_option( 'widget_' . $pbrthemer_widget_id );
			if ( ! empty( $pbrthemer_widget_data ) ) {
				$widget_datas[ $pbrthemer_widget_id ] = $pbrthemer_widget_data;
			}
		}
		unset( $all_pbrthemer_widgets );

		return $widget_datas;

	}

	public function export_sidebars() {
		$pbrthemer_sidebars = get_option( "sidebars_widgets" );
		$pbrthemer_sidebars = $this->exclude_sidebar_keys( $pbrthemer_sidebars );

		return $pbrthemer_sidebars;
	}

	private function exclude_sidebar_keys( $keys = array() ) {
		if ( ! is_array( $keys ) ) {
			return $keys;
		}

		unset( $keys['wp_inactive_widgets'] );
		unset( $keys['array_version'] );

		return $keys;
	}

	public function export_pbrthemer_menus() {
		global $wpdb;

		$this->data = array();
		$locations  = get_nav_menu_locations();

		$terms_table = $wpdb->prefix . "terms";
		foreach ( (array) $locations as $location => $menu_id ) {
			$menu_slug = $wpdb->get_results( "SELECT * FROM $terms_table where term_id={$menu_id}", ARRAY_A );
			if ( ! empty( $menu_slug ) ) {
				$this->data[ $location ] = $menu_slug[0]['slug'];
			}
		}

		$output = base64_encode( serialize( $this->data ) );
		$this->output_file_content( "menus.txt", $output );
	}

	public function export_page_options() {  
		$pbrthemer_static_page    = get_option( "page_on_front" );
		$pbrthemer_post_page      = get_option( "page_for_posts" );
		$pbrthemer_show_on_front  = get_option( "show_on_front" );
		$pbrthemer_settings_pages = array(
			'show_on_front'  => $pbrthemer_show_on_front,
			'page_on_front'  => $pbrthemer_static_page,
			'page_for_posts' => $pbrthemer_post_page
		);
		$output                   = base64_encode( serialize( $pbrthemer_settings_pages ) );
		$this->output_file_content( "page_options.txt", $output );
	}

	public function export_essential_grid() {
		require_once( ABSPATH . 'wp-content/plugins/essential-grid/essential-grid.php' );

		$c_grid = new Essential_Grid();

		$export_grids = array();
		$grids        = $c_grid->get_essential_grids();
		foreach ( $grids as $grid ) {
			$export_grids[] = $grid->id;
		}

		$export_skins = array();
		$item_skin    = new Essential_Grid_Item_Skin();
		$skins        = $item_skin->get_essential_item_skins( 'all', false );
		foreach ( $skins as $skin ) {
			$export_grids[] = $skin['id'];
		}

		$export_elements = array();
		$c_elements      = new Essential_Grid_Item_Element();
		$elements        = $c_elements->get_essential_item_elements();
		foreach ( $elements as $element ) {
			$export_elements[] = $element['id'];
		}

		$export_navigation_skins = array();
		$c_nav_skins             = new Essential_Grid_Navigation();
		$nav_skins               = $c_nav_skins->get_essential_navigation_skins();
		foreach ( $nav_skins as $nav_skin ) {
			$export_navigation_skins[] = $nav_skin['id'];
		}


		$export_custom_meta = array();
		$metas              = new Essential_Grid_Meta();
		$custom_metas       = $metas->get_all_meta();
		foreach ( $custom_metas as $custom_meta ) {
			$export_custom_meta[] = $custom_meta['handle'];
		}

		$export_punch_fonts = array();
		$fonts              = new ThemePunch_Fonts();
		$custom_fonts       = $fonts->get_all_fonts();
		foreach ( $custom_fonts as $custom_font ) {
			$export_punch_fonts[] = $custom_font['handle'];
		}

		$export = array();

		$ex = new Essential_Grid_Export();

		//export Grids
		if ( ! empty( $export_grids ) ) {
			$export['grids'] = $ex->export_grids( $export_grids );
		}

		//export Skins
		if ( ! empty( $export_skins ) ) {
			$export['skins'] = $ex->export_skins( $export_skins );
		}

		//export Elements
		if ( ! empty( $export_elements ) ) {
			$export['elements'] = $ex->export_elements( $export_elements );
		}

		//export Navigation Skins
		if ( ! empty( $export_navigation_skins ) ) {
			$export['navigation-skins'] = $ex->export_navigation_skins( $export_navigation_skins );
		}

		//export Custom Meta
		if ( ! empty( $export_custom_meta ) ) {
			$export['custom-meta'] = $ex->export_custom_meta( $export_custom_meta );
		}

		//export Punch Fonts
		if ( ! empty( $export_punch_fonts ) ) {
			$export['punch-fonts'] = $ex->export_punch_fonts( $export_punch_fonts );
		}

		//export Global Styles
		$export['global-css'] = $ex->export_global_styles( 'on' );

		$this->output_file_content( 'essential_grid.txt', json_encode( $export ) );
	}

	public function output_file_content( $file_name, $output ) {
		if( $this->output == 1 ){

			header( "Content-type: application/text", true, 200 );
			header( "Content-Disposition: attachment; filename=$file_name" );
			header( "Pragma: no-cache" );
			header( "Expires: 0" );
			echo $output;
			exit;

		}else {

			$theme		= get_stylesheet();  
			$dir  = get_template_directory().'/inc/import/'; 
			if( !is_dir($dir) ){
				mkdir( $dir, 0755 );
			}
			$dir  = $dir .$theme.'/';
			if( !is_dir($dir) ){
				mkdir( $dir, 0755 );
			}

			$fp = fopen( $dir.$file_name, 'w');
			fwrite($fp, $output );
			fclose($fp);

		}
	}

	public function pbrthemer_admin_export() {


		if( isset($_REQUEST['export_data_mode']) ){
			$method = "export_".$_REQUEST['export_data_mode'];  
			if( method_exists($this, $method) ){
				return $this->{$method}();
			}
		}

		if( isset($_REQUEST['export_data_all']) ){
			$this->export_data_all();
		}


		add_submenu_page( 'themes.php', __( 'WpOpal Export', 'fashion' ), esc_html__( 'WpOpal Export', 'fashion' ), 'manage_options', 'pbrthemer_options_export_page', array(
			&$this,
			'pbrthemer_generate_export_page'
		) );
	}

	public function get_sliders(){
		return ;

		if( class_exists("RevSliderGlobals") ){
			global $wpdb;		
			$response = $wpdb->get_results( ("SELECT * FROM ".RevSliderGlobals::$table_sliders ), ARRAY_A);

			return $response;
		}
		return array(); 
	}

	public function pbrthemer_generate_export_page() {


		$siders = $this->get_sliders();
 
		?>
		<div class="wrapper">
			<div class="content">
				<table class="form-table">
					<tbody>
					<tr>
						<td scope="row" width="150"><h2><?php esc_html_e( 'Export Wordpress Content', 'fashion' ); ?></h2></td>
					</tr>

					 
					<tr valign="middle">

						<td>


							<form method="post" action="">
								<input type="hidden" name="export_data_mode" value="wordpress_content"/>
								<input type="submit" class="button button-primary" value="Export Wordpress Content" name="export"/>
							</form>
									<br/>

							<form method="post" action="">
								<input type="hidden" name="export_data_mode" value="widgets_sidebars"/>
								<input type="submit" class="button button-primary" value="Export Widgets" name="export"/>
							</form>
							<br/>

							<form method="post" action="">
								<input type="hidden" name="export_data_mode" value="pbrthemer_menus"/>
								<input type="submit" class="button button-primary" value="Export Menus" name="export"/>
							</form>
							<br/>

							<form method="post" action="">
								<input type="hidden" name="export_data_mode" value="page_options"/>
								<input class="button button-primary" type="submit" value="Export Page Options" name="export"/>
							</form>
							<br/>

							<form method="post" action="">
								<input type="hidden" name="export_data_mode" value="customizer_options"/>
								<input type="submit" class="button button-primary" value="Export Customizer Options" name="export"/>
							</form>

								<br/>
							<form method="post" action="">
								<input type="hidden" name="export_data_all" value="1"/>
								<input type="submit" class="button button-primary" value="Export All" name="export"/>
							</form>

							<br/>
						</td>
					</tr>
					<tr>
						<td scope="row" width="150"><h2><?php esc_html_e( 'Export Revolution Slider', 'fashion' ); ?></h2></td>
					</tr>

					<tr>
						<td scope="row" width="150">
							<?php _e( 'Please access Revolution Slider and use export tools to get package then put inside THEME/inc/import/THEMENAME', 'fashion' ) ;?>
						</td>
					</tr>

					</tbody>
				</table>
			</div>
		</div>

	<?php }

}
$my_PbrThemer_Export = new PbrThemer_Export();
