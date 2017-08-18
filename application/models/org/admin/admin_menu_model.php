<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_menu_model extends Ion_auth_model
{
    public function __construct() {
        parent::__construct();
    }
    
    public function menu_identity_check($identity = '') {
        
    }
    
    public function create_menu($additional_data)
    {
        $data = $this->_filter_data($this->tables['menus'], $additional_data);
        $this->db->insert($this->tables['menus'], $data);
        $id = $this->db->insert_id();
        return (isset($id)) ? $id : FALSE;
    }
    
    public function get_all_menus()
    {
        return $this->db->select($this->tables['menus'].'.id as menu_id,'.$this->tables['menus'].'.*')
                ->from($this->tables['menus'])
                ->get();
    }
    
    public function get_menu($menu_id)
    {
        $this->db->where($this->tables['menus'] . '.id', $menu_id);
        return $this->db->select($this->tables['menus'] . '.id as menu_id, '.$this->tables['menus'] . '.*')
                        ->from($this->tables['menus'])
                        ->get();
    }
    
    public function update_menu($menu_id, $additional_data)
    {
        $data = $this->_filter_data($this->tables['menus'], $additional_data);
        $this->db->where('id', $menu_id);
        $this->db->update($this->tables['menus'], $data);
        if ($this->db->affected_rows() == 0) {
            return FALSE;
        }
        return TRUE;
    }
    
    public function delete_menu($menu_id)
    {
        $this->db->where('id',$menu_id);
        $this->db->delete($this->tables['menus']);
    }
}