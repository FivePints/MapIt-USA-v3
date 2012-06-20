<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ADMIN_Controller extends CI_Controller {
	public function __construct(){
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
		#form validation library, responsible for validating and xss cleaning all form fields that are submitted
		$this->load->library('form_validation');
		#load the Google Maps Library so we can interface with it and start populating points
		$this->load->library('GMap');
		#load MapIts File upload library
		$this->load->library('File_upload');
  		#load MapITs mapHtml library, this library handles all of the compiling of the users info into html
		$this->load->library('Map_html');
		$this->load->library('message');
		$this->load->helper('ckeditor');
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
			redirect(site_url('/user/login/'));
		}else{	
			$this->data['user'] = array(
				'user_id' => $this->tank_auth->get_user_id(),
				'username' => $this->tank_auth->get_username(),
				'last_login' => $this->tank_auth->get_last_login(),
				'emailAddress' => $this->tank_auth->get_email(),
				'firstname' => $this->tank_auth->get_firstname(),
				'lastname' => $this->tank_auth->get_lastname(),
				'userlevel' => $this->tank_auth->get_userlevel(),
				'avatar' => $this->tank_auth->get_avatar()
			);
		}
		if ($this->data['user']['userlevel'] < 2){
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
		#load the config info for the mapit site
		$this->data['mapConfig'] = $this->mapConfig->getConfig();

		#set customJS to blank for a placeholder
		$this->data['customJs'] = '';
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
			'categories' => $this->mapCategories->getAllCategories(),
			'users' => $this->mapUsers->getAllUsers(TRUE, FALSE),
			'levels' => $this->mapLevels->getAllLevels()
			);

		if($this->data['mapConfig']->events == 1){
			$this->data['map']['eventCategories'] = $this->mapCategories->getEventCategories();
		}

		$this->data['page'] = array(
			'announcements' => $this->mapConfig->getAnnouncements()
		);

		$this->load->spark('template/1.9.0');
		$this->load->library('template');
		
		$this->load->spark('Sprinkle/1.0.5');
		$this->sprinkle->load('jquery-libs');
		$this->sprinkle->load('modernizr');
		$this->sprinkle->load('backend-js');
		$this->sprinkle->load('backend-css');
		
		$this->template
			->set_partial('backend-sidebar', 'partials/backend/admin/sidebar')
			->set_partial('backend-header', 'partials/backend/admin/header')
			->set_partial('backend-absfooter', 'partials/backend/admin/absfooter')
			->set_layout('admin_template');
	}	
}
