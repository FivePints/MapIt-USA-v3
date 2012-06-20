<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends AUTH_Controller{
	function __construct(){
		parent::__construct();
	}

	/**
	 * Login user on the site
	 *
	 * @return void
	 */
	function login(){
		if( $this->ion_auth->logged_in() ){
			if( $this->ion_auth->is_admin() ){
				redirect('admin/index');
			}else{
				redirect('profile/index');
			}
		}else{
			//validate form input
			$this->form_validation->set_rules('identity', 'Identity', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');

			if ($this->form_validation->run() == true){
				//check to see if the user is logging in
				//check for "remember me"
				$remember = (bool) $this->input->post('remember');

				if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember)){
					//if the login is successful
					//redirect them back to the home page
					$this->session->set_flashdata('message', $this->ion_auth->messages());

					if( $this->ion_auth->is_admin() ){
						redirect('admin/index');
					}else{
						redirect('profile/index');
					}

				}else{
					//if the login was un-successful
					//redirect them back to the login page
					$this->session->set_flashdata('message', $this->ion_auth->errors());
					redirect('auth/login', 'refresh'); //use redirects instead of loading views for compatibility with MY_Controller libraries
				}
			}else{
				//the user is not logging in so display the login page
				//set the flash data error message if there is one
				$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

				$this->template
					->title('Login Form')
					->build('auth/templates/login_form', $this->data);
			}
		}
	}
	/**
	 * Logout the currently signed in user
	 */
	function logout(){
		//log the user out
		$logout = $this->ion_auth->logout();
		//redirect them back to the page they came from
		redirect('auth/login', 'refresh');
	}
}
/* End of file auth.php */
/* Location: ./application/controllers/auth.php */