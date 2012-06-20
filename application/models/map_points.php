<?php
class Map_points extends CI_Model {

    var $headerjs   = '';
    var $headermap = '';
    var $onload    = '';
    var $map = '';
    var $sidebar = '';

    function __construct()
    {
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
     * @param integer pointId id number of a point or series of points to lookup
     * @param array options array of options to be passed to filter criteria more
     * @return object
     *
     * @author Mike DeVita
     * @category model_function
     * @copyright 2011 MapIT USA
     * @package map_points
     *
     */
    function getMapPoint($pointId = FALSE, $options = array() ){

        $this->db->select('
        p.id As p_id,
        p.show_on_map As p_show_on_map,
        p.home_business As p_home_business,
        p.lat As p_lat,
        p.lng As p_lng,
        p.type As p_type,
        p.active As p_active,
        p.level As p_level,
        p.userid As p_userid,
        p.chamber As p_chamber,
        ml.id As ml_id,
        ml.levelname As ml_levelname,
        ml.cost As ml_cost,
        ml.allowed_fields As ml_allowed_fields,
        ml.min_width As ml_min_width,
        ml.max_width As ml_max_width,
        ml.min_height As ml_min_height,
        ml.max_height As ml_max_height,
        ml.video_width As ml_video_width,
        ml.video_height As ml_video_height'
        );

        if ( isset($options['eventFlag']) ){
            $this->db->select("DATE_FORMAT(p.expire_time, '%m/%d/%Y %l:%i %p') As p_expire_time,
                DATE_FORMAT(p.start_time, '%m/%d/%Y %l:%i %p') As p_start_time,", FALSE);
            $this->db->select("p.event_text_short As p_event_text_short, p.event_text_long As p_event_text_long");
        }

        $this->db->from('points p');
        $this->db->join('map_levels ml', 'ml.id = p.level');

        if ( isset($options['datePicked']) ){
            $this->db->like('p.start_time', $options['datePicked'], 'after' );
        }

        if ( isset($pointId) && is_numeric($pointId) ){
            $this->db->where_in('p.id', $pointId );
        }
        if ( isset($options['userId']) ){
            $this->db->where_in('p.userid', $options['userId'] );
        }
        if ( isset($options['activeFlag']) && is_numeric($options['activeStatus']) ){
            $this->db->where('p.active', $options['activeStatus'] );
        }
        if ( isset($options['categoryId']) ){
            $this->db->where_in('p.type', $options['categoryId'] );
        }
        if ( isset($options['limit']) ){
            $query = $this->db->limit($options['limit'] );
        }
        if ( isset($options['eventFlag']) ){
            $this->db->where('p.start_time IS NOT NULL');
        }

        $query = $this->db->get();

        if ( $query->num_rows() > 0 ){
            return $query->result();
        }else{
            return FALSE;
        }

    }

    public function getEventsByDate(){
        $query = "SELECT
                 count(start_time) As eventCount,
                 DATE_FORMAT(start_time, '%m') As eventMonth,
                 DATE_FORMAT(start_time, '%d') As eventDate
                 FROM
                 map_points
                 WHERE
                 start_time IS NOT NULL
                 GROUP BY DATE_FORMAT(start_time, '%m-%d-%Y');";
        $q = $this->db->query($query);
        if( $q->num_rows > 0 ){
            return $q->result();
        }else{
            return false;
        }
    }
    /**
     * Add Map Point Model Function
     *
     * The addMapPoint model add's a map point to the map_points table based on specific
     * data submitted to the model.
     *
     * @var companyname, contactname, phone1, phone2, fax, streetaddress, address2, city
     * @var state, zipcode, category, user, level, showonmap, homebusiness, lat, long
     * @var active, useuserinfo, email
     *
     * @author Mike DeVita
     * @category model_function
     * @copyright 2011 MapIT USA
     * @package map_points
     *
     */
    function addMapPoint( $category, $user, $level, $showonmap, $homebusiness, $lat, $long, $active, $chamber_member = 0, $echoBack, $event_name = false, $event_description = false, $event_start_time = false, $event_expire_time = false ){
        $pointsData = array(
            'date_time' => time(),
            'show_on_map' => $showonmap,
            'home_business' => $homebusiness,
            'lat' => $lat,
            'lng' => $long,
            'type' => $category,
            'active' => $active,
            'level' => $level,
            'userid' => $user,
            'chamber' => $chamber_member
        );
        if( $event_name != FALSE ){
            $pointsData['event_text_short'] = $event_name;
        }
        if( $event_description != FALSE ){
            $pointsData['event_text_long'] = $event_description;
        }
        if( $event_start_time != FALSE ){
            $pointsData['start_time'] = date( "Y-m-d H:i:s", strtotime( $event_start_time ) );
        }
        if( $event_expire_time != FALSE ){
            $pointsData['expire_time'] = date( "Y-m-d H:i:s", strtotime( $event_expire_time ) );
        }

        $this->db->insert('map_points', $pointsData);
        if ($this->db->affected_rows() > 0){
            if ($echoBack == TRUE){
                return $this->db->insert_id();
            }else{
                return true;
            }
        }else{
            return false;
        }
    }


    /**
     * Edit Map Point Model Function
     * The editMapPoint model edit's an existing map point's data.
     *
     * @param decimal $lat latitude of the point
     * @param decimal $long longitude of the point
     * @param array $options array of options to pass | show_on_map, home_business, category
     *
     * @author Mike DeVita
     * @category model_function
     * @copyright 2011 MapIT USA
     * @package map_points
     */
     function editMapPoint($lat = false, $long = false, $pointId = false,  $options){

        /** check if options are set */
        if ( isset($options['show_on_map']) ){
            $pointsData['show_on_map'] = $options['show_on_map'];
        }

        /** event specific options */
        if( isset($options['start_time']) ){
            $pointsData['start_time'] = $options['start_time'];
        }
        if( isset($options['expire_time']) ){
            $pointsData['expire_time'] = $options['expire_time'];
        }
        if( isset($options['event_text_short']) ){
            $pointsData['event_text_short'] = $options['event_text_short'];
        }

        if( isset($options['home_business']) ){
            $pointsData['home_business'] = $options['home_business'];
        }
        if( isset($options['category']) ){
            $pointsData['type'] = $options['category'];
        }
        if( isset($options['chamber_member']) ){
            $pointsData['chamber'] = $options['chamber_member'];
        }
        if( isset($options['user']) ){
            $pointsData['userid'] = $options['user'];
        }
        if( isset($options['level']) ){
            $pointsData['level'] = $options['level'];
        }

        if( isset($options['event_text_short']) ){
            $pointsData['event_text_short'] = $options['event_text_short'];
        }
        if( isset($options['event_text_long']) ){
            $pointsData['event_text_long'] = $options['event_text_long'];
        }
        if( isset($options['start_time']) ){
            $pointsData['start_time'] = date( "Y-m-d H:i:s", strtotime( $options['start_time'] ) );
        }
        if( isset($options['expire_time']) ){
            $pointsData['expire_time'] = date( "Y-m-d H:i:s", strtotime( $options['expire_time'] ) );
        }

        if ($lat == FALSE || $long == FALSE || $pointId == FALSE){
            return false;
        }

        $pointsData['lat'] = $lat;
        $pointsData['lng'] = $long;

        $this->db->where('id', $pointId);
        $this->db->update('map_points', $pointsData);
        if ($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }

    }#end function editMapPoint()


    /**
     * Delete Map Point Model Function
     *
     * The delete map point function deletes a row from the points table based
     * on pointId that was passed to it.
     *
     * @var pointId
     * @author Mike DeVita
     * @category model_function
     * @copyright 2011 MapIT USA
     * @package map_points
     *
     */
    public function deleteMapPoint($pointId){
        $this->db->delete('points', array('id' => $pointId));
        if ($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }#end deleteMapPoint function


    /**
     * Activate Map Point Model Function
     *
     * This function activates a single map point based on the
     * pointId that it is passed.
     *
     * @var pointId
     * @author Mike DeVita
     * @category model_function
     * @copyright 2011 MapIT USA
     * @package map_points
     *
     */
    public function activateMapPoint($pointId){
        $pointData = array(
            'active' => '1'
            );
        $this->db->where('id', $pointId);
        $this->db->update('map_points', $pointData);

        if ($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }

    }#end activateMapPoint function


    /**
     * Deactivate Map Point Model Function
     *
     * This function deactivates a single map point based on the
     * pointId that it is passed.
     *
     * @var pointId
     * @author Mike DeVita
     * @category model_function
     * @copyright 2011 MapIT USA
     * @package map_points
     *
     */
    public function deactivateMapPoint($pointId){
        $pointData = array(
            'active' => '0'
        );
        $this->db->where('id', $pointId);
        $this->db->update('map_points', $pointData);

        if ($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }

    }#end deactivateMapPoint function

    public function getCountByCategory($opt = array() ){
        $this->db
             ->from('map_points p')
             ->select("count(p.id) As count, c.category_name As category_name", TRUE)
             ->group_by('p.type')
             ->join('map_categories c', 'p.type = c.id')
             ->order_by('count', 'DESC');

        if( $opt['limit'] ){
            $this->db->limit( $opt['limit'] );
        }

        $q = $this->db->get();
        if( $q->num_rows() > 0 ){
            return $q->result();
        }
    }
    /**
     * Get a list of points that have
     * promotions
     * @return array array of ID numbers
     */
    public function getDealPoints(){
        $sql = "SELECT p.id FROM map_userfields uf RIGHT JOIN map_points p ON uf.pointid = p.id WHERE uf.fieldid = 33 AND uf.fieldvalue != ''";
        $q = $this->db->query($sql);
        if ( $q->num_rows > 0 ){
            return $q->result_array();
        }else{
            return false;
        }
    }
    /**
     * get a list of points that have
     * events.
     * @return array array of ID numbers
     */
    public function getEventPoints(){
        $this->db->select('id');
        $this->db->where('start_time IS NOT NULL');
        $q = $this->db->get('points');
        if ( $q->num_rows > 0 ){
            return $q->result_array();
        }else{
            return false;
        }
    }

    public function upgradePoint($pointId, $level){
        $this->db->where('id', $pointId);
        $pointData = array(
            'level' => $level
        );
        $this->db->update('map_points', $pointData);

        if ($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }


}#end map_points Class