<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Config extends ADMIN_Controller {

	var $mapItConfig = array();

	function __construct(){
		parent::__construct();
	} #end constructor function
	public function index(){

		/**
		 * Page Values
		 *
		 * This passes preset values that are loaded into the view.
		 * @var page_file, page_title, page_breadcrumb, page_description, customJs
		 *
		 */
		$this->template
			->title('MapIt Configuration')
			->set_breadcrumb('Configuration', '/admin/config')
			->build('admin/config/config', $this->data);
	}
	public function style(){
	$this->template
			->title('MapIt Style Configuration')
			->set_breadcrumb('Configuration', '/admin/config')
			->build('admin/config/style', $this->data);
	}


	/**
	 * Validate Form Fields Function
	 * @return boolean
	 */
	private function validateForm(){
	 	/** setup the validation rules */
		$this->form_validation->set_rules('sitetitle', 'Site Title', 'required|xss_clean');
		$this->form_validation->set_rules('sitename', 'Site Name', 'required|xss_clean');
		$this->form_validation->set_rules('markerIcon', 'Marker Icon', 'required|xss_clean');
		$this->form_validation->set_rules('apiKey', 'Default Zoom', 'required|xss_clean');
		$this->form_validation->set_rules('tabTitle', 'Primary Tab Title', 'required|xss_clean|max_length[24]');
		$this->form_validation->set_rules('defaultZoom', 'Default Latitude', 'required|xss_clean|is_natural');
		$this->form_validation->set_rules('defaultMapId', 'Default Longitude', 'required|xss_clean');
		$this->form_validation->set_rules('defaultMapType', 'Map Container ID', 'required|xss_clean');

		$this->form_validation->set_rules('events', 'Events Toggle', 'xss_clean');
		$this->form_validation->set_rules('deals', 'Deals Toggle', 'xss_clean');

		$this->form_validation->set_rules('default_email_from_name', 'Default Email Sender Name', 'required|xss_clean');
		$this->form_validation->set_rules('default_email_from_address', 'Default Email Sender Address', 'required|valid_email|xss_clean');

		$this->form_validation->set_rules('defaultLat', 'Default Map Type', 'required|xss_clean|numeric');
		$this->form_validation->set_rules('defaultLng', 'Maps API Key', 'required|xss_clean|numeric');
		$this->form_validation->set_rules('activationKey', 'MapIT Activation Key', 'required|xss_clean');


		/** run the validation, if its successful return TRUE, otherwise return the errors */
		if ($this->form_validation->run()){

			$this->mapItConfig = array(
				'site_title' => $this->input->post('sitetitle', TRUE),
				'site_name' => $this->input->post('sitename', TRUE),
				'marker_icon' => $this->input->post('markerIcon', TRUE),
				'api_key' => $this->input->post('apiKey', TRUE),
				'tab_title' => $this->input->post('tabTitle', TRUE),
				'default_zoom' => $this->input->post('defaultZoom', TRUE),
				'default_map_id' => $this->input->post('defaultMapId', TRUE),
				'default_map_type' => $this->input->post('defaultMapType', TRUE),
				'events' => $this->input->post('events', TRUE),
				'deals' => $this->input->post('deals', TRUE),
				'default_send_from_name' => $this->input->post('default_email_from_name', TRUE),
				'default_send_from_email' => $this->input->post('default_email_from_address', TRUE),
				'default_lat' => $this->input->post('defaultLat', TRUE),
				'default_lng' => $this->input->post('defaultLng', TRUE),
				'activationkey' => $this->input->post('activationKey', TRUE)
			);

			return TRUE;
		}else{
			return validation_errors();
		}
	}#end validation function

	/**
	 * processConfig()
	 *
	 * process the new configuration settings
	 */
	public function processconfig(){
		$validationErrors = $this->validateForm();

		if ($validationErrors != 1){
			/** add( message, type[success|error], echo[default|false] ) */
			$r[] = array(
				'message' => 'Unable to edit the config due to validation errors',
				'type' => 'error',
				'flashdata' => TRUE
			);
			$this->message->add(200, $r);
			redirect( $_SERVER['HTTP_REFERER'] );
		}else{

			/**
			 * submit the configs to the database.
			 *
			 * @param {array} array of configs, passed from validation
			 * @param {boolean} errorCallBack error call back flag, if set to true it will return any errors relating to database
			 */

			if ( $this->mapConfig->editConfig($this->mapItConfig, TRUE) ){
				/** add( message, type[success|error], echo[default|false] ) */
				$r[] = array(
					'message' => 'Successfully edited the configuration',
					'type' => 'success'
				);
				$this->message->add(200, $r);
				redirect( 'admin/index' );
			}else{
				/** add( message, type[success|error], echo[default|false] ) */
				$r[] = array(
					'message' => 'There was an error editing the configuration, please contact a system administrator',
					'type' => 'error',
					'flashdata' => TRUE
				);
				$this->message->add(200, $r);
				redirect( $_SERVER['HTTP_REFERER'] );
			}
		}
	}

	public function processstyle(){
		$this->styles['body_text_color'] =                                            $this->input->post('body-text-color');
		$this->styles['body_link_color'] =                                            $this->input->post('body-link-color');
		$this->styles['body_link_hover_color'] =                                      $this->input->post('body-link-hover-color');
		$this->styles['toolbar_text_color'] =                                         $this->input->post('toolbar-text-color');
		$this->styles['toolbar_bottom_border_color'] =                                $this->input->post('toolbar-bottom-border-color');
		$this->styles['toolbar_background_color'] =                                   $this->input->post('toolbar-background-color');
		$this->styles['toolbar_background_gradient_color_start'] =                    $this->input->post('toolbar-background-gradient-color-start');
		$this->styles['toolbar_background_gradient_color_end'] =                      $this->input->post('toolbar-background-gradient-color-end');
		$this->styles['toolbar_right_border_color'] =                                 $this->input->post('toolbar-right-border-color');
		$this->styles['toolbar_link_color'] =                                         $this->input->post('toolbar-link-color');
		$this->styles['toolbar_link_hover_color'] =                                   $this->input->post('toolbar-link-hover-color');
		$this->styles['popup_container_level_2_border_background_color'] =            $this->input->post('popup-container-level-2-border-background-color');
		$this->styles['popup_container_level_3_border_background_color'] =            $this->input->post('popup-container-level-3-border-background-color');
		$this->styles['popup_container_level_4_border_background_color'] =            $this->input->post('popup-container-level-4-border-background-color');
		$this->styles['right_sidebar_title_text_color'] =                             $this->input->post('right-sidebar-title-text-color');
		$this->styles['right_sidebar_title_background_color'] =                       $this->input->post('right-sidebar-title-background-color');
		$this->styles['right_sidebar_title_background_gradient_color_start'] =        $this->input->post('right-sidebar-title-background-gradient-color-start');
		$this->styles['right_sidebar_title_background_gradient_color_end'] =          $this->input->post('right-sidebar-title-background-gradient-color-end');
		$this->styles['right_sidebar_section_background_color'] =                     $this->input->post('right-sidebar-section-background-color');
		$this->styles['right_sidebar_section_border_color'] =                         $this->input->post('right-sidebar-section-border-color');
		$this->styles['right_sidebar_alternating_row_background_color'] =             $this->input->post('right-sidebar-alternating-row-background-color');
		$this->styles['right_sidebar_company_name_link_color'] =                      $this->input->post('right-sidebar-company-name-link-color');
		$this->styles['right_sidebar_contact_name_link_color'] =                      $this->input->post('right-sidebar-contact-name-link-color');
		$this->styles['left_sidebar_background_color'] =                              $this->input->post('left-sidebar-background-color');
		$this->styles['left_sidebar_right_border_color'] =                            $this->input->post('left-sidebar-right-border-color');
		$this->styles['left_sidebar_button_background'] =                             $this->input->post('left-sidebar-button-background');
		$this->styles['left_sidebar_button_border_color'] =                           $this->input->post('left-sidebar-button-border-color');
		$this->styles['left_sidebar_button_text_color'] =                             $this->input->post('left-sidebar-button-text-color');
		$this->styles['left_sidebar_search_field_border_color'] =                     $this->input->post('left-sidebar-search-field-border-color');
		$this->styles['left_sidebar_autocomplete_background_color'] =                 $this->input->post('left-sidebar-autocomplete-background-color');
		$this->styles['left_sidebar_autocomplete_border_color'] =                     $this->input->post('left-sidebar-autocomplete-border-color');
		$this->styles['left_sidebar_autocomplete_alternating_row_background_color'] = $this->input->post('left-sidebar-autocomplete-alternating-row-background-color');
		$this->styles['left_sidebar_autocomplete_background_hover_color'] =           $this->input->post('left-sidebar-autocomplete-background-hover-color');
		$this->styles['left_sidebar_browse_by_category_border_color'] =               $this->input->post('left-sidebar-browse-by-category-border-color');
		$this->styles['left_sidebar_submit_reset_text_color'] =                       $this->input->post('left-sidebar-submit/reset-text-color');
		$this->styles['left_sidebar_reset_background_color'] =                        $this->input->post('left-sidebar-reset-background-color');
		$this->styles['left_sidebar_reset_border_color'] =                            $this->input->post('left-sidebar-reset-border-color');
		$this->styles['left_sidebar_submit_background_color'] =                       $this->input->post('left-sidebar-submit-background-color');
		$this->styles['left_sidebar_submit_background_gradient_color_start'] =        $this->input->post('left-sidebar-submit-background-gradient-color-start');
		$this->styles['left_sidebar_submit_background_gradient_color_end'] =          $this->input->post('left-sidebar-submit-background-gradient-color-end');
		$this->styles['left_sidebar_submit_border_color'] =                           $this->input->post('left-sidebar-submit-border-color');

		$file = file_get_contents('assets/frontend/css/user/frontend-user-test_template.css');
		$new  = str_replace("%version%" ,'1.0' ,$file);
		foreach ($this->styles as $k => $v){
			print_r("%$k% -> $v<br>");
			$new  = str_replace("%$k%" ,$v ,$new);
		}
		$handle = fopen('assets/frontend/css/user/frontend-user.css' ,'w+');
		// Chmod the file, in case the user forgot
		@chmod('assets/frontend/css/user/frontend-user.css',0777);

		// Verify file permissions
		if( is_writable('assets/frontend/css/user/frontend-user.css') ) {

			// Write the file
			if(fwrite($handle,$new)) {
				return true;
			} else {
				return false;
			}

		} else {
			return false;
		}
	}
} #end class