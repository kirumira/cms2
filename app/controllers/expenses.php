<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Expenses extends CI_Controller {

    var $x;
    public function __construct() {
        parent::__construct();
        if (!($this->session->userdata('is_logged_in'))){
            echo json_encode(array('logged_out'=>true));
            redirect(base_url() . 'login');
        }
        $this->load->model('building');
        $this->load->model('audittrails');
        $this->load->model('expense');
        $this->load->model('floor');
        $this->load->model('room');
        $this->x = $this->building->reg_form_drops();   
        $this->x['floor_names'] = $this->floor->get_all_floors(); 
    }

    public function index() {
        $options = null;
        $user_data = $this->expense->GetAll($options);
        $data = array('managers' => $user_data);
        //$x = $this->building->reg_form_drops();
        $this->load->view('accounts_header');//('xx_header');
        $this->x['active'] = 'BE';
        $this->load->view('xx_menu',$this->x);
        $this->load->view('view_expenses', $data);
        $this->load->view('xx_footer');
    }

    public function view() {
        $options = null;
        $x1 = $this->expense->Get2($options);
        $data = array('managers' => $x1);
        //$x = $this->building->reg_form_drops();
        $this->load->view('accounts_header');//('xx_header');
        $this->x['active'] = 'BE';
        $this->load->view('xx_menu',$this->x);
        $this->load->view('view_expense_details', $data);
        $this->load->view('xx_footer');
    }

    public function add_new() {
        $this->form_validation->set_rules('e_code', 'Expense Code', 'trim|required|callback__already_exists');
        $this->form_validation->set_rules('description', 'Expense Description', 'trim|required');
        if ($this->form_validation->run()) {
            $options = array(
                'e_code' => $this->input->post('e_code'),
                'description' => $this->input->post('description'));
            $this->expense->Add($options);
            $log_array = array('audit_action' => $this->session->userdata('name_first') . " " . $this->session->userdata('name_last') .
                " added a new Expense Code and Description: " . $this->input->post('e_code') . " " . $this->input->post('description'));
            $this->audittrails->log_details($log_array);
            redirect('expenses');
        }

        //$x = $this->building->reg_form_drops();
        $this->load->view('accounts_header');//('xx_header');
        $this->x['active'] = 'BE';
        $this->load->view('xx_menu',$this->x);
        $this->load->view('add_new_expense');
        $this->load->view('xx_footer');
    }

    public function add() {
        $this->form_validation->set_rules('e_amount', 'Amount', 'trim|required|integer');
        $this->form_validation->set_rules('e_amount', 'Amount', 'trim|required');
        if ($this->form_validation->run()) {
            $options = array('e_code' => $this->input->post('e_code'),
                'e_amount' => $this->input->post('e_amount'),
                'e_b_id' => $this->input->post('b_id'),
                'e_floor' => $this->input->post('e_floor'),
                'particulars' => $this->input->post('part'),
                'e_room' => $this->input->post('e_room'));
            $this->expense->Add_exp($options);
            $log_array = array('audit_action' => $this->session->userdata('name_first') . " " . $this->session->userdata('name_last') .
                " added a new expenses");
            $this->audittrails->log_details($log_array);
            redirect('expenses/view');
        }
        $options1 = null;
        $codes = $this->expense->Get($options1);
        $buildings = $this->building->GetBuilding($options1);
        $floors = $this->floor->get_floor($options1);
        $rooms = $this->room->get_room($options1);
        $e_code = NULL;
        $e_b = NULL;
        foreach ($codes as $row) {
            $e_code.="<option value=" . $row['e_code'] . ">" . $row['e_code'] . "</option>";
        }
        $fl = NULL;
        foreach ($floors as $row) {
            $fl.="<option value=" . $row['floor'] . ">" . $row['floor'] . "</option>";
        }
        foreach ($buildings as $row) {
            $e_b.="<option value=" . $row['b_id'] . ">" . $row['b_name'] . "</option>";
        }
        $rm = NULL;
        foreach ($rooms as $row) {
            $rm.="<option value=" . $row['room_name'] . ">" . $row['room_name'] . "</option>";
        }
        $data['e_code'] = $e_code;
        $data['e_b'] = $e_b;
        $data['fl'] = $fl;
        $data['rm'] = $rm;
        //$x = $this->building->reg_form_drops();
        $this->load->view('accounts_header');//('xx_header');
        $this->x['active'] = 'BE';
        $this->load->view('xx_menu',$this->x);
        $this->load->view('add_expense', $data);
        $this->load->view('xx_footer');
    }

    public function edit($id) {
        $item_details = $this->expense->Get(array('e_code' => $id));
        $this->form_validation->set_rules('e_code', 'Expense Code', 'trim|required');
        $this->form_validation->set_rules('description', 'Expense Description', 'trim|required');
        if ($this->form_validation->run()) {
            $options2 = array(
                'e_code1' => $id,
                'e_code' => $this->input->post('e_code'),
                'description' => $this->input->post('description'));
            $this->expense->Update($options2);
            redirect('expenses');
        } else {

            $data['e_code'] = $item_details[0]['e_code'];
            $data['description'] = $item_details[0]['description'];
            //$x = $this->building->reg_form_drops();
            $this->load->view('accounts_header');//('xx_header');
            $this->x['active'] = 'BE';
            $this->load->view('xx_menu',$this->x);
            $this->load->view('edit_expense', $data);
            $this->load->view('xx_footer');
        }
    }

    public function view_audit_trail() {
        $data['audit_data'] = $this->audittrails->view_details();
        //$x = $this->building->reg_form_drops();
        $this->load->view('accounts_header');//('xx_header');
        $this->x['active'] = 'BE';
        $this->load->view('xx_menu',$x);
        $this->load->view('view_audit_trail', $data);
        $this->load->view('xx_footer');
    }

    public function delete($e_code) {
        $this->expense->Delete(array('e_code' => $e_code));
        redirect('expenses');
    }

    function _already_exists($str) {

        if (!$this->expense->Get(array('e_code' => $str))) {
            return TRUE;
        } else {
            $this->form_validation->set_message('_already_exists', 'That Expense already exists.');
            return FALSE;
        }
    }

}