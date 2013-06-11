<?php
class Message extends CI_Model {
    var $table = 'messages';

    function __construct(){
        parent::__construct();
    }

    function add($options=array()){
        $this->db->insert($this->table, $options);
        return $this->db->insert_id();
    }
    function get_messages($options=array()){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('rooms', 'messages.m_rmid = rooms.rm_id', 'LEFT');
        $this->db->join('buildings', 'messages.m_bid = buildings.b_id', 'LEFT');
        if(isset($options['building_id']))
            $this->db->where('m_bid',$options['building_id']);
        if(isset($options['tenant_id']))
            $this->db->where('tenant_id', $options['tenant_id']);
        if(isset($options['rm_id']))
            $this->db->where('m_rmid', $options['rm_id']);
        if(isset($options['floor_id']))
            $this->db->where('m_fid', $options['floor_id']);
        $query = $this->db->get();
        return$query->result_array();
    }
}