<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Page_library {
    public function __construct() {
        // Load IonAuth MongoDB model if it's set to use MongoDB,
        // We assign the model object to "ion_auth_model" variable.
        $this->config->item('use_mongodb', 'ion_auth') ?
                        $this->load->model('ion_auth_mongodb_model', 'ion_auth_model') :
                        $this->load->model('org/user/page_model');

        $this->page_model->trigger_events('library_constructor');
    }

    /**
     * __call
     *
     * Acts as a simple way to call model methods without loads of stupid alias'
     *
     * */
    public function __call($method, $arguments) {
        if (!method_exists($this->page_model, $method)) {
            throw new Exception('Undefined method ::' . $method . '() called in page_model');
        }

        return call_user_func_array(array($this->page_model, $method), $arguments);
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
    
    public function get_menu_submenu_list()
    {
        $menu_submenu_list = array();
        $menu_array = $this->page_model->get_menu_list()->result_array();
        $submenu_array = $this->page_model->get_submenu_list()->result_array();
        foreach($menu_array as $menu_info)
        {
            $menu = array(
                'menu_id' => $menu_info['menu_id'],
                'title' => $menu_info['title'],
                'page_id' => $menu_info['page_id'],
                'submenu_list' => array()
            );
            $menu_submenu_list[$menu_info['menu_id']] = $menu;
        }
        foreach($submenu_array as $submenu_info)
        {
            $submenu = array(
                'submenu_id' => $submenu_info['submenu_id'],
                'title' => $submenu_info['title'],
                'page_id' => $submenu_info['page_id']
            );
            if(array_key_exists($submenu_info['menu_id'], $menu_submenu_list) && array_key_exists('submenu_list', $menu_submenu_list[$submenu_info['menu_id']]))
            {
                $menu_submenu_list[$submenu_info['menu_id']]['submenu_list'][] = $submenu;
            }            
        }
        return $menu_submenu_list;
    }
    
    public function get_page_details($page_id)
    {
        $page_info = array();
        $page_info_array = $this->page_model->get_page_info($page_id)->result_array();
        $page_image_list_array = $this->page_model->get_page_image_list($page_id)->result_array();
        $page_file_list_array = $this->page_model->get_page_file_list($page_id)->result_array();
        if(!empty($page_info_array))
        {
            $page_info = $page_info_array[0];
            $page_info['description'] = html_entity_decode(html_entity_decode($page_info['description']));
            $page_info['image_list'] = array();
            foreach($page_image_list_array as $page_image_info)
            {
                $page_info['image_list'][] = $page_image_info['img'];
            }
            $page_info['file_list'] = array();
            foreach($page_file_list_array as $page_file_info)
            {
                $page_info['file_list'][] = $page_file_info;
            }
        }
        return $page_info;
    }
}