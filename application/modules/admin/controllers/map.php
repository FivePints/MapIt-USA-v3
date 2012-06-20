<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Map extends ADMIN_Controller {

	function __construct(){
		parent::__construct();
		//Ckeditor's configuration
		$this->data['ckeditor'] = array(
				//ID of the textarea that will be replaced
				'id' 	=> 	'tab1',
				'path'	=>	'/assets/shared/js/ckeditor',

				//Optionnal values
				'config' => array(
						'toolbar' 	=> 	"Promotions", 	//Using the Full toolbar
				)
		);
	} #end constructor function

 	private function _getPointInfo($id){

		#$pointId = FALSE , $limit = FALSE, $activeFlag = FALSE, $activeStatus = 1, $categoryId = FALSE, $userId = FALSE
		$options = array(
			'limit' => 1
		);
 		$pointData = $this->mapPoints->getMapPoint( $id, $options );

		$pointFields = $this->mapUserFields->getUserFields($id, FALSE);
		foreach ($pointFields[$id] as $pF){
			$pointsFields[$pF->f_fieldname] = $pF;
		}

    	return $this->data['points'] = array(
	    	'pointData' => $pointData[0],
	    	'pointFields' => $pointsFields
	    );

 	}
/**
 * View Map Controller Function
 *
 * This function is responsible for processing all
 * of the data relating to viewing the map points
 * in a table view.
 *
 * @author Mike DeVita
 * @category controller function
 * @copyright 2011 MapIT USA
 * @package map_points
 *
 */
	public function index(){
		/** get all the map points in the database */
		$points = $this->mapPoints->getMapPoint();
		if ($points){
			foreach ($points as $p){
				$pointIds[$p->p_id] =  $p->p_id;
			}
			/** @type array get the userfields from the model map_userfields */
			$userFields = $this->mapUserFields->getUserFields($pointIds, FALSE, array('19','20', '28', '31') );
			foreach ($points as $mapPoints){
				$usersfields = $userFields[$mapPoints->p_id];

	            /** reorganize userfields to be name based, and not id based */
	            foreach ($usersfields as $uF){
	                $uField[$uF->f_fieldname] = $uF;
	            }
				$this->data['points'][$mapPoints->p_id]['pointData'] = $mapPoints;
				$this->data['points'][$mapPoints->p_id]['pointFields'] = $uField;
			}
			$this->template
				->title('Map Management')
				->set_breadcrumb('Dashboard', '/admin/index')
				->append_metadata(" var oTable = $('#view-map-table').dataTable({ 'aaSorting': [[0, 'asc']] });")
				->build('admin/map/viewmap', $this->data);
		}
	} #end viewMap function

/**
  * Validate Form Fields Function
  * @return boolean
  */

	private function _validatePoints(){
		#Set the validation rules for the form fields
		$this->form_validation->set_rules('companyname', 'Company Name', 'required|xss_clean');
		$this->form_validation->set_rules('contactname', 'Contact Name', 'xss_clean');

		$this->form_validation->set_rules('phone1', 'Primary Phone Number', 'xss_clean');
		$this->form_validation->set_rules('phone2', 'Secondary Phone Number', 'xss_clean');
		$this->form_validation->set_rules('fax', 'Fax Number', 'xss_clean');


		$this->form_validation->set_rules('streetaddress', 'Street Address', 'xss_clean');
		$this->form_validation->set_rules('address2', 'Address 2', 'xss_clean');
		$this->form_validation->set_rules('city', 'City', 'required|xss_clean');
		$this->form_validation->set_rules('state', 'State', 'required|xss_clean');
		$this->form_validation->set_rules('zipcode', 'Zip Code', 'required|xss_clean');
		$this->form_validation->set_rules('category', 'Business Category', 'xss_clean');
		$this->form_validation->set_rules('user', 'Assigned User', '');
		$this->form_validation->set_rules('website', 'Company Website', 'xss_clean');
		$this->form_validation->set_rules('email', 'Company Email', 'xss_clean|valid_email');
		$this->form_validation->set_rules('logo', 'Logo', 'xss_clean');
		$this->form_validation->set_rules('image1', 'Image 1', 'xss_clean');
		$this->form_validation->set_rules('image2', 'Image 2', 'xss_clean');
		$this->form_validation->set_rules('twitter', 'Twitter', 'xss_clean');
		$this->form_validation->set_rules('facebook', 'Facebook', 'xss_clean');
		$this->form_validation->set_rules('linkedin', 'Linkedin', 'xss_clean');
		$this->form_validation->set_rules('youtube', 'Youtube', 'xss_clean');
		$this->form_validation->set_rules('googleplus', 'Google Plus', 'xss_clean');
		$this->form_validation->set_rules('youtubevideo', 'Youtube Video', 'xss_clean');

		$this->form_validation->set_rules('tab2', 'Tab 2', 'xss_clean');

		if ($this->form_validation->run()){
			$this->companyname = $this->input->post('companyname', TRUE);
			$this->contactname = $this->input->post('contactname', TRUE);
			$this->phone1 = $this->input->post('phone1', TRUE);
			$this->phone2 = $this->input->post('phone2', TRUE);
			$this->fax = $this->input->post('fax', TRUE);
			$this->address1 = $this->input->post('streetaddress', TRUE);
			$this->address2 = $this->input->post('address2', TRUE);
			$this->city = $this->input->post('city', TRUE);
			$this->state = $this->input->post('state', TRUE);
			$this->zip = $this->input->post('zipcode', TRUE);
			$this->category = $this->input->post('category', TRUE);


			$this->showonmap = $this->input->post('showonmap', TRUE);
			$this->chamber_member = $this->input->post('chamber_member', TRUE);
			$this->homebusiness = $this->input->post('homebusiness', TRUE);

			$this->active = $this->input->post('active', TRUE);
			$this->user = $this->input->post('user', TRUE);
			$this->level = $this->input->post('level', TRUE);

			$this->website = $this->input->post('website', TRUE);
			$this->email = $this->input->post('email', TRUE);
			$this->logo = $this->input->post('logo', TRUE);
			$this->image1 = $this->input->post('image1', TRUE);
			$this->image2 = $this->input->post('image2', TRUE);
			$this->twitter = $this->input->post('twitter', TRUE);
			$this->facebook = $this->input->post('facebook', TRUE);
			$this->linkedin = $this->input->post('linkedin', TRUE);
			$this->youtube = $this->input->post('youtube', TRUE);
			$this->googleplus = $this->input->post('googleplus', TRUE);
			$this->youtubevideo = $this->input->post('youtubevideo', TRUE);

			#promotions
			$this->tab1 = $this->input->post('tab1', TRUE);
			$this->tab2 = urlencode($this->input->post('facebook_feed', TRUE));
			return TRUE;

		}else{
			return validation_errors();
		}
 	}#end validation function

 	public function addPoint(){


 		$this->template
 			->title('Add Point')
 			->set_breadcrumb('Manage Points', 'profile/map/index/')
 			->set_breadcrumb('Add Point', 'profile/map/addpoint/')

 			->append_metadata('$().ready(function(){ $(".chzn-select").chosen(); });')
 			->build('admin/map/addmap', $this->data);
 	}
	/**
 	 * process the adding of a point's information
 	 * to the database. This validates from _validatePoints();
 	 * @return string json_encoded return if any errors or not
 	 */
	public function processAddPoint(){
		$validationErrors = self::_validatePoints();
		if ($validationErrors != 1){
			$r[] = array(
				'message' => 'Failed to submit point to database. Due to validation Errors',
				'type' => 'error'
			);
			$this->message->add(400, $r);
		}else{
			/**
			 * enable the youtube helper spark
			 *
			 * this does lots of nifty things with youtube, for retrieving the youtube Id and storing it in the database
			 * right now it just gets the youtube video ID when its passed the URL of the video.
			 */
			$this->load->spark('video_helper/1.0.2');
			$this->load->helper('video');

			/** @type youtube_spark if the field isnt blank, get the ID of the youtube video that was copy/pasted */
			if ($this->youtubevideo != 'Enter Your Youtube Video ID') {
				$this->youtubevideo = youtube_id($this->youtubevideo);
			}

			/**
			 * concact the address fields so we can throw the adderss to the geocoder for lat long.
			 * @type [type]
			 */
			$address = $this->address1.' '.$this->address2.' '.$this->city.' '.$this->state.' '.$this->zip;
			#get the geo coordinates for the provided address
			$_geocode = $this->gmap->geoGetCoords($address);
			$lon =  $_geocode['lon'];
			$lat =  $_geocode['lat'];

			#pass all this form data to the mapPoints model to be inserted into the database.
			$pointId = $this->mapPoints->addMapPoint($this->category, $this->user, $this->level, $this->showonmap, $this->homebusiness, $lat, $lon, $this->active, $this->chamber_member, TRUE);

			/**
			 * Start the file uploading!
			 *
			 * If the file upload fields are blank then we will pass the existing db vars
			 * back to the db via $logo, $image1, $image2
			 *
			 * @author Mike DeVita
			 * @category controller process
			 * @copyright 2011 MapIT USA
			 * @todo convert config arrays to a config file and loaded in dynamically
			 *
			 */

			foreach ($_FILES as $files => $filesValue){
				if (!empty($filesValue['name'])){
					#uploadImage($files, $configId, $pointId = FALSE, $time = FALSE);
					$this->$files = $this->file_upload->uploadImage($files, $pointId, TRUE);
		        #if the file fields are empty then set the var to whats existing in the database so theres no overwriting.
				}else{
					$this->$files = '';
				}
			}
			if ($this->tab1_image){
				$this->tab1 = '<img src="'.base_url().'uploads/'.$pointId.'/'.$this->tab1_image.'"/>';
			}

			/**
			 * User Field Processing
			 *
			 * this block of code handles all of the customer user field
			 * processing. This block of code gets all of the fields available
			 * and all of the user's set fields, and compiles the HTML for each field
			 * it then saves that HTML into a column in map_userfields to be pulled later
			 *
			 * @author Mike DeVita
			 * @category controller process
			 * @copyright 2011 MapIT USA
			 *
			 */

			/**
			 * get a list of all of the fields that are in the database
			 */
			$fields = $this->mapUserFields->getFields();

			/**
			 * go through each field and sort the data into the right format `$field[fieldname] = array(field values)`
			 */

			foreach ($fields as $f){
				$userValue = $f->fieldname;
				if (isset($this->$userValue) && $this->$userValue != '' ) {
					$userValue = $this->$userValue;
					$field[$f->fieldname] = array(
						'html' => $f->html_template,
						'fieldname' => $f->fieldname,
						'uservalue' => $userValue,
						'fieldid' => $f->id
						);
				}else{
					$field[$f->fieldname] = array(
						'html' => $f->html_template,
						'fieldname' => $f->fieldname,
						'uservalue' => '',
						'fieldid' => $f->id
						);
				}
			}
			#compile all of the HTML to be put into Userfields for quicker querying
			$compiledHtml = $this->map_html->compileHtml($field, $pointId);

			#pass the compiled HTML to the userfields model to be inserted into the userfields
			if( $this->mapUserFields->addUserFieldHtml($compiledHtml) ){
				$r[] = array(
					'message' => 'Successfully added the map point!',
					'type' => 'success',
					'flashdata' => TRUE
				);
				$this->message->add(200, $r);
				/** Clear the cache now that the point has been added */
				$this->db->cache_delete('admin', 'map');
				redirect('admin/map/index');
			}else{
				$r[] = array(
					'message' => 'Unable to add point to the database',
					'type' => 'error',
					'flashdata' => TRUE
				);
				$this->message->add(400, $r);
				redirect('admin/map/index');
			}

		}
	}

 	/**
 	 * display the edit map form, this
 	 * form is the same form that is used
 	 * for adding points, except it auto
 	 * populates the existing data.
 	 * @param  boolean $id intenger of id number, default is false
 	 */
 	public function editpoint($id = false){

 		if ($id == false){
 			die('No Point selected!');
 		}

 		self::_getPointInfo($id);

 		$this->template
 			->title('Edit Point')
 			->set_breadcrumb('Edit Point', 'profile/map/editpoint/'.$id)
 			->append_metadata('$().ready(function(){ $(".chzn-select").chosen(); });')
 			->build('admin/map/editmap', $this->data);
 	}
 	/**
 	 * process the edit of a point
 	 * This goes through each field
 	 * and makes sure the value changed
 	 * if the value did change then the
 	 * database column is updated.
 	 */
 	public function processEditPoint($id = false){
 		if ($id == false){
 			die('no point selected!');
 		}

		$validationErrors = self::_validatePoints();
		if ($validationErrors != 1){
			$r[] = array(
				'message' => 'Failed to submit edits to database. Due to validation Errors',
				'type' => 'errr'
			);
			$this->message->add(400, $r);
		}else{

			self::_getPointInfo($id);
			/**
			 * enable the youtube helper spark
			 *
			 * this does lots of nifty things with youtube, for retrieving the youtube Id and storing it in the database
			 * right now it just gets the youtube video ID when its passed the URL of the video.
			 */
			$this->load->spark('video_helper/1.0.2');
			$this->load->helper('video');

			/** @type youtube_spark if the field isnt blank, get the ID of the youtube video that was copy/pasted */
			if ($this->youtubevideo != $this->data['points']['pointFields']['youtubevideo']->uf_fieldvalue ) {
				$this->youtubevideo = youtube_id($this->youtubevideo);
			}else{
				if( isset($this->youtubevideo) ){
					$this->youtubevideo = $this->data['points']['pointFields']['youtubevideo']->uf_fieldvalue;
				}
			}

			/**
			 * concact the address fields so we can throw the adderss to the geocoder for lat long.
			 * @type [type]
			 */
			$address = $this->address1.' '.$this->address2.' '.$this->city.' '.$this->state.' '.$this->zip;
			#get the geo coordinates for the provided address
			$_geocode = $this->gmap->geoGetCoords($address);
			$lon =  $_geocode['lon'];
			$lat =  $_geocode['lat'];

			$options = array(
				'home_business' => $this->homebusiness,
				'chamber_member' => $this->chamber_member,
				'category' => $this->category,
				'show_on_map' => $this->showonmap,
				'user' => $this->user,
				'level' => $this->level
			);
			#pass all this form data to the mapPoints model to be updated in the database.
			/** @var integer returns the id of the point that was edited */
			$this->mapPoints->editMapPoint($lat, $lon, $id, $options);
			/**
			 * Start the file uploading!
			 *
			 * If the file upload fields are blank then we will pass the existing db vars
			 * back to the db via $logo, $image1, $image2
			 *
			 * @author Mike DeVita
			 * @category controller process
			 * @copyright 2011 MapIT USA
			 * @todo convert config arrays to a config file and loaded in dynamically
			 *
			 */

			foreach ($_FILES as $files => $filesValue){

				if (!empty($filesValue['name'])){
					#uploadImage($files, $configId, $pointId = FALSE, $time = FALSE);
					$this->$files = $this->file_upload->uploadImage($files, $id, TRUE);

					if ($this->tab1_image){
						$this->tab1 = '<img src="'.base_url().'uploads/'.$id.'/'.$this->tab1_image.'"/>';
					}

		        #if the file fields are empty then set the var to whats existing in the database so theres no overwriting.
				}else{
					if ( isset($this->data['points']['pointFields'][$files]->uf_fieldvalue) ){
						$this->$files = $this->data['points']['pointFields'][$files]->uf_fieldvalue;
					}else{
						$this->$files = '';
					}
				}
			}


			/**
			 * User Field Processing
			 *
			 * this block of code handles all of the customer user field
			 * processing. This block of code gets all of the fields available
			 * and all of the user's set fields, and compiles the HTML for each field
			 * it then saves that HTML into a column in map_userfields to be pulled later
			 *
			 * @author Mike DeVita
			 * @category controller process
			 * @copyright 2011 MapIT USA
			 *
			 */

			/**
			 * get a list of all of the fields that are in the database
			 */
			$fields = $this->mapUserFields->getFields();

			/**
			 * go through each field and sort the data into the right format `$field[fieldname] = array(field values)`
			 */

			foreach ($fields as $f){
				$userValue = $f->fieldname;
				if (isset($this->$userValue)){
					$userValue = $this->$userValue;
					$field[$f->fieldname] = array(
						'html' => $f->html_template,
						'fieldname' => $f->fieldname,
						'uservalue' => $userValue,
						'fieldid' => $f->id
						);
				}else{
					$field[$f->fieldname] = array(
						'html' => $f->html_template,
						'fieldname' => $f->fieldname,
						'uservalue' => '',
						'fieldid' => $f->id
						);
				}

			}
			#compile all of the HTML to be put into Userfields for quicker querying
			$compiledHtml = $this->map_html->compileHtml($field, $id);

			#pass the compiled HTML to the userfields model to be inserted into the userfields
			if( $this->mapUserFields->editUserFieldHtml($compiledHtml) ){
				$r[] = array(
					'message' => 'Successfully edited the map point!',
					'type' => 'success',
					'flashdata' => TRUE
				);
				$this->message->add(200, $r);
				/** Clear the cache now that the point has been added */
				$this->db->cache_delete('admin', 'map');
				redirect('admin/map/index');
			}else{
				$r[] = array(
					'message' => 'Unable to make the edits to the point',
					'type' => 'error',
					'flashdata' => TRUE
				);
				$this->message->add(400, $r);
				redirect('admin/map/index');
			}

		}
 	} //END processEditPoint()

	/**
	 * Delete Point Controller Function
	 *
	 * This function deletes a point from the database points table
	 * based on the pointId that was passed.
	 *
	 * @var pointId
	 * @author Mike DeVita
	 * @category controller function
	 * @copyright 2011 MapIT USA
	 * @package map_points
	 *
	 */
 	public function deletePoint($pointId = ''){
 		$this->mapPoints->deleteMapPoint($pointId);

 		if( $this->mapUserFields->deleteUserFields($pointId) ){
 			$r[] = array(
 				'message' => 'Successfully deleted the map point from the database',
 				'type' => 'success'
 			);
 			$this->message->add(200, $r);
 		}else{
 			$r[] = array(
 				'message' => 'There was an error when deleting the map point from the database',
 				'type' => 'error'
 			);
 			$this->message->add(400, $r);
 		}
 	}#end deletePoint function

 	public function status($pointId = ''){
 		if ( $this->input->post('status') == 1 ){
 			self::_deactivatePoint($pointId);
 		}elseif ( $this->input->post('status') == 0 ){
 			self::_activatePoint($pointId);
 		}else{
 			return false;
 		}
 	}
	/**
	 * Activate Point Controller Function
	 *
	 * This function activates a point from the database based
	 * on the pointId that was passed from the URI.
	 *
	 * @var pointId
	 * @author Mike DeVita
	 * @category controller function
	 * @copyright 2011 MapIT USA
	 * @package map_points
	 *
	 */
 	private function _activatePoint($pointId = ''){
 		if( $this->mapPoints->activateMapPoint($pointId) ){
 			$r[] = array(
 				'message' => 'Successfully Activated the map point, it will show on the map in 10 minutes.',
 				'type' => 'success'
 			);
 			$this->message->add(200, $r);
 		}else{
 			$r[] = array(
 				'message' => 'There was an error activating the map point',
 				'type' => 'error'
 			);
 			$this->message->add(403, $r);
 		}
 	}#end activatePoint function
	/**
	 * Deactivate Point Controller Function
	 *
	 * This function deactivates a point from the database based
	 * on the pointId that was passed from the URI.
	 *
	 * @var pointId
	 * @author Mike DeVita
	 * @category controller function
	 * @copyright 2011 MapIT USA
	 * @package map_points
	 *
	 */
 	private function _deactivatePoint($pointId = ''){
 		if( $this->mapPoints->deactivateMapPoint($pointId) ){
 			$r[] = array(
 				'message' => 'Successfully deactivated the map point, it will disappear from the map in 10 minutes.',
 				'type' => 'success'
 			);
 			$this->message->add(200, $r);
 		}else{
 			$r[] = array(
 				'message' => 'There was an error deactivating the map point',
 				'type' => 'error'
 			);
 			$this->message->add(400, $r);
 		}

 	}#end activatePoint function
} #end class