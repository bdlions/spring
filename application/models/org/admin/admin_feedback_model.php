<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_feedback_model extends Ion_auth_model
{
    public function __construct() {
        parent::__construct();
    }
    
    public function get_all_feedbacks()
    {
        return $this->db->select($this->tables['feedbacks'].'.id as feedback_id,'.$this->tables['feedbacks'].'.*')
                ->from($this->tables['feedbacks'])
                ->get();
    }
    
    public function get_feedback_info($feedback_id)
    {
        $this->db->where('id', $feedback_id);
        return $this->db->select($this->tables['feedbacks'].'.id as feedback_id,'.$this->tables['feedbacks'].'.*')
                ->from($this->tables['feedbacks'])
                ->get();
    }
    
    public function delete_feedback($feedback_id)
    {
        $this->db->where('id',$feedback_id);
        $this->db->delete($this->tables['feedbacks']);
    }
    
    public function get_all_replies($feedback_id)
    {
        $this->db->where('feedback_id', $feedback_id);
        return $this->db->select($this->tables['replies'].'.id as reply_id,'.$this->tables['replies'].'.*')
                ->from($this->tables['replies'])
                ->get();
    }
    
    public function create_reply($data)
    {
        $additional_data = $this->_filter_data($this->tables['replies'], $data);
        $this->db->insert($this->tables['replies'], $additional_data);
        $id = $this->db->insert_id();
        return (isset($id)) ? $id : FALSE;
    }
}