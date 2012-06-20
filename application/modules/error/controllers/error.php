<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Error extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->spark('template/1.9.0');
		$this->load->library('template');

		$this->load->spark('Sprinkle/1.0.5');
		$this->sprinkle->load('jquery-libs');
		$this->sprinkle->load('modernizr');
		$this->sprinkle->load('backend-js');
		$this->sprinkle->load('backend-css');
		
		$this->load->model('Map_config', 'mapConfig');
		$this->data['mapConfig'] = $this->mapConfig->getConfig();
		
		$this->template
			->set_layout('error_template');

	}
	public function message($code = '404'){
		switch ($code){
			default:
				$this->data['page'] = array(
					'errorType' => '404',
					'errorMessage' => 'Hey There! The page you were looking for has either moved, or never existed. We tend to move things around from time to time. Sorry about that!'
				);
			break;

			case '500':
				/** set the main_content, and load the view */
				$this->data['page'] = array(
					'errorType' => '500',
					'errorMessage' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
				);
			break;
			
			case '400':
				$this->data['page'] = array(
					'errorType' => '400',
					'errorMessage' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
				);
			break;

			case '404':
				/** set the main_content, and load the view */
				$this->data['page'] = array(
					'errorType' => '404',
					'errorMessage' => 'Hey There! The page you were looking for has either moved, or never existed. We tend to move things around from time to time. Sorry about that!'
				);
			break;
		}
		$this->template
			 ->title('Uhoh! Something went wrong!')
			 ->build('error/message', $this->data);
	}
	
}

/* End of file index.php */
/* Location: ./application/controllers/index.php */
?>