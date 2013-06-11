<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//session_start();

class Buildings extends CI_Controller {

    var $file;
    var $path;
    var $x;

    public function __construct() {
        parent::__construct();
        //print_r($this->session->all_userdata());return;
        if (!($this->session->userdata('is_logged_in'))) {
            echo json_encode(array('logged_out' => true));
            redirect(base_url() . 'login');
        }
        $this->load->helper('file');
        $this->load->helper('download');
        $this->load->helper('directory');
        $this->path = './php/uploads/';
        $this->load->library('listfiles', array('jpg', 'jpeg', 'pdf', 'doc', 'docx'));
        $this->load->model('building');
        $this->load->model('user');
        $this->load->model('tenant');
        $this->load->model('room');
        $this->load->model('landlord');
        $this->load->model('audittrails');
        $this->load->model('bill');
        $this->load->model('floor');
        $this->x = $this->building->reg_form_drops();
        $this->x['floor_names'] = $this->floor->get_all_floors();
    }

    public function index() {
        $ci = & get_instance();
        $options=array('building_id' => null);
        if($ci->session->userdata('name_group')==2){
            $options['manager_id'] = $ci->session->userdata('name_id');
        }
        $building_data = $this->building->GetBuilding($options);
        $data['buildings'] = $building_data;
        
        $ci->session->unset_userdata('building_id');
        $ci->session->unset_userdata('building_name');
        $ci->session->unset_userdata('floors');
        $ci->session->unset_userdata('rooms');
        $ci->session->unset_userdata('currency');

        //$x = $this->building->reg_form_drops();
        $this->x['active'] = 'BD';
        $this->load->view('xx_header');
        $this->load->view('xx_menu', $this->x);
        $this->load->view('view_building_list', $data);
        $this->load->view('xx_footer');
    }
    public function floor_plan(){
        $this->load->view('xx_header');
        $this->x['active'] = 'XB';
        $this->x['floor_names'] = $this->floor->get_all_floors();
        if($this->session->userdata('user_type')=='landlord'){
             $this->load->view('xx_menu_l', $this->x);
        }else{
             $this->load->view('xx_menu', $this->x);
        }
       
        $this->load->view('building_home');
        $this->load->view('xx_footer');
    }

    public function view_details($building_id) {
        $ci = & get_instance();
        $building_data = $this->building->GetBuilding(array('building_id' => $building_id));
        if ($building_data) {
            $floors = $this->building->GetBuildingFloors(array('b_id' => $building_id));
            //$ci->session->set_userdata('floors', $floors);
            $ci->session->set_userdata('building_id', $building_data[0]['b_id']);
            $ci->session->set_userdata('building_name', $building_data[0]['b_name']);
            $ci->session->set_userdata('floors', $building_data[0]['b_num_floors']);
            $ci->session->set_userdata('currency', $building_data[0]['currency']);
            if (isset($_SESSION['building_file_id']))
                unset($_SESSION['building_file_id']);
            $_SESSION['building_file_id'] = $building_data[0]['b_id'];
        }else {
            redirect('buildings');
        }
        $data['buildings'] = $this->building->GetBuilding(array('b_id' => $building_id));
        $this->load->view('xx_header');
        $this->x['active'] = 'XB';
        $this->x['floor_names'] = $this->floor->get_all_floors();
        if($this->session->userdata('user_type')=='landlord'){
          $this->load->view('xx_menu_l', $this->x);
        }else{
          $this->load->view('xx_menu', $this->x);
        }
        $this->load->view('building_home');
        $this->load->view('xx_footer');

    }

    public function building_details() {
        $id = $this->input->post('building_id');
        $data = $this->building->GetBuilding(array('building_id' => $id));
        //print_r($data);
        echo json_encode(array('status' => true, 'data' => $data[0]));
    }
    
    public function edit() {
        $options = array(
            'b_id' => $this->input->post('b_id'),
            'b_name' => $this->input->post('name'),
            'p_o_box' => $this->input->post('p_o_box'),
            'b_landlord_id' => $this->input->post('landlord'),
            'b_num_floors' => $this->input->post('floors'),
            'b_town' => $this->input->post('town'),
            'b_district' => $this->input->post('district'),
            'b_manager_id' => $this->input->post('manager'),
            'b_description' => $this->input->post('description'),
            'b_type' => $this->input->post('type'),
            'property_no' => $this->input->post('property_no'),
            'plot' => $this->input->post('plot'),
            'street' => $this->input->post('street'),
            'block' => $this->input->post('block'),
            'currency' => $this->input->post('currency')
        );
        $building_data = $this->building->Update($options);
        //print_r($building_data);
        echo json_encode(array('status' => true));
        exit;
    }

    public function add() {
        $check = $this->building->check_b_name($this->input->post('name'));
        if ($check) {
            $options = array(
                'b_name' => $this->input->post('name'),
                'p_o_box' => $this->input->post('p_o_box'),
                'b_landlord_id' => $this->input->post('landlord'),
                'b_num_floors' => $this->input->post('floors'),
                'b_town' => $this->input->post('town'),
                'b_district' => $this->input->post('district'),
                'b_manager_id' => $this->input->post('manager'),
                'b_description' => $this->input->post('description'),
                'b_type' => $this->input->post('type'),
                'property_no' => $this->input->post('property_no'),
                'plot' => $this->input->post('plot'),
                'street' => $this->input->post('street'),
                'block' => $this->input->post('block'),
                'currency' => $this->input->post('currency')
            );
            $building_data = $this->building->Add($options);
            for ($i = 1; $i <= $this->input->post('floors'); $i++) {
                if (($i == 1) || ($i == 21) || ($i == 31) || ($i == 41)) {
                    $flr_name = $i . 'st Floor';
                } elseif (($i == 2) || ($i == 22) || ($i == 32) || ($i == 42)) {
                    $flr_name = $i . 'nd Floor';
                } elseif (($i == 3) || ($i == 23) || ($i == 33) || ($i == 43)) {
                    $flr_name = $i . 'rd Floor';
                } else {
                    $flr_name = $i . 'th Floor';
                }
                $floors = $this->floor->add_floors(array('flr' => $i, 'flr_name' => $flr_name, 'b_id' => $building_data));
            }
            $log_array = array('audit_action' => $this->session->userdata('name_first') . " " . $this->session->userdata('name_last') .
                " Added a new building: " . $this->input->post('name'));
            $this->audittrails->log_details($log_array);
            echo json_encode(array('status' => true));
            exit;
        } else {
            echo json_encode(array('status' => FALSE, 'msg' => 'That building name already exists'));
        }
    }

    

    public function view_revenue_summary($b_id) {
        $fl = $this->building->GetBuilding(array('building_id' => $b_id));
        $floors = $fl[0]['b_num_floors'];
        $total = 0;
        for ($i = 1; $i <= $floors; $i++) {
            $data['floor'][$i] = $this->room->get_room2(array('rooms_b_id' => $b_id, 'floor_num' => $i));
            $data['x'] = $floors;
            $data['b_name'] = $fl[0]['b_name'];
        }
        $x = $this->building->reg_form_drops();
        $this->load->view('xx_header');
        $this->x['active'] = 'BD';
        $this->load->view('xx_menu', $this->x);
        $this->load->view('view_building_rev_summary', $data);
        $this->load->view('xx_footer');
    }

    public function view_room_revenue($rm_id) {
        $rm = $this->room->get_room_rev_details(array('	rm_id' => $rm_id));
        $data['revenue'] = $rm;

        $x = $this->building->reg_form_drops();
        $this->x['active'] = 'BD';
        $this->load->view('xx_header');
        $this->load->view('xx_menu', $this->x);
        $this->load->view('view_room_rev_details', $data);
        $this->load->view('xx_footer');
    }

    public function addfiles() {
        $x = $this->building->reg_form_drops();
        if (isset($_SESSION['building_file_id']))
                unset($_SESSION['building_file_id']);
        $_SESSION['building_file_id'] = $this->session->userdata('building_id');

        $this->load->view('xx_header');
        $this->x['active'] = 'XB';
        $this->load->view('xx_menu', $this->x);
        $this->load->view('upload_project_files');
        $this->load->view('xx_footer');
    }

    public function viewfiles($building_id) {
        $ci = & get_instance();
        $building_data = $this->building->GetBuilding(array('building_id' => $building_id));
        if ($building_data) {
            $ci->session->set_userdata('building_id', $building_data[0]['b_id']);
            $ci->session->set_userdata('building_name', $building_data[0]['b_name']);
            $ci->session->set_userdata('floors', $building_data[0]['b_num_floors']);
            $ci->session->set_userdata('currency', $building_data[0]['currency']);
            if (isset($_SESSION['building_file_id']))
                unset($_SESSION['building_file_id']);
            $_SESSION['building_file_id'] = $building_id;
        }else {
            redirect('buildings');
        }
        $new_path = $this->path . "". $ci->session->userdata('building_id');
        if (!file_exists($new_path))
            @mkdir($new_path, 0, true);
        $data['ifiles'] = $this->listfiles->getFiles($new_path);
        $data['tenants'] = $this->tenant->GetAll(array('building_id' => $building_id));
        //print_r($data);
        $x = $this->building->reg_form_drops();
        $this->load->view('xx_header');
        $this->x['active'] = 'BD';
        if($ci->session->userdata('user_type')=='landlord'){
         $this->load->view('xx_menu_l', $this->x);
        }else{
        $this->load->view('xx_menu', $this->x);
         }
        $this->load->view('view_building_files', $data);
        $this->load->view('xx_footer');
    }

    public function details() {
        echo json_encode(array('status' => true));
        exit;
    }

    public function delete() {
        $id = $this->input->post('building_id');
        $this->building->Delete(array('id' => $id));
        $data = array('status' => true);
        echo json_encode($data);
        exit;
    }

    public function del_info() {
        $id = $this->input->post('building_id');
        $r = $this->building->get_b_name($id);
        $data = array('bname' => $r['b_name']);
        echo json_encode($data); //0700326909
        exit;
    }

    public function get_notes_info() {

        $data['building_data'] = $this->building->Get(array('building_idnotrequired' => $this->session->userdata('building_id')));
        $room_data = $this->room->get(array('rooms_b_id' => $this->session->userdata('building_id')));
        $data['room_data'] = $room_data;

        $tenants = $this->tenant->Get(array('building_id' => $this->session->userdata('building_id')));
        $tenant = '<option>Select Tenant</option>';
        foreach ($tenants as $row) {
            $tenant.="<option value=" . $row['id'] . ">" . $row['f_name'] . " " . $row['l_name'] . "</option>";
        }
        $floor = "<option>Select Floor</floor>";
        $f = $this->session->userdata('floors');
        for ($i = 1; $i <= $f; $i++) {
            $floor .= "<option value=" . $i . ">" . $i . "</option>";
        }
        $rooms = '<option>Select Rooms</option>';
        foreach ($room_data as $row) {
            $rooms .= "<option value=" . $row['rm_id'] . ">" . $row['room_name'] . "</option>";
        }
        $building = '<option>Select Building</option>';
        foreach ($data['building_data'] as $row) {
            $building .= "<option value=" . $row['b_id'] . ">" . $row['b_name'] . "</option>";
        }
        $data = array();
        $data['tenants'] = $tenant;
        $data['rooms'] = $rooms;
        $data['floors'] = $floor;
        $data['buildings'] = $building;
        echo json_encode($data);
        return;
    }

    public function map_floor_x($n) {
        $floor_rooms = $this->room->map_floor_x(array('rm_b_id' => $this->session->userdata('building_id'), 'floor_num' => $n));

        foreach ($floor_rooms as $k => $v) {
            if ($v['tenant_id'] != 0) {
                $tenant = $this->bill->get_by_id($v['tenant_id'], 'tenants', 'f_name, l_name', 'id');
                $floor_rooms[$k]['tenant_id'] = $tenant['f_name'] . ' ' . $tenant['l_name'];
            } else {
                $floor_rooms[$k]['tenant_id'] = 'VACANT';
            }
            
            if($v['rm_state'] == 'CLOSED'){
                $floor_rooms[$k]['rm_status'] = '#A852E1';
            } elseif($v['rm_status'] == 'OCCUPIED') {
                $floor_rooms[$k]['rm_status'] = '#83B358';
            } elseif ($v['rm_status'] == 'PENDING') {
                $floor_rooms[$k]['tenant_id'] = $tenant['f_name'] . ' ' . $tenant['l_name'].'( BOOKED )';
                $floor_rooms[$k]['rm_status'] = '#6AAED0';
            } else {
                $floor_rooms[$k]['rm_status'] = '#BD7272';
            }
            $floor_rooms[$k]['xclass'] = 'mov';
        }
        $rows = array_chunk($floor_rooms, 5);
        foreach ($rows as $ke => $va) {
            if (count($va) != 5) {
                $empty = array('rm_id' => '', 'room_name' => '', 'tenant_id' => '', 'rm_size' => '', 'rm_dimensions' => '', 'rm_status' => '', 'xclass' => 'xmap1');
                $l = count($va);
                while ($l < 5) {
                    $rows[$ke][$l] = $empty;
                    $l++;
                }
            }
        }
        $fl_nm = $this->floor->get_fl_name($n);
        $fl_path = $this->floor->get_flr_path($n);
        $return_array = $arrayName = array('data' => $rows, 'n_rooms' => count($floor_rooms), 'fl_name' => $fl_nm);
        if($fl_path==''){$return_array['flr_path'] = 'NONE';}else{$return_array['flr_path'] = $fl_path;}
        echo json_encode($return_array);
        return;
    }

    public function get_rm_dimensions($id) {
        $q = $this->room->get_rm_dimensions($id);
        /*
Array
(
    [rm_size] => (size) undeclared
    [rm_dimensions] => (dim) undeclared
    [rm_status] => VACANT
)
        */
        //if($q['rm_status']!='CLOSED'){$q['rm_status']='OPEN';}
        echo json_encode($q);
        return;
    }

    public function change_rm_dimensions() {
        $data = $this->input->post();
        $this->room->change_rm_dimensions($data);
        echo json_encode(array('status' => true));
        return;
    }

    public function get_free_rooms(){
        $r = $this->building->get_free_rooms();        
        $rooms = '<option value="Select Option">Select Option</option>';
        if($r){
            foreach ($r as $v) {
                $rooms .= '<option value="'.$v['id'].'">'.$v['rm'].'</option>';
            }
        //return $rooms;
            echo json_encode(array('status'=>TRUE, 'drops'=>$rooms));
            return;
        }else{
            echo json_encode(array('status'=>FALSE, 'drops'=>'<option value="Select Option">No Rooms With Set Rent</option>'));
        }
    }

public function xx() {

        $ci = & get_instance();
        $options=array('building_id' => null);
        $options['b_landlord_id'] = $ci->session->userdata('name_id');

        $building_data = $this->building->GetBuilding($options);
        $data['buildings'] = $building_data;

        $ci->session->unset_userdata('building_id');
        $ci->session->unset_userdata('building_name');
        $ci->session->unset_userdata('floors');
        $ci->session->unset_userdata('rooms');
        $ci->session->unset_userdata('currency');

        //$x = $this->building->reg_form_drops();
        $this->x['active'] = 'BD';
        $this->load->view('xx_header');
        $this->load->view('xx_menu_l', $this->x);
        $this->load->view('view_building_list', $data);
        $this->load->view('xx_footer');
    }
}
