<?php
class Map_point_emails extends CI_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }


    /**
     * Get Map Points Model Function
     * 
     * The getMapPoints model retreives map points from the map_points table
     * and returns them in an object form. There can be an optional numerical limit
     * passed when the function is called as well as specifying a point id. This can
     * be called like so getMapPoint(pointId, limit) IE: getMapPoint(12, 1);
     * 
     * @var limit
     * @var pointId
     * @return object
     * 
     * @author Mike DeVita
     * @category model_function
     * @copyright 2011 MapIT USA
     * @package map_points
     * 
     */
    function getPointEmails($category, $options = array()){        
        $this->db->select('p.id,
        (SELECT uf.fieldvalue FROM map_userfields uf WHERE uf.pointid = p.id AND uf.fieldid = 20) As ContactName,
        (SELECT uf.fieldvalue FROM map_userfields uf WHERE uf.pointid = p.id AND uf.fieldid = 31) As ContactEmail
        ',TRUE);
        $this->db->from('map_points p');
        $this->db->where_in('p.type',$category);
        $q = $this->db->get();

        if ($q->num_rows() < 1){
            return FALSE;
        }else{
            return $q->result();
        }
    }
    function queueUp($emails = false){
        if ($emails != false){
            $this->db->insert_batch('email_queue', $emails);
            if ($this->db->affected_rows() > 0){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
}