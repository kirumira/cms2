<?php
class Document extends CI_Model {
    var $table = 'documents';
    var $document_path;

	function __construct() 
    {
    	parent::__construct();
        $this->document_path = realpath(APPPATH.'../documents');
    }
    function Add($options = array()){
        $this->db->insert($this->table, $options);
        return $this->db->insert_id();
    }
    function Update($options = array()){
        if(!$this->_required(array('documents_id'), $options)){   
            return FALSE;
        }
        if(isset($options['documents_title']))
            $this->db->set('documents_title',$options['documents_title']);
        if(isset($options['documents_path']))
            $this->db->set('documents_path',$options['documents_path']);
        if(isset($options['documents_project_id']))
            $this->db->set('documents_project_id',$options['documents_project_id']);
        
        $this->db->update($this->table);
        return $this->db->affected_rows();    
    }
    function do_upload(){
        $config = array(
            'allowed_types' => 'jpg|jpeg|gif|png|pdf|doc|docx|rtf',
            'upload_path' => $this->document_path
        );
        $this->load->library('upload',$config);
        $this->upload->do_upload();
    }
    function Get($options = array()){
        if(isset($options['documents_id']))
            $this->db->where('documents_id',$options['documents_id']);
        if(isset($options['documents_title']))
            $this->db->where('documents_title',$options['documents_title']);
        if(isset($options['documents_path']))
            $this->db->where('documents_path',$options['documents_path']);
        if(isset($options['documents_project_id']))
            $this->db->where('documents_project_id',$options['documents_project_id']);
        $query = $this->db->get($this->table);
        return $query->result_array();
    }
    function Delete($options = array()){}
    
    function _SetDefaults($defaults, $options){
        return array_merge($defaults, $options);
    }
    
    function _required($required, $data){
        foreach($requird as $field){
            if(!isset($data[$field])){
                return FALSE;
            }
        }
        return TRUE;
    }
    
}