<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This is the Core Controller that sets up
 * all of the default configs and code for 
 * the authentication area of the app.
 */
class AUTH_Controller extends MY_Controller {
	public function __construct(){
		parent::__construct();

		$this->template->set_layout('auth_template');

	}
}