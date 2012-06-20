<?php
class Map_email extends CI_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }

/**
 * queueEmail() function
 * 
 * this function adds the mass emails to the queue table
 * so that they can be processed on a x basis rather than 
 * sending a ton of emails at once and bogging the server down.
 * @param  array $ata an array of the recipients and the message
 * @return boolean | string (if errors)
 */
    public function queueEmail($data){
        
        $this->db->insert_batch('map_email_queue', $data);

        return true;
    }
}#end Map_email class