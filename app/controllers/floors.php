<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Floors extends CI_Controller {

    var $x;
    public function __construct() {
        parent::__construct();
        if (!($this->session->userdata('is_logged_in')))
        //redirect(base_url() . 'login');
            $this->load->model('room');
        $this->load->model('building');
        $this->load->model('tenant');
        $this->load->model('audittrails');
        $this->load->model('floor');
        $this->load->model('bill');
        $this->x = $this->building->reg_form_drops();   
        $this->x['floor_names'] = $this->floor->get_all_floors(); 
    }

    public function get_room_details() {
        $options = array(
            'rm_id' => $this->input->post('rm_id')
        );
        $y = $this->bill->get_room($options);
        $data['room_name'] = $y[0]['room_name'];
        $data['rm_cost'] = $y[0]['rm_cost'];
        $data['tenant_id'] = $y[0]['tenant_id'];
        $data['debit'] = $y[0]['debit'];
        $data['credit'] = $y[0]['credit'];
        $data['tn_tel'] = $y[0]['telephone'];
        $x = array('status' => true, 'data' => $data);
        echo json_encode($x);
        exit;
    }

    function define_letters($i) {
        $alphabet = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
        if ($i <= 25) {
            return $alphabet[($i)];
        }
        if (($i > 25) && ($i <= 50)) {
            $i -= 25;
            return $alphabet[0] . $alphabet[$i - 1];
        }
    }

    function billed($floor_num) {
        $rooms = $this->room->get_room(array('rooms_b_id' => $this->session->userdata('building_id'), 'floor_num' => $floor_num, 'billed' => 'true'));        
        $data['floor'] = $floor_num;
        $data['f_id'] = $floor_num;
        $data['flr_name'] = $this->floor->get_fl_name($floor_num);//$rooms[0]['flr_name'];
        //if ($rooms) {
        $data['rooms'] = $rooms;
        $options = array();
        $total = 0;
        $revenue = $this->room->GetRevenue(array('b_id' => $this->session->userdata('building_id')));
        $row['revenue'] = $revenue[0]['subtotal'];
        $total += $revenue[0]['subtotal'];
        $data['total'] = $total;
        foreach ($rooms as $room) {
            $evictions = $this->room->evictions(array('rm_id' => $room['rm_id'], 'date' => TRUE));
            if (isset($evictions[0]['ev_ten_id']) && ($evictions[0]['ev_ten_id'] == $room['tenant_id'])) {
                $room['rm_status'] = 'PENDING EVICTION';
                $options[] = $room;
            } else {
                $options[] = $room;
            }
        }
        $data['rooms'] = $options;
        //$x = $this->building->reg_form_drops();
        $this->load->view('accounts_header'); //('xx_header');
        $this->x['active'] = 'FL';
        $this->load->view('xx_menu', $this->x);
        $this->load->view('view_floor', $data);
        $this->load->view('xx_footer');
        //}
    }

    public function floor($floor_num) {
        $tenants = $this->tenant->Get_Tenants(array('building_id' => $this->session->userdata('building_id')));
        $rooms = $this->room->get_rooms(array('rooms_b_id' => $this->session->userdata('building_id'), 'floor' => $floor_num));

        $floor_id = $this->floor->get_floor_id(array('f_id' => $floor_num));
        $data['floor'] = $floor_num;
        $data['f_id'] = $floor_id[0]['f_id'];
        $data['flr'] = $floor_id[0]['flr'];
        $data['flr_name'] = $floor_id[0]['flr_name'];
        $data['fl_rms'] = $floor_id[0]['n_rms'];
        $data['rooms'] = $rooms;
        if ($rooms && count($floor_id) != 0) {
            $options = array();
            foreach ($rooms as $room) {
                $evictions = $this->room->evictions(array('rm_id' => $room['rm_id'], 'date' => TRUE));
                if (isset($evictions[0]['ev_ten_id']) && ($evictions[0]['ev_ten_id'] == $room['tenant_id'])) {
                    $room['rm_status'] = 'PENDING EVICTION';
                    $options[] = $room;
                } else {
//                    if($room['status'] == 'POTENTIAL'){$options['rm_status'] = 'BOOKED';}
                    $options[] = $room;
                }
            }
            $data['rooms'] = $options;
            $data['tenants'] = $tenants;
            //$x = $this->building->reg_form_drops();
            $this->load->view('accounts_header'); //('xx_header');
            $this->x['active'] = 'FL';
            $this->load->view('xx_menu', $this->x);
            $this->load->view('view_floor', $data);
            $this->load->view('xx_footer');
        } else {

            $this->form_validation->set_rules('rm_num', 'Number of Rooms', 'trim|required|integer');
            if ($this->form_validation->run()) {
                $options = array(
                    'flr' => $this->input->post('flr'),
                    'f_id' =>$floor_num,
                    'b_id' => $this->session->userdata('building_id'), 
                    'n_rms' => $this->input->post('rm_num')
                        );
                $flr = $this->input->post('flr');
                $this->floor->update_floor($options);
                $num_rooms = $this->input->post('rm_num');
                $flr_letter = $this->define_letters($flr - 1);
                
                for ($i = 1; $i <= $num_rooms; $i++) {
                    $options2 = array('floor' => $floor_num, 'rooms_b_id' => $this->session->userdata('building_id'), 'room_name' => $flr_letter . $i);
                    $this->room->Add($options2);
                }
                redirect('floors/floor/' . $floor_num);
            }
            //$x = $this->building->reg_form_drops();
            $this->load->view('accounts_header'); //('xx_header');
            $this->x['active'] = 'FL';
            $this->load->view('xx_menu', $this->x);
            $this->load->view('add_num_rooms', $data);
            $this->load->view('xx_footer');
        }
    }

    function add_x_rms() {
        $options = array('flr' => $this->input->post('flr'), 'b_id' => $this->session->userdata('building_id'), 'n_rms' => $this->input->post('rm_num'));
        $this->floor->add_num_rms($options);
        $num_rooms = $this->input->post('rm_num');
        $flr_letter = $this->define_letters($floor_num - 1);
        for ($i = 1; $i <= $num_rooms; $i++) {
            $options2 = array('floor' => $floor_num, 'rooms_b_id' => $this->session->userdata('building_id'), 'room_name' => $flr_letter . $i);
            $this->room->Add($options2);
        }
        //redirect('floors/floor/' . $floor_num);
    }

    function add_floors() {

        $fl = $this->building->Get(array('building_id' => $this->session->userdata('building_id')));
        $options = array('flrs' => $this->input->post('floors'), 'fl' => $fl[0]['b_num_floors'], 'b_id' => $this->session->userdata('building_id'));
        $this->building->Update($options);

        for ($i = ($fl[0]['b_num_floors']+1); $i <= ($this->input->post('floors')+$fl[0]['b_num_floors']); $i++) {
                if (($i == 1) || ($i == 21) || ($i == 31) || ($i == 41)) {
                    $flr_name = $i . 'st Floor';
                } elseif (($i == 2) || ($i == 22) || ($i == 32) || ($i == 42)) {
                    $flr_name = $i . 'nd Floor';
                } elseif (($i == 3) || ($i == 23) || ($i == 33) || ($i == 43)) {
                    $flr_name = $i . 'rd Floor';
                } else {
                    $flr_name = $i . 'th Floor';
                }
                $floors = $this->floor->add_floors(array('flr' => $i, 'flr_name' => $flr_name, 'b_id' => $this->session->userdata('building_id')));
            }
        echo json_encode(array('status' => true));
        exit;
    }

    function edit_balance() {
        $rm_id = $this->input->post('rm_id');
        $room_data = $this->room->get_room_name2(array('rm_id'=>$rm_id));
        echo json_encode(array('status' => true, 'rm_name' => $room_data[0]['room_name'], 'rm_cost' => $room_data[0]['rm_cost']));
        exit;
    }

    function edit_room_balance(){
        $rm = $this->room->get_rm_stuff(array('rm_id'=>$this->input->post('room_id')));
        $balance = ((str_replace(',','',$this->input->post('debit')))-(str_replace(',','',$this->input->post('credit'))));
        $options=array('rm_id'=>$this->input->post('room_id'), 'credit'=>str_replace(',','',$this->input->post('credit')), 'debit'=>str_replace(',','',$this->input->post('debit')));
        $x = $this->room->edit_rm_bal($options);
        $bal_options = array(
                        'bal_rm_id'=>$this->input->post('room_id'), 
                        'bal_ten_id'=>$rm[0]['tenant_id'], 
                        'bal_man_id'=>$this->session->userdata('name_id'), 
                        'bal_before'=>($rm[0]['debit']-$rm[0]['credit']), 
                        'bal_after'=>(str_replace(',','',$this->input->post('debit')))-(str_replace(',','',$this->input->post('credit'))));
        $this->room->Add_Bal_Change($bal_options);
        $pay_options = array(
                        'd_payment'=>date('Y-m-d'), 
                        'particulars'=>'Balance Adjustment', 
                        'tenant_id'=>$rm[0]['tenant_id'], 
                        'records_rm_id'=>$this->input->post('room_id'), 
                        'old_bal'=>($rm[0]['debit']-$rm[0]['credit']), 
                        're_bal'=>$balance);        
        if($balance>=0){
            $pay_options['pay_amount']=0; $pay_options['bill_amount']=$balance;
        }else{
            $pay_options['pay_amount']=(-1*$balance); $pay_options['bill_amount']=0;
        }
        $this->bill->add_payment($pay_options);
        echo json_encode(array('status' => TRUE , 'data'=>$x));
        exit;
    }

    public function addroom() {
        $options = array(
            'room_name' => $this->input->post('room'),
            'description' => $this->input->post('desc'),
            'rm_cost' => $this->input->post('rent'),
            'floor' => $this->input->post('floor'),
            'rooms_b_id' => $this->session->userdata('building_id')
        );
        $this->room->Add($options);
        echo json_encode(array('status' => true));
        exit;
    }

    public function view_room($m_id) {
        $room_data = $this->room->get_room(array('rm_id' => $m_id));
        $data['ten'] = $room_data;
        //$x = $this->building->reg_form_drops();
        $this->load->view('accounts_header'); //('xx_header');
        $this->x['active'] = 'FL';
        $this->load->view('xx_menu', $this->x);
        $this->load->view('view_room', $data);
        $this->load->view('xx_footer');
    }

    public function view_room1() {
        $rm_id = $this->input->post('rm_id');
        $room_data = $this->room->get_room(array('rm_id' => $rm_id));
        echo json_encode(array('status' => true, 'data' => $room_data[0]));
        return;
    }

    public function get_vacant_rooms() {
        $rooms = $this->room->get_vacant_rooms(array('b_id' => $this->session->userdata('building_id')));
        $str = '<option value="Select Option">Select Option</option>';
        foreach ($rooms as $room) {
            $str .= '<option value="' . $room['rm_id'] . '">' . $room['room_name'] . ' at a monthly rent of ' . $room['rm_cost'] . ' ' . $this->session->userdata('currency') . '</option>';
        }
        echo json_encode(array('data' => $str));
    }

    public function edit_room() {
        $options = array('m_id' => $this->input->post('rm_id'),
            'cost' => (int) str_replace(',', '', $this->input->post('rm_cost')),
            'name' => $this->input->post('room_name'),
            'desc' => $this->input->post('description')
        );
        $this->room->update_room($options);
        $log_array = array('audit_action' => $this->session->userdata('name_first') . " " . $this->session->userdata('name_last') .
            " edited details about a room: " . $this->input->post('room_n') . " of " . $this->session->userdata('building_name'));
        $this->audittrails->log_details($log_array);
        $data = array('status' => true);
        echo json_encode($data);
        exit;
    }

    public function evict_tenant($rm_id) {
        $room_data = $this->room->get_room(array('rm_id' => $rm_id));
        $data['room_data'] = $room_data;
        $floor = $room_data[0]['floor'];
//        $this->form_validation->set_rules('reason', 'Eviction Reason', 'trim|required');
//        $this->form_validation->set_rules('date', 'Date of departure', 'trim|required');
        //if ($this->form_validation->run()) {
//            $current = date('Y-m-d');
//            $ev_date = date('Y-m-d', strtotime($this->input->post('date')));

            $options = array('ev_ten_id' => $room_data[0]['tenant_id'],
                'ev_rm_id' => $rm_id,
                'ev_date' => date('Y-m-d'),
                'ev_reason' => $this->input->post('reason'),
                'ev_by' => $this->session->userdata('name_id')
                //,'ev_date' => date('Y-m-d', strtotime($this->input->post('date')))
            );
            $options['ev_status'] = 'EVICTED';
            
            $this->room->evict_tenant(array('ev_rm_id'=>$rm_id));
            //if($this->room->evict_tenant(array('ev_rm_id'=>$rm_id))==FALSE){echo json_encode(array('status'=>FALSE, 'floor'=>$floor));}else{echo json_encode(array('status'=>TRUE, 'floor'=>$floor));}
            $this->room->add_evictions($options);
            echo json_encode(array('status'=>TRUE, 'floor'=>$floor));

//            if ($ev_date > $current) {
//                $options['ev_status'] = 'PENDING';
//                $this->room->add_evictions($options);
//            } else {
//                $options['ev_status'] = 'MOVED';
//                $this->room->add_evictions($options = array());
//                $options['ev_ten'] = 0;
//                $this->room->evict_tenant($options);
//            }
            //Remember to alert a notification for the administrator here
            //redirect('floors/floor/' . $floor);
        //}
    }

    public function evict_tenant1() {

        $data = array('status' => true);
        echo json_encode($data);
        exit;
    }

    public function all_rooms() {
        $data = $this->room->get_room_x(array('b_id' => $this->session->userdata('building_id')));
        //print_r($data);
        $t = "";
        foreach ($data as $v) {
            $t.= "<option value='" . $v['rm_id'] . "'>" . $v['room_name'] . "</option>";
        }
        echo json_encode(array('status' => true, 'data' => $t));
        exit;
    }

    public function book_room($building_id) {
        $data['building_data'] = $this->building->GetBuilding(array('building_id' => $building_id));
        $room_data = $this->room->get_room(array('rooms_b_id' => 1));
        $data['room_data'] = $room_data;

        $tenants = $this->tenant->Get(array('building_id' => 1));
        $tenant = NULL;
        foreach ($tenants as $row) {
            $tenant.="<option value=" . $row['id'] . ">" . $row['f_name'] . " " . $row['l_name'] . "</option>";
        }
        $floor = NULL;
        $f = $this->session->userdata('floors');
        for ($i = 1; $i <= $f; $i++) {
            $floor .= "<option value=" . $i . ">" . $i . "</option>";
        }
        $names = NULL;
        foreach ($room_data as $row) {
            $names .= "<option>" . $row['room_name'] . "</option>";
        }
        $data['names'] = $names;
        $data['floor'] = $floor;
        $data['tenants'] = $tenant;
        //$x = $this->building->reg_form_drops();
        $this->load->view('accounts_header'); //('xx_header');
        $this->x['active'] = 'FL';
        $this->load->view('xx_menu', $this->x);
        $this->load->view('book_room', $data);
        $this->load->view('xx_footer');
    }

    public function delete_room() {
        
    }

    function _check_room($str) {
        if ($this->input->post('room_n')) {
            $options = array('room_num' => $this->input->post('room_n'));
            $vals = $this->room->check_room($options);
            if ($vals) {
                $this->form_validation->set_message('_check_room', 'The room Number Entered already exists.');
                return false;
            }
            return true;
        }
    }

    function _check($str) {
        if ($this->input->post('ten')) {
            if (($this->input->post('m_cost') == null) || ($this->input->post('m_cost') == 0)) {
                $this->form_validation->set_message('_check', 'That Room Needs to billed before it is allocated.');
                return false;
            }
            return true;
        }
    }

    function _check_room_name($str) {
        if ($this->input->post('room_name')) {
            $options = array('room_name' => $this->input->post('room_name'));
            $vals = $this->room->check_room($options);
            if ($vals) {
                $this->form_validation->set_message('_check_room_name', 'The room Name Entered already exists.');
                return false;
            }
            return true;
        }
    }

    function assign_tenant() {
        $rm_id = $this->input->post('rm_id');
        $options = array(
            'stat' => 'PENDING',
            'ten' => $this->input->post('ten_id'),
            'd_payment' => str_replace(',', '', $this->input->post('d_pay')),
            'm_id' => $rm_id,
            'rm_deposit' => str_replace(',', '', $this->input->post('s_depo')),
            'rm_s_date' => date('Y-m-d', strtotime($this->input->post('start'))),
            'rm_h_date' => date('Y-m-d', strtotime($this->input->post('end'))),
            'rm_purpose' => $this->input->post('purpose'),
            'rm_date' => date('Y-m-d')
        );
        $this->room->update_room($options);
        echo json_encode(array('status' => TRUE));
    }

    function room_encode() {
        $rm_id = $this->input->post('rm_id');
        $options = array('rm_id' => $rm_id);
        $rm_name = $this->room->get_room_name($options);
        echo json_encode(array('status' => TRUE, 'rm_name' => $rm_name[0]['room_name']));
    }

    function edit_floor() {
        $f_id = $this->input->post('flr_id');
        $f_name = $this->input->post('flr_name');
        $f_rms = $this->input->post('flr_rms');
        $this->floor->update_floor(array('f_id' => $f_id, 'f_name' => $f_name, 'f_rms' => $f_rms));
        echo json_encode(array('status' => TRUE, 'msg' => 'Floor Updated'));
    }

    function get_all_floors() {
        $data = $this->floor->get_all_floors();
        //print_r($data);
        $t = '<option>Select option</option>';
        foreach ($data as $v) {
            $t.= '<option value="' . $v['f_id'] . '">' . $v['flr_name'] . '</option>';
        }
        echo json_encode(array('status' => true, 'data' => $t));
        exit;
    }

}
