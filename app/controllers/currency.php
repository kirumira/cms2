<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//session_start();

class Currency extends CI_Controller {

    var $file;
    var $path;
    var $x;

    public function __construct() {
        parent::__construct();
        if (!($this->session->userdata('is_logged_in'))){
            echo json_encode(array('logged_out'=>true));
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
        $this->load->model('bill');
        $this->load->model('cur');
        $this->load->model('floor');
        $this->load->model('audittrails');
        $this->x = $this->building->reg_form_drops();   
        $this->x['floor_names'] = $this->floor->get_all_floors(); 
    }

    public function currency_info() {
        $id = $this->input->post('currency_id');
        $options = array('id' => $id);
        $data = $this->cur->get($options);
        echo json_encode(array('status' => true, 'data' => $data[0]));
    }
    public function report() {       
        $report = $this->cur->get_report();
        //$x = $this->building->reg_form_drops();
        $this->x['active'] = 'BD';
        $data['reports'] = $report;        
        $this->load->view('accounts_header');
        $this->load->view('xx_menu',$this->x);
        $this->load->view('view_currency_report', $data);
        $this->load->view('xx_footer');       
        
    }

     public function ureport() {       
        $report = $this->cur->get_ureport();
        //$x = $this->building->reg_form_drops();
        $this->x['active'] = 'ACC';
        $data['reports'] = $report;        
        $this->load->view('accounts_header');
        $this->load->view('xx_menu',$this->x);
        $this->load->view('view_umeme_report', $data);
        $this->load->view('xx_footer');       
        
    }

    public function delete() {
        $id = $this->input->post('currency_id');
        $this->cur->Delete(array('id' => $id));
        $data = array('status' => true);
        echo json_encode($data);
        exit;
    }

    public function del_info() {
        $id = $this->input->post('currency_id');
        $r = $this->building->get_by_id($id, 'currency', 'currency,rate');
        $data = array('currency' => $r['currency']);
        echo json_encode($data);
        exit;
    }

    public function cur() {
        $options = array(
            'currency' => $this->input->post('currency'),
            'rate' => $this->input->post('rate')
        );
        $this->cur->Add($options);
        $options = array(
            'edit_rate' => $this->input->post('rate'),
            'edit_by' => $this->session->userdata("name_first")." ".$this->session->userdata("name_last")
        );
        $this->cur->Add_edit($options);
        echo json_encode(array('status' => true));
        exit;
    }
    public function add_edit() {
        $options = array(
            'edit_rate' => $this->input->post('edit_rate'),
            'edit_by' => $this->session->userdata("name_first")." ".$this->session->userdata("name_last")
        );
        $this->cur->Add_edit($options);
        echo json_encode(array('status' => true));
        exit;
    }
    public function add_uedit() {
        $options = array(
            'u_edit_rate' => $this->input->post('u_edit_rate'),
            'u_edit_b_id' => $this->session->userdata("building_id"),
            'u_edit_by' => $this->session->userdata("name_first")." ".$this->session->userdata("name_last")
        );
        $this->cur->Add_uedit($options);
        echo json_encode(array('status' => true));
        exit;
    }

    public function manage() {
        $ci = & get_instance();
        $this->form_validation->set_rules('currency', 'Currency', 'trim|required');
        $this->form_validation->set_rules('rate', 'Rate', 'trim|required');
        $rows = $this->cur->get_cur();

        if ($this->form_validation->run()) {
            $options2 = array('currency' => $this->input->post('currency'), 'rate' => $this->input->post('rate'));
            $this->cur->Add($options2);
            redirect(base_url() . 'currency/manage');
        }
        $umeme = $this->building->get_umeme();
        $data['umeme'] = $umeme;
        $data['curr'] = $rows;
        //$x = $this->building->reg_form_drops();
        $this->x['active'] = 'ACC';
        $this->load->view('accounts_header');//('xx_header');
        $this->load->view('xx_menu', $this->x);
        $this->load->view('manage_currency', $data);
        $this->load->view('xx_footer');
    }

    public function edit_cur() {
        $this->form_validation->set_rules('currency', 'Currency', 'trim|required');
        $this->form_validation->set_rules('rate', 'Exchange Rate', 'trim|required');
        if ($this->form_validation->run()) {
            $options = array(
                'currency' => $this->input->post('currency'),
                'rate' => $this->input->post('rate'));
            $this->cur->update_cur($options);
            $log_array = array('audit_action' => $this->session->userdata('name_first') . " " . $this->session->userdata('name_last') .
                " edited the exchange rate details");
            $this->audittrails->log_details($log_array);
            redirect(base_url() . 'currency/manage');
        }
        $rows = $this->cur->get_cur();

        $data['curr'] = $rows;
        //$x = $this->building->reg_form_drops();
        $this->x['active'] = 'ACC';
        $this->load->view('accounts_header');//('xx_header');
        $this->load->view('xx_menu', $this->x);
        $this->load->view('edit_currency', $data);
        $this->load->view('xx_footer');
    }

    public function edit() {////by cleave
        $id = $this->input->post('currency_id');
        $options = array('id' => $id,
            'currency' => $this->input->post('currency'),
            'rate' => $this->input->post('rate')
        );
        $this->cur->edit($options);
        $log_array = array('audit_action' => $this->session->userdata('name_first') .
            " Edited details of currency : " . $this->input->post('currency'));
        $this->audittrails->log_details($log_array);
        $data = array('status' => true);
        echo json_encode($data);
        exit;
    }

}