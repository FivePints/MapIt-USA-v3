<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AUTH_Controller extends MY_Controller {
	public function __construct(){
		parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('message');

		$this->load->model('Map_config', 'mapConfig');
		$this->data['mapConfig'] = $this->mapConfig->getConfig();

		$this->template->set_layout('auth_template');

	}	
}