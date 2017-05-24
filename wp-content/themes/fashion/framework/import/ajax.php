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

class PbrThemer_Import_Ajax{

	public static $batch;
	/**
	 * Init ajax function to import data
	 */
	public static function init(){

		$actions = array(
			'pbrthemer_contentImport',
			'pbrthemer_allImport',
			'pbrthemer_metaImport',
			'pbrthemer_vc_templatesImport',
			'pbrthemer_rev_sliderImport',
			'pbrthemer_essential_gridImport',
			'pbrthemer_customizer_optionsImport',
			'pbrthemer_page_optionsImport',
			'pbrthemer_menusImport',
			'pbrthemer_widgetsImport'
		);

		foreach( $actions as $action ){
			add_action('wp_ajax_' . trim($action) ,  array( __CLASS__ , trim($action) ) );
			add_action( 'wp_ajax_nopriv_'.trim($action), array( __CLASS__, trim($action)) );

		}
		self::$batch = false ;
	}

	/**
	 *
	 */
	public static function pbrthemer_allImport(){ 
		return self::pbrthemer_contentImport();
	}

	/**
	 *
	 */
	public static function pbrthemer_contentImport(){
 
		$importObj = PbrThemer_Import::getInstance();

		if ($_POST['import_attachments'] == 1)
			{$importObj->attachments = true;}
		else
			{$importObj->attachments = false;}

		$folder = $_POST['demo_source']."/";

		$ouput = $importObj->import_content($folder.$_POST['xml']);
		echo json_encode( $ouput );
		die();
	}

	/**
	 *
	 */
	public static function pbrthemer_metaImport()
	{
		self::$batch = true ;
		$importObj = PbrThemer_Import::getInstance();
		
		

		$folder = $_POST['demo_source'] . "/";

		$import_types = apply_filters( 'pbrthemer_import_types', array() );
		if( isset($import_types['content']) ){
			unset( $import_types['content'] );
		}
		if( isset($import_types['all']) ){
			unset( $import_types['all'] );
		}

			
		if( $import_types ){
			foreach(  $import_types as $type => $value ){
				$method =  "pbrthemer_".$type."Import";		 
				if( method_exists( __CLASS__ , $method) ){
					 PbrThemer_Import_Ajax::$method();  
				}
			}	
		}

		die('okokokok');
	}

	/**
	 *
	 */
	public static function pbrthemer_vc_templatesImport()
	{
		$importObj = PbrThemer_Import::getInstance();

		$importObj->attachments = true;

		$ouput  = $importObj->import_content_vc($_POST['demo_source'] . "/vc_templates.xml");

		echo json_encode( $ouput ); exit;
	}

	/**
	 *
	 */
	public static function pbrthemer_rev_sliderImport()
	{	
		$importObj = PbrThemer_Import::getInstance();

		$ouput = $importObj->import_rev_slider($_POST['demo_source']);

		echo json_encode( $ouput ); exit;
	}

	/**
	 *
	 */
	public static function pbrthemer_essential_gridImport()
	{
		$importObj = PbrThemer_Import::getInstance();

		$ouput = $importObj->import_essential_grid($_POST['demo_source'] . '/essential_grid.txt');

		echo json_encode( $ouput ); exit;
	}

	/**
	 *
	 */
	public function pbrthemer_customizer_optionsImport()
	{
		$importObj = PbrThemer_Import::getInstance();

		$ouput = $importObj->import_customizer_options($_POST['demo_source'] . '/skins/Skin 1.txt');

		echo json_encode( $ouput ); exit;
	}

	/**
	 *
	 */
	public static function pbrthemer_page_optionsImport()
	{
		$importObj = PbrThemer_Import::getInstance();

		$importObj->import_page_options($_POST['demo_source'] . '/page_options.txt');

		$ouput = $importObj->import_theme_options( $_POST['demo_source'] . '/options.txt' );
		
		echo json_encode( $ouput ); exit;
	}

	/**
	 *
	 */
	public static function pbrthemer_menusImport()
	{
		$importObj = PbrThemer_Import::getInstance();

		$ouput  = $importObj->import_menus($_POST['demo_source'] . '/menus.txt');

		echo json_encode( $ouput ); exit;
	}

	/**
	 *
	 */
	public static function pbrthemer_widgetsImport() {

		$importObj = PbrThemer_Import::getInstance();

		$folder = $_POST['demo_source']."/";

		$importObj->import_widgets($folder.'widgets.txt');

		// Import widget logic
		$ouput = $importObj->import_widget_logic( $folder.'widget_logic_options.txt' );

		echo json_encode( $ouput ); exit;
	}
}

PbrThemer_Import_Ajax::init();