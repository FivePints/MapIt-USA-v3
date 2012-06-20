<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends ADMIN_Controller {

	function __construct(){
		parent::__construct();

	} #end constructor function



	public function index(){
		/**
		 * Page Values
		 * 
		 * This passes preset values that are loaded into the view. 
		 * @var page_file, page_title, page_breadcrumb, page_description, customJs
		 * 
		 */
		$this->data['chart'] = $this->mapPoints->getCountByCategory();
		$this->template
			->title('Admin Dashboard')
			->set_breadcrumb('Dashboard', 'profile/index')
			->set_partial('add-new-point-form', 'profile/partials/map/addpointform')
			->append_metadata("$('#graph-data').visualize({type: 'pie', height: 250}).appendTo('#tab-pie').trigger('visualizeRefresh');")
			->build('admin/index', $this->data);
	} #end viewMap function

	public function batchImportUserfields(){
		$this->load->library('csvreader');
		$userfields = $this->csvreader->parse_file('./uploads/map_userfields.csv');
		foreach ($userfields as $uF){
			$field = $this->mapUserFields->getFields(FALSE, $uF['fieldid']);
			$field = $field[0];
			$fieldvalue = array(
				$field->fieldname => $uF['fieldvalue']
			);
			$uF = array(
				'id' => $uF['id'],
				'fieldid' => $uF['fieldid'],
				'pointid' => $uF['pointid'],
				'timestamp' => time(),
				'html' => $this->map_html->compileBatchHtml($field->html, $fieldvalue),
				'fieldvalue' => $uF['fieldvalue']
			);
			
			$this->mapUserFields->addUserFieldHtml_Batch($uF);
			echo '<pre>';print_r($uF);echo '</pre>End of Array Item<br>	';
		}
	}#end batchimportUserfields
	public function batchProcessAddresses(){
		$points = $this->mapPoints->getMapPoint();
		foreach ($points as $p){
			$address = $p['21'].' '.$p['22'].' '.$p['23'].' '.$p['25'].' '.$p['26'];
			$_geocode = $this->gmap->geoGetCoords($address);
			$lat =  $_geocode['lat'];
			$lng =  $_geocode['lon'];
			$addresses[] = array(
				'id' => $id->p_id,
				'lat' => $lat,
				'lng' => $lng
			);
		}
		$this->mapPoints->updateCoords($addresses);
	}
	public function batchImportPoints(){
		$this->load->library('csvreader');
		$points = $this->csvreader->parse_file('./uploads/final_import_real_points-022812.csv');

		foreach ($points as $p){
			/**
			 * map_points db handling
			 * 
			 **/
			/** geocode the address thats in the csv file to lat/long for db submission */
			$address = $p['21'].' '.$p['22'].' '.$p['23'].' '.$p['25'].' '.$p['26'];
			$_geocode = $this->gmap->geoGetCoords($address);
			$lat =  $_geocode['lat'];
			$lng =  $_geocode['lon'];

			/** setup the db columns for map_points */
			$show_on_map = $p['show_on_map'];
			$home_business = $p['home_business'];
			$type = $p['type'];
			$active = $p['active'];
			$user = 2;
			$level = $p['level'];
			$chamber = $p['chamber_member'];
			if (!is_numeric($type)){die("Type is non numerical<br>Type Is: $type"); }
			#pass all this form data to the mapPoints model to be inserted into the database.
			$pointId = $this->mapPoints->addMapPoint($type, $user, $level, $show_on_map, $home_business, $lat, $lng, $active, $chamber, TRUE);			
			/**
			 * map_userfields db handling
			 * 
			 **/
			$field = $this->mapUserFields->getFields();
			#echo '<pre>'; print_r($field); echo '</pre>';
			foreach ($field as $f){

				$fieldValue[$f->fieldname] = $p[$f->id];
				if (!empty($fieldValue[$f->fieldname])){
					$userFields = array(
						'fieldid' => $f->id,
						'pointid' => $pointId,
						'timestamp' => time(),
						'html' => $this->map_html->compileBatchHtml($f->html_template, $fieldValue),
						'fieldvalue' => $p[$f->id]
					);
				}else{
					$userFields = array(
						'fieldid' => $f->id,
						'pointid' => $pointId,
						'timestamp' => time(),
						'html' => '',
						'fieldvalue' => $p[$f->id]
					);
				}
			
			$this->mapUserFields->addUserFieldHtml_Batch($userFields);
			#echo '<pre>'; print_r($userFields); echo '</pre>';
			}
		}
		
	}#end batchImportPoints()



}