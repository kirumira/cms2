<?php
class Audittrails extends CI_Model {
    var $tablename = 'audit_trail';

    function __construct() {
        parent::__construct();
    }
    function log_details($options=array()) {
        $x = $this->_SetDefaults(
            array('audit_username'=>$this->session->userdata('name_user'),
            'audit_userid'=>$this->session->userdata('name_id'),
            'audit_usertype'=>$this->session->userdata('name_group')),
            $options);
        if($this->_required($x, array('audit_username', 'audit_userid', 'audit_usertype', 'audit_action'))) {
            $audit_action = base64_encode($x['audit_action']);
        } else {
            $audit_action = 'Missing arguments.';
        }
        $this->db->insert($this->tablename, $x);
    }

    function view_details() {
        $temp = $this->session->userdata('name_group');
        if(isset($temp)) {
            if($this->session->userdata('name_group') == 1) {
                $this->db->select('*');
                $this->db->from($this->tablename);
                $this->db->order_by("audit_date", "desc");
                $query = $this->db->get();
                return $query->result_array();
            } else {
                $this->db->select('*');
                $this->db->from($this->tablename);
                $this->db->where('audit_userid', $this->session->userdata('name_id'));
                $this->db->order_by("audit_date", "desc");
                $query = $this->db->get();
                return $query->result_array();
            }
        }
    }

    function _required($required, $data) {
        foreach($required as $field) {
            if(!isset($data[$field])) {
                return FALSE;
            }
        }
        return TRUE;
    }
    function _SetDefaults($defaults, $options) {
        return array_merge($defaults, $options);
    }
}
