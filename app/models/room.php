<?php

class Room extends CI_Model {

    var $table = 'tenants';
    var $table1 = 'rooms';

    function __construct() {
        parent::__construct();
    }

    function Add($options = array()) {
        $this->db->insert($this->table1, $options);
        return $this->db->insert_id();
    }
    function Add_Bal_Change($options=array()){
        $this->db->insert('balance_adjustments', $options);
        return $this->db->insert_id();
    }
    function get_ten_id($options=array()){
        $this->db->select('tenant_id');
        $this->db->where('rm_id', $options['rm_id']);
        $query = $this->db->get('rooms')->result_array();
        return $query[0]['tenant_id'];
    }
    function get_rm_stuff($options=array()){
        $this->db->select('tenant_id, debit, credit');
        $this->db->where('rm_id', $options['rm_id']);
        return $this->db->get('rooms')->result_array();
    }
    function get_room_flr($options=array()){
        $this->db->select('rm_id, room_name, meter_reading, rate, b_num_floors, um_bill_date');
        //$this->db->select('rm_id, room_name,tenant_id,rm_size,rm_dimensions,rm_status');
        $this->db->where('rooms_b_id',$options['rm_b_id']);
        $this->db->join('umeme', 'umeme.u_b_id = rooms.rooms_b_id', 'LEFT');
        $this->db->join('buildings', 'buildings.b_id = rooms.rooms_b_id');
        $this->db->join('floors', 'floors.f_id = rooms.floor');
        if(isset($options['floor_num']))
            $this->db->where('flr', $options['floor_num']);
        $query = $this->db->get('rooms');
        return $query->result_array();
    }
    function map_floor_x($options=array()){
        $this->db->select('rm_id, room_name,tenant_id,rm_size,rm_dimensions,rm_status,rm_state');
        $this->db->where('rooms_b_id',$options['rm_b_id']);
        $this->db->join('umeme', 'umeme.u_b_id = rooms.rooms_b_id', 'LEFT');
        $this->db->join('buildings', 'buildings.b_id = rooms.rooms_b_id');
        $this->db->join('floors', 'floors.f_id = rooms.floor');
        if(isset($options['floor_num']))
            $this->db->where('flr', $options['floor_num']);
        $query = $this->db->get('rooms');
        return $query->result_array();
    }
    function get_rate($b_id){
        $this->db->select('rate');
        $this->db->where('u_b_id', $b_id);
        $query = $this->db->get('umeme');
        $Q = $query->result_array();
        if(isset($Q[0]['rate'])){return $Q[0]['rate'];}else{return false;}
    }

    function get_room_namesx(){
        $b_id = $this->session->userdata('building_id');
        $this->db->select('rm_id,room_name, f_name, l_name');
        $where = array('rooms_b_id'=>$b_id);
        $this->db->join('tenants', 'tenants.id = rooms.tenant_id');
        return $this->db->get_where('rooms',$where)->result_array();
    }
    function get_all_room_names(){
        $b_id = $this->session->userdata('building_id');
        $this->db->select('rm_id,room_name');
        $where = array('rooms_b_id'=>$b_id);
        return $this->db->get_where('rooms',$where)->result_array();
    }
    function get_room_name2($options=array()){
        $this->db->select('room_name, rm_cost');
        $where = array('rm_id'=>$options['rm_id']);
        $query = $this->db->get_where('rooms',$where)->result_array();
        return $query;
    }
    function edit_rm_bal($options=array()){
        $this->db->set('debit', $options['debit']);
        $this->db->set('credit', $options['credit']);
        $this->db->where('rm_id', $options['rm_id']);
        $this->db->update('rooms');
        return $this->db->affected_rows();
    }
    function get_room($options = array()) {
        $this->db->select('*');
        $this->db->from($this->table1);
        $this->db->join('tenants', 'tenants.id = rooms.tenant_id', 'LEFT');
        $this->db->join('buildings', 'buildings.b_id = rooms.rooms_b_id', 'LEFT');
        $this->db->join('floors', 'floors.b_id = rooms.rooms_b_id', 'LEFT');
        if (isset($options['floor_num']))
            $this->db->where('f_id', $options['floor_num']);
        if (isset($options['rm_id']))
            $this->db->where('rm_id', $options['rm_id']);
        if (isset($options['rooms_b_id']))
            $this->db->where('rooms_b_id', $options['rooms_b_id']);
        if (isset($options['floor_num']))
            $this->db->where('floor', $options['floor_num']);
        if (isset($options['status']))
            $this->db->where('rm_status', $options['status']);
        if (isset($options['rm_status']))
            $this->db->where('rm_status', $options['rm_status']);
        if (isset($options['landlord']))
            $this->db->where('landlord_id', $options['landlord']);
        if (isset($options['tenant']))
            $this->db->where('tenant_id', $options['tenant']);
        if (isset($options['manager']))
            $this->db->where('manager_id', $options['manager']);
        if (isset($options['billed']))
        $this->db->where('rm_cost >', '0');
        $query = $this->db->get();
        return $query->result_array();
    }
    function get($options = array()) {
        $this->db->select('*');
        $this->db->from($this->table1);
        $this->db->join('buildings', 'buildings.b_id = rooms.rooms_b_id', 'LEFT');
        if (isset($options['rm_id']))
            $this->db->where('rm_id', $options['rm_id']);
        if (isset($options['rooms_b_id']))
            $this->db->where('rooms_b_id', $options['rooms_b_id']);
        if (isset($options['floor_num']))
            $this->db->where('floor', $options['floor_num']);
        if (isset($options['status']))
            $this->db->where('rm_status', $options['status']);
        if (isset($options['rm_status']))
            $this->db->where('rm_status', $options['rm_status']);
        if (isset($options['landlord']))
            $this->db->where('landlord_id', $options['landlord']);
        if (isset($options['tenant']))
            $this->db->where('tenant_id', $options['tenant']);
        if (isset($options['manager']))
            $this->db->where('manager_id', $options['manager']);
        if (isset($options['room_name']))
            $this->db->where('room_name', $options['room_name']);
        $query = $this->db->get();
        return $query->result_array();
    }

    function evictions($options = array()) {
        if (!$this->_required(array('rm_id'), $options)) {
            return FALSE;
        }

        $this->db->select('*');
        $this->db->where('ev_rm_id', $options['rm_id']);
        $this->db->where('ev_date >', date('Y-m-d'));
        $query = $this->db->get('evictions');
        return $query->result_array();
    }

    /*public function get_evictions($options = array()) {
        if (!$this->_required(array('rooms_b_id'), $options)) {
            return FALSE;
        }
        $this->db->select('*');
        $this->db->from($this->table1);
        $this->db->join('evictions', 'evictions.ev_rm_id = rooms.rm_id', 'RIGHT');
        $this->db->join('tenants', 'evictions.ev_ten_id = tenants.id');
        $this->db->where('rooms_b_id', $options['rooms_b_id']);
        if (isset($options['pending'])) {
            $this->db->where('ev_status', 'PENDING');
        } else {
            $this->db->where('ev_status', 'EVICTED');
        }
        $query = $this->db->get();
        return $query->result_array();
    }*/
    public function get_evictions($options=array()) {
        $this->db->select('room_name, f_name, l_name, telephone, email, ev_ten_id, ev_date, name_first, name_last');
        $this->db->from('evictions');
        $this->db->join('rooms', 'evictions.ev_rm_id = rooms.rm_id');
        $this->db->join('tenants', 'evictions.ev_ten_id = tenants.id');
        $this->db->join('users', 'ev_by = name_id');
        $this->db->where('rooms_b_id', $options['building_id']);
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_room2($options = array()) {
        $this->db->select('*, SUM(pay_amount) as rev');
        $this->db->from('rooms');
        $this->db->join('records', 'records.records_rm_id = rooms.rm_id');
        $this->db->join('floors', 'floors.f_id = rooms.floor');
//        $this->db->join('buildings', 'buildings.b_id = rooms.rooms_b_id', 'LEFT');
        if (isset($options['rooms_b_id']))
            $this->db->where('rooms_b_id', $options['rooms_b_id']);
        if (isset($options['floor_num']))
            $this->db->where('flr', $options['floor_num']);
        $this->db->not_like('particulars', 'UMEME');
        $this->db->group_by('records.records_rm_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_debtors($options = array()) {
        $this->db->select('rm_id, room_name, debit, credit, f_name, l_name, pic_path');
        $this->db->from($this->table1);
        $this->db->join('tenants', 'tenants.id = tenant_id', 'LEFT');
        //$this->db->join('schedules', 'schedules.s_rm_id = rooms.rm_id');
        $this->db->where('rooms.debit > rooms.credit');
        $this->db->where('rooms_b_id', $options['b_id']);
        $query = $this->db->get();
        $y = $query->result_array();
        //return $query->result_array();
        $x = array();
        foreach($y as $row){
            $bal = $row['debit']-$row['credit'];
            $this->db->select('SUM(s_amount) as amount, SUM(s_cleared) as cleared');
            $this->db->where('s_rm_id', $row['rm_id']);
            $Q = $this->db->get('schedules');
            $Q_d = $Q->result_array();
            $sch_bal = $Q_d[0]['amount']-$Q_d[0]['cleared'];
            if($sch_bal<$bal){
                $row['schedule'] = $Q_d[0]['amount']-$Q_d[0]['cleared'];
                $x[] =  $row;
            }
        }
        return $x;
    }

    function get_down_payment($options = array()) {
        $this->db->select('*');
        $this->db->where('rm_id', $options['rm_id']);
        $query = $this->db->get('rooms');
        return $query->result_array();
    }

    function update_room_umeme($options = array()){
        $this->db->set('credit_umeme', 'credit_umeme + '.$options['cr'],FALSE);
        $this->db->where('rm_id',$options['rm_id']);
        $this->db->update('rooms');
    }
    function update_room($options = array()) {
        if (!$this->_required(array('m_id'), $options)) {
            return FALSE;
        }
        if (isset($options['name']))
            $this->db->set('room_name', $options['name']);
        if (isset($options['stat']))
            $this->db->set('rm_status', $options['stat']);
        if (isset($options['ten']))
            $this->db->set('tenant_id', $options['ten']);
        if (isset($options['desc']))
            $this->db->set('description', $options['desc']);
        if (isset($options['num']))
            $this->db->set('room_num', $options['num']);
        if (isset($options['cost']))
            $this->db->set('rm_cost', $options['cost']);
        if (isset($options['man']))
            $this->db->set('manager_id', $options['man']);
        if (isset($options['landlord']))
            $this->db->set('landlord_id', $options['landlord']);
        if (isset($options['cr']))
            $this->db->set('credit', $options['cr']);
        if (isset($options['dr']))
            $this->db->set('debit', $options['dr']);
        if (isset($options['d_payment']))
            $this->db->set('d_payment', $options['d_payment']);
        if (isset($options['rm_s_date']))
            $this->db->set('rm_s_date', $options['rm_s_date']);
        if (isset($options['rm_h_date']))
            $this->db->set('rm_h_date', $options['rm_h_date']);
        if (isset($options['rm_deposit']))
            $this->db->set('rm_deposit', $options['rm_deposit']);
        if(isset($options['rm_purpose']))
            $this->db->set('rm_purpose', $options['rm_purpose']);
        if(isset($options['rm_date']))
            $this->db->set('rm_date', $options['rm_date']);
        $this->db->where('rm_id', $options['m_id']);
        $this->db->update($this->table1);
        return $this->db->affected_rows();
    }

    function check_room($options = array()) {
        $this->db->select('*');
        if (isset($options['room_num']))
            $this->db->where('room_num', $options['room_num']);
        if (isset($options['room_name']))
            $this->db->where('room_name', $options['room_name']);
        $query = $this->db->get($this->table1);
        return $query->result_array();
    }

    function evict_tenant($options = array()) {
        if (!$this->_required(array('ev_rm_id'), $options)) {
            return FALSE;
        }

        $this->db->set('tenant_id', 0);
        $this->db->set('rm_status', 'VACANT');
        $this->db->set('debit', 0);
        $this->db->set('credit', 0);
        $this->db->set('rm_s_date', '');
        $this->db->set('rm_h_date', '');

        $this->db->where('rm_id', $options['ev_rm_id']);
        $this->db->update($this->table1);
    }

    function add_evictions($options = array()) {
        $this->db->insert('evictions', $options);
        return $this->db->insert_id();
    }

    function get_meter_reading($options=array()){
        if (!$this->_required(array('rm_id'), $options)) {
            return FALSE;
        }
        $this->db->select('meter_reading, debit, rate');
        $this->db->where('rm_id', $options['rm_id']);
        $this->db->join('umeme', 'umeme.u_b_id = rooms.rooms_b_id', 'LEFT');
        $query = $this->db->get('rooms');
        return $query->result_array();
    }

    function get_room_name($options=array()){
        if (!$this->_required(array('rm_id'), $options)) {
            return FALSE;
        }
        $this->db->select('room_name');
        $this->db->where('rm_id', $options['rm_id']);
        $query = $this->db->get('rooms');
        return $query->result_array();
    }
    function get_room_display($options=array()){
        if (!$this->_required(array('rm_id'), $options)) {
            return FALSE;
        }
        $this->db->select('tenants.status,rm_id, rm_status, rm_state, rooms_b_id, tenant_id, room_name, rm_cost, debit, credit, debit_umeme,credit_umeme, rooms.d_payment, email, f_name, l_name, pic_path, telephone');
        $this->db->join('tenants', 'tenants.id = rooms.tenant_id', 'LEFT');
        $this->db->where('rm_id', $options['rm_id']);
        $query = $this->db->get('rooms');
        return $query->result_array();
    }
    function check_status($rm){
        $this->db->select('rm_status');
        $this->db->where('rm_id', $rm);
        $query = $this->db->get('rooms');
        $q = $query->result_array();
        if($q[0]['rm_status']!='OCCUPIED'){
            return FALSE;
        }else{
            return TRUE;
        }
    }
    function get_pending_excel_data($options=array()){
        $this->db->select('room_name, rm_date, f_name, l_name');
        $this->db->where('rooms_b_id', $options['building_id']);
        $this->db->where('rm_status', 'PENDING');
        $this->db->join('tenants', 'tenants.id = rooms.tenant_id', 'LEFT');
        $query = $this->db->get('rooms');
        $q = $query->result_array();
        $data_array = array(); $data_array2 = array();
        foreach($q as $row){
            $data_array2['tenant_name'] = $row['f_name']." ".$row['l_name'];
            $data_array2['room'] = $row['room_name'];
            $data_array2['date'] = date('d-F-Y', strtotime($row['rm_date']));
            $data_array[] = $data_array2;
        }
        return $data_array;
    }
    function get_excel_data($options=array()){
        if (!$this->_required(array('rm_id'), $options)) {
            return FALSE;
        }
        $this->db->select('records.d_payment, pay_amount, bill_amount, particulars, pay_month, pay_year, f_name, l_name, re_bal');
        $this->db->from('records');
        //this->db->join('rooms', 'records.records_rm_id = rooms.rm_id', 'LEFT');
        $this->db->join('tenants', 'records.tenant_id = tenants.id', 'LEFT');
        $this->db->where('records.records_rm_id', $options['rm_id']);
        if (isset($options['start']))
            $this->db->where('records.d_payment >=', $options['start']);
        if (isset($options['end']))
            $this->db->where('records.d_payment <=', $options['end']);
        $this->db->order_by('records.receit_no');
        $this->db->not_like('particulars', 'UMEME');
        $this->db->not_like('particulars', 'CHEQUE PENALTY');
        $query = $this->db->get();
        //print_r($query->result_array());
        $data = array();
        $data2 = array();
        $cr = 0; $dr = 0;
        $bal = 0;
        foreach ($query->result_array() as $row){
            $data['tenant_name'] = $row['f_name']." ".$row['l_name'];
            $data['d_payment'] = date('d-m-Y', strtotime($row['d_payment']));
            $data['particulars'] = $row['particulars']." ". $row['pay_month']." - ".$row['pay_year'];
            if($row['bill_amount']!=0){$data['debit'] = number_format($row['bill_amount'],0,'','');}else{$data['debit'] = '';}
            if($row['pay_amount']!=0){$data['credit'] = number_format($row['pay_amount'],0,'','');}else{$data['credit'] = '';}
            $data['balance'] = $row['re_bal'];
            $bal = $row['re_bal'];
            if($row['particulars']=='RENT_BILL_OCCUPIED_X'){$cr += 0;$dr +=0;}else{$cr += $row['pay_amount'];$dr += $row['bill_amount'];}
            //$cr += $row['pay_amount']; $dr += $row['bill_amount'];

            $data2[] = $data;
        }
        $data2[] = array('tenant_name'=>'', 'd_payment'=>'','particulars'=>'TOTAL', 'debit'=>$dr, 'credit'=>$cr, 'balance'=>$bal);
        //print_r($data2);
        return $data2;
    }
    function get_room_x($options=array()){
        $this->db->select('rm_id, room_name');
        $this->db->where('rooms_b_id', $options['b_id']);
        $query = $this->db->get('rooms');
        return $query->result_array();

    }
    function get_balance_bf($options=array()){
        $this->db->select('SUM(pay_amount) as credit, SUM(bill_amount) as debit');
        $this->db->where('tenant_id', $options['ten_id']);
        $this->db->where('records_rm_id', $options['rm_id']);
        $this->db->where('d_payment < ', date('Y-m-01'));
        $query = $this->db->get('records');
        return $query->result_array();
    }
    function get_room_stuff($options=array()){
        $this->db->select('rm_id, room_name, rm_cost, debit, credit, f_name, l_name, tenant_id');
        $this->db->join('tenants', 'rooms.tenant_id = tenants.id', 'LEFT');
        $this->db->where('rooms_b_id', $options['building_id']);
        $this->db->where('rm_status', $options['status']);
        $query = $this->db->get('rooms');
        return $query->result_array();
    }
    function get_room_records($options=array()){
        $this->db->select('records.d_payment, pay_amount, bill_amount, particulars, pay_month, pay_year, rec_num, re_bal, old_bal');
        $this->db->where('records.records_rm_id', $options['rm_id']);
        if(isset($options['start_date']))
            $this->db->where('d_payment >= ', $options['start_date']);
        if(isset($options['end_date']))
            $this->db->where('d_payment <= ', $options['end_date']);
        $this->db->not_like('particulars', 'UMEME');
        $this->db->not_like('particulars', 'RENT_BILL_VACANT');
        $this->db->order_by('records.receit_no');
        $query = $this->db->get('records');
        return $query->result_array();
    }
    function get_room_credit($options=array()){
        $this->db->select('debit, credit');
        $this->db->where('rm_id', $options['rm_id']);
        $query = $this->db->get('rooms');
        return $query->result_array();
    }
    function get_room_credit2($options=array()){
        $this->db->select('SUM(bill_amount) as debit, SUM(pay_amount) as credit');
        $this->db->where('records_rm_id', $options['rm_id']);
        if(isset($options['tenant_id']))
            $this->db->where('tenant_id', $options['tenant_id']);
//        if(isset($options['start_date']))
//            $this->db->where('d_payment >', $options['start_date']);
        if(isset($options['end_date']))
            $this->db->where('d_payment <', $options['end_date']);
        $query = $this->db->get('records');
        return $query->result_array();
    }

    function _SetDefaults($defaults, $options) {
        return array_merge($defaults, $options);
    }

    function _required($required, $data) {
        foreach ($required as $field) {
            if (!isset($data[$field])) {
                return FALSE;
            }
        }
        return TRUE;
    }
    function get_rm_dimensions($id){
        return $this->get_by_id($id, 'rooms', 'rm_size,rm_dimensions,rm_status,rm_state', 'rm_id');
    }
    function change_rm_dimensions($data){
        /**
         *Array
(
    [rm_id] => 3
    [dim] => (dim) undeclared
    [size] => (size) undeclared
)
         * @param type $id
         * @param type $table_name
         * @param type $parameter
         * @param type $id_col_nm
         * @return type
         */

        $this->db->update('rooms', array('rm_size'=>$data['size'],'rm_dimensions'=>$data['dim'],'rm_state'=>$data['rm_state']), array('rm_id' => $data['rm_id']));

    }
    public function get_by_id($id, $table_name, $parameter, $id_col_nm) {
        $this->db->select($parameter);
        $q = $this->db->get_where($table_name, array($id_col_nm => $id))->result_array();
        if (isset($q[0])) {
            return $q[0];
        }else
            return $q;
    }

    function GetRevenue($options = array()) {
        $this->db->select('SUM(rm_cost) as subtotal');
        $this->db->from('rooms');
        $this->db->where('rooms_b_id', $options['b_id']);
        $query = $this->db->get();
        return $query->result_array();
    }
    function get_vacant_rooms($options=array()){
        $this->db->select('rm_id, room_name, rm_cost');
        $this->db->where('rooms_b_id', $options['b_id']);
        $this->db->where('rm_status', 'VACANT');
        $query = $this->db->get('rooms');
        return $query->result_array();
    }

 function get_rooms($options = array()) {
        $this->db->select('*');
        $this->db->from('rooms');
        $this->db->join('tenants', 'tenants.id = rooms.tenant_id', 'LEFT');
        $this->db->join('buildings', 'buildings.b_id = rooms.rooms_b_id', 'LEFT');
        //$this->db->join('floors', 'floors.b_id = rooms.floor', 'LEFT');
        if (isset($options['floor']))
            $this->db->where('floor', $options['floor']);
        if (isset($options['rooms_b_id']))
            $this->db->where('rooms_b_id', $options['rooms_b_id']);
        $query = $this->db->get();
        return $query->result_array();
    }


 function update_room_credit($options = array()){
        $this->db->set('credit', 'credit + '.$options['credit'],FALSE);
        $this->db->where('rm_id',$options['records_rm_id']);
        $this->db->update('rooms');
    }
}