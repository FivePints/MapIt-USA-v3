<?php
class Map_advertisements extends CI_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }

    /**
     * insert another row into the click_log table.
     * This tracks advertisement click throughs.
     * 
     * @param  integer $aid id number of the advertisement
     * @return boolean returns true if the row was inserted
     */
    function insertAdClick($aid = false){

        $clickData = array(
            'aid' => $aid,
            'ip_address' =>  $this->input->ip_address(),
            'browser' => $this->input->user_agent(),
            'timestamp' => time()
        );

        $this->db->insert('advertisements_click_log', $clickData);

        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }
    /**
     * get a count of clicks for a specific advertisement
     * 
     * @param  integer $aid id number of the advertisement
     * @return integer returns an integer of number of rows that were returned
     */
    function getAdClicks($aid = false){
        if ($aid == false){
            return false;
        }else{
            $this->db->where('aid', $aid);
            $this->db->from('advertisements_click_log');
            $q = $this->db->get();

            return $q->num_rows();
        }
    }
    /**
     * get a count of unique clicks for a specific advertisement
     * Unique clicks are determined by the User's IP Address.
     * 
     * @param integer $aid id number of the advertisement
     * @return integer returns an integer of number of rows that were returned
     */
    function getUniqueAdClicks($aid = false){
        if ($aid == false){
            return false;
        }else{
            $this->db->select('ip_address');
            $this->db->distinct();
            $this->db->where('aid', $aid);
            $this->db->from('advertisements_click_log');
            $q = $this->db->get();

            return $q->num_rows();
        }
    }
    function getAdvertisement($id = false){
        $this->db->select('
            a.id,
            a.type,
            a.status,
            a.description,
            a.title,
            a.filename,
            a.url,
            a.timestamp
            ');
        $this->db->from('advertisements a');
        $this->db->where('a.id', $id);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0){
            return$query->row();
        }else{
            return false;
        }
    }
    function getAdvertisementsWithClicks(){
        $this->db->select('
            a.id,
            a.type,
            a.status,
            a.description,
            a.filename,
            a.url,
            a.timestamp,
            (SELECT COUNT( DISTINCT(cl.ip_address) ) FROM map_advertisements_click_log cl WHERE cl.aid = a.id) As uniqueClicks,
            (SELECT COUNT(cl.aid) FROM map_advertisements_click_log cl WHERE cl.aid = a.id) As totalClicks
        ', TRUE);
        $this->db->from('advertisements a');
        $query = $this->db->get();
        if ($query->num_rows() > 0){
            $result = $query->result();
            return $result;
        }else{
            return false;
        }
    }

    function getAdvertisements($status = FALSE, $random = FALSE){
        if ($status != FALSE){
            $this->db->where('status', $status);
        }
        
        $this->db->select('
            a.id,
            a.type,
            a.status,
            a.description,
            a.filename,
            a.url,
            a.timestamp
            ');
        $this->db->from('advertisements a');
        $query = $this->db->get();
        if ($query->num_rows() > 0){
            $result = $query->result();

            if ($random != FALSE){
                $rand_keys = array_rand($result, 1);
                return $result[$rand_keys];
            }else{
                return $result;
            }
        }else{
            return false;
        }
    }
    public function insert($advertisement){
        $this->db->insert('advertisements', $advertisement);
        if ($this->db->affected_rows() >= 1){
            return true;
        }else{
            return false;
        }
    }
    public function delete($id){
        if ($id){
            $this->db->delete('advertisements', array('id' => $id));
            if ( $this->db->affected_rows() >= 1){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    public function activate($id){
        $this->db->where('id', $id);
        $this->db->update('advertisements', array('status' => 1) );
        if ($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }
    public function deactivate($id){
        $this->db->where('id', $id);
        $this->db->update('advertisements', array('status' => 0) );
        if ($this->db->affected_rows() >= 1){
            return true;
        }else{
            return false;
        }
    }
}
