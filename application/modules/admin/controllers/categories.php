<?php
/**
* Levels Class For Administration Backend
*/
class Categories extends ADMIN_Controller{
	
	function __construct(){
		parent::__construct();
		
	} #end constructor function

	/**
	 * lists all of the categories in a 
	 * data table view. Allows for access
	 * to a category for edits, or direct 
	 * deletion of a category.
	 * 
	 * @author Mike DeVita <mdevita@mapitusa.com>
	 * @copyright 2012 MapIt USA
	 */
	public function index(){
		$this->template
			->title('View Categories')
			->set_breadcrumb('View Categoires', '/admin/categories/index')
			->append_metadata(" var oTable = $('#view-categories-table').dataTable({ 'aaSorting': [[1, 'asc']] });")
			->build('admin/categories/index', $this->data);
	}
	/**
	 * Displays a form for editing a 
	 * categories name, this pulls data
	 * from the database based on the ID
	 * passed to it.
	 * 
	 * @param  integer $id id number of a category
	 * @author Mike DeVita <mdevita@mapitusa.com>
	 * @copyright 2012 MapIt USA
	 */
	public function edit($id = FALSE){
		if (!$id){
			$r[] = array(
				'message' => 'No Categories Selected',
				'type' => 'error'
			);
			$this->message->add(400, $r);
		}else{
			$this->data['category'] = $this->mapCategories->getCategory($id);
			$this->template
				 ->title('Edit Category')
				 ->set_breadcrumb('View Categories', '/admin/categories/index')
				 ->set_breadcrumb('Edit Category', '/admin/categories/edit/'.$id.'.html')

				 ->build('admin/categories/edit', $this->data);
		}
	}
	public function processEdit($id){
		$validationErrors = self::_validateForm();
		if ($validationErrors != 1){
			$r[] = array(
				'message' => 'Unable to edit the category due to name validation errors',
				'type' => 'error',
				'flashdata' => TRUE
			);
			$this->message->add(400, $r);
			redirect( $_SERVER['HTTP_REFERER'] );
		}else{
			$this->categoryName = strtoupper($this->categoryName);
			if ( $this->mapCategories->edit( array('id' => $id, 'category_name' => $this->categoryName) ) ){
				$r[] = array(
					'message' => 'Successfully Edited The Category',
					'type' => 'success'
					'flashdata' => TRUE
				);
				$this->message->add(200, $r);
				redirect( 'admin/categories/index' );
			}else{
				$r[] = array(
					'message' => 'Unable to edit the category due to a system error',
					'type' => 'error'
					'flashdata' => TRUE
				);
				$this->message->add(400, $r);
				redirect( $_SERVER['HTTP_REFERER'] );
			}

		}
	}
	public function add(){
		$this->template
			 ->title('Add Category')
			 ->set_breadcrumb('View Categories', '/admin/categories/index')
			 ->set_breadcrumb('Add Category', '/admin/categories/add')

			 ->build('admin/categories/add', $this->data);
	}
	public function ProcessAdd(){
		$validationErrors = self::_validateForm();
		if ($validationErrors != 1){
			$r[] = array(
				'message' => 'Unable to add the category due to name validation errors',
				'type' => 'error',
				'flashdata' => TRUE
			);
			$this->message->add(400, $r);
			redirect( $_SERVER['HTTP_REFERER'] );
		}else{
			$this->categoryName = strtoupper($this->categoryName);
			$catAdd = array(
				'category_name' => $this->categoryName,
				'category_type' => $this->categoryType
			);
			if ( $this->mapCategories->insert($catAdd) ){
				$r[] = array(
					'message' => 'Successfully Added The Category',
					'type' => 'success',
					'flashdata' => TRUE
				);
				$this->message->add(200, $r);
				redirect( 'admin/categories/index' );
			}else{
				$r[] = array(
					'message' => 'Unable to add the category due to a system error',
					'type' => 'error',
					'flashdata' => TRUE
				);
				$this->message->add(400, $r);
				redirect( $_SERVER['HTTP_REFERER'] );
			}

		}
	}

	public function delete($id = FALSE){
		if ( $this->mapCategories->delete($id) ){
			$r[] = array(
				'message' => 'Successfully Deleted The Category',
				'type' => 'success'
			);
			$this->message->add(200, $r);
		}else{
			$r[] = array(
				'message' => 'Unable to delete the category, contact a system adiministrator',
				'type' => 'error'
			);
			$this->message->add(400, $r);
		}

	}
	private function _validateForm(){
		$this->form_validation->set_rules('category', 'Category Name', 'required|xss_clean');

		if ($this->form_validation->run()){
			if($this->data['mapConfig']->events == 1){
				$this->categoryType = $this->input->post('categoryType', TRUE);
			}else{
				$this->categoryType = 'default';
			}
			$this->categoryName = $this->input->post('category', TRUE);
			return TRUE;
		}else{
			return validation_errors();
		}
	}
}