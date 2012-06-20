<?php
class File_upload    {
    function __construct() {
        $this->ci =& get_instance();
        $this->ci->load->config('file_upload');
        $this->ci->load->library('upload');
    }
    function uploadAdvertisement($file = '', $time = FALSE ){
        #load the specific config for this type of image.
        $config = $this->ci->config->item('file_upload');
        $config = $config['advertisements'];
        $config['file_name'] = $config['file_name'].$time;

        #initialize the upload class and pass it the config vars for the logo image
        $this->ci->upload->initialize($config);

        #if the upload succeeeded then grab the uploaded data into an array
        if ($this->ci->upload->do_upload('picture')){
            $image = $this->ci->upload->data();
            $image = $image['file_name'];
            return $image;
        }else{  
            return false;
        }
    }
	function uploadImage($file = '', $pointId = FALSE, $time = FALSE){
        #load the specific config for this type of image.
        $config = $this->ci->config->item('file_upload');
        $config = $config[$file];

        if(!is_dir($config['upload_path'].$pointId)){
            mkdir($config['upload_path'].$pointId, 0777);
        }
        
        $config['upload_path'] .= $pointId.'/';
        #adjust the file_name to include time() and the pointId if set
        if ($time){
           $config['file_name'] = $config['file_name'].$pointId.'_'.time();
        }else{
           $config['file_name'] = $config['file_name'].$pointId;
        }

        #initialize the upload class and pass it the config vars for the logo image
        $this->ci->upload->initialize($config);
        #if the upload succeeeded then grab the uploaded data into an array
        if ($this->ci->upload->do_upload($file)){
            $image = $this->ci->upload->data();
            $image = $image['file_name'];
        #if the file fields are empty then set the var to whats existing in the database so theres no overwriting.
        }else{
            echo $this->ci->upload->display_errors();
        }
        return $image;
	}#end uploadImage() function


    function uploadAvatar($file = '', $userName = FALSE, $time = FALSE){
        #load the specific config for this type of image.
        $config = $this->ci->config->item('file_upload');
        $config = $config['avatar'];
        #adjust the file_name to include time() and the pointId if set
        if ($time){
           $config['file_name'] = $config['file_name'].$userName.'_'.time();
        }else{
           $config['file_name'] = $config['file_name'].$userName;
        }

        #initialize the upload class and pass it the config vars for the logo image
        $this->ci->upload->initialize($config);
        #if the upload succeeeded then grab the uploaded data into an array
        if ($this->ci->upload->do_upload($file)){
            $image = $this->ci->upload->data();
            $image = $image['file_name'];
            return $image;
        #if the file fields are empty then set the var to whats existing in the database so theres no overwriting.
        }else{
            return false;
        }
    }#end uploadAvatar() function



}#end file_upload class