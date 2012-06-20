<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email extends ADMIN_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('admin/map_point_emails', 'pointEmails');
		$this->load->library('parser');

	} #end constructor function
	public function index(){
		$points = $this->mapPoints->getMapPoint();
		foreach ($points as $p){
			$pointIds[$p->p_id] =  $p->p_id;
		}
		$this->benchmark->mark('getuserfields_start');
		/** @type array get the userfields from the model map_userfields */
		$userFields = $this->mapUserFields->getUserFields($pointIds);

		$this->benchmark->mark('getuserfields_end');
		$this->benchmark->mark('plotpoints_start');


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
			->title('Mass Email')
			->set_breadcrumb('Mass Email', '/admin/email/index')
			->append_metadata('$().ready(function(){ $("chzn-select").chosen(); });')
			->build('admin/email/index', $this->data);

	}

	/**
	 * send a mass email based on category
	 */
	public function byCategory(){

		$points = $this->mapPoints->getMapPoint();
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
			->title('Mass Email | By Category')
			->set_breadcrumb('Mass Email', '/admin/email/index')
			->set_Breadcrumb('By Category', '/admin/email/bycategory')
			->append_metadata('$().ready(function(){ $(".chzn-select").chosen(); });')
			->build('admin/email/bycategory', $this->data);
	}

	public function validateEmail(){
		$this->form_validation->set_rules('sender_name', 'From Name', 'xss_clean|required');
		$this->form_validation->set_rules('sender_email', 'From Email', 'xss_clean|valid_email|required');
		$this->form_validation->set_rules('subject', 'Subject', 'xss_clean|required');
		$this->form_validation->set_rules('message', 'Message', 'xss_clean|required');

		if ($this->form_validation->run()){
			$this->sender_name = $this->input->post('sender_name', TRUE);
			$this->sender_email = $this->input->post('sender_email', TRUE);
			$this->subject = $this->input->post('subject', TRUE);
			$this->emailMessage = $this->input->post('message', TRUE);
			return TRUE;
		}else{
			return validation_errors();
		}
	}


	public function send($emailType){
		$validationErrors = $this->validateEmail();
		if ($validationErrors != TRUE){
			$r[] = array(
				'message' => 'Unable to validate email fields, please check the fields and try again',
				'type' => 'error',
				'flashdata' => TRUE
			);
			$this->message->add(403, $r);
		}else{
			switch ($emailType){
				/**
				 * if the submit is by category,
				 * explode the selected categories,
				 * check if they did indeed select something.
				 * If they did, grab all the email addresses for those categories
				 *
				 */
				case 'bycategory':
					$a = explode('&', $this->input->post('categoriesList'));

					$implodeIt = implode('', $a);
					if (empty($implodeIt)){
						$r[] = array(
							'message' => 'Please select at least one category before sending',
							'type' => 'error'
						);
						$this->message->add(403, $r);
					}else{
						$i = 0;
						while ($i < count($a)) {
						    $b = explode('=', $a[$i]);
						    $cat[] = urldecode($b[1]);
						    $i++;
						}

						/**
						 * Query the Database for email addresses,
						 * build the email, store it in the database
						 * to be sent at a later date.
						 */
						$userInfo = $this->pointEmails->getPointEmails($cat);

						foreach ($userInfo as $uI){

							$templateInfo = array(
								'contactName' => $uI->ContactName,
								'contactEmail' => $uI->ContactEmail
							);
							$emailMessage = $this->parser->parse_string($this->emailMessage, $templateInfo, TRUE);

							$emails[] = array(
								'subject' => $this->subject,
								'message' => $emailMessage,
								'from_name' => $this->sender_name,
								'from_email' => $this->sender_email,
								'added_on' => time(),
								'to_email' => $uI->ContactEmail,
								'to_name' => $uI->ContactName
							);
						}
						if ( $this->pointEmails->queueUp($emails) ){
							$r[] = array(
								'message' => 'Successfully added the emails to the queue, they will be sent out shortly',
								'type' => 'success'
							);
							$this->message->add(200, $r);
						}else{
							$r[] = array(
								'message' => 'There was an error adding the emails to the queue, contact a system administrator',
								'type' => 'error'
							);
							$this->message->add(403, $r);
						}
						//send by category
					}
				break;
			}
		}
	}
} #end class