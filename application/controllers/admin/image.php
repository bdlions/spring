<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Image extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper(array('form', 'url'));
        $this->load->library('org/admin/Admin_image_library');
        $this->load->library('org/utility/Image_utils');
        if (!$this->ion_auth->logged_in()) {
            redirect('admin/auth/login', 'refresh');
        }
    }
    
    public function index()
    {
        
    }
    
    public function logos()
    {
        $this->data['logo_list'] = $this->admin_image_model->get_all_logos()->result_array();
        $this->template->load(NULL, "admin/image/logo/index", $this->data);
    }
    
    public function create_logo()
    {
        if($this->input->post())
        {
            $result = array();
            if (isset($_FILES["userfile"])) {
                $file_info = $_FILES["userfile"];
                $result = $this->image_utils->upload_image($file_info, IMAGE_UPLOAD_PATH);
                $path = IMAGE_UPLOAD_PATH.$result['upload_data']['file_name'];
                $logo_type_id = $this->input->post('logo_type_list');
                if($logo_type_id == LOGO_TYPE_ID_HEADER)
                {
                    //Right now we are not resizing header logo                    
                    //$this->image_utils->resize_image($path, $path, LOGO_HEADER_HEIGHT, LOGO_HEADER_WIDTH);
                }
                else if($logo_type_id == LOGO_TYPE_ID_FOOTER)
                {
                    //Right now we are not resizing footer logo   
                    //$this->image_utils->resize_image($path, $path, LOGO_FOOTER_HEIGHT, LOGO_FOOTER_WIDTH);
                }
                $additional_data = array(
                    'img' => $result['upload_data']['file_name'],
                    'type_id' => $logo_type_id
                );
                $id = $this->admin_image_library->create_logo($additional_data);
                if($id !== FALSE)
                {               
                    $result['message'] = 'Image is stored successfully.';
                }
                else
                {
                    $result['message'] = 'Error while uploading image.';
                }                
            }
            else
            {
                $result['message'] = 'Please select an image.';
            }
            echo json_encode($result);
            return;
        }
        $logo_type_list = array();
        $logo_types_array = $this->admin_image_library->get_all_logo_types()->result_array();
        foreach($logo_types_array as $logo_type_info)
        {
            $logo_type_list[$logo_type_info['logo_type_id']] = $logo_type_info['title'];
        }
        $this->data['logo_type_list'] = $logo_type_list;
        $this->template->load(NULL, "admin/image/logo/create_logo", $this->data);
    }
    
    public function delete_logo()
    {
        $logo_id = $this->input->post('logo_id');
        $this->admin_image_library->delete_logo($logo_id);
        $response = array(
            'message' => 'Image is deleted successfully.'
        );
        echo json_encode($response);
    }
    
    
    //--------------- Gallery Images Module -------------------//
    public function show_all_gallery_images()
    {
        $gallery_image_list = $this->admin_image_model->get_all_gallery_images()->result_array();
        $this->data['gallery_image_list'] = $gallery_image_list;
        $this->template->load(NULL, "admin/image/gallery/index", $this->data);
    }
    
    public function create_gallery_image()
    {
        if($this->input->post())
        {
            $result = array();
            if (isset($_FILES["userfile"])) {
                $file_info = $_FILES["userfile"];
                $result = $this->image_utils->upload_image($file_info, IMAGE_UPLOAD_PATH);
                $path = IMAGE_UPLOAD_PATH.$result['upload_data']['file_name'];
                $this->image_utils->resize_image($path, $path, GALLERY_IMAGE_HEIGHT, GALLERY_IMAGE_WIDTH);
                 $additional_data = array(
                        'img' => $result['upload_data']['file_name']
                    );
                $id = $this->admin_image_library->create_gallery_image($additional_data);
                if($id !== FALSE)
                {               
                    $result['message'] = 'Image is stored successfully.';
                }
                else
                {
                    $result['message'] = 'Error while uploading image.';
                }                
            }
            else
            {
                $result['message'] = 'Please select an image.';
            }
            echo json_encode($result);
            return;
        }
        $this->template->load(NULL, "admin/image/gallery/create_image");
    }
    
    public function delete_gallery_image()
    {
        $image_id = $this->input->post('image_id');
        $this->admin_image_library->delete_gallery_image($image_id);
        $response = array(
            'message' => 'Image is deleted successfully.'
        );
        echo json_encode($response);
    }
}