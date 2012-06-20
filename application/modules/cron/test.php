<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends MX_Controller {

	public function __construct(){
		parent::__construct();
	}
	public function test_method(){
		echo 'test';
	}
}

/* End of file index.php */
/* Location: ./application/controllers/index.php */
?>