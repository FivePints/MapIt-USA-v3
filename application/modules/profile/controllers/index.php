<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends PROFILE_Controller {

	function __construct(){
		parent::__construct();
		//Ckeditor's configuration
		$this->data['ckeditor'] = array(
				//ID of the textarea that will be replaced
				'id' 	=> 	'tab1',
				'path'	=>	'/assets/shared/js/ckeditor',
				//Optionnal values
				'config' => array(
						'toolbar' 	=> 	"Promotions", 	//Using the Full toolbar
				)
		);
	} #end constructor function


	/**
	 * Dashboard For Users
	 * @return [type] [description]
	 */
	public function index(){
		/**
		 * Page Values
		 *
		 * This passes preset values that are loaded into the view.
		 * @var page_file, page_`tle, page_breadcrumb, page_description, customJs
		 *
		 */
		$this->data['chart'] = $this->mapPoints->getCountByCategory();


		/**
		 * get this user's points and show them in a datatable.
		 */
		$options = array(
			'userId' => $this->data['user']['user_id']
		);
		$points = $this->mapPoints->getMapPoint( FALSE, $options );
		foreach ($points as $p){
			$pointIds[$p->p_id] =  $p->p_id;
		}
		/** @type array get the userfields from the model map_userfields */
		$userFields = $this->mapUserFields->getUserFields($pointIds);

		foreach ($points as $mapPoints){
			$usersfields = $userFields[$mapPoints->p_id];

            /** reorganize userfields to be name based, and not id based */
            foreach ($usersfields as $uF){
                $uField[$uF->f_fieldname] = $uF;
            }
			$this->data['points'][$mapPoints->p_id]['pointData'] = $mapPoints;
			$this->data['points'][$mapPoints->p_id]['pointFields'] = $uField;
		}
		$this->template
			->title('User Dashboard')
			->set_breadcrumb('Dashboard', 'profile/index')
			->set_partial('add-new-point-form', 'profile/partials/map/addpointform')
			->append_metadata('$().ready(function() {$("#view-map-table").dataTable();$(".delete-item").click(function(){if( !confirm("Are you sure you want to delete?")){ return false; }});$("#graph-data").visualize({type: "line", height: 250}).appendTo("#tab-line").trigger("visualizeRefresh");});')
			->append_metadata('$().ready(function(){ $("chzn-select").chosen(); });')
			->build('profile/index', $this->data);
	} #end viewMap function



}