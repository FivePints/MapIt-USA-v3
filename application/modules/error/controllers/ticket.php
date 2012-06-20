<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ticket extends PROFILE_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->library('email');
		
		if(! $this->input->is_ajax_request()) {
		    redirect('/error/message/404');
		}
	}

	public function send(){
		
		$subject = $this->input->post('subject', TRUE);
		$user_id = $this->input->post('user_id', TRUE);
		$username = $this->input->post('username', TRUE);
		$emailAddress = $this->input->post('emailAddress', TRUE);
		$firstname = $this->input->post('firstname', TRUE);
		$lastname = $this->input->post('lastname', TRUE);
		$userlevel = $this->input->post('userlevel', TRUE);
		$last_login = date( 'm/d/Y g:i:s', $this->input->post('last_login', TRUE) );
		$user_ip = $this->input->post('user_ip', TRUE);


$message = '<h3>A New Support Inquiry has been submitted</h3><br><br>';
$message .= $this->input->post('message', TRUE);
$message .= '<br><br>
------<br>
<strong>subject:</strong> '.$subject.'<br>
<strong>user_id:</strong> '.$user_id.'<br>
<strong>username:</strong> '.$username.'<br>
<strong>firstname:</strong> '.$firstname.'<br>
<strong>lastname:</strong> '.$lastname.'<br>
<strong>userlevel:</strong> '.$userlevel.'<br>
<strong>last_login:</strong> '.$last_login.'<br>
<strong>user_ip:</strong> '.$user_ip.'<br>';

		$this->email->from('no-reply@mapitusa.com', 'MapIt USA Support Inquiry');
		$this->email->to('m.devita@gmail.com');
		$this->email->cc('jclegg@fivepints.com', 'mdevita@fivepints.com');

		$this->email->subject($subject);
		$this->email->message($message);
		$this->email->reply_to($emailAddress);

		$config['mailtype'] = 'html';
		$config['protocol'] = 'mail';
		if ($this->email->send($config)){
			return true;
		}else{
			echo $this->email->print_debugger();
			return false;
		}

	}
	
}

/* End of file index.php */
/* Location: ./application/controllers/index.php */
?>