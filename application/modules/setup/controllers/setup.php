<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setup extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if(INSTALLED == 1){ die('already installed'); }
		print_r(INSTALLED);	
		$this->load->spark('template/1.9.0');
		$this->load->library('template');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->library('message');
		$this->load->helper('file');		
		$this->lang->load('tank_auth');
		$this->load->library('tank_auth');

		$this->load->helper('url');
	
		$this->data = array();
		$this->template
			 ->set_partial('header', 'partials/installer/header')
			 ->set_partial('footer', 'partials/installer/footer')
			 ->title("MapIt USA Installer");

		$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><h4 class="alert-heading">Error!</h4>', '</div>');

	}

	public function index($step = ''){
		switch($step){
			default:
				self::_step3();
			break;
		}
	}

	/**
	 * insert the user to the database
	 * and then show the completion page.
	 * @return [type] [description]
	 */
	private function _step3(){
		$random_password = substr( md5(time() ), 16);
		if (!is_null($this->data = $this->tank_auth->create_user(
				'superadmin',
				'admin@mapitusa.com',
				$random_password,
				'Super',
				'Administrator',
				'',0,3
				))) {
					$data = array(
						'username' => 'superadmin',
						'password' => $random_password
					);
					$this->template
						 ->title("Step 3")
						 ->title("Installation Complete")
						 ->build('setup/step3', $data);
					define('INSTALLED', 1);
		} else {
			$errors = $this->tank_auth->get_error_message();
			print_r($errors);
		}
	}
	private function _createConfig(){
		/** setup the config arrays to be parsed */
		$db = array(
			'hostname' => $this->hostname,
			'username' => $this->username,
			'password' => $this->password,
			'database' => $this->database,
			'dbprefix' => $this->dbprefix,
			'cache' => $this->cache,
			'cachedir' => $this->cachedir
		);
		$core = array(
			'defaultpointstatus' => $this->defaultpointstatus,
			'defaultpointlevel' => $this->defaultpointlevel,
			'gzip' => $this->gzip,
			'base_url' => $this->base_url

		);
		$auth = array(
			'website_name' => $this->website_name,
			'website_email' => $this->website_email
		);
		$index = array(
			'environment' => $this->environment
		);
		
		/** create the config files from templates, and write them */
		$database_tpl = read_file(APPPATH.'modules/install/templates/database.tpl');
		$database_tpl = self::_parse($database_tpl, $db, TRUE);
		
		$core_tpl  = read_file(APPPATH.'modules/install/templates/config.tpl');
		$core_tpl  = self::_parse($core_tpl, $core, TRUE);

		$auth_tpl = read_file(APPPATH.'modules/install/templates/tank_auth.tpl');
		$auth_tpl = self::_parse($auth_tpl, $auth, TRUE);

		if( self::_writeConfig('database.php', $database_tpl) == false ){
			return false;
		}elseif( self::_writeConfig('config.php', $core_tpl) == false ){
			return false;
		}elseif( self::_writeConfig('tank_auth.php', $auth_tpl) == false ){
			return false;
		}else{
			return true;
		}

	}
	private function _parse($template, $data, $return = FALSE){
		if ($template == ''){
			return FALSE;
		}
		foreach ($data as $key => $val){
			if (is_array($val)){
				$template = $this->_parse_pair($key, $val, $template);
			}else{
				$template = $this->_parse_single($key, (string)$val, $template);
			}
		}
		return $template;
	}

	private function _parse_single($key, $val, $string){
		return str_replace('{'.$key.'}', $val, $string);
	}		

	private function _writeConfig( $filename = false, $data = array() ){
		if ( ! write_file(APPPATH.'config/production/'.$filename, $data)){
		    echo 'write errors for '.$filename;
     		echo '<pre>';
     		print_r($data);
     		echo '</pre>';
		}else{
		     return true;
		}
	}
	private function _validateForm(){
		$this->form_validation->set_rules('hostname', 'hostname', 'xss_clean|required');
		$this->form_validation->set_rules('username', 'username', 'xss_clean|required');
		$this->form_validation->set_rules('password', 'password', 'xss_clean|required');
		$this->form_validation->set_rules('database', 'database', 'xss_clean|required');
		$this->form_validation->set_rules('dbprefix', 'dbprefix', 'xss_clean|required');
		$this->form_validation->set_rules('cache', 'cache', 'xss_clean|required');
		$this->form_validation->set_rules('cachedir', 'cachedir', 'xss_clean|required');
		$this->form_validation->set_rules('defaultpointstatus', 'defaultpointstatus', 'xss_clean|required');
		$this->form_validation->set_rules('defaultpointlevel', 'defaultpointlevel', 'xss_clean|required');
		$this->form_validation->set_rules('environment', 'environment', 'xss_clean|required');
		$this->form_validation->set_rules('gzip', 'gzip', 'xss_clean|required');
		$this->form_validation->set_rules('base_url', 'base_url', 'xss_clean|required');
		$this->form_validation->set_rules('website_name', 'website_name', 'xss_clean|required');
		$this->form_validation->set_rules('website_email', 'website_email', 'xss_clean|required');

		if ($this->form_validation->run()){
			$this->hostname = $this->input->post('hostname');
			$this->username = $this->input->post('username');
			$this->password = $this->input->post('password');
			$this->database = $this->input->post('database');
			$this->dbprefix = $this->input->post('dbprefix');
			$this->cache = $this->input->post('cache');
			$this->cachedir = $this->input->post('cachedir');
			$this->defaultpointstatus = $this->input->post('defaultpointstatus');
			$this->defaultpointlevel = $this->input->post('defaultpointlevel');
			$this->environment = $this->input->post('environment');
			$this->gzip = $this->input->post('gzip');
			$this->base_url = $this->input->post('base_url');
			$this->website_name = $this->input->post('website_name');
			$this->website_email = $this->input->post('website_email');

			return TRUE;
		}else{
			return validation_errors();
		}
	}
}

/* End of file index.php */
/* Location: ./application/controllers/index.php */
?>