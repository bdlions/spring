<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_image_model extends Ion_auth_model
{
    public function __construct() {
        parent::__construct();
    }
    
    //------------------- Home Page Gallery Images Module ----------------------//
    public function get_all_gallery_images()
    {
        return $this->db->select($this->tables['gallery_images'].'.id as gallery_image_id,'.$this->tables['gallery_images'].'.*')
                ->from($this->tables['gallery_images'])
                ->get();
    }
    
    public function create_gallery_image($additional_data)
    {
        $data = $this->_filter_data($this->tables['gallery_images'], $additional_data);
        $this->db->insert($this->tables['gallery_images'], $data);
        $id = $this->db->insert_id();
        return (isset($id)) ? $id : FALSE;
    }
    
    public function delete_gallery_image($image_id)
    {
        $this->db->where('id',$image_id);
        $this->db->delete($this->tables['gallery_images']);
    }
    
    // ------------------- Logo Module ------------------------------//
    public function get_all_logo_types()
    {
        return $this->db->select($this->tables['logo_types'].'.id as logo_type_id,'.$this->tables['logo_types'].'.*')
                ->from($this->tables['logo_types'])
                ->get();
    }
    public function get_all_logos()
    {
        return $this->db->select($this->tables['logos'].'.id as logo_id,'.$this->tables['logos'].'.*')
                ->from($this->tables['logos'])
                ->get();
    }
    
    public function create_logo($additional_data)
    {
        $data = $this->_filter_data($this->tables['logos'], $additional_data);
        $this->db->insert($this->tables['logos'], $data);
        $id = $this->db->insert_id();
        return (isset($id)) ? $id : FALSE;
    }
    
    public function delete_logo($logo_id)
    {
        $this->db->where('id',$logo_id);
        $this->db->delete($this->tables['logos']);
    }
}