<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ADMIN_Controller extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->output->enable_profiler(true);

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
         * Load all of the helpers that we will need throughout the
         * entire class.
         */
        #url helper, responsible for parsing POST/GET and url segments
        $this->load->helper('url');
        #form helper, responsible for handling form fields, and get/post
        $this->load->helper('form');

        /**
         * Load all of the libraries that we will need throughout the
         * entire class.
         */
        #form validation library, responsible for validating and xss cleaning all form fields that are submitted
        $this->load->library('form_validation');
        #load the Google Maps Library so we can interface with it and start populating points
        $this->load->library('GMap');
        #load MapIts File upload library
        $this->load->library('File_upload');
        #load MapITs mapHtml library, this library handles all of the compiling of the users info into html
        $this->load->library('Map_html');
        $this->load->library('message');
        $this->load->helper('ckeditor');

        /**
         * MapIT Model Loading
         *
         * This section loads all of the models that are required to interface
         * with the MapIT Database.
         *
         * @author Mike DeVita
         * @category controller_function
         * @copyright 2011 MapIT USA
         * @package map_models
         *
         */
        #load the map config model to get the site title and other information
        $this->load->model('Map_config', 'mapConfig');
        #load the map points model to interact with the map_points table
        $this->load->model('Map_points', 'mapPoints');
        #load the levels model, this model interacts with the levels table
        $this->load->model('Map_levels', 'mapLevels');
        #load the model to interface with the categories table
        $this->load->model('Map_categories', 'mapCategories');
        #load the model to interface with users table
        $this->load->model('Map_users', 'mapUsers');
        #load the model to interface with the userfields table
        $this->load->model('Map_userfields', 'mapUserFields');
        #load the config info for the mapit site
        $this->data['mapConfig'] = $this->mapConfig->getConfig();

        #set customJS to blank for a placeholder
        $this->data['customJs'] = '';
        /**
         * Add Map Values
         *
         * This grabs all of the various values that we will need for each
         * of the form fields. List of all categories, list of all users,
         * and list of all levels.
         *
         * @var categories, users, levels
         *
         */
        $this->data['map'] = array(
            'categories' => $this->mapCategories->getAllCategories(),
            'users'      => $this->ion_auth->users(),
            'levels'     => $this->mapLevels->getAllLevels()
            );

        $this->data['page'] = array(
            'announcements' => $this->mapConfig->getAnnouncements()
        );

        $this->data['assets'] = array();

        $this->template
            ->set_partial('backend-sidebar', 'partials/backend/admin/sidebar')
            ->set_partial('backend-header', 'partials/backend/admin/header')
            ->set_partial('backend-absfooter', 'partials/backend/admin/absfooter')
            ->set_layout('admin_template');
    }
}
