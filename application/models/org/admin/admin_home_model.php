<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_home_model extends Ion_auth_model
{
    public function __construct() {
        parent::__construct();
    }
    // -------------- Home page info module ------------------------//
    public function get_home_page_info()
    {
        return $this->db->select($this->tables['home_page_info'].'.id as home_page_info_id,'.$this->tables['home_page_info'].'.*')
                ->from($this->tables['home_page_info'])
                ->get();
    }
    
    public function update_home_page_info($home_page_info_id, $additional_data)
    {
        $data = $this->_filter_data($this->tables['home_page_info'], $additional_data);
        $this->db->where('id', $home_page_info_id);
        $this->db->update($this->tables['home_page_info'], $data);
//        if ($this->db->affected_rows() == 0) {
//            return FALSE;
//        }
        return TRUE;
    }
    
    //--------------- Homa page links module ----------------//
    public function get_all_links()
    {
        return $this->db->select($this->tables['links'].'.id as id,'.$this->tables['links'].'.*')
                ->from($this->tables['links'])
                ->get();
    }
    
    public function create_link($additional_data)
    {
        $data = $this->_filter_data($this->tables['links'], $additional_data);
        $this->db->insert($this->tables['links'], $data);
        $id = $this->db->insert_id();
        return (isset($id)) ? $id : FALSE;   
    }
    
    public function get_link_info($link_id)
    {
        $this->db->where('id',$link_id);
        return $this->db->select($this->tables['links'].'.id as link_id,'.$this->tables['links'].'.*')
                ->from($this->tables['links'])
                ->get();
    }
    
    public function update_link($link_id, $additional_data)
    {
        $data = $this->_filter_data($this->tables['links'], $additional_data);
        $this->db->where('id', $link_id);
        $this->db->update($this->tables['links'], $data);
//        if ($this->db->affected_rows() == 0) {
//            return FALSE;
//        }
        return TRUE;
    }
    
    public function delete_link($link_id)
    {
        $this->db->where('id',$link_id);
        $this->db->delete($this->tables['links']);
    }
    
    // ------------------------- Address Module -----------------------//
    public function get_all_addresses()
    {
         return $this->db->select($this->tables['addresses'].'.id as address_id,'.$this->tables['addresses'].'.*')
                ->from($this->tables['addresses'])
                ->get();
    }
    
    public function update_address($address_id, $additional_data)
    {
        $data = $this->_filter_data($this->tables['addresses'], $additional_data);
        $this->db->where('id', $address_id);
        $this->db->update($this->tables['addresses'], $data);
//        if ($this->db->affected_rows() == 0) {
//            return FALSE;
//        }
        return TRUE; 
    }
}