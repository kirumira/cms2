<?php

class Floor extends CI_Model {

    var $table = 'floors';
    var $table1 = 'rooms';

    function __construct() {
        parent::__construct();

    }
    function add_num_rms($options=array()){
        
        $this->db->insert($this->table, $options);
        return $this->db->insert_id();
    }
    function get_floor($options=array()){
        $this->db->select('*');
        $this->db->from($this->table1);
        $this->db->group_by('floor');
        $query = $this->db->get();
        return $query->result_array();
    }
    function _SetDefaults($defaults, $options){
        return array_merge($defaults, $options);
    }

    function _required($required, $data){
        foreach($required as $field){
            if(!isset($data[$field])){
                return FALSE;
            }
        }
        return TRUE;
    }


}
?>

