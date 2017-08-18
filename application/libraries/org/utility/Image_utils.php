<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Image_utils {
    public function __construct() {
        $this->load->library('image_lib');
    }

    /**
     * __get
     * Enables the use of CI super-global without having to define an extra variable.
     * @access	public
     * @param	$var
     * @return	mixed
     */
    public function __get($var) {
        return get_instance()->$var;
    }
    
    public function upload_image($file_info, $uploaded_path) {
        $result = array();
        if (isset($file_info)) {
            $config['image_library'] = 'gd2';
            $config['upload_path'] = $uploaded_path;
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '10240';
            $config['maintain_ratio'] = FALSE;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $result['status'] = 0;
                $result['message'] = $this->upload->display_errors();
            } else {
                $upload_data = $this->upload->data();
                $result['status'] = 1;
                $result['message'] = 'Image is uploaded successfully';
                $result['upload_data'] = $upload_data;
            }
        }
        return $result;
    }
    
    public function resize_image($source_path, $new_path, $height, $width) {
        $result = array();
        $config = array(
            'image_library' => 'gd2',
            'source_image' => FCPATH.$source_path,
            'new_image' => FCPATH.$new_path,
            'maintain_ratio' => FALSE,
            'overwrite' => TRUE,
            'height' => $height,
            'width' => $width
        );
        $image_absolute_path = FCPATH.dirname($new_path);
        if( !is_dir($image_absolute_path) )
        {
            mkdir($image_absolute_path, 0777, TRUE);
        }
        $this->image_lib->clear();
        $this->image_lib->initialize($config);
        if (!$this->image_lib->resize()){
            $result['status'] = 0;
            $result['message'] = $this->image_lib->display_errors();
        }
        else
        {
            $result['status'] = 1;
        }
        return $result;
    }
    
    public function delete_image($relative_path)
    {
        $absolute_path = FCPATH.$relative_path;
        if(file_exists($absolute_path)) {
            unlink($absolute_path);
            return TRUE;
        } else {
            return FALSE;
        }
    }
}