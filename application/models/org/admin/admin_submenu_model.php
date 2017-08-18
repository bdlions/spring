<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_submenu_model extends Ion_auth_model {

    public function __construct() {
        parent::__construct();
    }

    public function submenu_identity_check($identity = '') {
        
    }

    public function create_submenu($additional_data) {
        $additional_data = $this->_filter_data($this->tables['submenus'], $additional_data);
        $this->db->insert($this->tables['submenus'], $additional_data);
        $id = $this->db->insert_id();
        return (isset($id)) ? $id : FALSE;
    }

    public function get_all_submenus() {
        return $this->db->select($this->tables['menus'] . '.title as menu_title,' .$this->tables['submenus'] . '.id as submenu_id,' . $this->tables['submenus'] . '.*')
                        ->from($this->tables['submenus'])
                        ->join($this->tables['menus'], $this->tables['submenus'] . '.menu_id=' . $this->tables['menus'] . '.id', 'left')
                        ->get();
    }
    
    public function get_submenu($menu_id)
    {
        $this->db->where($this->tables['submenus'] . '.id', $menu_id);
        return $this->db->select($this->tables['submenus'] . '.id as submenu_id, '.$this->tables['submenus'] . '.*')
                        ->from($this->tables['submenus'])
                        ->get();
    }

    public function update_submenu($menu_id, $additional_data) 
                {
       $data = $this->_filter_data($this->tables['submenus'], $additional_data);
        $this->db->where('id', $menu_id);
        $this->db->update($this->tables['submenus'], $data);
        if ($this->db->affected_rows() == 0) {
            return FALSE;
        }
        return TRUE;
        
    }

   public function delete_submenu($submenu_id) {
        $this->db->where('id',$submenu_id);
       $this->db->delete($this->tables['submenus']);
   }

}
