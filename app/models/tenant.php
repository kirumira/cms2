<?php

class Tenant extends CI_Model {

    var $table = 'tenants';
    var $table1 = 'notes';

    function __construct() {
        parent::__construct();
    }

    function Add($options = array()) {
        $this->db->insert($this->table, $options);
        return $this->db->insert_id();
    }

    function addnotes($options = array()) {
        $this->db->insert($this->table1, $options);
        return $this->db->insert_id();
    }

    function Get_Tenants($options = array()) {
        $this->db->select('*');
        $this->db->from($this->table);
        if (isset($options['building_id']))
            $this->db->where('tenants_b_id', $options['building_id']);
        if (isset($options['status']))
            $this->db->where('status', $options['status']);
        $query = $this->db->get();
        return$query->result_array();
    }

    function Get_Tenants2($options = array()) {
        $this->db->select('f_name, l_name, id');
        $this->db->from($this->table);
        if (isset($options['building_id']))
            $this->db->where('tenants_b_id', $options['building_id']);
        if (isset($options['status']))
            $this->db->where('status', $options['status']);
        $query = $this->db->get();
        return$query->result_array();
    }

    function Get_list($options = array()) {
        $query = $this->db->query("SELECT *  FROM `tenants` WHERE 'tenants_b_id'=" . $options['building_id']);
//        echo "Sila";
//        $this->db->select('*');
//       // $this->db->from('users');
//        $query = $this->db->get('users');
        return $query->result_array();
    }

    function Get($options = array()) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('buildings', 'tenants.tenants_b_id = buildings.b_id', 'LEFT');
        if (isset($options['tenant_id']))
            $this->db->where('id', $options['tenant_id']);
        if (isset($options['building_id']))
            $this->db->where('tenants_b_id', $options['building_id']);
        if (isset($options['status']))
            $this->db->where('status', $options['status']);
        $query = $this->db->get();
        return$query->result_array();
    }

    function Getnotes($options = array()) {
        $this->db->select('*');
        $this->db->from($this->table1);
//        $this->db->join('buildings', 'tenants.tenants_b_id = buildings.b_id', 'LEFT');
        $this->db->join('tenants', 'notes.notes_tenant_id = tenants.id', 'LEFT');
        if (isset($options['tenant_id']))
            $this->db->where('notes_tenant_id', $options['tenant_id']);
        if (isset($options['building_id']))
            $this->db->where('tenants_b_id', $options['building_id']);
        if (isset($options['status']))
            $this->db->where('status', $options['status']);
        if (isset($options['from_date']))
            $this->db->where('notes_date >=', date("Y-m-d H:i:s", strtotime($options['from_date'])));
        if (isset($options['to_date']))
            $this->db->where('notes_date <=', date("Y-m-d H:i:s", strtotime($options['to_date'])));
        $query = $this->db->get();
        return $query->result_array();
    }

    function GetAll($options = array()) {
        $this->db->select('*');
        if (isset($options['id']))
            $this->db->where('tenants.id', $options['id']);
        $this->db->from($this->table);
        $this->db->join('rooms', 'tenants.room_id = rooms.rm_id', 'LEFT');
        $this->db->join('buildings', 'tenants.tenants_b_id = buildings.b_id', 'LEFT');
        $this->db->join('floors', 'rooms.floor = floors.f_id', 'LEFT');
        if (isset($options['building_id']))
            $this->db->where('tenants_b_id', $options['building_id']);
        $query = $this->db->get();
        return $query->result_array();
    }

    function Delete($options = array()) {
        if (isset($options['id']))
            $this->db->where('id', $options['id']);
        $this->db->delete($this->table);
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

    function edit($options = array()) {
        if (isset($options['f_name']))
            $this->db->set('f_name', $options['f_name']);
        if (isset($options['name_last']))
            $this->db->set('l_name', $options['name_last']);
        if (isset($options['status']))
            $this->db->set('status', $options['status']);
        if (isset($options['email']))
            $this->db->set('email', $options['email']);
        if (isset($options['h_date']))
            $this->db->set('h_date', $options['h_date']);
        if (isset($options['s_date']))
            $this->db->set('s_date', $options['s_date']);
        if (isset($options['d_payment']))
            $this->db->set('d_payment', $options['d_payment']);
        if (isset($options['purpose']))
            $this->db->set('purpose', $options['purpose']);
        if (isset($options['c_person']))
            $this->db->set('c_person', $options['c_person']);
        if (isset($options['telephone']))
            $this->db->set('telephone', $options['telephone']);
        if (isset($options['phone_2']))
            $this->db->set('phone_2', $options['phone_2']);
        if (isset($options['phone_3']))
            $this->db->set('phone_3', $options['phone_3']);
        if (isset($options['c_phone']))
            $this->db->set('c_phone', $options['c_phone']);

        $this->db->where('id', $options['id']);
        $this->db->update('tenants');
        return $this->db->affected_rows();
    }

    function check_name($options = array()) {
        if (isset($options['f_name']))
            $this->db->where('f_name', $options['f_name']);
        if (isset($options['l_name']))
        $this->db->where('l_name', $options['l_name']);
        if (isset($options['email']))
        $this->db->where('email', $options['email']);
        $query = $this->db->get('tenants');
        if ($query->num_rows() != 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function get_tenant_notes($dates, $id) {

        $q = array();
        foreach ($dates as $v) {
            //echo $v."<br>";
            $this->db->select('subject,notes_description,added_by,notes_date');
            $this->db->like('notes_date', $v);
            $where = array('notes_tenant_id' => $id);
            $q1 = $this->db->get_where('notes', $where)->result_array();
            if (count($q1) > 0) {
                foreach ($q1 as $k => $vx) {
                    $q[] = $vx;
                }
            }
        }
        $ret = '';
        foreach ($q as $v) {
            $ret .= '<tr><td>' . $v['notes_date'] . '</td><td>' . $v['subject'] . '</td><td>' . $v['added_by'] . '</td><td>' . $v['notes_description'] . '</td></tr>';
        }
        return $ret;
    }

    function get_tenant_notes1($dates, $id) {
        foreach ($dates as $k => $v) {
            if ($k == 0) {
                $this->db->like('notes_date', $v);
            } else {
                $this->db->or_like('notes_date', $v);
            }
        }
        $where = array('notes_tenant_id' => $id);
        $q1 = $this->db->get_where('notes', $where)->result_array();
        //print_r($q1);
        $ret = '';
        foreach ($q1 as $v) {
            $ret .= '<tr><td>' . $v['notes_date'] . '</td><td>' . $v['subject'] . '</td><td>' . $v['added_by'] . '</td><td>' . $v['notes_description'] . '</td></tr>';
        }
        return $ret;
    }
    function get_excel_data($options=array()){
        $this->db->select('rm_id, room_name');
        $this->db->where('tenant_id', $options['ten_id']);
        $query = $this->db->get('rooms');
        $data = array(); $data2 = array();
        foreach($query->result_array() as $row){
            $cr = 0;
            $dr = 0;
            $vat = 0;
            $room_records = $this->get_rooms_records(array('ten_id'=>$options['ten_id'], 'records_rm_id'=>$row['rm_id'], 'start_date'=>$options['start_date'], 'end_date'=>$options['end_date']));
            
            $data2[] = array('room_name' => $row['room_name'], 'pay_amount_shs'=>'','d_payment' => '', 'xrate'=>'','particulars' => '', 'debit' => '', 'credit' => '', 'vat'=>'','bal'=>'');
            
            if(isset($room_records[0])){
                $data2[] = array('room_name' => '', 'd_payment' => '', 'xrate'=>'','pay_amount_shs'=>'', 'particulars' => 'Balance B/F', 'debit' => '', 'credit' => '', 'vat'=>'', 'bal'=>$room_records[0]['old_bal']);
            }
            foreach($room_records as $rm_stuff){
                //print_r($rm_stuff['pay_amount']); 
                $data['room_name'] = '';
                $data['d_payment'] = date('d-m-Y', strtotime($rm_stuff['d_payment']));
                $data['particulars'] = $rm_stuff['particulars'] . " " . $rm_stuff['pay_month'] . " - " . $rm_stuff['pay_year'];
                $data['xrate'] = $rm_stuff['x_rate'];
                $data['pay_amount_shs'] = $rm_stuff['pay_amount_shs'];
                if ($rm_stuff['bill_amount'] != 0) {
                    $data['debit'] = number_format(($rm_stuff['bill_amount']),0,'','');
                } else {
                    $data['debit'] = '';
                }
                if ($rm_stuff['pay_amount'] != 0) {
                    $data['credit'] = number_format(($rm_stuff['pay_amount']),2,'.','');
                    if($rm_stuff['vat']!=0){
                        $data['vat'] = number_format(floatval($rm_stuff['vat']),2,'.','');
                    }else{
                        $data['vat'] = '';
                    }
                    
                } else {
                    $data['credit'] = '';
                    $data['vat'] = '';
                }
                $data['bal'] = $rm_stuff['re_bal'];
                if($rm_stuff['particulars']=='RENT_BILL_OCCUPIED_X'){$cr += 0;$dr +=0;}else{$cr += ($rm_stuff['pay_amount']);$dr += $rm_stuff['bill_amount'];}
                $data2[] = $data;
                //$bal = $rm_stuff['re_bal']-$rm_stuff['vat']-$vat;
                $bal = $rm_stuff['re_bal'];
                $vat += $rm_stuff['vat'];                
            }
            $x_array = array('room_name' => '', 'd_payment' => '', 'pay_amount_shs'=>'', 'xrate'=>'','particulars' => 'TOTAL', 'debit' => $dr, 'credit' => $cr, 'vat'=>'');
            if(isset($bal)){$x_array['bal']=$bal;}else{$x_array['bal']=0;}
            $data2[] = $x_array;       
        }
        //print_r($data2);
        return $data2;
    }
    
    function get_rooms_records($options=array()){
        $this->db->select('records.d_payment, pay_amount, bill_amount, particulars, pay_month, pay_year, re_bal, vat, old_bal,x_rate, pay_amount_shs');
        $this->db->from('records');
        $this->db->join('rooms', 'records.records_rm_id = rooms.rm_id', 'LEFT');
        $this->db->where('records.tenant_id', $options['ten_id']);
        $this->db->where('records_rm_id', $options['records_rm_id']);
        $this->db->order_by('records.receit_no');
        $this->db->not_like('particulars', 'UMEME');
        if (isset($options['start_date']))
            $this->db->where('records.d_payment >=', $options['start_date']);
        if (isset($options['end_date']))
            $this->db->where('records.d_payment <=', $options['end_date']);
        $query = $this->db->get();
        return $query->result_array();
    }

    /*function get_excel_data($options = array()) {
        $this->db->select('records.d_payment, pay_amount, bill_amount, particulars, pay_month, pay_year, room_name, re_bal, vat');
        $this->db->from('records');
        $this->db->join('rooms', 'records.records_rm_id = rooms.rm_id', 'LEFT');
        $this->db->where('records.tenant_id', $options['ten_id']);
        $this->db->not_like('particulars', 'UMEME');
        $this->db->order_by('room_name');
        $this->db->order_by('d_payment', 'asc');
        if (isset($options['start_date']))
            $this->db->where('records.d_payment >=', $options['start_date']);
        if (isset($options['end_date']))
            $this->db->where('records.d_payment <=', $options['end_date']);
        $query = $this->db->get();
        $data = array();
        $data2 = array();
        $cr = 0;
        $dr = 0;
        $vat = 0;
        $roomName = $query->result_array()[0]['room_name'];
        foreach ($query->result_array() as $row) {
            for(i=0;i < $query->result_array()->num_rows())
            if($row['room_name'])
            $data['room_name'] = $row['room_name'];
            $data['d_payment'] = date('d-m-Y', strtotime($row['d_payment']));
            $data['particulars'] = $row['particulars'] . " " . $row['pay_month'] . " - " . $row['pay_year'];
            if ($row['bill_amount'] != 0) {
                $data['debit'] = number_format(($row['bill_amount']),0,'','');
            } else {
                $data['debit'] = '';
            }
            if ($row['pay_amount'] != 0) {
                //$data['credit'] = number_format($row['pay_amount'],0,'','');
                $data['credit'] = number_format(floatval($row['pay_amount']+$row['vat']),2,'.','');
            } else {
                $data['credit'] = '';
            }
            $data['bal'] = $row['re_bal']-$row['vat']-$vat;
             if($row['particulars']=='RENT_BILL_OCCUPIED_X'){$cr += 0;$dr +=0;}else{$cr += ($row['pay_amount']+$row['vat']);$dr += $row['bill_amount'];}
//            $cr += $row['pay_amount'];
//            $dr += $row['bill_amount'];
            $data2[] = $data;
            $bal = $row['re_bal']-$row['vat']-$vat;
            $vat += $row['vat'];
        }
        $x_array = array('room_name' => '', 'd_payment' => '', 'particulars' => 'TOTAL', 'debit' => $dr, 'credit' => $cr);
        if(isset($bal)){$x_array['bal']=$bal;}else{$x_array['bal']=0;}
        $data2[] = $x_array;
        
        return $data2;
    }*/

    function get_tenant_name($options = array()) {
        $this->db->select('f_name, l_name');
        $this->db->where('id', $options['ten_id']);
        $query = $this->db->get('tenants');
        return $query->result_array();
    }
    function get_tenant_phone($options=array()) {
        $this->db->select('telephone');
        $this->db->where('id', $options['ten_id']);
        $query = $this->db->get('tenants');
        $x = $query->result_array();
        return $x[0]['telephone'];
    }

}
