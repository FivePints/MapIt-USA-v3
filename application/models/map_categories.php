<?php
class Map_categories extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    function getCategory($id){
        if ($id == FALSE){
            return false;
        }else{

            $this->db->where('id', $id);
            $q = $this->db->get('categories');

            if ($q->num_rows > 0){
                return $q->row();
            }else{
                return false;
            }

        }
    }
    /**
     * get all of the categories from the table
     * `map_categories`. Optionally can pass an array
     * of parameters. Reference @param below for a full list.
     * 
     * @param  array onlyActiveCategories only show categories which have points 
     *                                    assigned to them. This is generated from
     *                                    a cron task.
     * @return array array of categories
     */
    function getAllCategories($params = array() ){
		$this->db->select('id, category_name, category_type')->from('categories')->order_by('category_name', 'ASC');
        if ( isset($params['onlyActiveCategories']) && $params['onlyActiveCategories'] == 1 ){
            $this->db->where('categoryCount > 0');
        }
        if ( isset($params['onlyDealCategories']) &&  $params['onlyDealCategories'] == 1 ){
            $this->db->where('dealCount > 0');
        }
        if( isset($params['onlyEventCategories']) && $params['onlyEventCategories'] == 1 ){
        	$this->db->where('eventCount > 0');

        	$this->db->where('category_type', 'event');
        }
		$query = $this->db->get();
        return $query->result_array();
    }
    function getChildEventCategories($id){
        $this->db->select('id, category_name, category_type')->from('categories')->order_by('category_name', 'ASC');

        $this->db->where('parent_category', $id);
        $q = $this->db->get();

        if($q->num_rows() > 0){
            return $q->result_array();
        }else{
            return false;
        }
    }
    function getEventCategories(){
        $this->db->select('id, category_name, category_type')->from('categories')->order_by('category_name', 'ASC');

        $this->db->where('eventCount > 0');
        $this->db->where('category_type', 'event');
        $this->db->where('parent_category', 0);
        $q = $this->db->get();

        if($q->num_rows() > 0){
            foreach ($q->result_array() as $cat){
                $children = $this->getChildEventCategories($cat['id']);
                $cats[] = array(
                    'children' => $children,
                    'id' => $cat['id'],
                    'category_name' => $cat['category_name']
                );
            }
            return $cats;
        }else{
            return false;
        }
    }

    /**
     * counts the categories which have points assigned to them
     * returns an array if the count is > 0
     * @return array
     */
    function getCategoryCount( $pointId = false, $countType = 'dealCount'){
        $sql = "SELECT count(*) As categoryCount, c.id FROM map_points p LEFT JOIN map_categories c ON p.type = c.id GROUP BY c.category_name";
        if( $pointId != false ):
            $sql = "SELECT count(*) As $countType, c.id FROM map_points p LEFT JOIN map_categories c ON p.type = c.id WHERE p.id in('" . implode("', '", $pointId) . "') GROUP BY c.category_name";
        endif;
        $q = $this->db->query($sql);
        if ( $q->num_rows > 0 ){
            return $q->result_array();
        }else{
            return false;
        }
    }
    /**
     * updates the `map_categories` table with the categoryCount
     * this model function is typically run from a cron task 
     * hourly.
     * 
     * @param  boolean $data array of the categories to update
     * @return boolean returns true.
     */
    function processCategoryCount($data = false){

        $this->db->update_batch('categories', $data, 'id');
        return true;
    }

    /**
     * deletes a specific category based on the category ID that is 
     * passed to it.
     * 
     * @param integer $id id number of a category
     * @return boolean returns true if deleted, false if not.
     */
    function delete($id = false){
        if ($id){

            $this->db->delete('categories', array('id' => $id));
            if ( $this->db->affected_rows() > 0){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    /**
     * Insert a new category
     * @param  string $categoryName category name
     * @return boolean true if successfully inserted, false if it failed
     */
    function insert($data = FALSE){
        if ($data == FALSE){
            return false;
        }else{
            $category = array(
                'category_name' => $data['category_name'],
                'timestamp' => time(),
                'category_type' => $data['category_type']
            );
            $this->db->insert('categories', $category);
            if ($this->db->affected_rows() >= 1){
                return true;
            }else{
                return false;
            }
        }
    }
    
    function edit($category){
        $category['timestamp'] = time();
        $this->db->where( 'id', $category['id'] );
        $this->db->update('categories', $category);

        if ($this->db->affected_rows() >= 1){
            return true;
        }else{
            return false;
        }
        
    }
}
