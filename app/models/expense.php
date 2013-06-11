<?php

class Expense extends CI_Model {

    var $table = 'expenses';
    var $table1 = 'e_details';

    function __construct() {
        parent::__construct();
    }

    function Add($options = array()) {
        $this->db->insert($this->table, $options);
        return $this->db->insert_id();
    }

    function Add_exp($options = array()) {
        $this->db->insert($this->table1, $options);
        return $this->db->insert_id();
    }

    function Update($options = array()) {
        if (isset($options['e_code']))
            $this->db->set('e_code', $options['e_code']);
        if (isset($options['description']))
            $this->db->set('description', $options['description']);
        if (isset($options['name_user']))
            $this->db->set('name_user', $options['name_user']);
        if (isset($options['name_password']))
            $this->db->set('name_password', $options['name_password']);
        if (isset($options['e_code']))
            $this->db->where('e_code', $options['e_code1']);
        $this->db->update($this->table);
        return $this->db->affected_rows();
    }

    function Get($options = array()) {
        $this->db->select('*');
        if (isset($options['e_code']))
            $this->db->where('e_code', $options['e_code']);
        if (isset($options['name_user']))
            $this->db->where('name_user', $options['name_user']);
        if (isset($options['name_password']))
            $this->db->where('name_password', $options['name_password']);
        $query = $this->db->get($this->table);

        return $query->result_array();
    }

    function Get2($options = array()) {
        $this->db->select('*');
        $this->db->from($this->table1);
        $this->db->join('buildings', 'buildings.b_id = e_details.e_b_id');
        $this->db->join('expenses', 'expenses.e_code= e_details.e_code');
        $query = $this->db->get();
      
        return $query->result_array();
    }

    function Login($vals = array()) {
        $arrayd = array('name_first' => $vals[0]['name_first'],
            'name_last' => $vals[0]['name_last'],
            'name_id' => $vals[0]['name_id'],
            'name_group' => $vals[0]['manager_group'],
            'name_user' => $vals[0]['name_user'],
            'is_logged_in' => TRUE);
        $ci = & get_instance();
        $ci->session->set_userdata($arrayd);
        //$this->session->set_userdata($arrayd);
        //$ci->session->set_userdata("admin", $user[0]["admin"]);
        return true;
    }

    function GetAll($options = array()) {
        $this->db->select('*');
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result_array();
    }

    function GetUserTypes() {
        $query = $this->db->get('user_types');
        return $query->result_array();
    }

    function Delete($options = array()) {
        if (isset($options['e_code']))
            $this->db->where('e_code', $options['e_code']);
        $this->db->delete($this->table);
    }

    function _SetDefaults($defaults, $options) {
        return array_merge($defaults, $options);
    }

    function _required($required, $data) {
        foreach ($requird as $field) {
            if (!isset($data[$field])) {
                return FALSE;
            }
        }
        return TRUE;
    }

}