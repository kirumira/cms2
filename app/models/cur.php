<?php

class Cur extends CI_Model {

    var $table1 = 'currency';
    var $table2 = 'records';
    var $table3 = 'edit_currency';
    var $table4 = 'edit_umeme';

    function __construct() {
        parent::__construct();
    }

    function Add($options = array()) {
        $this->db->insert($this->table1, $options);
        return $this->db->insert_id();
    }

    function Add_Umeme($options = array()) {
        $this->db->insert('umeme', $options);
        return $this->db->insert_id();
    }

    function Add_edit($options = array()) {
        $this->db->insert($this->table3, $options);
        return $this->db->insert_id();
    }
    
    function Add_uedit($options = array()) {
        $this->db->insert($this->table4, $options);
        return $this->db->insert_id();
    }

    function get_cur() {
        $query = $this->db->query('SELECT * FROM `currency`');
        return $query->result_array();
    }

    function get_cur2() {
        $this->db->select('*');
        $this->db->from('currency');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_report() {
        $this->db->select('*');
        $this->db->from($this->table3);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    function get_ureport() {
        $this->db->select('*');
        $this->db->from($this->table4);
        $this->db->where('u_edit_b_id', $this->session->userdata("building_id"));
        $query = $this->db->get();
        return $query->result_array();
    }

    function Delete($options = array()) {
        if (isset($options['id']))
            $this->db->where('id', $options['id']);
        $this->db->delete($this->table1);
    }

    function edit($options = array()) {
        if (isset($options['currency']))
            $this->db->set('currency', $options['currency']);
        if (isset($options['rate']))
            $this->db->set('rate', $options['rate']);
        $this->db->where('id', $options['id']);
        $this->db->update('currency');
        return $this->db->affected_rows();
    }

    function get($options = array()) {
        $this->db->select('*');
        $this->db->from($this->table1);
        if (isset($options['currency']))
            $this->db->where('currency', $options['currency']);
        if (isset($options['id']))
            $this->db->where('id', $options['id']);
        $query = $this->db->get();
        return $query->result_array();
    }

    function update_cur($options = array()) {
        if (isset($options['currency']))
            $this->db->set('currency', $options['currency']);
        if (isset($options['rate']))
            $this->db->set('rate', $options['rate']);
        $this->db->where('currency', $options['currency']);
        $this->db->update($this->table1);
    }

    function check_cur($options = array()) {
        $this->db->select('*');
        if (isset($options['currency']))
            $this->db->where('currency', $options['currency']);
        $query = $this->db->get($this->table1);
        return $query->result_array();
    }

    function get_total($options = array()) {
        //echo "NO!".date('Y-m-d', strtotime($options['d_receipt']));
        $this->db->select('SUM(pay_amount) as tpay, SUM(vat) as tvat');
        $this->db->join('rooms', 'rooms.rm_id = records.records_rm_id', 'LEFT');
        $this->db->where('records.bill_amount', '0');
        if (isset($options['rooms_b_id']))
            $this->db->where('rooms.rooms_b_id', $options['rooms_b_id']);
        if (isset($options['d_receipt']))
            $this->db->like('records.d_receipt', date('Y-m-d', strtotime($options['d_receipt'])));
        $this->db->not_like('particulars','UMEME');
//            $this->db->where('records.d_receipt', $options['d_receipt']);
        $query = $this->db->get('records');
        RETURN ($query->result_array());
    }
    function get_umeme_total($options = array()) {
        //echo "NO!".date('Y-m-d', strtotime($options['d_receipt']));
        $this->db->select('SUM(pay_amount) as tpay');
        $this->db->join('rooms', 'rooms.rm_id = records.records_rm_id', 'LEFT');
        $this->db->where('records.bill_amount', '0');
        if (isset($options['rooms_b_id']))
            $this->db->where('rooms.rooms_b_id', $options['rooms_b_id']);
        if (isset($options['d_receipt']))
            $this->db->like('records.d_receipt', date('Y-m-d', strtotime($options['d_receipt'])));
        $this->db->where('particulars','UMEME');
//            $this->db->where('records.d_receipt', $options['d_receipt']);
        $query = $this->db->get('records');
        RETURN ($query->result_array());
    }
}