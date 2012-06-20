<?php
class Map_config extends CI_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }


    /**
     * getConfig()
     * 
     * gets all of the configuration variables from the database
     * these variables are settings that pertain to the core 
     * function of the MapIT system.
     * 
     * @author Mike DeVita
     * @category map_models
     * @package map_config
     * @copyright 2011 MapIT USA
     * 
     */    
    function getConfig(){
        $this->db->from('config')->limit(1)->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->row();
    }

    /**
     * editConfig()
     * 
     * updates the config table with the submitted values
     * from the edit config form in the admin panel.
     * This can return database errors if there are any.
     * @return boolean | string
     * 
     * @param {string} sitetitle
     * @param {string} sitename
     * @param {string} markericon
     * @param {string} apikey 
     * @param {string} tabtitle
     * @param {string} defaultzoom
     * @param {string} defaultmapid
     * @param {string} defaultmaptype
     * @param {string} defaultlat
     * @param {string} defaultlng
     * @param {string} activationkey
     * @param {boolean} errorFlag
     */
    function editConfig($params = array() , $errorFlag = FALSE){

        $this->db->insert('map_config', $params);
        if( $this->db->affected_rows() > 0 ){
            return true;
        }else{
            return false;
        }
    }

    /**
     * getAnnouncements()
     * 
     * retrieves all active announcements from the database 
     * for display on the user/admin panel.
     */
    function getAnnouncements(){
        $this->db->from('announcements')->where('expire_timestamp >', time())->order_by('timestamp', 'DESC');
        $query = $this->db->get();
        if ($query->num_rows() > 0){
            return $query->result();
        }else{
            return FALSE;
        }
     }
}

