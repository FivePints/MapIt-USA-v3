<?php
class Map_pages extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function getPage($uri = 'index', $pageType){
        $query = $this->db->select('*')->from('pages')->where(array('page_slug' => $uri, 'page_type' => $pageType))->limit(1);
        $query = $this->db->get();
        return $query->row();
    }
}