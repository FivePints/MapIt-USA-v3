<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ADMIN_Controller extends MY_Controller {
    public function __construct(){
        parent::__construct();

        if (!$this->ion_auth->logged_in()){
            redirect(site_url('/user/login/'));
        }else{
            if( !$this->ion_auth->is_admin() ){
                redirect('/profile/index');
            }
        }
        $this->data['user'] = array(
            'session_id'     => $this->session->userdata('session_id'),
            'ip_address'     => $this->session->userdata('ip_address'),
            'user_agent'     => $this->session->userdata('user_agent'),
            'last_activity'  => $this->session->userdata('last_activity'),
            'user_data'      => $this->session->userdata('user_data'),
            'identity'       => $this->session->userdata('identity'),
            'username'       => $this->session->userdata('username'),
            'first_name'     => $this->session->userdata('first_name'),
            'last_name'      => $this->session->userdata('last_name'),
            'email'          => $this->session->userdata('email'),
            'user_id'        => $this->session->userdata('user_id'),
            'old_last_login' => $this->session->userdata('old_last_login'),
        );

        /**
         * Load Libraries
         * Load libraries specific to the admin area
         */
        #load the Google Maps Library so we can interface with it and start populating points
        $this->load->library('GMap');
        #load MapIts File upload library
        $this->load->library('File_upload');

        /**
         * Load Models
         * Load models specific to admin area
         */
        #load the model to interface with users table
        $this->load->model('Map_users', 'mapUsers');

        /**
         * Load Helpers
         */
        #wysiwyg editor helper
        $this->load->helper('ckeditor');

        /**
         * Load Configs
         */
        $this->data['map'] = array(
            'categories'     => $this->mapCategories->getAllCategories(),
            'users'          => $this->ion_auth->users(),
            'levels'         => $this->mapLevels->getAllLevels(),
            'announcements'  => $this->mapConfig->getAnnouncements()
        );

        /** Empty holder for assets, used in views to dynamically load js/css files */

        $this->template
            ->set_partial('backend-sidebar', 'partials/backend/admin/sidebar')
            ->set_partial('backend-header', 'partials/backend/admin/header')
            ->set_partial('backend-absfooter', 'partials/backend/admin/absfooter')
            ->set_layout('admin_template');
    }
}
