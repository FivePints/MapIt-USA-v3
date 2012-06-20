<?php
class Map_userfields extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function getLogoNames($pointId){
        $this->db->select('fieldvalue, pointid');
        $this->db->where('fieldid', '15');
        $this->db->where('pointId', $pointId);
        $q = $this->db->get('map_userfields');
        if( $q->num_rows > 0 ){
            return $q->result();
        }else{
            return false;
        }
    }
    /**
     * get the fields from the database. The fields are the
     * placeholder for the userfield. 
     * @param numerical $limit 
     * @param numerical $fieldid array of field id's that should be pulled
     * @return object
     * 
     */
   public function getFields($limit = FALSE, $fieldid = ''){
        if ($limit == TRUE){
            $this->db->limit($limit);
        }
        if ($fieldid != ''){
            $this->db->where_in('id', $fieldid);
        }
        $query = $this->db->get('fields');
        if ($query->num_rows() > 0){
            return $query->result();
        }else{
            return FALSE;
        }

    }#end getFields function



    function searchCompanyName($searchTerms, $strict = FALSE, $params = array() ){

        if ($strict == TRUE){
            $this->db->where('fieldvalue', $searchTerms);
        }else{
            $this->db->like('fieldvalue', $searchTerms, 'after');
        }
        
        $this->db->where('fieldid', '19');

        if(isset($params['deals']) && $params['deals'] == true){
            $this->db->where("fieldid = '33' AND fieldvalue != ''");
        }

        $query = $this->db->select('pointid')->get('map_userfields');

        if ($query->num_rows() < 1){
            return false;
        }else{
            return $query->result_array();
        }

    }

/**
 * get a point's fields based on its pointid. 
 * $uid can be an array of point IDs
 * @param array $uid 
 * @return object
 * 
 */
    function getUserFields($uid = '', $searchTerms = FALSE, $fieldid = FALSE){
        if ($uid != ''){
            $this->db->select('uf.html As uf_html, f.fieldname As f_fieldname, uf.pointid As uf_pointid, uf.fieldid As uf_fieldid, uf.fieldvalue As uf_fieldvalue, f.id As f_fieldid, f.html_template As f_html_template');
            $this->db->from('userfields uf');
            $this->db->join('map_fields f', 'f.id = uf.fieldid');
            /** get all of the userFields where pointid = uid */
            $this->db->where_in('uf.pointid', $uid);

            if ($fieldid != FALSE){
                $this->db->where_in('fieldid', $fieldid);
            }
            
            $query_userfields = $this->db->get();
            if ($query_userfields->num_rows() < 1){
                return FALSE;
            }else{
                $userFields = $query_userfields->result();
                foreach ($userFields as $uF){
                    $uField[$uF->uf_pointid][$uF->f_fieldid] = $uF;
                }
                return $uField;
            }
        }
    }#end getUserFields function


    function addUserFieldHtml($compiledHtml){
        foreach ($compiledHtml as $c){
            $data[] = array (
                'pointid' => $c['pointId'],
                'timestamp' => time(),
                'html' => $c['html'],
                'fieldid' => $c['fieldId'],
                'fieldvalue' => $c['fieldValue']
            );
        }
        $this->db->insert_batch('userfields', $data);

        if( $this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }#end addUserFieldHtml() function


    function addUserFieldHtml_Batch($compiledHtml){
        $this->db->insert('userfields', $compiledHtml);
    }#end addUserFieldHtml() function

    function editUserFieldHtml($compiledHtml){
        foreach ($compiledHtml as $cHK => $cHV){
            $data = array (
                'pointid' => $cHV['pointId'],
                'timestamp' => time(),
                'html' => $cHV['html'],
                'fieldid' => $cHV['fieldId'],
                'fieldvalue' => $cHV['fieldValue']
            );
            $this->db->where('pointid', $cHV['pointId']);
            $this->db->where('fieldid', $cHV['fieldId']);
            $this->db->update('map_userfields', $data);
        }
        if( $this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }#end addUserFieldHtml() function

    /**
     * delete userfields()
     * 
     * delete userfields where userfield = pointid
     */
    public function deleteUserFields($pointId = FALSE){
        if ($pointId != FALSE){
            $this->db->delete('userfields', array('pointid' => $pointId));

            if( $this->db->affected_rows() > 0){
                return true;
            }else{
                return false;
            }            
        }
    }
}