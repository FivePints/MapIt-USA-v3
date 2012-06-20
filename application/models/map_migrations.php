<?php
class Map_migrations extends CI_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
    public function getCurrent(){
        $q = $this->db->get('migrations');
        if ($q->num_rows() > 0){
            return $q->row();
        }else{
            return false;
        }
    }
}
