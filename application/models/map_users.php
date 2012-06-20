<?php
class Map_users extends CI_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }

    /**
     * Gets all users from the database
     * Optionally allows to specify whether 
     * to only get active users, or only get
     * banned users.
     * 
     * @param  boolean $activeFlag flag to retrieve only active
     * @param  boolean $bannedFlag flag to retrieve only banned
     * @return query object - returns object of users from db
     */
    function getAllUsers($activeFlag = FALSE, $bannedFlag = FALSE){
        $this->db->from('users');
        if ($activeFlag ==TRUE){
            $this->db->where('activated', 1);
        }
        if ($bannedFlag  == TRUE){
            $this->db->where('banned', 0);
        }
        $this->db->order_by('username', 'ASC');

		$query = $this->db->get();
        return $query->result();
    }

    /**
     * function to get a specific user's
     * information from the database.
     * 
     * @param  string $uid user id number
     * @return object      query object of user's info
     */
    function getUserInfo($uid = ''){
        $this->db->where('id', $uid);
        $query = $this->db->get('users', 1);

        if ($query->num_rows > 0){
            return $query->row();   
        }else{
            return false;
        }
    }#end getUserInfo() function
    /**
     * Edit User Model Function
     * 
     * This model edits the non critical user information 
     * for a specific user. Such as: First Name, Last Name,
     * and their avatar. 
     * @param integer $userId id number of the user that is to be edited
     * @param array $data the data that is being edited.
     * @return boolean true/false whether data was edited.
     */
    public function editUser($userId = '', $data = ''){
        $this->db->where('id', $userId);
        $this->db->update('users', $data);
        
        if ($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }#end editUser() function
    /**
     * delete a specific user from the database,
     * given the ID number that is passed. Returns
     * a boolean whether it deleted or not.
     * @param  integer $userId user id number to be deleted
     * @return boolean return true/false if row was deleted
     */
    public function deleteUser($userId){
        $this->db->delete('users', array('id' => $userId));
        if ($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }#end deleteUser function
    /**
     * Activate a specific user, this allows
     * a user to login or be assigned to a 
     * map point.
     * @param  integer $userId user id to activate
     * @return boolean true/false return if affected_rows > 0
     */
    public function activateUser($userId){
        $userData = array(
            'activated' => '1'
            );
        $this->db->where('id', $userId);
        $this->db->update('map_users', $userData);
        
        if ($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }#end activateUser function
    /**
     * Deactivate a specific user, this removes
     * the ability for a user to login or be
     * assigned to a map point
     * @param  integer $userId user id to deactivate
     * @return boolean true/false return if affected_rows > 0
     */
    public function deactivateUser($userId){
        $userData = array(
            'activated' => '0'
            );
        $this->db->where('id', $userId);
        $this->db->update('map_users', $userData);
        
        if ($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }#end deactivateMapPoint function


}#map_users class




