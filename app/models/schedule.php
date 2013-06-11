<?php
class Schedule extends CI_Model {

    var $table1 = 'schedules';

    function __construct() {
        parent::__construct();
    }
    function Add($options=array()){
        $this->db->insert($this->table1, $options);
        return $this->db->insert_id();
    }
    function get($options=array()){
        $this->db->select('s_id, s_ten_id, s_rm_id, schedules.s_date, s_amount, s_num, s_cleared, s_paid, s_color, f_name, l_name, email, room_name');
        $this->db->from($this->table1);
        $this->db->join('tenants', 'schedules.s_ten_id = tenants.id', 'LEFT');
        $this->db->join('rooms', 'schedules.s_rm_id = rooms.rm_id', 'LEFT');
        //$this->db->join('evictions', 'rooms.rm_id = evictions.ev_rm_id', 'LEFT');
        if(isset($options['rm_id']))
            $this->db->where('s_rm_id',$options['rm_id']);
        if(isset($options['rooms_b_id']))
            $this->db->where('rooms_b_id',$options['rooms_b_id']);
        if(isset($options['ten_id']))
            $this->db->where('s_ten_id',$options['ten_id']);
        if(isset($options['status']))
            $this->db->where('s_paid',$options['status']);
        if(isset($options['b_id']))
            $this->db->where('rooms_b_id',$options['b_id']);
        if(isset($options['s_id']))
            $this->db->where('s_id',$options['s_id']);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    function get_installment($options=array()){
        $this->db->select('*');
        $this->db->join('tenants', 'schedules.s_ten_id = tenants.id', 'LEFT');
        $this->db->where('s_id', $options['s_id']);
        $query = $this->db->get($this->table1);
        return $query->result_array();
    }
    function update_credit($options=array()){
        if (isset($options['credit']))
            $this->db->set('credit', ($options['credit'] + $options['credit2']));
        if (isset($options['tenant_id']))
            $this->db->where('tenant_id', $options['tenant_id']);
        if (isset($options['rm_id']))
            $this->db->where('rm_id', $options['rm_id']);
        $this->db->update('rooms');
        return $this->db->affected_rows();
    }
    function get_room_credit($options=array()){
        $this->db->select('credit');
        $this->db->where('rm_id', $options['rm_id']);
        $query = $this->db->get('rooms');
        return $query->result_array();
    }
    function pay($options=array()){
        if(isset($options['s_paid']))
            $this->db->set('s_paid', $options['s_paid']);
        $this->db->set('s_color', $options['s_color']);
        $this->db->set('s_cleared', $options['s_cleared']);
        $this->db->where('s_id', $options['s_id']);
        $this->db->update($this->table1);
        return $this->db->affected_rows();
    }
    function get_due_schedules($options=array()){
        $this->db->select('s_id, s_date, s_amount, s_num, s_cleared');
        $this->db->where('s_rm_id', $options['rm_id']);
        $this->db->where('s_paid', 'DUE');
        $query = $this->db->get('schedules');
        return $query->result_array();
    }
    function get_pending($options=array()){
        $this->db->select('*');
        $this->db->from('schedules');
        $this->db->where('s_date', date('Y-m-d'));
        return $this->db->count_all_results();
    }
    function get_due($options=array()){
        $this->db->select('*');
        $this->db->from('schedules');
        $this->db->where('s_date >', $options['start_date']);
        $this->db->where('s_date <', $options['end_date']);
        if(isset($options['due']))
            $this->db->where('s_paid', $options['due']);
        return $this->db->count_all_results();
    }

}
?>
