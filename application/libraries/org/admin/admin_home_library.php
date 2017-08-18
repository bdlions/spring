<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_home_library {
    public function __construct() {
        // Load IonAuth MongoDB model if it's set to use MongoDB,
        // We assign the model object to "ion_auth_model" variable.
        $this->config->item('use_mongodb', 'ion_auth') ?
                        $this->load->model('ion_auth_mongodb_model', 'ion_auth_model') :
                        $this->load->model('org/admin/admin_home_model');

        $this->admin_home_model->trigger_events('library_constructor');
    }

    /**
     * __call
     *
     * Acts as a simple way to call model methods without loads of stupid alias'
     *
     * */
    public function __call($method, $arguments) {
        if (!method_exists($this->admin_home_model, $method)) {
            throw new Exception('Undefined method ::' . $method . '() called in admin_home_model');
        }

        return call_user_func_array(array($this->admin_home_model, $method), $arguments);
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
}