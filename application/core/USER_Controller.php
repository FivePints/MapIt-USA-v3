<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class USER_Controller extends CI_Controller {
	public function __construct(){
		parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('tank_auth');
		$this->load->library('message');
		
		$this->lang->load('tank_auth');
		
		$this->load->model('Map_config', 'mapConfig');
		$this->data['mapConfig'] = $this->mapConfig->getConfig();

		$this->load->spark('template/1.9.0');
		$this->load->library('template');
		
		$this->load->spark('Sprinkle/1.0.5');
		$this->sprinkle->load('jquery-libs');
		$this->sprinkle->load('modernizr');
		$this->sprinkle->load('backend-js');
		$this->sprinkle->load('backend-css');

		$this->template->set_layout('auth_template');

	}	
}