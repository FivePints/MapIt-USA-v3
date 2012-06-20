<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends ADMIN_Controller {

	function __construct(){
		parent::__construct();
		$this->lang->load('tank_auth');
	}#end constructor function


/**
 * Index Function
 *
 * Default view that is loaded this displays all of the users
 * in a tabular view.
 *
 * @author Mike DeVita
 * @category controller function
 * @copyright 2011 MapIT USA
 * @package map_users
 *
 */
	public function index(){
		$this->data['users'] = $this->mapUsers->getAllUsers();
		$this->template
			->title('User Management')
			->set_breadcrumb('User Management', 'user/index')
			->append_metadata(" var oTable = $('#view-user-table').dataTable({ 'aaSorting': [[1, 'asc']] });")
			->build('admin/user', $this->data);

	}#end index() function

/**
 * Add User Controller Function
 *
 * This function handles adding a user via the admin panel.
 * The admin adding the user can override the email activation
 * and also upload an avatar.
 *
 * @author Mike DeVita
 * @category controller function
 * @copyright 2011 MapIT USA
 * @package map_users
 *
 */
	public function addUser(){
		$use_username = $this->config->item('use_username', 'tank_auth');

		if ($use_username) {
			$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|min_length['.$this->config->item('username_min_length', 'tank_auth').']|max_length['.$this->config->item('username_max_length', 'tank_auth').']|alpha_dash');
		}
		$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|min_length['.$this->config->item('password_min_length', 'tank_auth').']|max_length['.$this->config->item('password_max_length', 'tank_auth').']');
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|xss_clean|matches[password]');
		$this->form_validation->set_rules('firstname', 'First Name', 'required|min_length[1]');
		$this->form_validation->set_rules('lastname', 'Last Name', 'required|min_length[1]');
		$this->form_validation->set_rules('avatar', 'Avatar', 'xss_clean');
		$this->data['errors'] = array();
		if ($this->input->post('activate') == 0){
			$email_activation = 0;
		}elseif( $this->input->post('activate') == 1 ){
			$email_activation = 1;
		}

		if ($this->form_validation->run()) {								// validation ok
			if (!is_null($this->data = $this->tank_auth->create_user(
					$use_username ? $this->form_validation->set_value('username') : '',
					$this->form_validation->set_value('email'),
					$this->form_validation->set_value('password'),
					$this->form_validation->set_value('firstname'),
					$this->form_validation->set_value('lastname'),
					$this->file_upload->uploadAvatar('avatar', $this->form_validation->set_value('username'),  TRUE),
					$email_activation,
					$this->input->post('level', TRUE)
					))) {
				 		$this->message->add('Successfully Added The User', 'success', FALSE);
						redirect('/admin/user/index');		 //form success
			} else {
				$errors = $this->tank_auth->get_error_message();
				foreach ($errors as $k => $v){
					#$this->data['errors'][$k] = $this->lang->line($v);
					$this->message->add($v, 'error');
				}
			}
		}
		$this->data['use_username'] = $use_username;
		$this->template
			 ->title('Add New User')
			 ->set_breadcrumb('User Management', '/admin/user/index')
			 ->set_breadcrumb('Add New User', '/admin/user/adduser')
			 ->build('admin/adduser', $this->data);
	}#end addUser() function
	/**
	 * Edit User Controller Function
	 *
	 * This function handles the editing of a specific
	 * user. The userId is pulled from the URI
	 * and passed to the map_points model to be modified.
	 *
	 * @var userId
	 * @author Mike DeVita
	 * @category controller function
	 * @copyright 2011 MapIT USA
	 * @package map_users
	 *
	 */
 	public function editUser($userId = ''){
		#if the userId is blank then redirect the visitor to the index function so they can pick a user to edit.
		if ($userId == ''){
			 redirect(site_url('/admin/user/index'));
		}

		$userInfo = $this->mapUsers->getUserInfo($userId);
		$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
		$this->form_validation->set_rules('firstname', 'First Name', 'required|min_length[1]');
		$this->form_validation->set_rules('lastname', 'Last Name', 'required|min_length[1]');
		$this->form_validation->set_rules('avatar', 'Avatar', 'xss_clean');
		/**
		 * if the form has been submitted then start the validation and editing process
		 * otherwise set formsuccess NULL and load the view.
		 */
		if ($this->input->post('email') == TRUE){

			if ($this->form_validation->run()) {
				$email = $this->input->post('email', TRUE);
				$firstname = $this->input->post('firstname', TRUE);
				$lastname = $this->input->post('lastname', TRUE);
				$avatar = $this->input->post('avatar', TRUE);

				$level = $this->input->post('level', TRUE);
				/**
				 * If the email address was changed run the following code
				 */
				if ($email != $userInfo->email){
						// validation ok
						if (!is_null($this->data = $this->tank_auth->set_new_email(
								$this->form_validation->set_value('email'),
								$this->form_validation->set_value('password')))) {			// success

							// Send email with new email address and its activation link
							$this->_send_email('change_email', $this->data['new_email'], $this->data);
							$r[] = array(
								'message' => "An email was successfully sent to ".$this->data['new_email']." the user will need to click the confirmation link before the new email is activated.",
								'type' => 'warning'
							);
							$this->message->add(200, $r);
						} else {
							$errors = $this->tank_auth->get_error_message();
							foreach ($errors as $k => $v) {
								$r[] = array(
									'message' => $this->lang->line($v),
									'type' => 'error'
								);
								$this->message->add(400, $r);
							}
						}
				}
				if ($firstname != $userInfo->firstname || $lastname != $userInfo->lastname || $avatar != $userInfo->avatar){
					$avatar = $this->file_upload->uploadAvatar('avatar', $userInfo->username,  TRUE);

					if ($avatar == FALSE){
						$avatar = $userInfo->avatar;
					}

					$userData = array(
						'firstname' => $firstname,
						'lastname' => $lastname,
						'user_level' => $level,
						'avatar' => $avatar
					);
					$this->mapUsers->editUser($userId, $userData);

			 		$r[] = array(
			 			'message' => 'Successfully Edited The User',
			 			'type' => 'success'
			 		);
			 		$this->message->add(200, $r);
				}
			}else{
				$r[] = array(
					'message' => 'Form Validation Failed',
					'type' => 'error'
				);
				$this->message->add(400, $r);
			}
		}else{
			$this->data['userInfo'] = $userInfo;
			$this->template
				 ->title('Edit User')
				 ->set_breadcrumb('User Management', '/admin/user/index')
				 ->set_breadcrumb('Edit User', '/admin/user/edituser/'.$userId)
				 ->build('admin/edituser', $this->data);
		}
 	}#end editUser() function


	/**
	 * Delete User Controller Function
	 *
	 * This function deletes a user from the database users table
	 * based on the userId that was passed.
	 *
	 * @var pointId
	 * @author Mike DeVita
	 * @category controller function
	 * @copyright 2011 MapIT USA
	 * @package map_points
	 *
	 */
 	public function deleteUser($userId = ''){
 		/** $message, $type, $echo */
 		if( $this->mapUsers->deleteUser($userId) ){
 			$r[] = array(
 				'message' => 'Successfully Deleted The User',
 				'type' => 'success'
 			);
 			$this->message->add(200, $r);
 		}else{
 			$r[] = array(
 				'message' => 'There was an error deleting the user',
 				'type' => 'error'
 			);
 			$this->message->add(400, $r);
 		}
 	}#end deletePoint function

 	public function status($userId= ''){
 		if ( $this->input->post('status') == 1 ){
 			self::_deactivateUser($userId);
 		}elseif ( $this->input->post('status') == 0 ){
 			self::_activateUser($userId);
 		}else{
 			return false;
 		}
 	}

	/**
	 * Activate User Controller Function
	 *
	 * This function activates a point from the database based
	 * on the pointId that was passed from the URI.
	 *
	 * @var pointId
	 * @author Mike DeVita
	 * @category controller function
	 * @copyright 2011 MapIT USA
	 * @package map_points
	 *
	 */
 	private function _activateUser($userId = ''){
 		if( $this->mapUsers->activateUser($userId) ){
 			$r[] = array(
 				'message' => 'Successfully activated the user',
 				'type' => 'success'
 			);
 			$this->message->add(200, $r);
 		}else{
 			$r[] = array(
 				'message' => 'There was an error activating the user',
 				'type' => 'error'
 			);
 			$this->message->add(400, $r);
 		}
 	}#end activatePoint function

	/**
	 * Deactivate User Controller Function
	 *
	 * This function deactivates a point from the database based
	 * on the pointId that was passed from the URI.
	 *
	 * @var pointId
	 * @author Mike DeVita
	 * @category controller function
	 * @copyright 2011 MapIT USA
	 * @package map_points
	 *
	 */
 	private function _deactivateUser($userId = ''){
 		if( $this->mapUsers->deactivateUser($userId) ){
 			$r[] = array(
 				'message' => 'Successfully deactivated the user',
 				'type' => 'success'
 			);
 			$this->message->add(200, $r);
 		}else{
 			$r[] = array(
 				'message' => 'There was an error deactivating the user',
 				'type' => 'error'
 			);
 			$this->message->add(400, $r);
 		}
 	}#end activatePoint function

	/**
	 * Send email message of given type (activate, forgot_password, etc.)
	 *
	 * @param	string
	 * @param	string
	 * @param	array
	 * @return	void
	 */
	function _send_email($type, $email, &$data)
	{
		$this->load->library('email');
		$this->email->from($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
		$this->email->reply_to($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
		$this->email->to($email);
		$this->email->subject(sprintf($this->lang->line('auth_subject_'.$type), $this->config->item('website_name', 'tank_auth')));
		$this->email->message($this->load->view('email/'.$type.'-html', $data, TRUE));
		$this->email->set_alt_message($this->load->view('email/'.$type.'-txt', $data, TRUE));
		$this->email->send();
	}


}#end class