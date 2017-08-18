<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class File_utils {
    public function __construct() {
        
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
    
    public function upload_file($file_info, $uploaded_path) {
        $result = array();
        if (isset($file_info)) {
            $config['upload_path'] = $uploaded_path;
            $config['allowed_types'] = 'pdf|txt';
            $config['max_size'] = '10240';
            
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $result['status'] = 0;
                $result['message'] = $this->upload->display_errors();
            } else {
                $upload_data = $this->upload->data();
                $result['status'] = 1;
                $result['message'] = 'File is uploaded successfully';
                $result['upload_data'] = $upload_data;
            }
        }
        return $result;
    }


}