<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//session_start();

class Umeme extends CI_Controller {

    var $file;
    var $path;
    var $x;

    public function __construct() {
        parent::__construct();
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
        $this->load->model('audittrails');
        $this->load->model('user');
        $this->load->model('tenant');
        $this->load->model('room');
        $this->load->model('bill');
        $this->load->model('floor');
        $this->load->model('cur');
        $this->load->model('schedule');
        $this->x = $this->building->reg_form_drops();   
        $this->x['floor_names'] = $this->floor->get_all_floors(); 
    }

    public function add_umeme() {
        $options = array('rate' => $this->input->post('rate'), 'u_b_id' => $this->session->userdata('building_id'));
        $this->cur->Add_Umeme($options);
        echo json_encode(array('status' => TRUE, 'msg' => 'Success'));
    }

    public function umeme_floors($floor) {
        $billing_data = $this->bill->get_room2(array('rooms_b_id' => $this->session->userdata('building_id'), 'floor' => $floor));
        foreach ($billing_data as $rows) {
            $str = "current_" . $rows['room_name'];
            $this->form_validation->set_rules($str, 'Current Meter Reading', 'trim|integer');
        }
        if ($this->form_validation->run()) {

            foreach ($billing_data as $rows) {

                if (($rows['rate'] > 0) && ($rows['rm_status'] == 'OCCUPIED')) {
                    $s = "current_" . $rows['room_name'];
                    if ($this->input->post($s) == 0) {
                        $units = 0;
                    } elseif (($this->input->post($s) - $rows['meter_reading']) < 0) {
                        $units = (-1) * ($this->input->post($s) - $rows['meter_reading']);
                    } else {
                        $units = ($this->input->post($s) - $rows['meter_reading']);
                    }
                    $options = array(
                        'rm_id' => $rows['rm_id'],
                        'debit1' => $rows['debit'],
                        'meter_reading' => ($this->input->post($s) + $rows['meter_reading']),
                        'debit2' => ($rows['rate'] * $units) + (0.18 * ($rows['rate'] * $units)),
                    );
                    $bill = $this->bill->Update($options);
                    $options2 = array(
                        'rm_id' => $rows['rm_id'],
                        'units' => $units,
                        'meter_r' => $this->input->post($s),
                        'bill_amount' => ($rows['rate'] * $units) + (0.18 * ($rows['rate'] * $units)),
                        'particulars' => 'UMEME_BILL'
                    );

                    $record = $this->bill->add_payment($options2);
                }
            }
            $x1 = $this->bill->get_room(array('rooms_b_id' => $this->session->userdata('building_id')));
            $data['y'] = $x1;
            //$x = $this->building->reg_form_drops();
            $this->x['active'] = 'ACC';
            $this->load->view('xx_header');
            $this->load->view('xx_menu', $this->x);
            $this->load->view('view_rooms_status', $data);
            $this->load->view('xx_footer');
        } else {
            $floors = $this->session->userdata('floors');
//            for ($i = 1; $i <= $floors; $i++) {
//                $name = "floor" . $i;
            $data['floor'] = $this->room->get_room(array('rooms_b_id' => $this->session->userdata('building_id'), 'floor' => $floor));
//            }
            $data['fl'] = $floor;
            //$x = $this->building->reg_form_drops();
            $this->x['active'] = 'ACC';
            $this->load->view('xx_header');
            $this->load->view('xx_menu', $this->x);
            $this->load->view('bill_floor_umeme', $data);
            $this->load->view('xx_footer');
        }
    }

    public function umeme_rooms($room) {
        $billing_data = $this->bill->get_room2(array('rooms_b_id' => $this->session->userdata('building_id'), 'rm_id' => $room));
        foreach ($billing_data as $rows) {
            $str = "current_" . $rows['room_name'];
            $this->form_validation->set_rules($str, 'Current Meter Reading', 'trim|integer');
        }
        if ($this->form_validation->run()) {

            foreach ($billing_data as $rows) {

                if (($rows['rate'] > 0) && ($rows['rm_status'] == 'OCCUPIED')) {
                    $s = "current_" . $rows['room_name'];
                    if ($this->input->post($s) == 0) {
                        $units = 0;
                    } elseif (($this->input->post($s) - $rows['meter_reading']) < 0) {
                        $units = (-1) * ($this->input->post($s) - $rows['meter_reading']);
                    } else {
                        $units = ($this->input->post($s) - $rows['meter_reading']);
                    }
                    $options = array(
                        'rm_id' => $rows['rm_id'],
                        'debit1' => $rows['debit'],
                        'meter_reading' => ($this->input->post($s) + $rows['meter_reading']),
                        'debit2' => ($rows['rate'] * $units) + (0.18 * ($rows['rate'] * $units)),
                    );
                    $bill = $this->bill->Update($options);
                    $options2 = array(
                        'rm_id' => $rows['rm_id'],
                        'units' => $units,
                        'meter_r' => $this->input->post($s),
                        'bill_amount' => ($rows['rate'] * $units) + (0.18 * ($rows['rate'] * $units)),
                        'particulars' => 'UMEME_BILL'
                    );

                    $record = $this->bill->add_payment($options2);
                }
            }
            $x = $this->bill->get_room(array('rooms_b_id' => $this->session->userdata('building_id')));
            $data['y'] = $x;
            //$x = $this->building->reg_form_drops();
            $this->x['active'] = 'ACC';
            $this->load->view('xx_header');
            $this->load->view('xx_menu', $this->x);
            $this->load->view('view_rooms_status', $data);
            $this->load->view('xx_footer');
        } else {
            $data['floor'] = $this->room->get_room(array('rooms_b_id' => $this->session->userdata('building_id'), 'rm_id' => $room));
            //$x = $this->building->reg_form_drops();
            $this->x['active'] = 'ACC';
            $this->load->view('xx_header');
            $this->load->view('xx_menu', $this->x);
            $this->load->view('bill_floor_umeme', $data);
            $this->load->view('xx_footer');
        }
    }

    public function bill_umeme() {
        $rm_id = $this->input->post('rm_id');
        //$old_meter_reading = $this->input->post('old_meter_reading');
        $new_meter_reading = $this->input->post('new_meter_reading');
        $m_reading = $this->room->get_meter_reading(array('rm_id' => $rm_id));
        $rate = $m_reading[0]['rate'];
        $old_m_reading = $m_reading[0]['meter_reading'];

        $units = $this->input->post('new_meter_reading') - $m_reading[0]['meter_reading'];
        $options = array(
            'rm_id' => $m_id,
            'debit1' => $m_reading['debit'],
            'meter_reading' => $new_meter_reading,
            'debit2' => ($rate * $units) + (0.18 * ($rate * $units))
        );
        $bill = $this->bill->Update($options);

        $options2 = array(
            'rm_id' => $rm_id,
            'units' => $units,
            'meter_r' => $new_meter_reading,
            'bill_amount' => ($rate * $units) + (0.18 * ($rate * $units)),
            'particulars' => 'UMEME_BILL'
        );
        $record = $this->bill->add_payment($options2);

        echo json_encode(array('status' => true, 'msg' => 'payment ' . $record . ' made'));
    }

    public function edit() {////by cleave
        $id = $this->input->post('umeme_id');
        $options = array('id' => $id,
            'quantity' => $this->input->post('quantity'),
            'rate' => $this->input->post('rate')
        );
        $this->building->edit($options);
        $log_array = array('audit_action' => $this->session->userdata('name_first') .
            " Edited details of currency : " . $this->input->post('currency'));
        $this->audittrails->log_details($log_array);
        $data = array('status' => true);
        echo json_encode($data);
        exit;
    }

    public function umeme_info() {
        $id = $this->input->post('umeme_id');
        $options = array('id' => $id);
        $data = $this->building->get_umeme($options);
        echo json_encode(array('status' => true, 'data' => $data[0]));
    }

    public function umeme_statement() {
        $options = array('b_id' => $this->session->userdata('building_id'), 'particulars' => 'UMEME');
        $rm_data = $this->building->get_rooms_umeme($options);
        $data['rooms'] = $rm_data;
        $dr=0;$cr=0;$bal=0;
        foreach($rm_data as $x){
            $cr += $x['credit'];
            $dr += $x['debit'];
        }
        $data['cred'] = $cr;
        $data['deb'] = $dr;
        //$x = $this->building->reg_form_drops();
        $this->x['active'] = 'ACC';
        $this->load->view('accounts_header');
        $this->load->view('xx_menu', $this->x);
        $this->load->view('view_umeme_statement', $data);
        $this->load->view('xx_footer');
    }
     public function umeme_statement_details($rm_id) {
        $options = array('rm_id' => $rm_id, 'particulars' => 'UMEME');
        $rm_data = $this->building->get_rooms_umeme_details($options);
        $x = $this->room->get_room_name(array('rm_id'=>$rm_id));
        $data['details'] = $rm_data;
        $data['rm_name'] = $x[0]['room_name'];
        //$x = $this->building->reg_form_drops();
        $this->x['active'] = 'ACC';
        $this->load->view('accounts_header');
        $this->load->view('xx_menu', $this->x);
        $this->load->view('view_umeme_statement_details', $data);
        $this->load->view('xx_footer');
    }

}