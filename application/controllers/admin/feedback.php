<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feedback extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('org/admin/admin_feedback_library');
        if (!$this->ion_auth->logged_in()) {
            redirect('admin/auth/login', 'refresh');
        }
    }
    
    public function index()
    {
        $this->data['feedback_list'] = $this->admin_feedback_model->get_all_feedbacks()->result_array();
        $this->template->load(NULL, "admin/feedback/index", $this->data);
    }
    
    public function show_feedback($feedback_id)
    {
        $feedback_info = array();
        $feedback_info_array = $this->admin_feedback_model->get_feedback_info($feedback_id)->result_array();
        if(!empty($feedback_info_array))
        {
            $feedback_info = $feedback_info_array[0];
        }
        $this->data['feedback_info'] = $feedback_info;
        $this->template->load(NULL, "admin/feedback/show_feedback", $this->data);
    }
    
    public function delete_feedback()
    {
        $result = array();
        $feedback_id = $this->input->post('feedback_id');
        if($this->admin_feedback_model->delete_feedback($feedback_id))
        {
            $result['message'] = "Feedback is deleted successfully.";
        }
        else
        {
            $result['message'] = "Error while deleting feedback.";
        }
        echo json_encode($result);
    }
    
    public function show_replies($feedback_id)
    {
        $reply_list = $this->admin_feedback_model->get_all_replies($feedback_id)->result_array();
        $this->data['reply_list'] = $reply_list;
        $this->template->load(NULL, "admin/feedback/show_replies", $this->data);
    }
    
    public function create_reply($feedback_id)
    {
        $this->data['message'] = '';
        $this->form_validation->set_error_delimiters("<div style='color:red'>", '</div>');
        $this->form_validation->set_rules('description', 'Description', 'xss_clean|required');
        
        if ($this->input->post('submit_create_reply')) {
            if($this->form_validation->run() == true)
            {
                $reply_id = $this->admin_feedback_library->create_reply($feedback_id, $this->input->post('description'));
                if($reply_id !== FALSE)
                {
                    $this->data['message'] = "Reply is sent successfully.";
                }
                else
                {
                    $this->data['message'] = 'Error while sending reply.';
                }
            }
            else
            {
                $this->data['message'] = validation_errors();
            }            
        }

        $this->data['description'] = array(
            'id' => 'description',
            'name' => 'description',
            'type' => 'text',
            'rows' => 4
        );
        
        $this->data['submit_create_reply'] = array(
            'id' => 'submit_create_reply',
            'name' => 'submit_create_reply',
            'type' => 'submit',
            'value' => 'Submit',
        );
        $this->data['feedback_id'] = $feedback_id;
        $this->template->load(NULL, "admin/feedback/create_reply", $this->data);
    }
}