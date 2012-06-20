<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ad_tracking extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}
	public function generateAdWrapper($url, $id){
		echo $url;
		echo $id;
	}
	
}

/* End of file index.php */
/* Location: ./application/controllers/index.php */
?>