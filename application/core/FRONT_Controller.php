<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class FRONT_Controller extends MY_Controller {

	public function __construct(){
		parent::__construct();

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
		 * Load Models
		 */
		#load the model to interface with the advertisements table
		$this->load->model('Map_advertisements', 'mapAdvertisements');

		/**
		 * Load Configs
		 */
		#get all of the categories to be shown in the mapit program front end
		$this->data['categories'] = $this->mapCategories->getAllCategories(
			array(
				'onlyActiveCategories' => 1
			)
		);

		/** If events is enabled, get those categories as well */
		if($this->data['mapConfig']->events == 1){
			$this->data['event_categories'] = $this->mapCategories->getEventCategories();
		}
		/** If deals is enabled, get those categories as well */
		if($this->data['mapConfig']->deals == 1){
			$this->data['deal_categories'] = $this->mapCategories->getAllCategories( array('onlyDealCategories' => 1) );
		}
	}
}