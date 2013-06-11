<?php

class Floor extends CI_Model {

    var $table = 'floors';
    var $table1 = 'rooms';

    function __construct() {
        parent::__construct();
    }

    function add_num_rms($options = array()) {
        $this->db->insert($this->table, $options);
        return $this->db->insert_id();
    }

    function add_floors($options = array()) {
        $this->db->insert($this->table, $options);
        return $this->db->insert_id();
    }

    function get_floor_rooms($options = array()) {
        $this->db->select('*');
        $this->db->from($this->table1);
        if (isset($options['rooms_b_id']))
            $this->db->where('rooms_b_id', $options['rooms_b_id']);
        if (isset($options['rm_id']))
            $this->db->where('rm_id', $options['rm_id']);
        if (isset($options['floor']))
            $this->db->where('floor', $options['floor']);
        $this->db->group_by('floor');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_floor_id($options = array()) {
        $this->db->select('f_id, flr, flr_name, n_rms');
        // $this->db->where('b_id', $options['b_id']);
        $this->db->where('f_id', $options['f_id']);
        $query = $this->db->get('floors');
        return $query->result_array();
    }

    function update_floor($options = array()) {
        if (isset($options['n_rms']))
            $this->db->set('n_rms', $options['n_rms']);
        if (isset($options['f_name']))
            $this->db->set('flr_name', $options['f_name']);
        if (isset($options['f_rms']))
            $this->db->set('n_rms', $options['f_rms']);
        $this->db->where('f_id', $options['f_id']);
        $this->db->update('floors');
    }

    function get_total_rms($options = array()) {
        $this->db->select('SUM(n_rms) as subtotal');
        $this->db->where('b_id', $options['building_id']);
        $query = $this->db->get('floors');
        return $query->result_array();
    }

    function get_total_rms2($options = array()) {
        $this->db->select('SUM(n_rms) as subtotal');
        $this->db->where('b_id', $options['building_id']);
        $query = $this->db->get('floors');
        $x = $query->result_array();
        return $x[0]['subtotal'];
    }

    function get_all_floors() {
        $b_id = $this->session->userdata('building_id');
        $this->db->where('b_id', $b_id);
        $this->db->select('flr_name,f_id');
        return $this->db->get('floors')->result_array();
    }

    function get_fl_name($n) {
        $b_id = $this->session->userdata('building_id');
        $this->db->select('flr_name');
        $where = array('b_id' => $b_id, 'flr' => $n);
        $q = $this->db->get_where('floors', $where)->result_array();
        return $q[0]['flr_name'];
    }
    function get_flr_path($n){
        $b_id = $this->session->userdata('building_id');
        $this->db->select('flr_plan');
        $where = array('b_id' => $b_id, 'flr' => $n);
        $q = $this->db->get_where('floors', $where)->result_array();
        return $q[0]['flr_plan'];
    }

    function get_floor_summary($options = array()) {
        $this->db->select('f_id');
        $this->db->from('floors');
        if (isset($options['b_id']))
            $this->db->where('b_id', $options['b_id']);
//        $this->db->group_by('floor');
        $query = $this->db->get();
        return $query->result_array();
    }

}