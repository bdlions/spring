<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Page extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('org/admin/admin_page_library');
        //$this->load->library('org/admin/admin_submenu_library');
        $this->load->library('org/utility/Image_utils');
        $this->load->library('org/utility/File_utils');
        if (!$this->ion_auth->logged_in()) {
            redirect('admin/auth/login', 'refresh');
        }
    }

    /*
     * This method will show all page list
     */
    public function index() {
        $this->data['page_list'] = $this->admin_page_library->get_page_list()->result_array();
        $this->template->load(NULL, "admin/page/index", $this->data);
    }

    /*
     * This method will create page
     */
    public function create_page() {

        $this->data['message'] = '';
        $this->form_validation->set_error_delimiters("<div style='color:red'>", '</div>');
        $this->form_validation->set_rules('title', 'Title', 'xss_clean|required');

        if ($this->input->post()) {
            $result = array();
            if ($this->form_validation->run() == true) {
                $additional_data = array(
                    'title' => $this->input->post('title'),
                    'description' => htmlentities($this->input->post('description_editortext')),
                );
                $page_id = $this->admin_page_library->create_page($additional_data);
                if ($page_id !== FALSE) {
                    $result['message'] = "Page is created successfully.";
                } else {
                    $result['message'] = 'Error while creating a page.';
                }
            } else {
                $result['message'] = validation_errors();
            }
            echo json_encode($result);
            return;
        }
        $this->data['title'] = array(
            'id' => 'title',
            'name' => 'title',
            'type' => 'text',
        );
        $this->data['description'] = array(
            'id' => 'description',
            'name' => 'description',
            'type' => 'text',
            'value' => $this->form_validation->set_value('description'),
            'rows' => '4',
            'cols' => '10'
        );

        $this->data['submit_create_page'] = array(
            'id' => 'submit_create_page',
            'name' => 'submit_create_page',
            'type' => 'submit',
            'value' => 'create',
        );
        $this->template->load(NULL, "admin/page/create_page", $this->data);
    }

    /*
     * This method will update page
     */
    public function update_page($id = 0) {
        $this->data['message'] = '';
        $this->form_validation->set_error_delimiters("<div style='color:red'>", '</div>');
        $this->form_validation->set_rules('title', 'Title', 'xss_clean|required');
        if ($this->input->post()) {
            $result = array();
            if ($this->form_validation->run() == true) {
                $additional_data = array(
                    'title' => $this->input->post('title'),
                    'description' => htmlentities($this->input->post('description_editortext')),
                );
                if ($this->admin_page_library->update_page($id, $additional_data)) {
                    $result['message'] = "Page is updated successfully.";
                } else {
                    $result['message'] = 'Error while updating the page.';
                }
            } else {
                $result['message'] = validation_errors();
            }
            echo json_encode($result);
            return;    
        }
        $page = array();
        $page_info_array = $this->admin_page_library->get_page($id)->result_array();
        if (!empty($page_info_array)) {
            $page = $page_info_array[0];
        }
        $this->data['page'] = $page ;
        $this->data['title'] = array(
            'name' => 'title',
            'id' => 'title',
            'type' => 'text',
            'value' => $page['title'],
        );
        $this->data['description'] = array(
            'id' => 'description',
            'name' => 'description',
            'type' => 'text',
            'value' => html_entity_decode(html_entity_decode($page['description'])),
            'rows' => '4',
            'cols' => '10'
        );


        $this->data['submit_update_page'] = array(
            'id' => 'submit_update_page',
            'name' => 'submit_update_page',
            'type' => 'submit',
            'value' => 'Update',
        );
        $this->template->load(NULL, "admin/page/update_page", $this->data);
    }
    
    /*
     * Ajax call to delete page
     * This method will delete a page
     */
    public function delete_page() {
        $result = array();
        $id = $this->input->post('id');
     
        if($this->admin_page_library->delete_page($id))
        {
            $result['message'] = "Page is deleted successfully.";
        }
        else
        {
            $result['message'] = "Error while deleting page.";
        }
        echo json_encode($result);   
    }
    
    //-------------------------Page Images Module----------------------------//
    //show all page images
    public function images() 
    {
        $this->data['page_image_list'] = $this->admin_page_library->get_all_page_images()->result_array();
        $this->template->load(NULL, "admin/page/image/index", $this->data);
    }
    //create page image
    public function create_page_image() {

        $this->data['message'] = '';
        $this->form_validation->set_error_delimiters("<div style='color:red'>", '</div>');
        
        if ($this->input->post()) {
            $result = array();
            //if page_id is zero then show an error message. -------------------
                $page_id = $this->input->post('page_list');
                if($page_id == 0)
                {
                    $result['message'] = "Please select a page.";
                    echo json_encode($result);
                    return;
                }
                $additional_data = array(
                    'page_id' => $page_id
                );
                if (isset($_FILES["userfile"])) {
                    $file_info = $_FILES["userfile"];
                    $result = $this->image_utils->upload_image($file_info, IMAGE_UPLOAD_PATH);
                    $path = IMAGE_UPLOAD_PATH.$result['upload_data']['file_name'];
                    $this->image_utils->resize_image($path, $path, PAGE_IMAGE_HEIGHT, PAGE_IMAGE_WIDTH);
                    $additional_data['img'] = $result['upload_data']['file_name'];                                  
                }
                $page_id = $this->admin_page_library->create_page_image($additional_data);
                if ($page_id !== FALSE) {
                    $result['message'] = "Page image is added successfully.";
                } else {
                    $result['message'] = 'Error while adding page image. Please try again later.';
                }
            echo json_encode($result);
            return;
        }
        $page_list = array();
        $page_array = $this->admin_page_library->get_page_list()->result_array();
        foreach($page_array as $page_info)
        {
            $page_list[$page_info['id']] = $page_info['title'];
        }
        $this->data['page_list'] = $page_list;
        $this->data['title'] = array(
            'id' => 'title',
            'name' => 'title',
            'type' => 'text',
        );
        $this->data['description'] = array(
            'id' => 'description',
            'name' => 'description',
            'type' => 'text',
            'value' => $this->form_validation->set_value('description'),
            'rows' => '4',
            'cols' => '10'
        );

        $this->data['submit_create_page'] = array(
            'id' => 'submit_create_page',
            'name' => 'submit_create_page',
            'type' => 'submit',
            'value' => 'create',
        );
        $this->template->load(NULL, "admin/page/image/create_image", $this->data);
    }
    
    //delete page image
    public function delete_page_image() {
        $result = array();
        $id = $this->input->post('id');     
        if($this->admin_page_library->delete_page_image($id))
        {
            $result['message'] = "Page image is deleted successfully.";
        }
        else
        {
            $result['message'] = "Error while deleting page image.";
        }
        echo json_encode($result);   
    }
    
    //-------------------------Page File Module--------------------------------------//
    public function files()
    {
        $this->data['page_file_list'] = $this->admin_page_library->get_all_page_files()->result_array();
        $this->template->load(NULL, "admin/page/file/index", $this->data);
    }
    //create page image
    public function create_page_file() {

        $this->data['message'] = '';
        $this->form_validation->set_error_delimiters("<div style='color:red'>", '</div>');
        
        if ($this->input->post()) {
            $result = array();
            //if page_id is zero then show an error message. -------------------
                $page_id = $this->input->post('page_list');
                if($page_id == 0)
                {
                    $result['message'] = "Please select a page.";
                    echo json_encode($result);
                    return;
                }
                $additional_data = array(
                    'page_id' => $page_id
                );
                if (isset($_FILES["userfile"])) {
                    $file_info = $_FILES["userfile"];
                    $result = $this->file_utils->upload_file($file_info, FILE_UPLOAD_PATH);
                    $additional_data['name'] = $result['upload_data']['file_name'];                                  
                }
                $page_file_id = $this->admin_page_library->create_page_file($additional_data);
                if ($page_file_id !== FALSE) {
                    $result['message'] = "Page file is added successfully.";
                } else {
                    $result['message'] = 'Error while adding page file. Please try again later.';
                }
            echo json_encode($result);
            return;
        }
        $page_list = array();
        $page_array = $this->admin_page_library->get_page_list()->result_array();
        foreach($page_array as $page_info)
        {
            $page_list[$page_info['id']] = $page_info['title'];
        }
        $this->data['page_list'] = $page_list;
        $this->data['title'] = array(
            'id' => 'title',
            'name' => 'title',
            'type' => 'text',
        );
        $this->data['description'] = array(
            'id' => 'description',
            'name' => 'description',
            'type' => 'text',
            'value' => $this->form_validation->set_value('description'),
            'rows' => '4',
            'cols' => '10'
        );

        $this->data['submit_create_page'] = array(
            'id' => 'submit_create_page',
            'name' => 'submit_create_page',
            'type' => 'submit',
            'value' => 'create',
        );
        $this->template->load(NULL, "admin/page/file/create_file", $this->data);
    }
    
    /*
     * Ajax call to delete page file
     * This method will delete a page file
     */
    public function delete_page_file() {
        $result = array();
        $id = $this->input->post('id');
     
        if($this->admin_page_library->delete_page_file($id))
        {
            $result['message'] = "Page is file deleted successfully.";
        }
        else
        {
            $result['message'] = "Error while deleting page file.";
        }
        echo json_encode($result);   
    }
}
