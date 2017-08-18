<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Page_model extends Ion_auth_model
{
    public function __construct() {
        parent::__construct();
    }
            
    public function get_all_logos()
    {
        return $this->db->select($this->tables['logos'].'.id as logo_id,'.$this->tables['logos'].'.*')
                ->from($this->tables['logos'])
                ->get();
    }
    
    public function get_all_addrsses()
    {
        return $this->db->select($this->tables['addresses'].'.id as address_id,'.$this->tables['addresses'].'.*')
                ->from($this->tables['addresses'])
                ->get();
    }
    
    public function get_all_menus()
    {
        $this->db->order_by('order', 'asc');
        return $this->db->select($this->tables['menus'].'.id as menu_id,'.$this->tables['menus'].'.*')
                ->from($this->tables['menus'])
                ->get();
    }
    
    public function get_menu_list()
    {
        $this->db->order_by('order', 'asc');
        return $this->db->select($this->tables['menus'].'.id as menu_id,'.$this->tables['menus'].'.*')
                ->from($this->tables['menus'])
                ->get();
    }
    
    public function get_submenu_list()
    {
        $this->db->order_by('order', 'asc');
        return $this->db->select($this->tables['submenus'].'.id as submenu_id,'.$this->tables['submenus'].'.*')
                ->from($this->tables['submenus'])
                ->get();
    }
    
    public function get_page_info($page_id)
    {
        $this->db->where($this->tables['pages'].'.id', $page_id);
        return $this->db->select($this->tables['pages'].'.id as page_id,'.$this->tables['pages'].'.*')
                ->from($this->tables['pages'])
                ->get();
    }
    
    public function get_page_image_list($page_id)
    {
        $this->db->where($this->tables['page_images'].'.page_id', $page_id);
        return $this->db->select($this->tables['page_images'].'.id as page_image_id,'.$this->tables['page_images'].'.*')
                ->from($this->tables['page_images'])
                ->get();
    }
    
    public function get_page_file_list($page_id)
    {
        $this->db->where($this->tables['page_files'].'.page_id', $page_id);
        return $this->db->select($this->tables['page_files'].'.id as page_file_id,'.$this->tables['page_files'].'.*')
                ->from($this->tables['page_files'])
                ->get();
    }
    
    public function get_all_submenus($menu_id)
    {
        $this->db->where('menu_id', $menu_id);
        $this->db->order_by('order', 'asc');
        return $this->db->select($this->tables['submenus'].'.id as submenu_id,'.$this->tables['submenus'].'.*')
                ->from($this->tables['submenus'])
                ->get();
    }
    
    /*public function get_page_info($submenu_id)
    {
        $this->db->where($this->tables['submenus'].'.id', $submenu_id);
        return $this->db->select($this->tables['menus'].'.id as menu_id,'.$this->tables['submenus'].'.id as submenu_id,'.$this->tables['pages'].'.id as page_id,'.$this->tables['pages'].'.title,'.$this->tables['pages'].'.img,'.$this->tables['pages'].'.description')
                ->from($this->tables['pages'])
                ->join($this->tables['submenus'], $this->tables['pages'] . '.submenu_id=' . $this->tables['submenus'] . '.id', 'left')
                ->join($this->tables['menus'], $this->tables['submenus'] . '.menu_id=' . $this->tables['menus'] . '.id', 'left')
                ->get();
    }*/
    
    public function create_feedback($additional_data)
    {
        $additional_data = $this->_filter_data($this->tables['feedbacks'], $additional_data);
        $this->db->insert($this->tables['feedbacks'], $additional_data);
        $id = $this->db->insert_id();
        return (isset($id)) ? $id : FALSE;
    }
}