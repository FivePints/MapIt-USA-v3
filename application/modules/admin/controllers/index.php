<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends ADMIN_Controller {

	function __construct(){
		parent::__construct();
	}
	/**
	 * The default controller
	 * This is the dashboard, which 
	 * shows some nifty charting and
	 * basic statistical information 
	 * for the administrators.
	 */
	public function index(){
		$this->data['chart'] = array(
			'byCategory' => array(
				'title'  => 'Top 5 Categories',
				'data'   => $this->mapPoints->getCountByCategory( array('limit' => 5) ),
			),
		);

		$this->template
			->title('Admin Dashboard')
			->set_breadcrumb('Dashboard', 'admin/index')
			->set_partial('add-new-point-form', 'profile/partials/map/addpointform')
			->append_metadata("$('#graph-data').visualize({type: 'pie', height: 250}).appendTo('#tab-pie').trigger('visualizeRefresh');")
			->build('admin/index', $this->data);
	} #end viewMap function
}