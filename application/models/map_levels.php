<?php
class Map_levels extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function getLevel($levelId = ''){
        $query = $this->db->get_where('levels', array('id' => $levelId));
        return $query->result();
    }

    function getAllLevels(){
		$this->db->order_by('levelname', 'ASC');
		$query = $this->db->get('levels');
        return $query->result_array();
    }

    function addLevel($data){
        $this->db->insert('levels', $data);
        
    }
}