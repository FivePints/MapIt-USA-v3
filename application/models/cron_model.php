<?php
class Cron_model extends CI_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
    /**
     * Get a list of the cron tasks in the database
     * @param  integer $id id number if specified, will get a single task
     * @return object the list if IDs return from the database
     */
    public function get($id = false){
        if($id){
        	$this->db->where('id', $id);
        }
        $q = $this->db->get('crontasks');
        if ( $q->num_rows() > 0){
        	if($id){
        		return $q->row();
        	}else{
        		return $q->result();
        	}
        }else{
        	return false;
        }
    }
    /**
     * Updates a cron task with another increment
     * when a cron task is ran, based on the cron
     * tasks ID number.
     * @param  integer $id id number of the cron_task
     * @return boolean  true/false
     */
    public function updateRunCount($id){
    	$this->db->set('total_runs', 'total_runs + 1', FALSE);
        $this->db->set('last_run_on', time());
    	$this->db->where('id', $id);
    	$this->db->update('crontasks');
    	if ( $this->db->affected_rows() > 0){
    		return true;
    	}else{
    		return false;
    	}
    }

   }
