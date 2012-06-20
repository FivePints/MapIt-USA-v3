<?php
/**
* Levels Class For Administration Backend
*/
class Levels extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		/**
		 * Load all of the helpers that we will need throughout the 
		 * entire class. 
		 */
		#url helper, responsible for parsing POST/GET and url segments
		$this->load->helper('url');
		#form helper, responsible for handling form fields, and get/post
		$this->load->helper('form');
		
		/**
		 * Load all of the libraries that we will need throughout the
		 * entire class.
		 */
		#authetnication library, responsible for all things related to authentication, registeration, login, lougout, user data
		$this->load->library('tank_auth');
		$this->load->library('security');
		#form validation library, responsible for validating and xss cleaning all form fields that are submitted
		$this->load->library('form_validation');
		#load the Google Maps Library so we can interface with it and start populating points
		$this->load->library('GMap');
		#load MapIts File upload library
		$this->load->library('File_upload');
  		#load MapITs mapHtml library, this library handles all of the compiling of the users info into html
		$this->load->library('Map_html');

		/**
		 * load the sprinkles!
		 * 
		 * sprinkle is an asset management library, it concactentates js/css files into one file
		 * it also can dynamically load js/css via PHP.
		 */

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
		if (!$this->tank_auth->is_logged_in()){
			redirect(site_url('/admin/auth/login/'));
		}else{
			$this->data['user'] = array(
				'user_id' => $this->tank_auth->get_user_id(),
				'username' => $this->tank_auth->get_username(),
				'firstname' => $this->tank_auth->get_firstname(),
				'lastname' => $this->tank_auth->get_lastname(),
				'userlevel' => $this->tank_auth->get_userlevel(),
				'avatar' => $this->tank_auth->get_avatar()
			);
		}
		if ($this->data['user']['userlevel'] != 2){
			redirect('/profile/index'); 
		}

		/**
		 * MapIT Model Loading
		 * 
		 * This section loads all of the models that are required to interface
		 * with the MapIT Database.
		 * 
		 * @author Mike DeVita
		 * @category controller_function
		 * @copyright 2011 MapIT USA
		 * @package map_models
		 * 
		 */
		#load the map config model to get the site title and other information
		$this->load->model('Map_config', 'mapConfig');
		#load the map points model to interact with the map_points table
		$this->load->model('Map_points', 'mapPoints');
		#load the levels model, this model interacts with the levels table
		$this->load->model('Map_levels', 'mapLevels');
		#load the model to interface with the categories table
		$this->load->model('Map_categories', 'mapCategories');
		#load the model to interface with users table
		$this->load->model('Map_users', 'mapUsers');
		#load the model to interface with the userfields table
		$this->load->model('Map_userfields', 'mapUserFields');
		#load the model to interface with the levels table
		$this->load->model('Map_levels', 'mapLevels');

		#load the config info for the mapit site
		$this->data['mapConfig'] = $this->mapConfig->getConfig();

		#set customJS to blank for a placeholder
		$this->data['customJs'] = '';

		$this->profiler = FALSE;
		$this->output->enable_profiler($this->profiler);
		/**
		 * Add Map Values
		 *  
		 * This grabs all of the various values that we will need for each
		 * of the form fields. List of all categories, list of all users, 
		 * and list of all levels. 
		 * 
		 * @var categories, users, levels
		 * 
		 */
		$this->data['map'] = array(
			'fields' => $this->mapUserFields->getFields(),
			'categories' => $this->mapCategories->getAllCategories(),
			'users' => $this->mapUsers->getAllUsers(TRUE, FALSE),
			'levels' => $this->mapLevels->getAllLevels()
			);
			
	} #end constructor function



	private function showMessage($message = 'this is the default message', $fields = '', $exit = FALSE, $jsonEncode = TRUE, $messageType = 'success'){
		$message = array(
			'message' => $message,
			'fields' => $fields,
			'messageType' => $messageType
		);

		if ($jsonEncode == TRUE){
			echo json_encode($message);
		}else{
			return $message;
		}
		if($exit == TRUE){
			exit;
		}
	}

	/**
	  * Validate Form Fields Function
	  * @return boolean
	  */ 

	 private function validateForm(){
		#Set the validation rules for the form fields
		$this->form_validation->set_rules('level-name', 'Level Name', 'required|xss_clean|alpha_numeric');
		$this->form_validation->set_rules('level-cost', 'Level Cost', 'required|xss_clean|');
		$this->form_validation->set_rules('level-min-width', 'Level Min Width', 'required|xss_clean|numeric');
		$this->form_validation->set_rules('level-min-height', 'Level Min Height', 'required|xss_clean|numeric');
		$this->form_validation->set_rules('level-max-width', 'Level Max Width', 'required|xss_clean|numeric');
		$this->form_validation->set_rules('level-max-height', 'Level Max Height', 'required|xss_clean|numeric');

		if ($this->form_validation->run()){
			$this->level_name = $this->input->post('level-name', TRUE);
			$this->level_cost = $this->input->post('level-cost', TRUE);
			$this->level_min_width = $this->input->post('level-min-width', TRUE);
			$this->level_min_height = $this->input->post('level-min-height', TRUE);
			$this->level_max_width = $this->input->post('level-max-width', TRUE);
			$this->level_max_height = $this->input->post('level-max-height', TRUE);
			return TRUE;
		}else{
			return validation_errors();
		}
	 }#end validation function

	/**
	* default view for level management
	* 
	* the default vie lists all of the levels currently
	* set in MapIT.
	* 
	*/
	public function index(){
		
		/**
		 * Page Values
		 * 
		 * This passes preset values that are loaded into the view. 
		 * @var page_file, page_title, page_breadcrumb, page_description, customJs
		 * 
		 */
		$this->data['page'] = array(
			'page_file' => 'viewlevels',
			'page_title' => 'View Existing Levels',
			'page_breadcrumb' => 'View Levels',
			'page_description' => 'This page lists all of the Levels',
			'announcements' => $this->mapConfig->getAnnouncements(),
			'customJs' => array("$('#view-levels-table').dataTable();", "$('.delete-item').click(function(){ if( !confirm('Are you sure you want to delete?') ) { return false; }});"),
			'page_section' => 'levels'
		);
		
		$this->load->view('admin/template', $this->data);	
	}

	/**
	 * addLevel function handles the display of the
	 * 
	 * form for adding a level to MapIT.
	 * 
	 */
	public function addLevel(){

		/**
		 * Page Values
		 * 
		 * This passes preset values that are loaded into the view. 
		 * @var page_file, page_title, page_breadcrumb, page_description, customJs
		 * 
		 */
		$this->data['page'] = array(
			'page_file' => 'addlevel',
			'page_title' => 'Add A New Level',
			'page_breadcrumb' => 'Add New Level',
			'announcements' => $this->mapConfig->getAnnouncements(),
			'page_description' => 'This page Will allow you to add a new level',
			'page_section' => 'levels'
		);
		
		$this->load->view('admin/template', $this->data);	
	}

	/**
	 * addlevelprocess() 
	 * 
	 * function handles the inserting of a level to the
	 * database. The form runs validation against postvars
	 * and if true, explodes the url strings and sets them 
	 * into array format to be handled via php
	 * 
	 */
	public function addlevelprocess(){
		$validation = $this->validateForm();

		if ($validation == 1){
			/** @type array explode the query string postvar into an array */
			$a = explode('&', $this->input->post('allowed_fields'));
			$i = 0;
			/** go through each of the array items and explode it again to get the array key/value combination */
			while ($i < count($a)) {
			    $b = explode('=', $a[$i]);
			    $allowed_fields[] = urldecode($b[1]);
			    $i++;
			}
			$allowed_fields = implode(',', $allowed_fields);
			
			$data = array(
				'levelname' => $this->level_name,
				'cost' => $this->level_cost,
				'timestamp' => time(),
				'allowed_fields' => $allowed_fields,
				'min_width' => $this->level_min_width,
				'max_width' => $this->level_max_width,
				'min_height' => $this->level_min_height,
				'max_height' => $this->level_max_height
			);

			$this->mapLevels->addLevel($data);

			/** show a jgrowl message - message text | fields to pass | exit; | json_encode | message-type */
			$this->showMessage('successfully added the level to the database!', $data, FALSE, TRUE, 'success');

		}else{
			/** show a jgrowl message - message text | fields to pass | exit; | json_encode | message-type */
			$this->showMessage('unable to add the level to the database', $validation, TRUE, TRUE, 'error');
		}
	}
}