<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_page_model extends Ion_auth_model
{
    public function __construct() {
        parent::__construct();
    }
            
    public function page_identity_check($identity = '') {
        
    }
    
    //--------------------Page module---------------------------//
    /*
     * this method will create a new page
     * @param additional_data page data
     * @return last inserted page id or boolean false based on success or fail
     * @author nazmul hasan on 18th aug 17
     */
    public function create_page($additional_data)
    {
        $data = $this->_filter_data($this->tables['pages'], $additional_data);
        $this->db->insert($this->tables['pages'], $data);
        $id = $this->db->insert_id();
        return (isset($id)) ? $id : FALSE;
    }
    
    /*
     * this method will return page list with id and title
     * @author nazmul hasan on 18th aug 17
     */
    public function get_page_list()
    { 
        return $this->db->select($this->tables['pages'].'.id, '.$this->tables['pages'].'.title')
                ->from($this->tables['pages'])
                ->order_by($this->tables['pages'] . '.title', 'asc')
                ->get();  
    }
    
    /*
     * this method will return page info
     * @param id, page id
     * @author nazmul hasan on 18th aug 17
     */
    public function get_page($id)
    {
        $this->db->where($this->tables['pages'] . '.id', $id);
        return $this->db->select($this->tables['pages'] . '.*')
                        ->from($this->tables['pages'])
                        ->get();
    }
    

    /*
     * this method will update page info
     * @param id, page id
     * @param additional_data, page data to be updated
     * @return boolean whether page is updated or not
     * @author nazmul hasan on 18th aug 17
     */
    public function update_page($id, $additional_data)
    {
        $data = $this->_filter_data($this->tables['pages'], $additional_data);
        $this->db->where('id', $id);
        $this->db->update($this->tables['pages'], $data);
        if ($this->db->affected_rows() == 0) {
            return FALSE;
        }
        return TRUE;
        
    }
    
    /*
     * this method will delete page
     * @param id, page id
     * @author nazmul hasan on 18th aug 17
     */
    public function delete_page($id)
    {
        $this->db->where('id',$id);
        $this->db->delete($this->tables['pages']);   
    }
    
    //-------------------------------------page image module ---------------------------------//
    /*
     * this method will create page image
     * @param additional_data page image data
     * @return last inserted page image id or boolean false based on success or fail
     * @author nazmul hasan on 18th aug 17
     */
    public function create_page_image($additional_data)
    {
        $data = $this->_filter_data($this->tables['page_images'], $additional_data);
        $this->db->insert($this->tables['page_images'], $data);
        $id = $this->db->insert_id();
        return (isset($id)) ? $id : FALSE;
    }
    
    /*
     * this method will return page images
     * @author nazmul hasan on 18th aug 17
     */
    public function get_all_page_images()
    {
        return $this->db->select($this->tables['page_images'] . '.*,' .$this->tables['pages'] . '.title')
                        ->from($this->tables['page_images'])
                        ->join($this->tables['pages'], $this->tables['page_images'] . '.page_id=' . $this->tables['pages'] . '.id')
                        ->order_by($this->tables['pages'] . '.title', 'asc')
                        ->get();
    }
    
    /*
     * this method will delete page image
     * @param id, page image id
     * @author nazmul hasan on 18th aug 17
     */
    public function delete_page_image($id)
    {
        $this->db->where('id',$id);
        $this->db->delete($this->tables['page_images']);   
    }
    //---------------------- Page File Module -----------------------------//
    /*
     * this method will create page file
     * @param additional_data page file data
     * @return last inserted page file id or boolean false based on success or fail
     * @author nazmul hasan on 18th aug 17
     */
    public function create_page_file($additional_data)
    {
        $data = $this->_filter_data($this->tables['page_files'], $additional_data);
        $this->db->insert($this->tables['page_files'], $data);
        $id = $this->db->insert_id();
        return (isset($id)) ? $id : FALSE;
    }
    
    /*
     * this method will return page files
     * @author nazmul hasan on 18th aug 17
     */
    public function get_all_page_files()
    {
        return $this->db->select($this->tables['page_files'] . '.*,' .$this->tables['pages'] . '.title')
                        ->from($this->tables['page_files'])
                        ->join($this->tables['pages'], $this->tables['page_files'] . '.page_id=' . $this->tables['pages'] . '.id')
                        ->order_by($this->tables['pages'] . '.title', 'asc')
                        ->get();
    }
    
    /*
     * this method will delete page file
     * @param id, page file id
     * @author nazmul hasan on 18th aug 17
     */
    public function delete_page_file($id)
    {
        $this->db->where('id',$id);
        $this->db->delete($this->tables['page_files']);   
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    //---------------------------------Other methods------------------------------------//
    //may be this method is not used anymore
    public function get_all_pages()
    { 
        return $this->db->select($this->tables['pages'].'.id as page_id, '.$this->tables['pages'].'.*')
                ->from($this->tables['pages'])
                ->get();  
    }
    

}