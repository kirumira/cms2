<?php

class Landlord extends CI_Model {

    var $table = 'landlords';
    var $table2 = 'groups';

    function __construct() {
        parent::__construct();
        $this->load->model('bill');
        $this->load->model('floor');
    }

    function Add($options = array()) {
        $this->db->insert($this->table, $options);
        return $this->db->insert_id();
    }

    function Get_list() {
        $query = $this->db->query("SELECT *  FROM `landlords`");
//        echo "Sila";
//        $this->db->select('*');
//       // $this->db->from('users');
//        $query = $this->db->get('users');
        return $query->result_array();
    }

    function get_bounced_data($options = array()){
        $this->db->select('records.d_payment, pay_amount, pay_month, pay_year, records.cheque, details, rec_num, vat, f_name, l_name, x_rate, b_name, currency,room_name');
        $this->db->from('records');
        $this->db->join('tenants', 'tenants.id = records.tenant_id', 'LEFT');
        $this->db->join('rooms', 'records.records_rm_id=rooms.rm_id', 'LEFT');
        $this->db->join('bounced_cheqs', 'receit_no=rec_id');
        $this->db->join('buildings', 'rooms_b_id=b_id');
        $this->db->join('landlords', 'b_landlord_id=landlords.id');
        $this->db->where('landlords.id', $options['landlord_id']);
        $this->db->where('bill_amount', 0);
        $this->db->where('records.d_payment >=', $options['start']);
        $this->db->where('records.d_payment <=', $options['end']);
        $this->db->where('isdeleted', 1);
        $this->db->not_like('particulars', 'UMEME');
        $this->db->group_by('receit_no');
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
            $data['cheque'] = $row['cheque'];
            $data['reason'] = $row['details'];
            if($row['currency']=='USD'){
                $data['amountUSD'] = 0;
                $data['vatUSD'] =0;
                $data['totalUSD'] = $row['vat']+$row['pay_amount'];
                $total_USD += $row['pay_amount'];
                $total_VAT_USD += $row['vat'];
                $total_total_USD += $data['totalUSD'];
                $data['amountUGX'] = 0;
                $data['vatUGX'] =0;
                $data['totalUGX'] = 0;
            }else{
                $data['amountUGX'] = 0;
                $data['vatUGX'] =0;
                $data['totalUGX'] = $row['vat']+$row['pay_amount'];
                $total_UGX += $row['pay_amount'];
                $total_VAT_UGX += $row['vat'];
                $total_total_UGX += $data['totalUGX'];
                $data['amountUSD'] = 0;
                $data['vatUSD'] =0;
                $data['totalUSD'] = 0;
            }
            $data2[] = $data;

        }
        $data2[] = array('date'=>'','b_name'=>'','tenant'=>'' ,'period'=>'', 'cheque'=>'', 'reason'=>'TOTAL', 'amountUGX'=>$total_UGX, 'vatUGX'=>$total_VAT_UGX, 'totalUGX'=>$total_total_UGX, 'amountUSD'=>$total_USD, 'vatUSD'=>$total_VAT_USD, 'totalUSD'=>$total_total_USD);
        //print_r($data2);
        return $data2;
    }

    function Get($options = array()) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('buildings', 'landlords.id = buildings.b_landlord_id', 'LEFT');
        if (isset($options['landlord_id']))
            $this->db->where('id', $options['landlord_id']);
        if (isset($options['building_id']))
            $this->db->where('landlords_b_id', $options['building_id']);
        $query = $this->db->get();
        return $query->result_array();
    }

    function check_name($options = array()) {
        $this->db->select('l_name_first');
        $this->db->from('landlords');
        if (isset($options['l_name_first']))
            $this->db->where('l_name_first', $options['l_name_first']);
        if (isset($options['building_id']))
            $this->db->where('landlords_b_id', $options['building_id']);
        $query = $this->db->get();
        return $query->result_array();
    }

    function edit($options = array()) {
        if (isset($options['f_name']))
            $this->db->set('l_name_first', $options['f_name']);
        if (isset($options['name_last']))
            $this->db->set('l_name_last', $options['name_last']);
        if (isset($options['group']))
            $this->db->set('group', $options['group']);
        if (isset($options['email']))
            $this->db->set('l_email', $options['email']);
        if (isset($options['telephone']))
            $this->db->set('telephone', $options['telephone']);

        $this->db->where('id', $options['id']);
        $this->db->update('landlords');
        return $this->db->affected_rows();
    }

    function Get_list2() {
        $query = $this->db->query("SELECT *  FROM `landlords`");
//        echo "Sila";
//        $this->db->select('*');
//       // $this->db->from('users');
//        $query = $this->db->get('users');
        return $query->result_array();
    }

    function GetAll($options = array()) {
        $this->db->select('*');
        $this->db->from($this->table);
//        $this->db->join('buildings', 'landlords.id = buildings.b_landlord_id', 'LEFT');
        $query = $this->db->get();
        return $query->result_array();
    }

    function edit_landlord($options = array()) {

        if (isset($options['f_name']))
            $this->db->set('l_name_first', $options['f_name']);
        if (isset($options['l_name']))
            $this->db->set('l_name_last', $options['l_name']);
        if (isset($options['email']))
            $this->db->set('l_email', $options['email']);
        if (isset($options['telephone']))
            $this->db->set('telephone', $options['telephone']);
        if (isset($options['building_id']))
            $this->db->set('landlords_b_id', $options['building_id']);

        $this->db->where('id', $options['landlord_id']);
        $this->db->update($this->table);
    }

    function get_report_data($options = array()) {
        $this->db->select('l_name_last, l_name_first, l_email, telephone, pic_path');
        $this->db->where('landlords.id', $options['l_id']);
        $query = $this->db->get('landlords');
        return $query->result_array();
    }

    function Delete($options = array()) {
        if (!$this->_required(array('landlord_id'), $options)) {
            return FALSE;
        }
        $this->db->where('id', $options['landlord_id']);
        $this->db->delete($this->table);
    }

    function add_group($options = array()) {
        $this->db->insert('groups', $options);
        return $this->db->insert_id();
    }

    function delete_group($options = array()) {
        if (!$this->_required(array('grp_id'), $options)) {
            return FALSE;
        }
        $this->db->where('grp_id', $options['grp_id']);
        $this->db->delete($this->table2);
    }

    function update_group($options = array()) {
        if (!$this->_required(array('grp_id'), $options)) {
            return FALSE;
        }
        if (isset($options['grp_name']))
            $this->db->set('grp_name', $options['grp_name']);
        $this->db->where('grp_id', $options['grp_id']);
        $this->db->update($this->table2);
    }

    function get_group($options = array()) {
        $this->db->select('*');
        $this->db->from($this->table2);
        if (isset($options['grp_id']))
            $this->db->where('grp_id', $options['grp_id']);
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_group_excel_data($options = array()) {

    }

    function get_landlord_name($options = array()) {
        $this->db->select('l_name_first, l_name_last');
        $this->db->where('id', $options['landlord_id']);
        $query = $this->db->get('landlords');
        $x = $query->result_array();
        $name = $x[0]['l_name_first'] . " " . $x[0]['l_name_last'];
        return $name;
    }

    function get_excel_data($options = array()) {
        $this->db->select('b_name, b_num_floors, b_id, currency');
        $this->db->from('buildings');
        $this->db->where('b_landlord_id', $options['landlord_id']);
        $query = $this->db->get();
        $data = array();
        $data2 = array();
        $x = array();
        $p = 0;
        $v = 0;
        $e = 0;
        $r = 0;
        foreach ($query->result_array() as $row) {
            $data['b_name'] = $row['b_name']." (".$row['currency'].")";
            $data['b_num_rooms'] = $this->floor->get_total_rms2(array('building_id' => $row['b_id']));
            $data['potential'] = $this->bill->get_total_bills(array('building_id' => $row['b_id'], 'start_date' => $options['start_date'], 'end_date' => $options['end_date']));
            $data['vacant'] = $this->bill->get_total_bills(array('building_id' => $row['b_id'], 'particulars' => 'RENT_BILL_VACANT', 'start_date' => $options['start_date'], 'end_date' => $options['end_date']));
            $data['expected'] = $this->bill->get_total_bills(array('building_id' => $row['b_id'], 'particulars' => 'RENT_BILL_OCCUPIED', 'start_date' => $options['start_date'], 'end_date' => $options['end_date']));
            $data['received'] = $this->bill->get_total_payments(array('building_id' => $row['b_id'], 'start_date' => $options['start_date'], 'end_date' => $options['end_date']));

            $p += $data['potential'];
            $v += $data['vacant'];
            $e += $data['expected'];
            $r += $data['received'];
            $data['outstanding'] = $data['expected'] - $data['received'];
            $data2[] = $data;
        }
        return $data2;
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
function Get2($options = array()) {
    if ($options == null) {
        $query = $this->db->get($this->table);
    } else {
        $this->db->select('*');
        $this->db->from('landlords');
        if (isset($options['name_user']))
            $this->db->where('l_email', $options['name_user']);
        if (isset($options['name_passwordr']))
            $this->db->where('pass', $options['name_password']);
        $query = $this->db->get();
       if ($query->num_rows() > 0){
       
            return $query->result_array();
       }else{
            return FALSE;
        }
        

    }
}
}