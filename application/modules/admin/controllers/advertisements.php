<?php
/**
* Levels Class For Administration Backend
*/
class Advertisements extends ADMIN_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->model('map_advertisements');
	} #end constructor function

	/**
	 * displays the advertisements currently in
	 * the database. From this page you can 
	 * change the status of advertisements or
	 * edit them.
	 * 
	 * @author Mike DeVita <m.devita@fivepints.com>
	 * @copyright 2012 Copyright MapIt USA
	 * @package advertisements
	 * @version 1.0
	 */
	public function index(){
		$this->data['advertisements'] = $this->map_advertisements->getAdvertisementsWithClicks();

		$this->data['assets'] = array(
			array(
				'type' => 'js',
				'assets' => array( 'backend/jquery.dataTables.min.js', 'backend/jquery.dataTables.user.js' ),
			),
		);

		$this->template
			 ->title('All Advertisements')
			 ->set_breadcrumb('Advertisement Management', '/admin/advertisements/index')
			 //->append_metadata(" var oTable = $('#view-advertisements-table').dataTable({ 'aaSorting': [[3, 'asc']] });")
			 ->build('admin/advertisements/index', $this->data);
	}
	/**
	 * displays the add advertisement form
	 * this form is used to add an advertisement
	 * to the front-end of mapit.
	 * 
	 * @author Mike DeVita <m.devita@fivepints.com>
	 * @copyright 2012 Copyright MapIt USA
	 * @package advertisements
	 * @version  1.0
	 */	
	public function add(){
		if ( $this->input->post() ){
			$validationErrors = self::_validateForm();
			if ($validationErrors != 1){
				$r[] = array(
					'message' => 'Unable to add the advertisement due to the following validation errors: '.$validationErrors,
					'type' => 'error',
					'flashdata' => TRUE
				);
				$this->message->add(400, $r);
				exit;
				redirect( '/admin/advertisements/add');
			}else{
				$this->timestamp = time();
				if($this->youtube){
					#load the video helper spark
					$this->load->spark('video_helper/1.0.2');
					#load the video helper to parse vimeo and youtube videos
					$this->load->helper('video');
					$this->youtube = youtube_id($this->youtube);
					$this->picture = '';

				}elseif($_FILES['picture']['name'] != ''){
					$this->picture = $this->file_upload->uploadAdvertisement($_FILES, $this->timestamp );
				}else{
					$this->youtube = '';
					$this->picture = '';
				}
				$advertisement = array(	
					'youtube_id'  => $this->youtube,
					'status'      => $this->status,
					'timestamp'   => $this->timestamp,
					'type'        => $this->type,
					'filename'    => $this->picture,
					'url'         => $this->url,
					'description' => $this->description,
					'title'       => $this->title
				);
				if ( $this->map_advertisements->insert($advertisement) ){
					/** add( message, type[success|error], echo[default|false] ) */
					$r[] = array(
						'message' => 'Successfully added the advertisement to the system, it should show up shortly.',
						'type' => 'success',
						'flashdata' => TRUE,
					);
					$this->message->add(200, $r);
					$this->db->cache_delete('admin', 'advertisements');
					redirect('admin/advertisements/index', 'refresh');
				}else{
					/** add( message, type[success|error], echo[default|false] ) */
					$r[] = array(
						'message' => 'Unable to add the advertisement to the system, due to a system error. Contact an Administrator',
						'type' => 'error',
						'flashdata' => TRUE,
					);
					$this->message->add(400, $r);
				}
			}
		}else{
			$this->template
				 ->title('Add Advertisement')
				 ->set_breadcrumb('Advertisement Management', '/admin/advertisements/index')
				 ->build('admin/advertisements/add', $this->data);
		}
	}

	public function edit($id){
	}
	/**
	 * the public facing status change method.
	 * This method changes the status of the
	 * advertisement based on the status post
	 * var that was passed to it from the form.
	 * 
	 * @param  integer $id id number of the advertisement
	 * @return boolean     returns false if the status change failed
	 * 
	 * @author Mike DeVita <m.devita@fivepints.com>
	 * @copyright 2012 Copyright MapIt USA
	 * @package advertisements
	 * @version  1.0
	 */
	public function status($id){
		$this->output->enable_profiler(false);
		$data = $this->input->post('data');

 		if ( $data['status'] == 1 ){
 			self::_deactivate($id);
 		}elseif ( $data['status'] == 0 ){
 			self::_activate($id);
 		}else{
 			return false;
 		}

	}
	public function delete($id){
		$this->output->enable_profiler(false);
		if ( $this->map_advertisements->delete($id) ){
			/** add( message, type[success|error], echo[default|false] ) */
			$r[] = array(
				'message' => 'Successfully deleted the advertisement',
				'type' => 'success'
			);
			$this->message->add(200, $r);
			$this->db->cache_delete('admin', 'advertisements');
		}else{
			/** add( message, type[success|error], echo[default|false] ) */
			$r[] = array(
				'message' => 'Unable to delete the advertisement, due to a system error. Please contact a system administrator',
				'type' => 'error'
			);
			$this->message->add(400, $r);
			exit;
		}
	}
	private function _activate($id){
		if ($this->map_advertisements->activate($id)){
			/** add( message, type[success|error], echo[default|false] ) */
			$r[] = array(
				'message' => 'Successfully activated the Advertisement',
				'type' => 'success'
			);
			$this->message->add(200, $r);
			$this->db->cache_delete('admin', 'advertisements');
		}else{
			/** add( message, type[success|error], echo[default|false] ) */
			$r[] = array(
				'message' => 'Unable to activate the advertisement, contact a system administrator',
				'type' => 'error'
			);
			$this->message->add(400, $r);
		}
	}
	private function _deactivate($id){
		if ($this->map_advertisements->deactivate($id)){
			/** add( message, type[success|error], echo[default|false] ) */
			$r[] = array(
				'message' => 'Successfully deactivated the Advertisement',
				'type' => 'success'
			);
			$this->message->add(200, $r);
			$this->db->cache_delete('admin', 'advertisements');
		}else{
			/** add( message, type[success|error], echo[default|false] ) */
			$r[] = array(
				'message' => 'Unable to deactivate the advertisement, contact a system administrator',
				'type' => 'error'
			);
			$this->message->add(400, $r);
		}
	}
	private function _validateForm(){

		$this->form_validation->set_rules('youtube', 'YouTube Video URL', 'xss_clean');
		$this->form_validation->set_rules('status', 'Advertisement Default Status', 'required|xss_clean|is_natural');
		$this->form_validation->set_rules('type', 'Advertisement Type', 'required|xss_clean');
		$this->form_validation->set_rules('url', 'Advertisement URL', 'xss_clean|prep_url');
		$this->form_validation->set_rules('description', 'Advertisement Description', 'required|xss_clean');
		$this->form_validation->set_rules('title', 'Advertisement Page Title', 'required|xss_clean');

		if ($this->form_validation->run()){
			$this->youtube = $this->input->post('youtube', TRUE);
			$this->status = $this->input->post('status', TRUE);
			$this->type = $this->input->post('type', TRUE);
			$this->url = $this->input->post('url', TRUE);
			$this->description = $this->input->post('description', TRUE);
			$this->title = $this->input->post('title', TRUE);
			return TRUE;
		}else{
			return validation_errors();
		}
	}
}