<?php

class Bill extends CI_Model {

    var $table = 'landlords';
    var $table1 = 'tenants';
    var $table2 = 'rooms';
    var $table3 = 'records';
    var $table4 = 'umeme';

    function __construct() {
        parent::__construct();
    }

    function add_payment($options = array()) {
        $this->db->insert('records', $options);
        return $this->db->insert_id();
    }

    function add_bill($options = array()) {
        $this->db->insert('records', $options);
        return $this->db->insert_id();
    }

    function add_bill_reason($options = array()) {
        $this->db->insert('rebill', $options);
        return $this->db->insert_id();
    }
    function get_bounced_cheque_data($options=array()){
        $this->db->select('date_time,cheque,penalty,amount,rec_id,amount_clrd,date_clrd,room_name,f_name,l_name,room,tenant');
        $this->db->where('bounced_cheqs.id', $options['pen_id']);
        $this->db->join('rooms','rooms.rm_id=bounced_cheqs.room');
        $this->db->join('tenants', 'tenants.id=bounced_cheqs.tenant');
        $query = $this->db->get('bounced_cheqs');
        $Q = $query->result_array();
        return $Q[0];
    }
    function pay_penalty($options=array()){
        $this->db->set('amount_clrd', $options['amount']);
        $this->db->set('date_clrd', date('Y-m-d'));
        $this->db->where('id', $options['pen_id']);
        $this->db->update('bounced_cheqs');
        return $this->db->affected_rows();
    }

    function get_payments($options = array()) {
        $this->db->select('*');
        $this->db->from('records');
        $this->db->join('rooms', 'rooms.rm_id = records.records_rm_id', 'LEFT');
        $this->db->join('tenants', 'rooms.rm_id = tenants.room_id', 'LEFT');
        $this->db->where('rooms_b_id', $options['b_id']);
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_payments_made($options = array()) {
        $this->db->select('rec_num, d_receipt, particulars, f_name, l_name, room_name, pay_amount, vat, rm_id ');
        $this->db->from('records');
        $this->db->join('rooms', 'rooms.rm_id = records.records_rm_id', 'RIGHT');
        $this->db->join('tenants', 'records.tenant_id = tenants.id', 'LEFT');
        $this->db->where('rooms.rooms_b_id', $this->session->userdata('building_id'));
        $this->db->where('records.bill_amount', '0');
        $query = $this->db->get();
        return $query->result_array();
    }
    function get_payments_made_by_date($date) {
        $b_id = $this->session->userdata('building_id');
        $this->db->like('d_receipt',date('Y-m-d', strtotime($date)));
        $this->db->select('rec_num, d_receipt, particulars, f_name, l_name, room_name, pay_amount, vat, rm_id ');
        $this->db->from('records');
        $this->db->join('rooms', 'rooms.rm_id = records.records_rm_id', 'RIGHT');
        $this->db->join('tenants', 'records.tenant_id = tenants.id', 'LEFT');
        $this->db->where('rooms.rooms_b_id', $this->session->userdata('building_id'));
        $this->db->where('records.bill_amount', '0');
        $this->db->where('isdeleted', 0);
        $where = array('rooms.rooms_b_id'=>$b_id);
        return $this->db->get()->result_array();
    }


    public function get_rate() {
        $this->db->select('*');
        $this->db->from($this->table4);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function check_date($rm_id) {
        $this->db->select('*');
        $this->db->where('records_rm_id', $rm_id);
        $this->db->where('particulars', 'RENT_BILL');
        //        something missing here on comparing dates

        $this->db->from($this->table3);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function delete_record($record_id) {
        $this->db->set('isdeleted', 1);
        $this->db->where('receit_no', $record_id);
        $this->db->update('records');
        return $this->db->affected_rows();
    }

    public function get_date($rm_id) {
        $this->db->select('d_receipt');
        $this->db->where('records_rm_id', $rm_id);
        $this->db->from($this->table3);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get($options = array()) {
        $this->db->select('*');
        $this->db->from('rooms');
        $this->db->join('floors', 'rooms.floor = floors.f_id', 'LEFT');
        if(isset($options['rm_id']))
            $this->db->where('rm_id', $options['rm_id']);
        if (isset($options['building_id']))
            $this->db->where('rooms_b_id', $options['building_id']);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_bill_date($options = array()) {
        $this->db->select('*');
        $this->db->from('rooms');
        //$this->db->join('tenants', 'rooms.rm_id = tenants.room_id', 'LEFT');
        if (isset($options['rm_id']))
            $this->db->where('rm_id', $options['rm_id']);
        $query = $this->db->get();
        //print_r($query->result_array());
        return $query->result_array();
    }

    function update_rate($options = array()) {
        if (isset($options['rate']))
            $this->db->set('rate', $options['rate']);
        $this->db->where('u_b_id', $options['id']);
        $this->db->update($this->table4);
        return $this->db->affected_rows();
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

        $this->db->where('rm_id', $options['rm_id']);
        $this->db->update($this->table2);
    }

    function Add($options = array()) {
        $this->db->insert($this->table, $options);
        return $this->db->insert_id();
    }

    function add_receipt() {
        $this->db->select_max('rc_id');
        $query = $this->db->get('receipts');
        $rc = $query->result_array();
        if (isset($rc[0]['rc_id'])) {
            $rec_num = $rc[0]['rc_id'];
        } else {
            $rec_num = 0;
        }
        $rc_name = "RC-3000" . $rec_num;
        $this->db->insert('receipts', array('rc_num' => $rc_name));
        return array('name' => $rc_name, 'num' => $this->db->insert_id());
    }

    function add_invoice() {
    //        $this->db->select_max('inv_id');
    //        $query = $this->db->get('invoices');
        $str = "SELECT MAX(`inv_id`) AS inv_id FROM (`invoices`)";
        $query = $this->db->query($str);
        $inv = $query->result_array();
        if (isset($inv[0]['inv_id'])) {
            $inv_num = $inv[0]['inv_id'];
        } else {
            $inv_num = 0;
        }
        $inv_name = "INV-7000" . $inv_num;
        $this->db->insert('invoices', array('inv_name' => $inv_name));
        return array('name' => $inv_name, 'num' => $this->db->insert_id());
    }

    function get_room($options = array()) {
        $this->db->select('bill_date, rm_cost, rm_status, room_name, rm_id, debit, tenant_id, credit,telephone');
        $this->db->from('rooms');
        $this->db->join('tenants', 'rooms.rm_id = tenants.room_id', 'LEFT');
        if (isset($options['rooms_b_id']))
            $this->db->where('rooms_b_id', $options['rooms_b_id']);
        if (isset($options['floor']))
            $this->db->where('floor', $options['floor']);
        if (isset($options['rm_id']))
            $this->db->where('rooms.rm_id', $options['rm_id']);
        $query = $this->db->get();
        $this->db->group_by('rm_id');
        return $query->result_array();
    }

    function get_umeme_details($options = array()) {
        $this->db->select('*');
        $this->db->from('rooms');
        $this->db->join('umeme', 'umeme.u_b_id = rooms.rooms_b_id', 'LEFT');
        if (isset($options['rooms_b_id']))
            $this->db->where('rooms_b_id', $options['rooms_b_id']);
        if (isset($options['floor']))
            $this->db->where('floor', $options['floor']);
        if (isset($options['rm_id']))
            $this->db->where('rooms.rm_id', $options['rm_id']);
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_room2($options = array()) {
        $this->db->select('*');
        $this->db->from('rooms');
        $this->db->join('umeme', 'umeme.u_b_id = rooms.rooms_b_id', 'LEFT');
        $this->db->join('tenants', 'tenants.id = rooms.tenant_id', 'LEFT');
        if (isset($options['rooms_b_id']))
            $this->db->where('rooms_b_id', $options['rooms_b_id']);
        if (isset($options['floor']))
            $this->db->where('floor', $options['floor']);
        if (isset($options['rm_id']))
            $this->db->where('rooms.rm_id', $options['rm_id']);
        $query = $this->db->get();

        return $query->result_array();
    }

    function get_statement($options = array()) {
        $this->db->select('*');
        $this->db->from($this->table3);
        $this->db->join('rooms', 'rooms.rm_id = records.records_rm_id');
        $this->db->not_like('particulars', 'UMEME');
        if (isset($options['rm_id']))
            $this->db->where('records_rm_id', $options['rm_id']);
        if (isset($options['particulars']))
            $this->db->where('records.particulars', $options['particulars']);
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_ten_statement($options = array()) {
        $this->db->select('*');
        $this->db->from($this->table3);
        $this->db->join('rooms', 'rooms.rm_id = records.records_rm_id');
        $this->db->join('tenants', 'tenants.id = records.tenant_id');
        if (isset($options['id']))
            $this->db->where('tenants.id', $options['id']);
        $this->db->order_by('records.receit_no');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_tenants($options = array()) {
        $this->db->select('*, sum(rooms.debit)as bill, sum(rooms.credit)as payed');
        $this->db->from($this->table1);
        $this->db->join('rooms', 'rooms.tenant_id = tenants.id');
        if (isset($options['rooms_b_id']))
            $this->db->where('rooms_b_id', $options['rooms_b_id']);
        $this->db->group_by('tenants.id');
        $query = $this->db->get();
        return $query->result_array();
    }

    function GetAll($options = array()) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('buildings', 'landlords.landlords_b_id = buildings.b_id', 'LEFT');
        $query = $this->db->get();
        return $query->result_array();
    }

    function Update4($options = array()) {
        if (isset($options['meter_reading']))
            $this->db->set('meter_reading', $options['meter_reading']);
        if (isset($options['debit_umeme']))
            $this->db->set('debit_umeme', 'debit_umeme + ' . $options['debit_umeme'],FALSE);
        $this->db->set('um_bill_date', date('Y-m-d'));
        $this->db->where('rm_id', $options['rm_id']);
        $this->db->update('rooms');
        return $this->db->affected_rows();
    }

    function update_cheq_debit($options=array()) {
        $this->db->set('debit', $options['debit']);
        $this->db->where('rm_id', $options['rm_id']);
        $this->db->update('rooms');
        return $this->db->affected_rows();
    }

    function Update_rebill($options = array()) {
         if (isset($options['bill_date']))
            $this->db->set('bill_date', $options['bill_date']);
        if (isset($options['debit']))
            $this->db->set('debit', ($options['debit'] + ($options['new'] - $options['old'])));
        if (isset($options['new']))
            $this->db->set('rm_cost', $options['new']);
        if (isset($options['rm_id']))
            $this->db->where('rm_id', $options['rm_id']);
        $this->db->update($this->table2);
        return $this->db->affected_rows();
    }
    function Update($options = array()) {
        if (isset($options['debit']))
            $this->db->set('debit', ($options['debit'] + $options['rm_cost']));
        if (isset($options['debit2']))
            $this->db->set('debit', ($options['debit1'] + $options['debit2']));
        if (isset($options['bill_date']))
            $this->db->set('bill_date', $options['bill_date']);
        if (isset($options['credit']))
            $this->db->set('credit', ($options['credit']) + $options['credit2']);
        if (isset($options['rm_cost']))
            $this->db->set('rm_cost', $options['rm_cost']);
        if (isset($options['prm_cost']))
            $this->db->set('debit', ($options['debit'] + ($options['rm_cost'] - $options['prm_cost'])));
        if (isset($options['meter_reading']))
            $this->db->set('meter_reading', $options['meter_reading']);
        if (isset($options['tenant_id']))
            $this->db->where('tenant_id', $options['tenant_id']);
        if (isset($options['rm_id']))
            $this->db->where('rm_id', $options['rm_id']);
        if (isset($options['floor']))
            $this->db->where('floor', $options['floor']);

        $this->db->update($this->table2);
        return $this->db->affected_rows();
    }

    function UpdateRooms($options = array()) {
        if (isset($options['debit']))
            $this->db->set('debit', ($options['debit'] + $options['rm_cost']));
        if (isset($options['bill_date']))
            $this->db->set('bill_date', $options['bill_date']);
        if (isset($options['rm_status']))
            $this->db->set('rm_status', $options['rm_status']);
        if (isset($options['credit2']))
            $this->db->set('credit', ($options['credit']) + $options['credit2']);
        if (isset($options['rm_id']))
            $this->db->where('rm_id', $options['rm_id']);
        $this->db->update('rooms');
        return $this->db->affected_rows();
    }

    function UpdateRecords($options = array()) {
        $this->db->set('particulars', 'RENT_BILL_OCCUPIED_X');
         if (isset($options['records_rm_id']))
            $this->db->where('records_rm_id', $options['records_rm_id']);
        if (isset($options['d_payment']))
        $this->db->where('d_payment', $options['d_payment']);
        $this->db->where('particulars','RENT_BILL_OCCUPIED');
        $this->db->update('records');
        return $this->db->affected_rows();
    }

    function update_records($options = array()) {
        if (isset($options['tenant_id']))
            $this->db->set('records.tenant_id', $options['tenant_id']);
        if (isset($options['re_bal']))
            $this->db->set('re_bal', $options['re_bal']);
        if (isset($options['d_payment']))
            $this->db->set('records.d_payment', $options['d_payment']);
        if (isset($options['particulars']))
            $this->db->set('particulars', $options['particulars']);
        if (isset($options['rec_num']))
            $this->db->set('rec_num', $options['rec_num']);
        if (isset($options['bill_amount']))
            $this->db->set('bill_amount', $options['bill_amount']);
        if (isset($options['records_rm_id']))
            $this->db->where('records_rm_id', $options['records_rm_id']);
        if (isset($options['pay_month']))
            $this->db->where('pay_month', date('F'));
        if (isset($options['pay_year']))
            $this->db->where('pay_year', date('Y'));
        $this->db->where('particulars', 'RENT_BILL_VACANT');
        $this->db->update($this->table3);
        return $this->db->affected_rows();
    }

    function UpdateUmemeBill($options = array()) {
        if (isset($options['rate']) && isset($options['current']))
            $this->db->set('debit', ($options['debit'] + (($options['current'] - $options['prev']) * $options['rate'])));
        if (isset($options['rm_id']))
            $this->db->where('rm_id', $options['rm_id']);
        if (isset($options['current']))
            $this->db->set('meter_reading', $options['current']);
        $this->db->update($this->table2);
        return $this->db->affected_rows();
    }

    function Update2($options = array()) {
        if (isset($options['rm_cost']))
            $this->db->set('bill_amount', $options['rm_cost']);
        $this->db->set('particulars', 'Bill');
        if (isset($options['tenant_id']))
            $this->db->where('id', $options['tenant_id']);
        if (isset($options['rm_id']))
            $this->db->where('records_rm_id', $options['rm_id']);
        if ($this->db->update($this->table3)) {
            return TRUE;
        } else {
            return false;
        }
    }

    function get_total_payments($options = array()) {
        $this->db->select('sum(pay_amount) as subtotal');
        $this->db->from('records');
        $this->db->join('rooms', 'records.records_rm_id = rooms.rm_id');
        $this->db->where('rooms_b_id', $options['building_id']);
        if (isset($options['particlulars']))
            $this->db->where('particulars', $options['particulars']);
        if (isset($options['start_date']))
            $this->db->where('records.d_payment >=', $options['start_date']);
        if (isset($options['end_date']))
            $this->db->where('records.d_payment <=', $options['end_date']);
        $this->db->not_like('particulars', 'UMEME');
        $this->db->not_like('particulars', 'CHEQUE PENALTY');
        $query = $this->db->get();
        $q_a = $query->result_array();
        return $q_a[0]['subtotal'];
    }

    function get_total_bills($options = array()) {
        $this->db->select('sum(bill_amount) as subtotal');
        $this->db->from('records');
        $this->db->join('rooms', 'records.records_rm_id = rooms.rm_id');
        $this->db->where('rooms_b_id', $options['building_id']);
        if (isset($options['particulars']))
            $this->db->where('particulars', $options['particulars']);
        if (isset($options['start_date']))
            $this->db->where('records.d_payment >=', $options['start_date']);
        if (isset($options['end_date']))
            $this->db->where('records.d_payment <=', $options['end_date']);
        $this->db->not_like('particulars', 'UMEME');
        $query = $this->db->get();
        $q_a = $query->result_array();
        return $q_a[0]['subtotal'];
    }

    //    public function get_closing_excel($options=array()){
    //        $this->db->where('', $options['b_id']);
    //    }
    public function get_debt_excel($options = array()) {
        $this->db->select('f_name, l_name, room_name, debit, credit, status, telephone');
        $this->db->from('rooms');
        $this->db->join('tenants', 'tenants.id = rooms.tenant_id', 'LEFT');
        $this->db->where('rooms_b_id', $options['building_id']);
        $this->db->where('debit > credit');
        $query = $this->db->get();
        $data = array();
        $data2 = array();
        $tot = 0;
        foreach ($query->result_array() as $row) {
            $data['ten_name'] = $row['f_name'] . " " . $row['l_name'];
            $data['status'] = $row['status'];
            $data['rm'] = $row['room_name'];
            $data['Phone'] = $row['telephone'];
            $data['amount'] = $row['debit'] - $row['credit'];
            $data2[] = $data;
            $tot += $row['debit'] - $row['credit'];
        }
        $data2[] = array('ten_name' => '', 'status' => '', 'rm' => '', 'Phone' => 'TOTAL', 'amount' => $tot);
        return $data2;
    }

    public function umeme_report($options = array()) {
        $this->db->select('records.d_payment, pay_amount, bill_amount, room_name, meter_r, units, pay_month, pay_year, re_bal');
        $this->db->from('records');
        $this->db->join('rooms', 'records.records_rm_id = rooms.rm_id', 'LEFT');
        $this->db->where('records_rm_id', $options['rm_id']);
        $this->db->like('particulars', 'UMEME');
        $this->db->where('records.d_payment >=', $options['start_date']);
        $this->db->where('records.d_payment <=', $options['end_date']);
        $query = $this->db->get();
        $data = array();
        $data2 = array();
        $tot = 0;
        $cr = 0;
        $dr = 0;
        $bal = 0;
        foreach ($query->result_array() as $row) {
            $data['date'] = date('d-m-Y', strtotime($row['d_payment']));
            $data['old_read'] = $row['meter_r'] - $row['units'];
            $data['new_read'] = $row['meter_r'];
            $data['units'] = $row['units'];
            $data['credit'] = $row['pay_amount'];
            $cr += $row['pay_amount'];
            $data['debit'] = $row['bill_amount'];
            $data['balance'] = $row['re_bal'];
            $dr += $row['bill_amount'];
            $bal = $row['re_bal'];
            $data2[] = $data;
            $tot += $row['bill_amount'] - $row['pay_amount'];
        }
        $data2[] = array('date' => '', 'old_read' => '', 'new_read' => '', 'units' => 'TOTAL', 'credit' => $cr, 'debit' => $dr, 'balance'=>$bal);
        return $data2;
    }
    function get_bills($options=array()) {
        $this->db->select('records.d_payment, bill_amount, particulars, rec_num');
        $this->db->join('rooms', 'records.records_rm_id = rooms.rm_id');
        $this->db->where('pay_amount', 0);
        $this->db->where('rooms_b_id', $options['b_id']);
        $this->db->where('records_rm_id', $options['rm_id']);
        $this->db->not_like('particulars', 'UMEME');
        $this->db->not_like('particulars', 'RENT_BILL_VACANT');
        $query = $this->db->get('records');
        return $query->result_array();
    }
    function get_rent_invoice_excel($options=array()) {
        $this->db->select('pay_month, pay_year, d_payment, bill_amount, particulars');
        $this->db->where('rec_num', $options['inv']);
        $query = $this->db->get('records');
        $data = array();
        $data2 = array();
        foreach($query->result_array() as $row) {
            $data['Particulars'] = $row['particulars']." - ".$row['pay_month']." ".$row['pay_year'];
            $data['amount'] = $row['bill_amount'];
            $data['d_payment'] = $row['d_payment'];
            $data2[] = $data;
        }
        return $data2;
    }
    function get_umeme_invoice_excel($options=array()) {
        $this->db->select('meter_r, units, pay_month, pay_year, d_payment, bill_amount, x_rate, re_bal, old_bal');
        $this->db->where('rec_num', $options['inv']);
        $query = $this->db->get('records');
        $Q = $query->result_array();
        $data = array();
        $data2 = array();
        foreach($Q as $row) {
            $data['Particulars'] = "Electricity - ".$row['pay_month']." ".$row['pay_year']." + VAT";
            $data['old_read'] = $row['meter_r'] - $row['units'];
            $data['new_read'] = $row['meter_r'];
            $data['units'] = $row['units'];
            $data['rate'] = 0;
            $data['amount'] = $row['bill_amount'];
            $data2[] = $data;
        }
        $data2[] = array('Particulars'=>'Balance B/F','old_read'=>0,'new_read'=>0,'units'=>0,'rate'=>0,'amount'=>$row['old_bal']);
        return $data2;
    }
    function get_invoice($options=array()) {
        $this->db->select('inv_date, room_name, records.tenant_id');
        $this->db->from('records');
        $this->db->join('invoices', 'records.rec_num = invoices.inv_name');
        $this->db->join('rooms', 'rooms.rm_id=records.records_rm_id');
        //$this->db->join('tenants', 'tenants.id=records.tenant_id');
        $this->db->where('rec_num', $options['inv']);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_all_cheques() {
    //        $this->db->select('receit_no,cheque,pay_amount,records_rm_id,records.tenant_id,vat');
    //        $this->db->from('records');
    //        $this->db->join('rooms', 'rooms.rm_id = records.records_rm_id');
    //        $this->db->where('rooms.rooms_b_id', $this->session->userdata('building_id'));
    //        $this->db->where('confirmed','true');
    //        $this->db->where('mode','Cheque');
    //        $query = $this->db->get();
    //        return $query->result_array();
        $b_id = $this->session->userdata('building_id');
        $where = array('mode' => 'Cheque', 'confirmed' => true, 'isdeleted'=>0);
        $this->db->select('receit_no,cheque,pay_amount,records_rm_id,tenant_id,vat');
        //$this->db->join('rooms', 'rooms.rooms_b_id = '.$b_id);

        $q = $this->db->get_where('records', $where)->result_array();
        return $q;
    }

    public function get_bounced_cheques() {
        $this->db->select('bounced_cheqs.id,date_time,room,tenant,cheque,penalty,amount,details');
        $this->db->join('rooms', 'rooms.rm_id = bounced_cheqs.room');
        $this->db->where('rooms.rooms_b_id', $this->session->userdata('building_id'));
        $q = $this->db->get('bounced_cheqs')->result_array();
        foreach ($q as $i => $v) {
            $ten = $this->get_by_id($v['tenant'], 'tenants', 'f_name,l_name', 'id');
            $rm = $this->get_by_id($v['room'], 'rooms', 'room_name', 'rm_id');
            $q[$i]['tenant'] = $ten['f_name'] . ' ' . $ten['l_name'];
            $q[$i]['room'] = $rm['room_name'];
        }
        return $q;
    }

    public function deactivate_rec($id) {
        $where = array('receit_no' => $id);
        $data = array('confirmed' => false);
        $this->db->update('records', $data, $where);
    }

    public function reg_bounced_cheque($data) {
        return $this->db->insert('bounced_cheqs', $data);
    }

    public function get_by_id($id, $table_name, $parameter, $id_col_nm) {
        $this->db->select($parameter);
        $q = $this->db->get_where($table_name, array($id_col_nm => $id))->result_array();
        if (isset($q[0])) {
            return $q[0];
        }else
            return $q;
    }
    function get_ten_id($options=array()){
        $this->db->select('tenant_id');
        $this->db->where('rm_id', $options['rm_id']);
        $query = $this->db->get('rooms');
        $Q = $query->result_array();
        return $Q[0]['tenant_id'];
    }
    function get_b_chqs($options=array()){
        $this->db->select('id,cheque,penalty,amount_clrd');
        $this->db->where('room', $options['rm_id']);
        $this->db->where('tenant', $options['ten_id']);
        $query = $this->db->get('bounced_cheqs');
        return $query->result_array();
    }

    function get_cheque($options = array()) {
        $this->db->select('cheque, slip');
        $this->db->from('records');
        if (isset($options['cheque']))
            $this->db->where('cheque', $options['cheque']);
        if (isset($options['slip']))
            $this->db->where('slip', $options['slip']);
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_bill($options = array()) {
        $this->db->select('*');
        $this->db->from('records');
        $this->db->join('rooms', 'rooms.rm_id=records.records_rm_id', 'LEFT');
        $this->db->where('records_rm_id', $options['records_rm_id']);
        $this->db->where('pay_month', date('F'));
        $this->db->where('pay_year', date('Y'));
        $this->db->like('particulars', 'RENT_BILL');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    function get_total_daily_collection($options=array()) {
        $this->db->select('records.d_payment, pay_amount, pay_amount_shs,pay_month, pay_year, rec_num, f_name, l_name, x_rate, b_name, currency, l_name_first, l_name_last');
        $this->db->from('records');
        $this->db->join('tenants', 'tenants.id = records.tenant_id', 'LEFT');
        $this->db->join('rooms', 'records.records_rm_id=rooms.rm_id', 'LEFT');
        $this->db->join('buildings', 'rooms_b_id=b_id');
        $this->db->join('landlords', 'b_landlord_id=landlords.id');
        $this->db->where('bill_amount', 0);
        $this->db->where('records.d_payment', $options['date']);
        $this->db->order_by('receit_no');
        $query = $this->db->get();
        $data = array();
        $data2 = array();
        $total = 0;$total_eq = 0;$total_2 = 0;$total_3 = 0;
        foreach($query->result_array() as $row) {
            $data['date'] = date('d-F-Y', strtotime($row['d_payment']));
            $data['tenant'] = $row['f_name']." ".$row['l_name'];
            $data['amount'] = $row['pay_amount'];
            $data['mode'] = $row['pay_month']." ".$row['pay_year'];
            $data['receipt'] = $row['rec_num'];
            $data['x_rate'] = $row['x_rate'];
            $data['b_name'] = $row['b_name'];
            $data['landlord'] = $row['l_name_first']." ".$row['l_name_last'];
            if($row['x_rate']!=0) {
                //$data['eq_amount'] = $row['pay_amount']*$row['x_rate'];
                $data['eq_amount'] = $row['pay_amount_shs'];
                //$total_eq+=$data['eq_amount'];
                $data['amount2'] = $row['pay_amount'];
                $data['amount'] = 0;
                $total_eq +=  $row['pay_amount_shs'];
                $total_3 += $row['pay_amount'];
            }else {
                if($row['currency']=='UGX') {
                    $data['eq_amount']=$row['pay_amount'];
                    $data['amount2'] = 0;
                    $data['amount'] = 0;
                    $total_eq +=  $row['pay_amount'];
                }else {
                    $data['eq_amount']=0;
                    $data['amount2'] = 0;
                    $data['amount'] = $row['pay_amount'];
                    $total += $row['pay_amount'];
                }

            }


            $data2[] = $data;
        }
        $data2[] = array('date'=>'','x_rate'=>'','b_name'=>'', 'landlord'=>'','tenant'=>'','receipt'=>'' ,'mode'=>'TOTAL','amount'=>$total, 'eq_amount'=>$total_eq, 'amount2'=>'');
        //print_r($data2);
        return $data2;
    }

    function get_landlord_collection($options = array()) {
    //$options = array('landlord_id','start', 'end');
        $this->db->select('records.d_payment, pay_amount, pay_month, pay_year, rec_num, vat, f_name, l_name, x_rate, b_name, currency,room_name');
        $this->db->from('records');
        $this->db->join('tenants', 'tenants.id = records.tenant_id', 'LEFT');
        $this->db->join('rooms', 'records.records_rm_id=rooms.rm_id', 'LEFT');
        $this->db->join('buildings', 'rooms_b_id=b_id');
        $this->db->join('landlords', 'b_landlord_id=landlords.id');
        $this->db->where('landlords.id', $options['landlord_id']);
        $this->db->where('bill_amount', 0);
        $this->db->where('records.d_payment >=', $options['start']);
        $this->db->where('records.d_payment <=', $options['end']);
        $this->db->where('isdeleted', 0);
        $this->db->not_like('particulars', 'UMEME');
        $this->db->order_by('receit_no');
        $query = $this->db->get();
        $data = array();
        $data2 = array();
        $total_UGX = 0;$total_VAT_UGX = 0;$total_total_UGX = 0;
        $total_USD = 0;$total_VAT_USD = 0;$total_total_USD=0;
        foreach($query->result_array() as $row) {
            $data['date'] = date('d-M-Y', strtotime($row['d_payment']));
            $data['tenant'] = $row['f_name']." ".$row['l_name']." (".$row['room_name'].")";
            $data['period'] = $row['pay_month']." ".$row['pay_year'];
            $data['receipt'] = $row['rec_num'];
            $data['b_name'] = $row['b_name'];
            if($row['currency']=='USD') {
                $data['amountUSD'] = $row['pay_amount'];
                $data['vatUSD'] =$row['vat'];
                $data['totalUSD'] = $row['pay_amount'];
                $total_USD += $row['pay_amount'];
                $total_VAT_USD += $row['vat'];
                $total_total_USD += $data['totalUSD'];
                $data['amountUGX'] = 0;
                $data['vatUGX'] =0;
                $data['totalUGX'] = 0;
            }else {
                $data['amountUGX'] = $row['pay_amount'];
                $data['vatUGX'] =$row['vat'];
                $data['totalUGX'] = $row['pay_amount'];
                $total_UGX += $row['pay_amount'];
                $total_VAT_UGX += $row['vat'];
                $total_total_UGX += $data['totalUGX'];
                $data['amountUSD'] = 0;
                $data['vatUSD'] =0;
                $data['totalUSD'] = 0;
            }
            $data2[] = $data;

        }
        $data2[] = array('date'=>'','b_name'=>'','tenant'=>'' ,'period'=>'TOTAL','amountUGX'=>$total_UGX, 'vatUGX'=>$total_VAT_UGX, 'totalUGX'=>$total_total_UGX, 'amountUSD'=>$total_USD, 'vatUSD'=>$total_VAT_USD, 'totalUSD'=>$total_total_USD);
        //print_r($data2);
        return $data2;
    }

    function check_if_paid($rm,$particular) {
        if(count($this->db->get_where('records',array('particulars'=>$particular,'records_rm_id'=>$rm))->result_array())>0) {
            return true;
        }else return false;
    }
    function get_daily_excel($options=array()) {
        $this->db->select('records.d_payment, pay_amount, pay_amount_shs, mode, cheque, slip, TT, rec_num, f_name, l_name, x_rate, vat');
        $this->db->from('records');
        $this->db->join('tenants', 'tenants.id = records.tenant_id', 'LEFT');
        $this->db->join('rooms', 'records.records_rm_id=rooms.rm_id', 'LEFT');
        $this->db->where('bill_amount', 0);
        $this->db->where('records.d_payment', $options['date']);
        $this->db->where('rooms_b_id', $options['building_id']);
        $query = $this->db->get();
        $data = array();
        $data2 = array();
        $total = 0;$total_eq = 0;$total_2 = 0;$total_3 = 0;
        foreach($query->result_array() as $row) {
            $data['date'] = date('d-m-Y', strtotime($row['d_payment']));
            $data['tenant'] = $row['f_name']." ".$row['l_name'];
            $data['amount'] = $row['pay_amount']+$row['vat'];
            $data['mode'] = $row['mode']." ".$row['cheque'].$row['slip'].$row['TT'];
            $data['receipt'] = $row['rec_num'];
            $data['x_rate'] = $row['x_rate'];
            if($row['x_rate']!=0) {
                $data['eq_amount'] = ($row['pay_amount_shs']);
                //$total_eq+=$data['eq_amount'];
                $data['amount2'] = ($row['pay_amount']);
                $data['amount'] = 0;
                $total_eq +=  ($row['pay_amount_shs']);
                $total_3 += $row['pay_amount'];
            }else {
                $data['eq_amount']=0;
                $data['amount2'] = 0;
                $total += $row['pay_amount'];
            }


            $data2[] = $data;
        }
        $data2[] = array('date'=>'', 'x_rate'=>'','tenant'=>'','receipt'=>'' ,'mode'=>'TOTAL','amount'=>$total, 'eq_amount'=>$total_eq, 'amount2'=>''/*$total_3*/);
        //print_r($data2);
        return $data2;
    }
    function get_daily_excel_UGX($options=array()) {
        $this->db->select('records.d_payment, pay_amount, mode, cheque, slip, TT, rec_num, f_name, l_name, x_rate, vat');
        $this->db->from('records');
        $this->db->join('tenants', 'tenants.id = records.tenant_id', 'LEFT');
        $this->db->join('rooms', 'records.records_rm_id=rooms.rm_id', 'LEFT');
        $this->db->where('bill_amount', 0);
        $this->db->where('records.d_payment', $options['date']);
        $this->db->where('rooms_b_id', $options['building_id']);
        $this->db->where('isdeleted', 0);
        $query = $this->db->get();
        $data = array();
        $data2 = array();
        $total = 0;$total2 = 0;
        foreach($query->result_array() as $row) {
            $data['date'] = date('d-m-Y', strtotime($row['d_payment']));
            $data['tenant'] = $row['f_name']." ".$row['l_name'];
            $data['amount'] = floor($row['pay_amount']);
            $data['x_rate'] = 0;//$row['x_rate'];
            $data['amount_USD'] = 0;
            $data['mode'] = $row['mode']." ".$row['cheque'].$row['slip'].$row['TT'];
            $data['receipt'] = $row['rec_num'];
            $total += floor($row['pay_amount']);
            $total2 += $data['amount_USD'];

            $data2[] = $data;
        }
        $data2[] = array('date'=>'','tenant'=>'','receipt'=>'' ,'x_rate'=>'', 'amount_USD'=>$total2,'mode'=>'TOTAL','amount'=>$total);
        return $data2;
    }

    function check_exists( $options=array()) {
        $this->db->select('records_rm_id');
        $this->db->from('records');
        //$this->db->join('rooms', 'rooms.rm_id = records.records_rm_id');
        if(isset($options['cheque']))
            $this->db->where('records.cheque', $options['cheque']);
        if(isset($options['slip']))
            $this->db->where('records.slip', $options['slip']);
        if(isset($options['TT']))
            $this->db->where('records.TT', $options['TT']);
        $query = $this->db->get();
        if($query->num_rows()==0) {
            return false;
        }else {
            return $query->result_array();
        }
    }

     function get_rev_statement($options = array()) {
        $this->db->select('*');
        $this->db->from('records');
        $this->db->join('rooms', 'rooms.rm_id = records.records_rm_id', 'LEFT');
        $this->db->join('buildings', 'rooms.rooms_b_id = buildings.b_id', 'LEFT');
        $this->db->where('records_rm_id', $options['rm_id']);
        $this->db->where('bill_amount', 0);
        $query = $this->db->get();
        return $query->result_array();
    }

     function get_all_payments($options = array()) {
        $this->db->select('pay_amount, rec_num, vat, re_bal, records_rm_id');        
        $this->db->from('records');
        $this->db->join('rooms', 'rooms.rm_id = records.records_rm_id', 'LEFT');
        $this->db->where('rooms.rooms_b_id', $this->session->userdata('building_id'));
        $this->db->where('records.pay_amount >', 0);
        $query = $this->db->get();
        return $query->result_array();
    }

    function Update_cr($options = array()) {
         if (isset($options['re_bal']))
            $this->db->set('re_bal', $options['re_bal']);
         if (isset($options['vat']))
            $this->db->set('vat', $options['vat']);
        if (isset($options['pay_amount']))
            $this->db->set('pay_amount', $options['pay_amount']);
        $this->db->set('d_payment', date('Y-m-d'));
        if (isset($options['rec_num']))
            $this->db->where('rec_num', $options['rec_num']);
       
        $this->db->update($this->table3);
        return $this->db->affected_rows();
    }

     function add_re_payment($options = array()) {
        $this->db->insert('adjustments', $options);
        return $this->db->insert_id();
    }

    function get_cr(){
        $this->db->select('*');
        $query = $this->db->get('adjustments');
        return $query->result_array();
    }

    function delete_tx($xxx){
        $this->db->where('rec_num', $xxx);
        $query = $this->db->delete('records');
        return true;
    }
    function get_ten_tel($options=array()){
        $this->db->select('telephone');
        $this->db->where('id', $options['t_id']);
        $query = $this->db->get('tenants');
        $Q = $query->result_array();
        return $Q[0]['telephone'];
    }

}