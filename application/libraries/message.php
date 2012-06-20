<?php
class Message {
	function __construct() {
		$this->ci =& get_instance();
		$this->messages = array(); 
   }

   /**
    * add a jGrowl message to the array, 
    * echo out if $echo = true, otherwise 
    * set the value to a flashdata for redirect.
    *
    * @param array $message the message, type, and any optional params to be used
    * @param integer $code the http status code to be used
    */
    public function add( $code = 200, $message = array() ){
        $this->ci->output->set_status_header($code);

        foreach ($message as $m){
            if( !$m['type'] ){
                $m['type'] = 'error';
            }
            if( !$m['message'] ){
                $m['message'] = 'Unable to Proceed Due To System Error';
            }
            $messages = array(
                'type' => $m['type'],
                'message' => $m['message']
            );

            if( isset($m['flashdata']) && $m['flashdata'] == TRUE ){
                $this->ci->session->set_flashdata('messages', $messages);
            }else{
                echo json_encode( $messages );
            }
        }
   }
}