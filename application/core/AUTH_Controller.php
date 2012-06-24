<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AUTH_Controller extends MY_Controller {
	public function __construct(){
		parent::__construct();

		$this->template->set_layout('auth_template');

	}
}