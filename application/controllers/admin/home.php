<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('org/admin/admin_home_library');
        $this->load->library('org/utility/Image_utils');
        $this->load->library('org/admin/admin_submenu_library');
        if (!$this->ion_auth->logged_in()) {
            redirect('admin/auth/login', 'refresh');
        }
    }
    // --------------------- Home page Info Module -------------------//
    public function index($home_page_info_id = 0)
    {
        $this->data['message'] = '';
        $this->form_validation->set_rules('gallery_image_text', 'Gallery Image Text', 'xss_clean|required');
        $this->form_validation->set_rules('title', 'Title', 'xss_clean|required');
        $this->form_validation->set_rules('description_editortext', 'Description', 'xss_clean|required');
        $this->form_validation->set_rules('links_title', 'Links Title', 'xss_clean|required');
        $this->form_validation->set_rules('footer_message', 'Footer Message', 'xss_clean|required');
        $this->form_validation->set_rules('copy_right', 'Copyright', 'xss_clean|required');
        
        if ($this->input->post()) {
            $result = array();
            if($this->form_validation->run() == true)
            {
                $additional_data = array(
                    'gallery_image_text' => $this->input->post('gallery_image_text'),
                    'title' => $this->input->post('title'),
                    'description' => htmlentities($this->input->post('description_editortext')),
                    'links_title' => $this->input->post('links_title'),
                    'footer_message' => $this->input->post('footer_message'),
                    'copy_right' => $this->input->post('copy_right')
                );
                if($this->admin_home_model->update_home_page_info($home_page_info_id, $additional_data))
                {
                    $result['message'] = "Home page info is updated successfully.";
                }
                else
                {
                    $result['message'] = 'Error while updating home page info.';
                }
            }
            else
            {
                $result['message'] = validation_errors();
            }  
            echo json_encode($result);
            return;
        }
        
        $home_page_info = array();
        $home_page_info_array = $this->admin_home_model->get_home_page_info()->result_array();
        if(!empty($home_page_info_array))
        {
            $home_page_info = $home_page_info_array[0];
        }
        $this->data['home_page_info'] = $home_page_info;
        
        $this->data['gallery_image_text'] = array(
            'id' => 'gallery_image_text',
            'name' => 'gallery_image_text',
            'type' => 'text',
            'value' => $home_page_info['gallery_image_text']
        );
        $this->data['title'] = array(
            'id' => 'title',
            'name' => 'title',
            'type' => 'text',
            'value' => $home_page_info['title']
        );
        $this->data['description'] = array(
            'id' => 'description',
            'name' => 'description',
            'type' => 'textarea',
            'rows' => 5,
            'value' => html_entity_decode(html_entity_decode($home_page_info['description']))
        );
        $this->data['links_title'] = array(
            'id' => 'links_title',
            'name' => 'links_title',
            'type' => 'text',
            'value' => $home_page_info['links_title']
        );
        $this->data['footer_message'] = array(
            'id' => 'footer_message',
            'name' => 'footer_message',
            'type' => 'text',
            'value' => $home_page_info['footer_message']
        );
        $this->data['copy_right'] = array(
            'id' => 'copy_right',
            'name' => 'copy_right',
            'type' => 'text',
            'value' => $home_page_info['copy_right']
        );
        $this->data['submit_update_home_page_info'] = array(
            'id' => 'submit_update_home_page_info',
            'name' => 'submit_update_home_page_info',
            'type' => 'submit',
            'value' => 'Update',
        );
        $this->template->load(NULL, "admin/home/home_page/index", $this->data);
    }
    
    // ---------------------- Link Module -------------------------//
    public function link()
    {
        $this->data['link_list'] = $this->admin_home_library->get_all_links()->result_array();
        $this->template->load(NULL, "admin/home/link/index", $this->data);
    }
    
    
    public function create_link()
    {
        $this->data['message'] = '';
        $this->form_validation->set_error_delimiters("<div style='color:red'>", '</div>');
        $this->form_validation->set_rules('title', 'Title', 'xss_clean|required');
        $this->form_validation->set_rules('summary', 'Summary', 'xss_clean|required');
        $this->form_validation->set_rules('submenu_list', 'Submenu', 'xss_clean|required');

        if ($this->input->post()) {
            $result = array();
            if ($this->form_validation->run() == true) {
                $additional_data = array(
                    'title' => $this->input->post('title'),
                    'summary' => htmlentities($this->input->post('summary')),
                    'link' => $this->input->post('submenu_list'),
                    'order' => $this->input->post('order'),
                );
                if (isset($_FILES["userfile"])) {
                    $file_info = $_FILES["userfile"];
                    $result = $this->image_utils->upload_image($file_info, IMAGE_UPLOAD_PATH);
                    $path = IMAGE_UPLOAD_PATH.$result['upload_data']['file_name'];
                    $this->image_utils->resize_image($path, $path, LINK_IMAGE_HEIGHT, LINK_IMAGE_WIDTH);
                    $additional_data['img'] = $result['upload_data']['file_name'];                                  
                }
                $id = $this->admin_home_library->create_link($additional_data);
                if ($id !== FALSE) {
                    $result['message'] = "Link is created successfully.";
                } else {
                    $result['message'] = 'Error while creating a link.';
                }
            } else {
                $result['message'] = validation_errors();
            }
            echo json_encode($result);
            return;
        }
        $submenu_list = array();
        $submenu_array = $this->admin_submenu_library->get_all_submenus()->result_array();
        foreach($submenu_array as $submenu_info)
        {
            $submenu_list[$submenu_info['submenu_id']] = $submenu_info['title'];
        }
        $this->data['submenu_list'] = $submenu_list;
        $this->data['title'] = array(
            'id' => 'title',
            'name' => 'title',
            'type' => 'text',
        );
        $this->data['summary'] = array(
            'id' => 'summary',
            'name' => 'summary',
            'type' => 'text',
            'value' => $this->form_validation->set_value('summary'),
            'rows' => '4',
            'cols' => '10'
        );
        $this->data['link'] = array(
            'id' => 'link',
            'name' => 'link',
            'type' => 'text',
        );
        $this->data['order'] = array(
            'id' => 'order',
            'name' => 'order',
            'type' => 'text',
        );
        $this->template->load(NULL, "admin/home/link/create_link", $this->data);
    }

    public function update_link($link_id = 0)
    {
        $this->data['message'] = '';
        $this->form_validation->set_rules('title', 'Title', 'xss_clean|required');
        $this->form_validation->set_rules('summary', 'Summary', 'xss_clean|required');
        $this->form_validation->set_rules('submenu_list', 'Submenu', 'xss_clean|required');
        
        if ($this->input->post()) {
            $result = array();
            if ($this->form_validation->run() == true) {
                $additional_data = array(
                    'title' => $this->input->post('title'),
                    'summary' => htmlentities($this->input->post('summary')),
                    'link' => $this->input->post('submenu_list'),
                    'order' => $this->input->post('order'),
                );
                if (isset($_FILES["userfile"])) {
                    $file_info = $_FILES["userfile"];
                    $result = $this->image_utils->upload_image($file_info, IMAGE_UPLOAD_PATH);
                    $path = IMAGE_UPLOAD_PATH.$result['upload_data']['file_name'];
                    $this->image_utils->resize_image($path, $path, LINK_IMAGE_HEIGHT, LINK_IMAGE_WIDTH);
                    $additional_data['img'] = $result['upload_data']['file_name'];                                  
                }
                if ($this->admin_home_library->update_link($link_id, $additional_data)) {
                    $result['message'] = "Link is updated successfully.";
                } else {
                    $result['message'] = 'Error while updating the link.';
                }
            } else {
                $result['message'] = validation_errors();
            }
            echo json_encode($result);
            return;
        }
        $submenu_list = array();
        $submenu_array = $this->admin_submenu_library->get_all_submenus()->result_array();
        foreach($submenu_array as $submenu_info)
        {
            $submenu_list[$submenu_info['submenu_id']] = $submenu_info['title'];
        }
        $this->data['submenu_list'] = $submenu_list;
        $link_info = array();
        $link_info_array = $this->admin_home_library->get_link_info($link_id)->result_array();
        if(!empty($link_info_array))
        {
            $link_info = $link_info_array[0];
        }
        $this->data['link_info'] = $link_info;
        $this->data['title'] = array(
            'id' => 'title',
            'name' => 'title',
            'type' => 'text',
            'value' => $link_info['title']
        );
        $this->data['summary'] = array(
            'id' => 'summary',
            'name' => 'summary',
            'type' => 'text',
            'value' => $link_info['summary'],
            'rows' => '4',
            'cols' => '10'
        );
        $this->data['link'] = array(
            'id' => 'link',
            'name' => 'link',
            'type' => 'text',
            'value' => $link_info['link']
        );
        $this->data['order'] = array(
            'id' => 'order',
            'name' => 'order',
            'type' => 'text',
            'value' => $link_info['order']
        );
        $this->template->load(NULL, "admin/home/link/update_link", $this->data);
    }
    
    public function delete_link()
    {
        $link_id = $this->input->post('link_id');
        $this->admin_home_library->delete_link($link_id);
        $response = array(
            'message' => 'Link is deleted successfully.'
        );
        echo json_encode($response);
    }
    
    // --------------------- Address Module ------------------------//
    
    public function address($address_id = 0)
    {
        $this->data['message'] = '';
        $this->form_validation->set_rules('title', 'Title', 'xss_clean|required');
        $this->form_validation->set_rules('street', 'Street', 'xss_clean|required');
        $this->form_validation->set_rules('city', 'City', 'xss_clean|required');
        $this->form_validation->set_rules('post_code', 'Post_code', 'xss_clean|required');
        $this->form_validation->set_rules('telephone', 'Telephone', 'xss_clean|required');
        //$this->form_validation->set_rules('fax', 'Fax', 'xss_clean|required');
        $this->form_validation->set_rules('email', 'Email', 'xss_clean|required');
        
        if ($this->input->post('submit_update_address')) {
            if($this->form_validation->run() == true)
            {
                $additional_data = array(
                    'title' => $this->input->post('title'),
                    'street' => $this->input->post('street'),
                    'city' => $this->input->post('city'),
                    'post_code' => $this->input->post('post_code'),    
                    'telephone' => $this->input->post('telephone'),    
                    'fax' => $this->input->post('fax'),    
                    'email' => $this->input->post('email'),    
                     
                );
                if($this->admin_home_model->update_address($address_id, $additional_data))
                {
                    $this->data['message'] = "Addresses is updated successfully.";
                }
                else
                {
                    $this->data['message'] = 'Error while updating Addresses info.';
                }
            }
            else
            {
                $this->data['message'] = validation_errors();
            }            
        }
        
        $address = array();
        $address_array = $this->admin_home_model->get_all_addresses()->result_array();
        if(!empty($address_array))
        {
            $address = $address_array[0];
        }
        $this->data['address'] = $address;
        
        $this->data['title'] = array(
            'id' => 'title',
            'name' => 'title',
            'type' => 'text',
            'value' => $address['title']
        );
        $this->data['street'] = array(
            'id' => 'street',
            'name' => 'street',
            'type' => 'text',
            'value' => $address['street']
        );
        
        $this->data['city'] = array(
            'id' => 'city',
            'name' => 'city',
            'type' => 'text',
            'value' => $address['city']
        );
        
        $this->data['post_code'] = array(
            'id' => 'post_code',
            'name' => 'post_code',
            'type' => 'text',
            'value' => $address['post_code']
        );
        
        $this->data['telephone'] = array(
            'id' => 'telephone',
            'name' => 'telephone',
            'type' => 'text',
            'value' => $address['telephone']
        );
        $this->data['fax'] = array(
            'id' => 'fax',
            'name' => 'fax',
            'type' => 'text',
            'value' => $address['fax']
        );
        $this->data['email'] = array(
            'id' => 'email',
            'name' => 'email',
            'type' => 'text',
            'value' => $address['email']
        );
        
        
        $this->data['submit_update_address'] = array(
            'id' => 'submit_update_address',
            'name' => 'submit_update_address',
            'type' => 'submit',
            'value' => 'Update',
        ); 
        
        $this->data['address_list'] = array();
        $this->template->load(NULL, "admin/home/address/index", $this->data);
    }
    
}