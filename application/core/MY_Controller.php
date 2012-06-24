<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This is the Core Controller that sets up
 * all of the default configs and code that 
 * are used between both frontend/backend
 * areas of the app.
 */
class MY_Controller extends CI_Controller {

	/**
	 * Primary Object Used Throughout
	 * the application to store data
	 * and pass it between controller/view
	 * @var array
	 */
	public $data = array(
		'event_categories'  => array(),
		'deal_categories'   => array(),
		'categories'        => array(),
		'user'              => array(),
		'assets'            => array(),
		'map' => array(
			'config'        => array(),
			'categories'    => array(),
			'users'         => array(),
			'levels'        => array(),
			'announcements' => array(),
		),
	);

    public function __construct(){
		parent::__construct();

    	/**
    	 * Load Models
    	 * Load models used across the app
    	 */
		#load the map config model to get the site title and other information
		$this->load->model('Map_config', 'mapConfig');
		#load the map points model to interact with the map_points table
		$this->load->model('Map_points', 'mapPoints');
		#load the levels model, this model interacts with the levels table
		$this->load->model('Map_levels', 'mapLevels');
		#load the model to interface with the categories table
		$this->load->model('Map_categories', 'mapCategories');
		#load the model to interface with the userfields table
		$this->load->model('Map_userfields', 'mapUserFields');


		#load the mapHtml library, this takes the userfields and sets up all the html
		$this->load->library('Map_html');
		#load CodeIgniters Form Validation
		$this->load->library('form_validation');
		$this->load->library('message');


		#the config data is passed in a class object, referenced via $mapConfig->columname;
		$this->data['mapConfig'] = $this->mapConfig->getConfig();


		if( ENVIRONMENT != 'production' ){
            //$this->output->enable_profiler(true);
        }

    }
}
