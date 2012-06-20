<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cron extends ADMIN_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->library('crontasks');
	}
	/**
	 * Handles the enable/disable of 
	 * cron tasks, also tracks the amount of
	 * times a cron task has been iniiated.
	 */
	public function index(){
		$this->data['cron_tasks'] = $this->cron_model->get();
		$this->template
			->title('MapIt Cron Tasks')
			->append_metadata(" var oTable = $('#view-crontasks-table').dataTable({ 'aaSorting': [[0, 'asc']] });")
			->build('admin/cron/list', $this->data);
	}
	public function test(){
        if( $this->crontasks->processCategoryDealCount() ){
        	redirect('admin/index');
        }else{
        }
    }
	public function forcerun($id){
	}
}

/* End of file index.php */
/* Location: ./application/controllers/index.php */
?>