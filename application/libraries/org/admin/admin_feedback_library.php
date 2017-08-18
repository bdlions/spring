<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_feedback_library {
    public function __construct() {
        $this->load->config('ion_auth', TRUE);
        $this->load->library('email');
        // Load IonAuth MongoDB model if it's set to use MongoDB,
        // We assign the model object to "ion_auth_model" variable.
        $this->config->item('use_mongodb', 'ion_auth') ?
                        $this->load->model('ion_auth_mongodb_model', 'ion_auth_model') :
                        $this->load->model('org/admin/admin_feedback_model');

        $this->admin_feedback_model->trigger_events('library_constructor');
    }

    /**
     * __call
     *
     * Acts as a simple way to call model methods without loads of stupid alias'
     *
     * */
    public function __call($method, $arguments) {
        if (!method_exists($this->admin_feedback_model, $method)) {
            throw new Exception('Undefined method ::' . $method . '() called in admin_feedback_model');
        }

        return call_user_func_array(array($this->admin_feedback_model, $method), $arguments);
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
    
    public function create_reply($feedback_id, $reply)
    {
        $data = array(
            'feedback_id' => $feedback_id,
            'description' => $reply
        );
        $reply_id = $this->admin_feedback_model->create_reply($data);
        
        //send email if configuration is enabled
        if (!$this->config->item('use_feedback_email', 'ion_auth')) 
        {
            return $reply_id;
        } 
        else 
        {
            $feedback_info_array = $this->admin_feedback_model->get_feedback_info($feedback_id)->result_array();
            if(!empty($feedback_info_array))
            {
                $feedback_info = $feedback_info_array[0];
                
                $message = $reply;
                $this->email->clear();
                $this->email->from($this->config->item('feedback_email', 'ion_auth'), $this->config->item('site_title', 'ion_auth'));
                $this->email->to($feedback_info['email']);
                $this->email->subject($this->config->item('feedback_subject', 'ion_auth'));
                $this->email->message($message);

                if ($this->email->send() == TRUE) {
                    return $reply_id;
                }
                else
                {
                    return FALSE;
                }
            }            
        }
        return $reply_id;
    }
}