<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Submenu extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('org/admin/admin_menu_library');
        $this->load->library('org/admin/admin_submenu_library');
        $this->load->library('org/admin/admin_page_library');
        if (!$this->ion_auth->logged_in()) {
            redirect('admin/auth/login', 'refresh');
        }
    }

    /*
     * This method will show all submenu items
     */

    public function index() {
        $this->data['submenu_list'] = $this->admin_submenu_library->get_all_submenus()->result_array();
        $this->template->load(NULL, "admin/submenu/index", $this->data);
    }

    /*
     * This method will create submenu item
     */

    public function create_submenu() {
        $this->data['message'] = '';
        $this->form_validation->set_error_delimiters("<div style='color:red'>", '</div>');
        $this->form_validation->set_rules('title', 'Title', 'xss_clean|required');

        if ($this->input->post('submit_create_submenu')) {
            if ($this->form_validation->run() == true) {
                $additional_data = array(
                    'title' => $this->input->post('title'),
                    'order' => $this->input->post('order'),
                );
                $mune_id = $this->input->post('menu_list');
                if($mune_id > 0)
                {
                    $additional_data['menu_id'] = $mune_id;
                }
                $page_id = $this->input->post('page_list');
                if($page_id > 0)
                {
                    $additional_data['page_id'] = $page_id;
                }
                $submenu_id = $this->admin_submenu_library->create_submenu($additional_data);
                if ($submenu_id !== FALSE) {
                    $this->data['message'] = "SubMenu is created successfully.";
                } else {
                    $this->data['message'] = 'Error while creating a SubMenu.';
                }
            } else {
                $this->data['message'] = validation_errors();
            }
        }
        $menu_list = array();
        $menu_array = $this->admin_menu_library->get_all_menus()->result_array();
        foreach($menu_array as $menu_info)
        {
            $menu_list[$menu_info['menu_id']] = $menu_info['title'];
        }
        $this->data['menu_list'] = $menu_list;
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
        $this->data['menu_id'] = array(
            'id' => 'menu_id',
            'name' => 'menu_id',
            'type' => 'int',
        );
        $this->data['order'] = array(
            'id' => 'order',
            'name' => 'order',
            'type' => 'text',
        );

        $this->data['submit_create_submenu'] = array(
            'id' => 'submit_create_submenu',
            'name' => 'submit_create_submenu',
            'type' => 'submit',
            'value' => 'create',
        );
        $this->template->load(NULL, "admin/submenu/create_submenu", $this->data);
    }

    public function update_submenu($id = 0) {
       $this->data['message'] = '';
        $this->form_validation->set_error_delimiters("<div style='color:red'>", '</div>');
        $this->form_validation->set_rules('title', 'Title', 'xss_clean|required');
        if ($this->input->post('submit_update_submenu')) {
            if($this->form_validation->run() == true)
            {
                $additional_data = array(
                    'title' => $this->input->post('title'),
                    'order' => $this->input->post('order'),
                );
                $mune_id = $this->input->post('menu_list');
                if($mune_id > 0)
                {
                    $additional_data['menu_id'] = $mune_id;
                }
                else
                {
                    $additional_data['menu_id'] = null;
                }
                $page_id = $this->input->post('page_list');
                if($page_id > 0)
                {
                    $additional_data['page_id'] = $page_id;
                }
                else
                {
                    $additional_data['page_id'] = null;
                }
                if($this->admin_submenu_library->update_submenu($id, $additional_data))
                {
                    $this->data['message'] = "SubMenu is updated successfully.";
                }
                else
                {
                    $this->data['message'] = 'Error while updating the SubMenu.';
                }
            }
            else
            {
                $this->data['message'] = validation_errors();
            }            
        }
        $menu_list = array();
        $menu_array = $this->admin_menu_library->get_all_menus()->result_array();
        foreach($menu_array as $menu_info)
        {
            $menu_list[$menu_info['menu_id']] = $menu_info['title'];
        }
        $this->data['menu_list'] = $menu_list;
        $submenu = array();
        $submenu_info_array = $this->admin_submenu_library->get_submenu($id)->result_array();
        if(!empty($submenu_info_array))
        {
            $submenu = $submenu_info_array[0];
        }
        $this->data['submenu'] = $submenu;
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
            'value' => $submenu['title'],
        ); 
        $this->data['menu_id'] = array(
            'name' => 'menu_id',
            'id' => 'menu_id',
            'type' => 'int',
            'value' => $submenu['menu_id'],
        ); 
        
        $this->data['order'] = array(
            'name' => 'order',
            'id' => 'order',
            'type' => 'text',
            'value' => $submenu['order'],
        );
        $this->data['submit_update_submenu'] = array(
            'id' => 'submit_update_submenu',
            'name' => 'submit_update_submenu',
            'type' => 'submit',
            'value' => 'Update',
        );
        $this->template->load(NULL, "admin/submenu/update_submenu", $this->data);  
    }

    /*
     * Ajax call to delete menu item
     * This method will delete a menu item
     */

  public function delete_submenu() {
      $result = array();
        $id = $this->input->post('id');
        if($this->admin_submenu_library->delete_submenu($id))
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
