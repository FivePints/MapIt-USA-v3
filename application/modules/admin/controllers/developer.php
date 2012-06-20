<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Developer extends ADMIN_Controller {

	function __construct(){
		parent::__construct();
	} #end constructor function

	/**
	 * handles the updating of the database
	 * with new tables/columns for future versions
	 */
	public function migrate(){
		$this->load->library('migration');
		$this->load->model('map_migrations');
		$this->load->helper('directory');

		if( $this->input->post('migration_version') ){
			$v = $this->input->post('migration_version', TRUE);

			if ( !$this->migration->version($v) ){
				show_error( $this->migration->error_string() );
			}else{
				$this->db->cache_delete_all();
				$r[] = array(
					'message' => 'Successfully Made the Migrations',
					'type' => 'success',
					'flashdata' => TRUE
				);
				$this->message->add(200, $r);
				redirect('admin/developer/migrate', 'redirect');
			}
		}else{
			$m = directory_map(APPPATH.'migrations/');
			$this->data['currentMigration'] = $currMigration = $this->map_migrations->getCurrent();
			foreach ($m as $m){
				$version = explode('_', $m);
				$this->data['migrations'][] = array(
					'version' => $version[0],
					'file' => $m
				);
			}

			$this->template
				->title('MapIt Migrations')
				->set_breadcrumb('Developer Toolbox', '/admin/developer')
				->build('admin/developer/migrate_add', $this->data);
		}
	}
} #end class