<?php
/**
 * The controller for the front end of MapIT.
 *
 * @author Mike DeVita
 * @category controller
 * @copyright 2011 MapIT USA
 * @package map_controller
 */

 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends FRONT_Controller {
	function __construct(){
		parent::__construct();
	}#end constructor function

	public function out($id){
		$this->mapAdvertisements->insertAdClick($id);
		$this->data['advertisement'] = $this->mapAdvertisements->getAdvertisement($id);
		$title = $this->data['advertisement']->title;
		$this->template
			 ->title($title)
			 ->build('index/out', $this->data);
	}
	/**
	 * Index Function, Default view
	 *
	 * This is the default function that is ran when visiting the MapIT
	 * frontend program
	 *
	 * @var pointId
	 * @author Mike DeVita
	 * @category controller_function
	 * @copyright 2011 MapIT USA
	 * @package index_controller
	 */
	public function index(){
		if($this->data['mapConfig']->events == 1){
		}
		#load a random video advertisement from the getAdvertisements(status {numerical}, RANDOM{boolean} );
		$advertisement = $this->mapAdvertisements->getAdvertisements(1, FALSE);

		#generate the embed code for advertisement and set it to an array that can be loaded into the view.
		if ($advertisement != false){
			foreach ($advertisement as $a){
				if ($a->type == 'picture'){
					$fullUrl = base_url('index/out').'/'.$a->id.'/'.url_title($a->description);
					$this->data['advertisement'][] = '<a href="'.$fullUrl.'" target="_blank"><img src="'.base_url().'uploads/advertisements/'.$a->filename.'" /></a>';
				}elseif($a->type == 'video'){
					$this->data['advertisement'][] = youtube_embed($a->youtube_id, '200', '160');
				}
			}
		}else{
			$this->data['advertisement'][] = '<img src="http://placehold.it/200x160" />';
		}
		/** set the main_content, and load the view */
		$this->data['main_content'] = 'index';
		$this->load->view('index/template', $this->data);
	}#END Index Function


	/**
	 * Process Function, called via ajax
	 *
	 * this function is called via ajax, typically from the default
	 * view. It takes a category, search term, or zipcode and returns a list of points in
	 * json encoded array format of the points lat/long, html, and sidebar Html
	 *
	 * @author Mike DeVita
	 * @category controller_function
	 * @copyright 2011 MapIT USA
	 * @package index_controller
	 *
	 * @return json_encoded array of points
	 */
	public function process($searchType){
		/**
		 * handle the type of search
		 *
		 * there are three tpyes of search: categorylist, companyname, and zipcode
		 */
		switch($searchType){
			case 'geteventdates':
				$eventDates = $this->mapPoints->getEventsByDate();
				if($eventDates){
					foreach ($eventDates as $eD):
						$dates[] = array(
							'month' => $eD->eventMonth,
							'day' => $eD->eventDate,
							'count' => $eD->eventCount
						);
					endforeach;
					echo json_encode($dates);
				}else{
					return false;
				}
			break;
			case 'events':
				/**
				 * get all of the points that have a category of $cat and put them in an array
				 *
				 * @param {numerical} $pointId the id of the point you want to return. default is FALSE
				 * @param {numerical} $limit the limit of rows returned, if any is set. default is FALSE
				 * @param {boolean} $activeFlag boolean (TRUE/FALSE) flag to only show members based on $activeStatus
				 * @param {numerical} $activeStatus shows members based on this status, $activeFlag must be set TRUE
				 * @param {numerical} $categoryId only retrieve points based on the category id that is passed
				 * @param boolean $userId id to lookup based on specific user ID number
				 * @param boolean eventsFlag flag of whether to enable events search or not
				 * @param boolean eventsDate string for searching by date
				 *
				 */
				$date_picked = $this->input->post('date-picked');
				$events_categories = $this->input->post('category-events');

				$options = array(
					'activeFlag' => TRUE,
					'activeStatus' => 1,
					'categoryId' => $events_categories,
					'eventFlag' => TRUE,
					'datePicked' => $date_picked
				);
				$this->data['mapPoints'] = $this->mapPoints->getMapPoint( FALSE, $options );

				$this->data['events'] = true;

				/**
				 * if theres an error, show it.
				 *
				 * @param string - message
				 * @param array - fields
				 * @param boolean - exit
				 * @param boolean - jsonEncode
				 * @param string - messageType [success, error]
				 */
				if ($this->data['mapPoints'] == 0){
					$r[] = array(
						'message' => 'No Map Points Were Returned, when searching for an event',
						'type' => 'error'
					);
					$this->message->add(400, $r);
					exit;
				}
				$this->_addPoint();
			break;
			/**
			 * deals categorlist search
			 *
			 * this searches the database based on what was checked on the
			 * deals category list, this takes a postvar(items), which is a query
			 * string and explodes/decodes it to be a numerical array of category Ids.
			 * It then passes these IDs to the getMapPoints function that queries the
			 * table for any points where type IN($cat);
			 *
			 */
			case 'deals-categorylist':
				$a = explode('&', $this->input->post('items'));
				$implodeIt = implode('', $a);
				if (empty($implodeIt)){
					$r[] = array(
						'message' => 'Please select at least one category first.',
						'type' => 'error'
					);
					$this->message->add(400, $r);
					exit;
				}else{
					$i = 0;
					while ($i < count($a)) {
					    $b = explode('=', $a[$i]);
					    $cat[] = urldecode($b[1]);
					    $i++;
					}
				}

				$dPIds = $this->mapPoints->getDealPoints();

				foreach($dPIds as $d){
					$dealPointIds[] = $d['id'];
				}
				/**
				 * get all of the points that have a category of $cat and put them in an array
				 *
				 * @param {numerical} $pointId the id of the point you want to return. default is FALSE
				 * @param {numerical} $limit the limit of rows returned, if any is set. default is FALSE
				 * @param {boolean} $activeFlag boolean (TRUE/FALSE) flag to only show members based on $activeStatus
				 * @param {numerical} $activeStatus shows members based on this status, $activeFlag must be set TRUE
				 * @param {numerical} $categoryId only retrieve points based on the category id that is passed
				 *
				 */
				$options = array(
					'activeFlag' => TRUE,
					'activeStatus' => 1,
					'categoryId' => $cat
				);
				$this->data['mapPoints'] = $this->mapPoints->getMapPoint( $dealPointIds, $options );
				/**
				 * if theres an error, show it.
				 *
				 * @param string - message
				 * @param array - fields
				 * @param boolean - exit
				 * @param boolean - jsonEncode
				 * @param string - messageType [success, error]
				 */
				if ($this->data['mapPoints'] == 0){
					$r[] = array(
						'message' => 'No Map Points Were Returned, when searching by category list',
						'type' => 'error'
					);
					$this->message->add(400, $r);
					exit;
				}
				self::_addPoint();
			break;

			/**
			 * categorylist Search
			 *
			 * This searches the database based on what was checked on
			 * the category list, this takes a postvar(items), which is a query string
			 * and explodes/decodes it to be a numerical array of category IDs. It then
			 * passes these IDs to the getMapPoints function that queries the table for
			 * any points where type IN($cat);
			 *
			 */
			case 'categorylist':
					$a = explode('&', $this->input->post('items'));
					$implodeIt = implode('', $a);
					if (empty($implodeIt)){
						$r[] = array(
							'message' => 'Please select at least one category first',
							'type' => 'error'
						);
						$this->message->add(400, $r);
						exit;
					}else{
						$i = 0;
						while ($i < count($a)) {
						    $b = explode('=', $a[$i]);
						    $cat[] = urldecode($b[1]);
						    $i++;
						}
					}

				/**
				 * get all of the points that have a category of $cat and put them in an array
				 *
				 * @param {numerical} $pointId the id of the point you want to return. default is FALSE
				 * @param {numerical} $limit the limit of rows returned, if any is set. default is FALSE
				 * @param {boolean} $activeFlag boolean (TRUE/FALSE) flag to only show members based on $activeStatus
				 * @param {numerical} $activeStatus shows members based on this status, $activeFlag must be set TRUE
				 * @param {numerical} $categoryId only retrieve points based on the category id that is passed
				 *
				 */
				$options = array(
					'activeFlag' => TRUE,
					'activeStatus' => 1,
					'categoryId' => $cat
				);
				$this->data['mapPoints'] = $this->mapPoints->getMapPoint( FALSE, $options );
				/**
				 * if theres an error, show it.
				 *
				 * @param string - message
				 * @param array - fields
				 * @param boolean - exit
				 * @param boolean - jsonEncode
				 * @param string - messageType [success, error]
				 */
				if ($this->data['mapPoints'] == 0){
					$r[] = array(
						'message' => 'No Map Points Were Returned, When Searching By Category List',
						'type' => 'error'
					);
					$this->message->add(400, $r);
					exit;
				}
				self::_addPoint();
			break;

			/**
			 * companyname Search
			 *
			 * this searches the database based on what was input
			 * into the textbox #company-name. It then takes a
			 * postvar(items), which is a querty string of search
			 * terms that are space delimited. It explodes the string
			 * and then explodes each section by + and assigns each term
			 * to a numerical array. This array is passed to the
			 * searchCompanyname() model that queries the table for
			 * any points where fieldid = 19 AND fieldvalue LIKE $searchTerms
			 *
			 */
			case 'companyname':
				$searchTerms = $this->input->post('items', TRUE);

				/**
				 * [$results description]
				 * @param  array searchTerms array of search terms
				 * @param boolean strict flag to determine whether its a wildcard search or not.
				 */
				$results = $this->mapUserFields->searchCompanyName($searchTerms, TRUE);
				/**
				 * if theres an error, show it.
				 *
				 * @param string - message
				 * @param array - fields
				 * @param boolean - exit
				 * @param boolean - jsonEncode
				 * @param string - messageType [success, error]
				 */
				if ($results == 0 ){
					$r[] = array(
						'message' => 'No Map Points Were Returned By Searching For Company Name.',
						'type' => 'error'
					);
					$this->message->add(400, $r);
					exit;
				}

				/** go through each point's userfield and set the pointid */
				foreach ($results as $r){
					$p[] = $r['pointid'];
				}
				/**
				 * get all of the points that have a category of $cat and put them in an array
				 *
				 * @param {numerical} $pointId the id of the point you want to return. default is FALSE
				 * @param {numerical} $limit the limit of rows returned, if any is set. default is FALSE
				 * @param {boolean} $activeFlag boolean (TRUE/FALSE) flag to only show members based on $activeStatus
				 * @param {numerical} $activeStatus shows members based on this status, $activeFlag must be set TRUE
				 * @param {numerical} $categoryId only retrieve points based on the category id that is passed
				 *
				 */
				$options = array(
					'activeFlag' => TRUE,
					'activeStatus' => 1
				);
				$this->data['mapPoints'] = $this->mapPoints->getMapPoint( $p, $options );
				/**
				 * if theres an error, show it.
				 *
				 * @param string - message
				 * @param array - fields
				 * @param boolean - exit
				 * @param boolean - jsonEncode
				 * @param string - messageType [success, error]
				 */
				if ($this->data['mapPoints'] == 0){
					$r[] = array(
						'message' => 'No Map Points Were Returned By Searching For Company Name.',
						'type' => 'error'
					);
					$this->message->add(400, $r);
					exit;
				}
				self::_addPoint();

			break;

			case 'deals-lookup':
				$searchTerms = $this->input->post('term', TRUE);
				print_r($searchTerms);
				$results = $this->mapUserFields->searchCompanyName($searchTerms, FALSE, array('deals' => true) );
				/**
				 * if theres an error, show it.
				 *
				 * @param string - message
				 * @param array - fields
				 * @param boolean - exit
				 * @param boolean - jsonEncode
				 * @param string - messageType [success, error]
				 */
				if ($results == 0 ){
					$r[] = array(
						'message' => 'No Map Points Were Returned By Searching For Company Name.',
						'type' => 'error'
					);
					$this->message->add(400, $r);
					exit;
				}

				/** go through each point's userfield and set the pointid */
				foreach ($results as $r){
					$p[] = $r['pointid'];
				}
				/**
				 * get all of the points that have a category of $cat and put them in an array
				 *
				 * @param {numerical} $pointId the id of the point you want to return. default is FALSE
				 * @param {numerical} $limit the limit of rows returned, if any is set. default is FALSE
				 * @param {boolean} $activeFlag boolean (TRUE/FALSE) flag to only show members based on $activeStatus
				 * @param {numerical} $activeStatus shows members based on this status, $activeFlag must be set TRUE
				 * @param {numerical} $categoryId only retrieve points based on the category id that is passed
				 *
				 */
				$options = array(
					'activeFlag' => TRUE,
					'activeStatus' => 1
				);
				$this->data['mapPoints'] = $this->mapPoints->getMapPoint( $p, $options );
				/**
				 * if theres an error, show it.
				 *
				 * @param string - message
				 * @param array - fields
				 * @param boolean - exit
				 * @param boolean - jsonEncode
				 * @param string - messageType [success, error]
				 */
				if ($this->data['mapPoints'] == 0){
					$r[] = array(
						'message' => 'No Map Points Were Returned By Searching For Company Name.',
						'type' => 'error'
					);
					$this->message->add(400, $r);
					exit;
				}
				$this->_addPoint();
			break;

			case 'companyname-lookup':
				$searchTerms = $this->input->post('term', TRUE);

				$results = $this->mapUserFields->searchCompanyName($searchTerms);
				/**
				 * if theres an error, show it.
				 *
				 * @param string - message
				 * @param array - fields
				 * @param boolean - exit
				 * @param boolean - jsonEncode
				 * @param string - messageType [success, error]
				 */
				if ($results == 0 ){
					$r[] = array(
						'message' => 'No Map Points Were Returned By Searching For Company Name.',
						'type' => 'error'
					);
					$this->message->add(400, $r);
					exit;
				}

				/** go through each point's userfield and set the pointid */
				foreach ($results as $r){
					$p[] = $r['pointid'];
				}
				/**
				 * get all of the points that have a category of $cat and put them in an array
				 *
				 * @param {numerical} $pointId the id of the point you want to return. default is FALSE
				 * @param {numerical} $limit the limit of rows returned, if any is set. default is FALSE
				 * @param {boolean} $activeFlag boolean (TRUE/FALSE) flag to only show members based on $activeStatus
				 * @param {numerical} $activeStatus shows members based on this status, $activeFlag must be set TRUE
				 * @param {numerical} $categoryId only retrieve points based on the category id that is passed
				 *
				 */
				$options = array(
					'activeFlag' => TRUE,
					'activeStatus' => 1
				);
				$this->data['mapPoints'] = $this->mapPoints->getMapPoint( $p, $options );
				/**
				 * if theres an error, show it.
				 *
				 * @param string - message
				 * @param array - fields
				 * @param boolean - exit
				 * @param boolean - jsonEncode
				 * @param string - messageType [success, error]
				 */
				if ($this->data['mapPoints'] == 0){
					$r[] = array(
						'message' => 'No Map Points Were Returned By Searching For Company Name.',
						'type' => 'error'
					);
					$this->message->add(400, $r);
					exit;
				}
				$this->_addPoint();
			break;
		}#END Switch
	}

	/**
	 * this function actually processes the data,
	 * and puts it all in json format to be passed back to the
	 * frontend views to be populated on the map.
	 *
	 * @author Mike DeVita <mdevita@fivepints.com>
	 * @package map_controller
	 * @copyright 2012 MapIt USA
	 *
	 */
	private function _addPoint(){
		/** cycle through each mapPoint row that was returned and set the pointIds up to be something we can use. */
		foreach ($this->data['mapPoints'] as $p){
			$pointIds[$p->p_id] =  $p->p_id;
		}

		/** @type array get the userfields from the model map_userfields */
		$userFields = $this->mapUserFields->getUserFields($pointIds);
		/**
		 * if theres an error, show it.
		 *
		 * @param string - message
		 * @param array - fields
		 * @param boolean - exit
		 * @param boolean - jsonEncode
		 * @param string - messageType [success, error]
		 */
		if ($userFields == 0){
			$r[] = array(
				'message' => 'No user fields were returned, probably because nothing was found',
				'type' => 'error'
			);
			$this->message->add(400, $r);
			exit;
		}

		/** cycle through each mapPoint row that was returned and begin to setup the map point data */
		foreach ($this->data['mapPoints'] as $mapPoints){
			/** @type object array create data object array  so we can pass it to the views that create the popup and sidebar html */
			$this->data['mapsPoint'] = $mapPoints;
			/** @type array associate the point to its userfields */
			$usersfields = $userFields[$mapPoints->p_id];
			/** @type array explode the points allowed_fields into a numerical ray of fieldid's */
			$allowed_fields = explode(',', $mapPoints->ml_allowed_fields);
			if ($this->data['mapsPoint']->p_chamber == 1){
				array_push($allowed_fields, 1);
			}
			/**
			 * go through each of the allowed_fields and associate the userfield with the field
			 * this is what actually limits a field from showing up if they arent a certain level
			 */
			foreach ($allowed_fields as $af){

				$this->data['userfield'][$usersfields[$af]->f_fieldname] = $usersfields[$af];
			}
			/**
			 * enable the youtube helper spark
			 *
			 * this does lots of nifty things with youtube, for retrieving the youtube Id and storing it in the database
			 * right now it just gets the youtube video ID when its passed the URL of the video.
			 */
			$this->load->spark('video_helper/1.0.2');
			$this->load->helper('video');

			if (isset($this->data['userfield']['youtubevideo']->uf_fieldvalue)){
				$youtubevideo = $this->data['userfield']['youtubevideo'];
				$this->data['userfield']['youtubevideo']->uf_html = youtube_embed($youtubevideo->uf_fieldvalue, '246', '125');
			}
			if( isset($this->data['events']) && $this->data['events'] == true ){
				$popup_template = 'popup_events_template';
			}else{
				$popup_template = 'popup_template';
			}

			/** @type htmlview load the infoBubble view, pass it the data object and return html in a string format */
			$pointHtmlView = $this->load->view('index/'.$popup_template, $this->data, TRUE);
			/** @type htmlview load the sidebar view, pass it the data object and return html in a string format */
			$sidebarHtmlView = $this->load->view('index/sidebar_template', $this->data, TRUE);
			if ($mapPoints->p_home_business == 1){
				/** @type string create the url to the marker icon, based on the points level */
				$markerIcon = base_url()."/images/client_images/marker_icons/".$mapPoints->p_level."_"."home_".$this->data['mapConfig']->marker_icon;
			}else{
				/** @type string create the url to the marker icon, based on the points level */
				$markerIcon = base_url()."/images/client_images/marker_icons/".$mapPoints->p_level."_".$this->data['mapConfig']->marker_icon;
			}
			/** add the company tab, which is the default tab */
			$tabs[$mapPoints->p_id][] = array(
				'tabTitle' => 'Company',
				'tabContent' => $pointHtmlView
			);
			if (isset($this->data['userfield']['tab1'])){
				if ($this->data['userfield']['tab1']->uf_fieldvalue != ''):
					$tabs[$mapPoints->p_id][] = array(
						'tabTitle' => 'Promotions',
						'tabContent' => $this->data['userfield']['tab1']->uf_html,
						'tabFieldValue' => $this->data['userfield']['tab1']->uf_fieldvalue
					);
				endif;
			}
			if (isset($this->data['userfield']['tab2'])){
				if ($this->data['userfield']['tab2']->uf_fieldvalue != ''):
					$tabs[$mapPoints->p_id][] = array(
						'tabTitle' => 'Facebook Feed',
						'tabContent' => $this->data['userfield']['tab2']->uf_html,
						'tabFieldValue' => $this->data['userfield']['tab2']->uf_fieldvalue
					);
				endif;
			}

			if( $this->data['mapConfig']->default_point_id != 0 ){
				if ($mapPoints->p_id == $this->data['mapConfig']->default_point_id) {
					$default_point = true;
				}
			}else{
				$default_point = false;
			}
			/** @type array create the points array that contains all of a specific points information */
			$points[] = array(
				'companyname' => $this->data['userfield']['companyname']->uf_fieldvalue,
				'show_on_map' => $mapPoints->p_show_on_map,
				'home_business' => $mapPoints->p_home_business,
				'id' => $mapPoints->p_id,
				'lat' => $mapPoints->p_lat,
				'lng' => $mapPoints->p_lng,
				'type' => $mapPoints->p_type,
				'active' => $mapPoints->p_active,
				'level' => $mapPoints->p_level,
				'userid' => $mapPoints->p_userid,
				'chamber' => $mapPoints->p_chamber,
				'levelname' => $mapPoints->ml_levelname,
				'allowed_fields' => $mapPoints->ml_allowed_fields,
				'min_width' => $mapPoints->ml_min_width,
				'max_width' => $mapPoints->ml_max_width,
				'min_height' => $mapPoints->ml_min_height,
				'max_height' => $mapPoints->ml_max_height,
				'sidebarHtmlView' => $sidebarHtmlView,
				'marker_icon' => $markerIcon,
				'default_point' => $default_point,
				'tabs' => $tabs[$mapPoints->p_id]
			);

		}
		/** sort the points alpha-numerically instead of by ID. */
		sort($points);

		/** output the points array in json format */
		echo json_encode($points);
	}#END addPoint function

}#end class