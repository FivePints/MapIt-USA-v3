<?php
class Install_model extends CI_Model {
    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
    public function import($query = false){
    	if(query != false){
    		$this->db->query($query);
    		return true;
    	}else{
    		return false;
    	}
    }
    
}