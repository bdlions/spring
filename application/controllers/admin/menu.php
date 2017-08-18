<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Menu extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('org/admin/admin_menu_library');
        $this->load->library('org/admin/admin_page_library');
        if (!$this->ion_auth->logged_in()) {
            redirect('admin/auth/login', 'refresh');
        }
    }

    public function index() {


        $this->data['menu_list'] = $this->admin_menu_library->get_all_menus()->result_array();
        $this->template->load(NULL, "admin/menu/index", $this->data);
    }

    /*
     * This method will create menu item
     */

    public function create_menu() {
        $this->data['message'] = '';
        $this->form_validation->set_error_delimiters("<div style='color:red'>", '</div>');
        $this->form_validation->set_rules('title', 'Title', 'xss_clean|required');
        
        if ($this->input->post('submit_create_menu')) {
            if($this->form_validation->run() == true)
            {
                $additional_data = array(
                    'title' => $this->input->post('title'),
                    'order' => $this->input->post('order'),
                );
                $page_id = $this->input->post('page_list');
                if($page_id > 0)
                {
                    $additional_data['page_id'] = $page_id;
                }
                $menu_id = $this->admin_menu_library->create_menu($additional_data);
                if($menu_id !== FALSE)
                {
                    $this->data['message'] = "Menu is created successfully.";
                }
                else
                {
                    $this->data['message'] = 'Error while creating a menu.';
                }
            }
            else
            {
                $this->data['message'] = validation_errors();
            }            
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
        $this->data['order'] = array(
            'id' => 'order',
            'name' => 'order',
            'type' => 'text',
        );
        $this->data['submit_create_menu'] = array(
            'id' => 'submit_create_menu',
            'name' => 'submit_create_menu',
            'type' => 'submit',
            'value' => 'create',
        );
        $this->template->load(NULL, "admin/menu/create_menu", $this->data);
    }

    /*
     * This method will update menu item
     */

    public function update_menu($menu_id) {
        
        $this->data['message'] = '';
        $this->form_validation->set_error_delimiters("<div style='color:red'>", '</div>');
        $this->form_validation->set_rules('title', 'Title', 'xss_clean|required');
        if ($this->input->post('submit_update_menu')) {
            if($this->form_validation->run() == true)
            {
                $additional_data = array(
                    'title' => $this->input->post('title'),
                    'order' => $this->input->post('order'),
                );
                $page_id = $this->input->post('page_list');
                if($page_id > 0)
                {
                    $additional_data['page_id'] = $page_id;
                }
                else
                {
                    $additional_data['page_id'] = null;
                }
                if($this->admin_menu_library->update_menu($menu_id, $additional_data))
                {
                    $this->data['message'] = "Menu is updated successfully.";
                }
                else
                {
                    $this->data['message'] = 'Error while updating a menu.';
                }
            }
            else
            {
                $this->data['message'] = validation_errors();
            }            
        }
        $menu_info = array();
        $menu_info_array = $this->admin_menu_library->get_menu($menu_id)->result_array();
        if(!empty($menu_info_array))
        {
            $menu = $menu_info_array[0];
        }
        $this->data['menu'] = $menu;
        $page_list = array();
        $page_array = $this->admin_page_library->get_page_list()->result_array();
        foreach($page_array as $page_info)
        {
            $page_list[$page_info['id']] = $page_info['title'];
        }
        $this->data['page_list'] = $page_list;
        $this->data['title'] = array(
            'name' => 'title',
            'id' => 'title',
            'type' => 'text',
            'value' => $menu['title'],
        );  
        $this->data['order'] = array(
            'name' => 'order',
            'id' => 'order',
            'type' => 'text',
            'value' => $menu['order'],
        );
        $this->data['submit_update_menu'] = array(
            'id' => 'submit_update_menu',
            'name' => 'submit_update_menu',
            'type' => 'submit',
            'value' => 'Update',
        );
        $this->template->load(NULL, "admin/menu/update_menu", $this->data);
    }

    /*
     * Ajax call to delete menu item
     * This method will delete a menu item
     */

    public function delete_menu() {
        $result = array();
        $menu_id = $this->input->post('menu_id');
        if($this->admin_menu_library->delete_menu($menu_id))
        {
            $result['message'] = "Menu is deleted successfully.";
        }
        else
        {
            $result['message'] = "Error while deleting menu.";
        }
        echo json_encode($result);
    }

}
