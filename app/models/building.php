<?php

class Building extends CI_Model {

    var $table = 'buildings';

    function __construct() {
        parent::__construct();
        $this->load->model('landlord');
        $this->load->model('user');
        $this->load->model('room');
        $this->load->model('tenant');
    }


    function Add($options = array()) {
        $this->db->insert($this->table, $options);
        return $this->db->insert_id();
    }

    public function get_free_rooms(){
        //$rooms1 = $this->room->get_room(array('rooms_b_id' => $this->session->userdata('building_id'), 'rm_status' => 'VACANT'));
        $this->db->select('rm_id,room_name,rm_cost,currency');
        $this->db->join('buildings', 'buildings.b_id = rooms.rooms_b_id', 'LEFT');
        $rooms1 = $this->db->get_where('rooms',array('rm_cost >'=>0,'rooms_b_id' => $this->session->userdata('building_id'), 'rm_status' => 'VACANT'))->result_array();
//        print_r($rooms1);
//        return;
        $rooms = NULL;
        foreach ($rooms1 as $row) {
            //$tenants.="<option value=" . $row['rm_id'] . ">" . $row['room_name'] . "  at a monthly rent of " . $row['rm_cost'] . " " . $row['currency'] . "</option>";
            $rooms[] = array('id' => $row['rm_id'], 'rm' => $row['room_name'] . "  at a monthly rent of " . number_format($row['rm_cost'],0) . " " . $row['currency']);
        }
        return $rooms;
    }
    public function reg_form_drops() {
        $vals = $this->user->Get_List();

        $query = $this->landlord->Get_List();
        $landlords = NULL;
        $managers = NULL;
        $rooms = NULL;
        $tenants = NULL;
        if ($this->session->userdata('building_id') != null) {
            $ten = $this->tenant->Get_list(array('building_id' => $this->session->userdata('building_id')));
            foreach ($ten as $row) {
                //$tenants.="<option value=" . $row['rm_id'] . ">" . $row['room_name'] . "  at a monthly rent of " . $row['rm_cost'] . " " . $row['currency'] . "</option>";
                $tenants[] = array('id' => $row['id'], 't_name' => $row['f_name'] . $row['l_name']);
            }
        }
        $groups = $this->landlord->Get_list2(array());
        $group = NULL;


        $rooms1 = $this->room->get_room(array('rooms_b_id' => $this->session->userdata('building_id'), 'rm_status' => 'VACANT'));

        $rooms = NULL;
        foreach ($rooms1 as $row) {
            //$tenants.="<option value=" . $row['rm_id'] . ">" . $row['room_name'] . "  at a monthly rent of " . $row['rm_cost'] . " " . $row['currency'] . "</option>";
            $rooms[] = array('id' => $row['rm_id'], 'rm' => $row['room_name'] . "  at a monthly rent of " . $row['rm_cost'] . " " . $row['currency']);
        }

        foreach ($groups as $row) {
            //$group.="<option value=" . $row['group'] . ">" . $row['group'] . "</option>";
            $group[] = array('group' => $row['group']);
        }
        foreach ($query as $rowx) {
            //$landlords.="<option value=" . $rowx['id'] . ">" . $rowx['l_name_first'] . " " . $rowx['l_name_last'] . "</option>";
            $landlords[] = array('id' => $rowx['id'], 'name' => $rowx['l_name_first'] . ' ' . $rowx['l_name_last']);
        }
        foreach ($vals as $row) {
            //$managers.="<option value=" . $row['name_id'] . ">" . $row['name_first'] . " " . $row['name_last'] . "</option>";
            $managers[] = array('id' => $row['name_id'], 'name' => $row['name_first'] . " " . $row['name_last']);
        }
        $x['groups'] = $group;
        $x['landlords'] = $landlords;
        $x['managers'] = $managers;
        $x['rooms'] = $rooms;
        $x['tenants'] = $tenants;

        return $x;
    }

    function Update($options = array()) {
        if (isset($options['b_name']))
            $this->db->set('b_name', $options['b_name']);
        if (isset($options['p_o_box']))
            $this->db->set('p_o_box', $options['p_o_box']);
        if (isset($options['b_landlord_id']))
            $this->db->set('b_landlord_id', $options['b_landlord_id']);
        if (isset($options['num_floors']))
            $this->db->set('b_num_floors', $options['num_floors']);
        if (isset($options['b_town']))
            $this->db->set('b_town', $options['b_town']);
        if (isset($options['b_district']))
            $this->db->set('b_district', $options['b_district']);
        if (isset($options['b_manager_id']))
            $this->db->set('b_manager_id', $options['b_manager_id']);
        if (isset($options['b_description']))
            $this->db->set('b_description', $options['b_description']);
        if (isset($options['currency']))
            $this->db->set('currency', $options['currency']);
        if (isset($options['block']))
            $this->db->set('block', $options['block']);
        if (isset($options['street']))
            $this->db->set('street', $options['street']);
        if (isset($options['plot']))
            $this->db->set('plot', $options['plot']);
        if (isset($options['property_no']))
            $this->db->set('property_no', $options['property_no']);
        if (isset($options['flrs']))
            $this->db->set('b_num_floors', ($options['flrs'] + $options['fl']));
        if (isset($options['b_type']))
            $this->db->set('b_type', $options['b_type']);
        $this->db->where('b_id', $options['b_id']);

        $this->db->update($this->table);
        return $this->db->affected_rows();
    }

    function GetRevenue($options = array()) {
        $this->db->select('SUM(pay_amount) as subtotal');
        $this->db->from('rooms');
        $this->db->join('records', 'rooms.rm_id = records.records_rm_id', 'LEFT');
        $this->db->where('rooms_b_id', $options['b_id']);
        if(isset($options['rm_id']))
             $this->db->where('records_rm_id', $options['rm_id']);
        $this->db->not_like('particulars', 'umeme');
        $query = $this->db->get();
        return $query->result_array();
    }

    function Get_Total_Revenue($options = array()) {
        $this->db->select('SUM(pay_amount) as subtotal');
        $this->db->from('rooms');
        $this->db->join('records', 'rooms.rm_id = records.records_rm_id', 'LEFT');
        $this->db->join('buildings', 'rooms.rooms_b_id = buildings.b_id', 'LEFT');
        $this->db->where('b_landlord_id', $options['l_id']);
        $query = $this->db->get();
        return $query->result_array();
    }

    function Get($options = array()) {
        $this->db->select('*');
        $this->db->from($this->table);
        if (isset($options['l_id']))
            $this->db->where('b_landlord_id', $options['l_id']);
        if (isset($options['building_id']))
            $this->db->where('b_id', $options['building_id']);
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_building($options = array()) {
        $this->db->select('b_name, b_id, b_num_floors');
        if (isset($options['building_id']))
            $this->db->where('b_id', $options['building_id']);
        if (isset($options['l_id']))
            $this->db->where('b_landlord_id', $options['l_id']);
        $query = $this->db->get('buildings');
        return $query->result_array();
    }

    function get_umeme($options = array()) {
        $this->db->select('*');
        $this->db->from('umeme');
        if (isset($options['id']))
            $this->db->where('id', $options['id']);
        $this->db->where('u_b_id', $this->session->userdata('building_id'));
        $query = $this->db->get();
        return $query->result_array();
    }

    function edit($options = array()) {
        if (isset($options['quantity']))
            $this->db->set('quantity', $options['quantity']);
        if (isset($options['rate']))
            $this->db->set('rate', $options['rate']);
        $this->db->where('id', $options['id']);
        $this->db->update('umeme');
        return $this->db->affected_rows();
    }

     function GetBuilding($options = array()) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('landlords', 'buildings.b_landlord_id = landlords.id', 'LEFT');
        $this->db->join('users', 'buildings.b_manager_id = users.name_id', 'LEFT');
        if (isset($options['b_landlord_id']))
            $this->db->where('b_landlord_id', $options['b_landlord_id']);
        if (isset($options['building_id']))
            $this->db->where('b_id', $options['building_id']);
        if (isset($options['b_id']))
            $this->db->where('b_id', $options['b_id']);
        if (isset($options['manager_id']))
            $this->db->where('b_manager_id', $options['manager_id']);
        $query = $this->db->get();
        return$query->result_array();
    }
    function GetBuildingFloors($options = array()) {
        $this->db->select('flr_name, f_id');
        $this->db->from('floors');
        if (isset($options['b_id']))
            $this->db->where('b_id', $options['b_id']);
        $query = $this->db->get();
        return$query->result_array();
    }

    function Delete($options = array()) {

    }

    function get_excel_data($building_id, $start, $end) {
        $data = array();
        $data2 = array();
        $rooms = $this->room->get_room_stuff($options = array('building_id' => $building_id, 'status' => 'OCCUPIED'));
        if (count($rooms) != 0) {
            foreach ($rooms as $room) {
                $cr = 0;
                $dr = 0;
                $records = $this->room->get_room_records(array('rm_id' => $room['rm_id'], 'ten_id' => $room['tenant_id'], 'start_date' => date('Y-m-d', strtotime($start)), 'end_date' => date('Y-m-d', strtotime($end))));
                $data2[] = array('ten_name' => $room['f_name'] . " " . $room['l_name']." - ".$room['room_name'], 'date' => '', 'particulars' => '', 'trans_no' => '', 'debit' => '', 'credit' => '', 'balance' => '');

                if (isset($records[0]['old_bal'])) {
                    $balance = $records[0]['old_bal'];
                } else {
                    //$cred = $this->room->get_room_credit2(array('rm_id' => $room['rm_id'], 'tenant_id' => $room['tenant_id'], 'start_date' => date('Y-m-d', strtotime($start)), 'end_date' => date('Y-m-d', strtotime($end))));
//                    $balance = $cred[0]['debit']-$cred[0]['credit'];
                    //You have to get the latest record of this room and get its balance...
                    $balance = 0;
                }

//                if ($balance >= 0) {
//                    $data2[] = array('ten_name' => '', 'date' => $start, 'particulars' => 'Balance C/F', 'trans_no' => '', 'debit' => $balance, 'credit' => '', 'balance' => '');
//                    $cr += $balance;
//                } else {
//                    $data2[] = array('ten_name' => '', 'date' => '', 'trans_no' => '', 'particulars' => 'Balance B/F', 'debit' => '', 'credit' => (-1 * $balance), 'balance' => '');
//                    $dr += (-1 * $balance);
//                }
                foreach ($records as $record) {
                    $data['ten_name'] = '';
                    $data['date'] = date('d-m-Y', strtotime($record['d_payment']));
                    $data['trans_no'] = $record['rec_num'];
                    $data['particulars'] = $record['particulars'] . " " . $record['pay_month'] . " - " . $record['pay_year'];
                    $data['debit'] = $record['bill_amount'];
                    $data['credit'] = $record['pay_amount'];
                    if($record['particulars']=='RENT_BILL_OCCUPIED_X'){$cr += 0;$dr +=0;}else{$cr += $record['pay_amount'];$dr += $record['bill_amount'];}

                    $data['balance'] = $record['re_bal']; //$data['debit']-$data['credit'];
                    $balance = $record['re_bal'];
                    $data2[] = $data;
                }
                $data2[] = array('ten_name' => '', 'date' => '', 'trans_no' => '', 'particulars' => 'TOTAL', 'debit' => $dr, 'credit' => $cr, 'balance' => $balance);
                //print_r($data2);
//$data2['line'] = TRUE;
            }
            return $data2;
        } else {
            $data2[] = array('ten_name' => '', 'date' => '', 'particulars' => 'NO ROOMS AVAILABLE IN THAT BUILDING', 'debit' => '', 'credit' => '', 'balance' => '');
            return $data2;
        }
    }

    public function get_by_id($id, $table_name, $parameter) {
        $this->db->select($parameter);
        $this->db->join('users', 'name_id=b_manager_id', 'LEFT');
        $q = $this->db->get_where($table_name, array('b_id' => $id))->result_array();

        if (isset($q[0])) {
            return $q[0];
        }else
            return $q;
    }

    public function get_b_name($id) {
        $this->db->select('b_name');
        $q = $this->db->get_where('buildings', array('b_id' => $id))->result_array();
        if (isset($q[0])) {
            return $q[0];
        }else
            return $q;
    }

    public function check_b_name($name) {
        $query = $this->db->get_where('buildings', array('b_name' => $name));
        if ($query->num_rows() != 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function get_umeme_statement($options = array()) {
        $this->db->select('*');
        $this->db->from('umeme');
        if (isset($options['id']))
            $this->db->where('id', $options['id']);
        $this->db->where('u_b_id', $this->session->userdata('building_id'));
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_rooms_umeme($options = array()) {
        $this->db->select('rm_id, room_name, SUM(pay_amount) as credit, SUM(bill_amount) as debit');
        $this->db->from('rooms');
        $this->db->join('records', 'records.records_rm_id = rooms.rm_id');
        if (isset($options['rm_id']))
            $this->db->where('records.rm_id', $options['rm_id']);
        if (isset($options['particulars']))
            $this->db->like('records.particulars', $options['particulars']);
        if (isset($options['b_id']))
            $this->db->where('rooms.rooms_b_id', $options['b_id']);
        $this->db->group_by('rm_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_rooms_umeme_details($options = array()) {
        $this->db->select('records.d_payment, room_name, particulars, bill_amount, pay_amount,rec_num, re_bal');
        $this->db->from('records');
        $this->db->join('rooms', 'rooms.rm_id = records.records_rm_id');
        $this->db->like('records.particulars', $options['particulars']);
        if (isset($options['rm_id']))
            $this->db->where('records.records_rm_id', $options['rm_id']);
        $query = $this->db->get();
        return $query->result_array();
    }

    function diff($param){
        $data = array('param'=>$param);
        $where = array('id'=>1);
        $this->db->update('settings',$data,$where);
    }

}