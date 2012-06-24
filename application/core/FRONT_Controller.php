<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class FRONT_Controller extends MY_Controller {

	public function __construct(){
		parent::__construct();

		/**
		 * Load all of hte models and libraries that we will need across all areas of this function
		 */

		#load the map config model to get the site title and other information
		$this->load->model('Map_config', 'mapConfig');
		#load the map points model to interact with the map_points table
		$this->load->model('Map_points', 'mapPoints');
		#load the levels model, this model interacts with the levels table
		$this->load->model('Map_levels', 'mapLevels');
		#load the model to interface with the categories table
		$this->load->model('Map_categories', 'mapCategories');
		#load the model to interface with the advertisements table
		$this->load->model('Map_advertisements', 'mapAdvertisements');
		#load the model to interface with the userfields table
		$this->load->model('Map_userfields', 'mapUserFields');
		#load the mapHtml library, this takes the userfields and sets up all the html
		$this->load->library('Map_html');
		#load the Google Maps Library so we can interface with it and start populating points
		$this->load->library('Map_library');

		#load CodeIgniters Form Validation
		$this->load->library('form_validation');
		$this->load->library('message');

		#load CodeIgniters Form helper
		$this->load->helper('form');
		#load CodeIgniters URL heloer
		$this->load->helper('url');
		/**
		 * User Authentication
		 * 
		 * This makes sure the user is authenticated before any of the below
		 * functions can run. If the user is authenticated then it sets an 
		 * array of data relating to that user. If not it redirects the user
		 * back to the login page.
		 * 
		 * @author Ilya Konyukhov
		 * @category controller function
		 * @copyright 2011 MapIT USA
		 * @package user_authentication
		 * @return @var data['user'] = user_id, username, firstname, lastname, avatar
		 * 
		 */
		if (!$this->ion_auth->logged_in()){
			$this->data['user'] = FALSE;
		}else{
	        $this->data['user'] = array(
	            'session_id'     => $this->session->userdata('session_id'),
	            'ip_address'     => $this->session->userdata('ip_address'),
	            'user_agent'     => $this->session->userdata('user_agent'),
	            'last_activity'  => $this->session->userdata('last_activity'),
	            'user_data'      => $this->session->userdata('user_data'),
	            'identity'       => $this->session->userdata('identity'),
	            'username'       => $this->session->userdata('username'),
	            'first_name'     => $this->session->userdata('first_name'),
	            'last_name'      => $this->session->userdata('last_name'),
	            'email'          => $this->session->userdata('email'),
	            'user_id'        => $this->session->userdata('user_id'),
	            'old_last_login' => $this->session->userdata('old_last_login'),
	        );
		}
		/**
		 * setup some default items to be used across all of the 
		 * functions
		 */
		#the config data is passed in a class object, referenced via $mapConfig->columname;
		$this->data['mapConfig'] = $this->mapConfig->getConfig();
		#get all of the categories to be shown in the mapit program front end
		$this->data['categories'] = $this->mapCategories->getAllCategories( array('onlyActiveCategories' => 1) );
		if($this->data['mapConfig']->events == 1){
			$this->data['event_categories'] = $this->mapCategories->getEventCategories();
		}
		if($this->data['mapConfig']->deals == 1){
			$this->data['deal_categories'] = $this->mapCategories->getAllCategories( array('onlyDealCategories' => 1) );
		}
	}
}