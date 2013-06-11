<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//session_start();

class Bills extends CI_Controller {

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
        $this->load->library('num_to_words.php');
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

    public function index() {
        $ci = & get_instance();
        $data['buildings'] = $this->building->GetBuilding(array('b_id' => $ci->session->userdata('building_id')));
        //$x = $this->building->reg_form_drops();
        $this->x['active'] = 'ACC';
        $this->load->view('accounts_header');
        $this->load->view('xx_menu', $this->x);
        $this->load->view('bill_building', $data);
        $this->load->view('xx_footer');
    }

    public function bill() {
        $billing_data = $this->bill->get_room(array('rooms_b_id' => $this->session->userdata('building_id')));
        $billed = '';
        $n = 0;
        $rate = $this->cur->get_cur();
        $invoices = array();
        foreach ($billing_data as $rows):
            $inv = $this->bill->add_invoice();
            $inv_name = $inv['name'];
            if (date('m', strtotime($rows['bill_date'])) == date('m') && date('Y', strtotime($rows['bill_date'])) == date('Y')) {
            } else {
                if (($rows['rm_cost'] > 0) && ($rows['rm_status'] == 'OCCUPIED')) {
                    $billed .= '<b>' . $rows['room_name'] . ' (OCCUPIED) > '.number_format($rows['rm_cost'],0).'</b>, </br>';
                    $n +=1;
                    $options = array('rm_id' => $rows['rm_id'], 'debit' => $rows['debit'], 'rm_cost' => $rows['rm_cost'], 'bill_date' => date('Y-m-d')
                    );
                    $bill = $this->bill->Update($options);
                    $options2 = array(
                        'records_rm_id' => $rows['rm_id'],
                        'tenant_id' => $rows['tenant_id'],
                        're_bal' => $rows['debit'] - $rows['credit'] + $rows['rm_cost'],
                        'old_bal'=> $rows['debit'] - $rows['credit'],
                        'd_payment' => date('Y-m-d'),
                        'particulars' => 'RENT_BILL_OCCUPIED',
                        'bill_amount' => $rows['rm_cost'],
                        'rec_num' => $inv_name,
                        'pay_month' => date('F'),
                        'pay_year' => date('Y')
                    );
                    $record = $this->bill->Add_bill($options2);
                     $t_4n = $this->bill->get_ten_tel(array('t_id'=>$options2['tenant_id']));
                    $curl_handle=curl_init();
                    curl_setopt($curl_handle,CURLOPT_URL,'http://121.241.242.114:8080/bulksms/bulksms?username=cd1-cranemgtsys&password=cms123&type=0&dlr=1&&destination='.$t_4n.'&source=CMS&message=You%20have%20been%20billed%20for%20Rent;%20Room:'.$rows['room_name'].'%20Ushs:'.$rows['rm_cost'].'%20Rent%20balance:%20'.$options2['re_bal']);
                    curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
                    curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
                    $buffer = curl_exec($curl_handle);
                    curl_close($curl_handle);

                   /* $msg_array = array(
                                'destination'=>$this->tenant->get_tenant_phone(array('ten_id'=>$rows[0]['tenant_id'])),
                                'message'=>"You have been billed for RENT ".date('F').' '.date('Y'). 
                                            " Room: ".$this->room->get_room_name(array('rm_id'=>$this->input->post('rm_id')))[0]['room_name'].
                                            "Amount: ".$this->input->post('rm_cost').". Balance: ".($rows[0]['debit'] - $rows[0]['credit'] +$diff)
                                            );                
                        $this->msg->send_msg($msg_array);*/

                } else if (($rows['rm_cost'] > 0) && ($rows['rm_status'] != 'OCCUPIED' )) {
                        $billed .= '<b>' . $rows['room_name'] . ' (VACANT) > '.number_format($rows['rm_cost'],0).'</b>, </br>';
                        $n +=1;
                        $options = array(
                            'rm_id' => $rows['rm_id'],
                            'bill_date' => date('Y-m-d')
                        );
                        $bill = $this->bill->Update($options);
                        $options2 = array(
                            'records_rm_id' => $rows['rm_id'],
                            'tenant_id' => $rows['tenant_id'],
                            'd_payment' => date('Y-m-d'),
                            'particulars' => 'RENT_BILL_VACANT',
                            'bill_amount' => $rows['rm_cost'],
                            'pay_month' => date('F'),
                            'pay_year' => date('Y')
                        );
                        $record = $this->bill->Add_bill($options2);
                        $invoices[] = $inv_name;
                    }
            }
        endforeach;
        echo json_encode(array('status' => true, 'page' => 'bills/billed_rooms', 'changed' => $billed, 'b_n' => $n, 'inv_num' => $invoices));
        return;
    }

    public function billed_rooms() {
        $x1 = $this->bill->get_room(array('rooms_b_id' => $this->session->userdata('building_id')));
        $data['y'] = $x1;
        //$x = $this->building->reg_form_drops();
        $this->x['active'] = 'ACC';
        $this->load->view('accounts_header');
        $this->load->view('xx_menu', $this->x);
        $this->load->view('view_rooms_status', $data);
        $this->load->view('xx_footer');
    }

    public function bill_floor($floor) {
        $billing_data = $this->floor->get_floor(array('rooms_b_id' => $this->session->userdata('building_id'), 'floor' => $floor));
        foreach ($billing_data as $rows):
            if (($rows['rm_cost'] > 0) && ($rows['rm_status'] == 'OCCUPIED')) {
                $options = array(
                    'debit' => $rows['debit'],
                    'rm_id' => $rows['rm_id'],
                    'rm_cost' => $rows['rm_cost']
                );

                $bill = $this->bill->Update($options);
                $options2 = array(
                    'rm_id' => $rows['rm_id'],
                    'tenant_id' => $rows['tenant_id'],
                    'bill_amount' => $rows['debit'],
                    'd_payment' => date('yyy:mm:dd'),
                    'particulars' => 'RENT_BILL',
                    'bill_amount' => $rows['rm_cost']
                );
                $record = $this->bill->Add_bill($options2);
            }
        endforeach;
        $x1 = $this->bill->get_room(array('rooms_b_id' => $this->session->userdata('building_id'), 'floor' => $floor));
        $data['y'] = $x1;
        //$x = $this->building->reg_form_drops();
        $this->x['active'] = 'ACC';
        $this->load->view('accounts_header');
        $this->load->view('xx_menu', $this->x);
        $this->load->view('view_rooms_status', $data);
        $this->load->view('xx_footer');
    }

    public function bill_room() {
        $rows = $this->bill->get_bill_date(array('rm_id'=>$this->input->post('rm_id')));
        $billed = '';
        $n = 0;
        $inv = $this->bill->add_invoice();
        $inv_name = $inv['name'];
        if (($rows[0]['rm_cost'] > 0) && ($rows[0]['tenant_id'] != 0)) {
            if (date('m', strtotime($rows[0]['bill_date'])) == date('m') && date('Y', strtotime($rows[0]['bill_date'])) == date('Y')) {
                $billed .= '<b>' . $rows[0]['room_name'] . '</b>, </br>';
                $n +=1;
                $options = array(
                    'rm_id' => $this->input->post('rm_id'),
                    'debit' => $rows[0]['debit'],
                    'new' => $this->input->post('rm_cost'),
                    'old' => $rows[0]['rm_cost'],
                    'bill_date' => date('Y-m-d')
                );
                $bill = $this->bill->Update_rebill($options);
                $diff = ($this->input->post('rm_cost') - $rows[0]['rm_cost']);

                 $options3 = array(
                    'records_rm_id' => $this->input->post('rm_id'),
                    'd_payment' => $rows[0]['bill_date']
                );
                $x = $this->bill->UpdateRecords($options3);
                $options2 = array(
                    'records_rm_id' => $this->input->post('rm_id'),
                    'tenant_id' => $rows[0]['tenant_id'],
                    'old_bal' => $rows[0]['debit'] - $rows[0]['credit'],
                    're_bal' => ($rows[0]['debit'] - $rows[0]['credit'] +$diff),
                    'd_payment' => date('Y-m-d'),
                    'particulars' => 'RENT_RE-BILL_OCCUPIED',
                    'rec_num' => $inv_name,
                    'pay_month' => date('F'),
                    'bill_amount' => $this->input->post('rm_cost'),
                    'pay_year' => date('Y')
                );
                $record = $this->bill->Add_bill($options2);

                echo json_encode(array('status' => true, 'page' => 'bills/billed_rooms', 'changed' => $billed, 'b_n' => $n, 'rec_num' => $inv_name));
                return;
            } else {
                echo json_encode(array('status' => false, 'msg' => 'That room is not yet billed for this month.'));
                return;

            }
        }

        else {
            echo json_encode(array('status' => false, 'msg' => 'That room is either empty or has no monthly rent attached to it'));
            return;

        }
    }


    public function bill_room_umeme() {
        $options = array(
            'rm_id' => $this->input->post('rm_id'),
            'debit' => $this->input->post('debit'),
            'prev' => $this->input->post('prev'),
            'rate' => $this->input->post('rate'),
            'current' => $this->input->post('current')
        );
        $bill = $this->bill->UpdateUmemeBill($options);
        $options2 = array(
            'records_rm_id' => $this->input->post('rm_id'),
            'tenant_id' => $this->input->post('tenant_id'),
            'd_payment' => date('yyy:mm:dd'),
            'particulars' => 'UMEME_BILL',
            'bill_amount' => (($this->input->post('current') - $this->input->post('prev')) * $this->input->post('rate'))
        );
        $record = $this->bill->add_bill($options2);
        echo json_encode(array('status' => true));
    }

    public function umeme_statement() {
        $floors = $this->session->userdata('floors');
        for ($i = 1; $i <= $floors; $i++) {
            $name = "floor" . $i;
            $data['floor'][$i] = $this->room->get_room(array('rooms_b_id' => $this->session->userdata('building_id'), 'floor_num' => $i));
        }
        //$x = $this->building->reg_form_drops();
        $this->x['active'] = 'ACC';
        $this->load->view('accounts_header');
        $this->load->view('xx_menu', $this->x);
        $this->load->view('view_umeme_statement', $data);
        $this->load->view('xx_footer');
    }

    public function umeme_meter($id) {
        $data['room'] = $this->room->get_room(array('rm_id' => $id));
        $data['managers'] = $this->bill->get_statement(array('rm_id' => $id, 'particulars' => 'UMEME_BILL'));
        //$x = $this->building->reg_form_drops();
        $this->x['active'] = 'ACC';
        $this->load->view('accounts_header');
        $this->load->view('xx_menu', $x);
        $this->load->view('view_meter_reading', $data);
        $this->load->view('xx_footer');
    }

    public function floors($id) {
        $floors = $this->building->GetBuilding(array('b_id' => $id));
        $data['floors'] = $floors;

        //$x = $this->building->reg_form_drops();
        $this->x['active'] = 'ACC';
        $this->load->view('accounts_header');
        $this->load->view('xx_menu', $this->x);
        $this->load->view('bill_floor', $data);
        $this->load->view('xx_footer');
    }

    public function rooms($id) {
        $rooms = $this->room->get_rooms(array('rooms_b_id' => $id));
        $data['rooms'] = $rooms;
        //$x = $this->building->reg_form_drops();
        $this->x['active'] = 'ACC';
        $this->load->view('accounts_header');
        $this->load->view('xx_menu', $this->x);
        $this->load->view('bill_room', $data);
        $this->load->view('xx_footer');
    }

    public function umeme() {
        $billing_data = $this->bill->get_room2(array('rooms_b_id' => $this->session->userdata('building_id')));
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
                        'records_rm_id' => $rows['rm_id'],
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
            $this->load->view('accounts_header');
            $this->load->view('xx_menu', $this->x);
            $this->load->view('view_rooms_status', $data);
            $this->load->view('xx_footer');
        } else {
            $floors = $this->session->userdata('floors');
            for ($i = 1; $i <= $floors; $i++) {
                $name = "floor" . $i;
                //$data['floor'][$i] = $this->room->get_room(array('rooms_b_id' => $this->session->userdata('building_id'), 'floor_num' => $i));
                $data['floor'][$i] = $this->room->get_room_flr(array('rm_b_id' => $this->session->userdata('building_id'), 'floor_num' => $i));
            }

            if (!$this->room->get_rate($this->session->userdata('building_id'))) {//
                $data['rate'] = 0;
            } else {
                $data['rate'] = $this->room->get_rate($this->session->userdata('building_id'));
            }
            //$x = $this->building->reg_form_drops();
            $this->x['active'] = 'ACC';
            $this->load->view('accounts_header');
            $this->load->view('xx_menu', $this->x);
            //print_r($data);
            $this->load->view('bill_umeme2', $data);
            $this->load->view('xx_footer');
        }
    }

    public function umemex() {
    //        print_r($this->input->post());
    //        return;
        $readings = $this->input->post('readings');

        foreach ($readings as $reading) {
            if ($reading == 'undefined') {
            //Do nothing
            } else {
                $inv = $this->bill->add_invoice();
                $inv_name = $inv['name'];
                $options = array(
                    'rm_id' => $reading['rm_id'],
                    'debit_umeme' => $reading['cost'] ,
                    'meter_reading' => $reading['n_reading']
                );
                $q = $this->bill->get_by_id($reading['rm_id'], 'rooms', 'debit_umeme,credit_umeme', 'rm_id');
                $bill = $this->bill->Update4($options);
                $options2 = array(
                    'records_rm_id' => $reading['rm_id'],
                    'units' => $reading['n_units'],
                    'meter_r' => $reading['n_reading'],
                    'old_bal' => $q['debit_umeme']-$q['credit_umeme'],
                    're_bal' => $q['debit_umeme']-$q['credit_umeme']+$reading['cost'],
                    'bill_amount' => $reading['cost'],
                    'particulars' => 'UMEME_BILL',
                    'tenant_id' => $this->bill->get_ten_id(array('rm_id'=>$reading['rm_id'])),
                    'rec_num' => $inv_name,
                    'pay_month' => date('F'),
                    'pay_year' => date('Y'),
                    'd_payment' => date('Y-m-d')
                );
                $record = $this->bill->add_payment($options2);
                $t_4n = $this->bill->get_ten_tel(array('t_id'=>$options2['tenant_id']));
                    $curl_handle=curl_init();
                    curl_setopt($curl_handle,CURLOPT_URL,'http://121.241.242.114:8080/bulksms/bulksms?username=cd1-cranemgtsys&password=cms123&type=0&dlr=1&&destination='.$t_4n.'&source=CMS&message=You%20have%20been%20billed%20for%20UMEME;%20Units:'.$reading['n_units'].'%20Ushs:'.$reading['cost'].'%20UMEME%20balance:%20'.$options2['re_bal']);
                    curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
                    curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
                    $buffer = curl_exec($curl_handle);
                    curl_close($curl_handle);
           }
        }
        //print_r($data);
        echo json_encode(array('status' => true));
        return;
    }
    public function umemex1() {
        print_r($this->input->post());
        return;
        $readings = $this->input->post('readings');
        $inv = $this->bill->add_invoice();
        $inv_name = $inv['name'];
        //print_r($readings);

        $x_ = 400;
        if ($this->session->userdata('currency') == 'USD') {
            $currency = $this->cur->get_cur();
            if ($currency[0]['currency'] == 'USD') {
                $rate = $currency[0]['rate'];
            } else {
                $rate = 1;
            }
        } else {
            $rate = 1;
        }
        foreach ($readings as $reading) {
            if ($reading == 'undefined') {
            //Do nothing
            } else {
                $options = array(
                    'rm_id' => $reading['rm_id'],
                    'debit' => (($reading['cost'] + (0.18 * ($reading['cost']))) / $rate),
                    'meter_reading' => $reading['n_reading']
                );
                $bill = $this->bill->Update4($options);

                $options2 = array(
                    'records_rm_id' => $reading['rm_id'],
                    'units' => $reading['n_units'],
                    'meter_r' => $reading['n_reading'],
                    'bill_amount' => (($reading['cost'] + (0.18 * ($reading['cost']))) / $rate),
                    'particulars' => 'UMEME_BILL',
                    'rec_num' => $inv_name,
                    'pay_month' => date('F'),
                    'pay_year' => date('Y'),
                    'd_payment' => date('Y-m-d')
                );
                $record = $this->bill->add_payment($options2);
            }
        }
        //print_r($data);
        echo json_encode(array('status' => true));
        return;
    }

    public function bill_umeme_x($n) {
        $fl_nm = $this->floor->get_fl_name($n);
        $floor_rooms = $this->room->get_room_flr(array('rm_b_id' => $this->session->userdata('building_id'), 'floor_num' => $n));
        echo json_encode(array('rooms' => $floor_rooms, 'fl_name' => $fl_nm));
        return;
    }

    public function manage() {
        $ci = & get_instance();
        $this->form_validation->set_rules('currency', 'Currency', 'trim|required');
        $this->form_validation->set_rules('rate', 'Rate', 'trim|required');
        $rows = $this->bill->get_rate();

        if ($this->form_validation->run()) {
            $options2 = array('currency' => $this->input->post('currency'), 'rate' => $this->input->post('rate'));
            $this->cur->Add($options2);
            redirect(base_url() . 'currency/manage');
        }
        $data['curr'] = $rows;
        //$x = $this->building->reg_form_drops();
        $this->x['active'] = 'ACC';
        $this->load->view('accounts_header');
        $this->load->view('xx_menu', $this->x);
        $this->load->view('manage_umeme', $data);
        $this->load->view('xx_footer');
    }

    public function edit_umeme() {
        $ci = & get_instance();
        $this->form_validation->set_rules('rate', 'Per UnitRate', 'trim|required');
        if ($this->form_validation->run()) {
            $options = array(
                'rate' => $this->input->post('rate'),
                'id' => $ci->session->userdata('building_id')
            );
            $this->bill->update_rate($options);
            $log_array = array('audit_action' => $this->session->userdata('name_first') . " " . $this->session->userdata('name_last') .
                " edited the UMEME rate details");
            $this->audittrails->log_details($log_array);
            redirect(base_url() . 'bills/manage');
        }
        $rows = $this->bill->get_rate();


        $data['curr'] = $rows;
        //$x = $this->building->reg_form_drops();
        $this->x['active'] = 'ACC';
        $this->load->view('accounts_header');
        $this->load->view('xx_menu', $this->x);
        $this->load->view('edit_umeme', $data);
        $this->load->view('xx_footer');
    }

    function view_rooms($b_id) {
        $x1 = $this->bill->get(array('building_id' => $b_id));
        $data['y'] = $x1;
        //$x = $this->building->reg_form_drops();
        $this->x['active'] = 'ACC';
        $this->load->view('accounts_header');
        $this->load->view('xx_menu', $this->x);
        $this->load->view('view_rooms_status', $data);
        $this->load->view('xx_footer');
    }
    function view_rooms2() {
        $b_id = $this->session->userdata('building_id');
        $x1 = $this->bill->get(array('building_id' => $b_id));
        $data['y'] = $x1;
        //$x = $this->building->reg_form_drops();
        $this->x['active'] = 'ACC';
        $this->load->view('accounts_header');
        $this->load->view('xx_menu', $this->x);
        $this->load->view('view_rooms_status', $data);
        $this->load->view('xx_footer');
    }

    function view_tenants_bills($b_id) {
        $x1 = $this->bill->get_tenants(array('rooms_b_id' => $b_id));
        $data['y'] = $x1;
        $this->x['active'] = 'ACC';
        $this->load->view('accounts_header');
        $this->load->view('xx_menu', $this->x);
        $this->load->view('view_tenants_status', $data);
        $this->load->view('xx_footer');
    }

    function view_payments() {
        $payments = $this->bill->get_payments(array('b_id' => $this->session->userdata('building_id')));
        $data['payments'] = $payments;
        //$x = $this->building->reg_form_drops();
        $this->x['active'] = 'ACC';
        $this->load->view('accounts_header');
        $this->load->view('xx_menu', $this->x);
        $this->load->view('view_payments', $data);
        $this->load->view('xx_footer');
    }

    public function make_payment_form_drops() {
        $rooms = $this->room->get_room(array('rooms_b_id' => $this->session->userdata('building_id')));
        $data['rooms'] = $rooms;
        $n_rooms = NULL;
        foreach ($rooms as $row) {
            $n_rooms.="<option value=" . $row['rm_id'] . ">" . $row['room_name'] . "</option>";
        }
        $particulars = null;
        $particulars .= "<option value=RENT>Rent Payment</option>";
        $particulars .= "<option value=UMEME>Umeme Payment</option>";
        $particulars .= "<option value=installment>Installment Payment</option>";
        $particulars .= "<option value=D_PAY>Down Payment</option>";
        //$data['c'] = $c;
        $data['x'] = $n_rooms;
        $data['particulars'] = $particulars;
        echo json_encode(array('drops' => $data));
        return;
    }

    function _particulars($str) {
        if ($str == 'd_payment') {
            $d_payment = $this->room->get_down_payment(array('rm_id' => $this->input->post('room_n')));
            if ($this->input->post('amount') < $d_payment[0]['d_payment']) {
                $this->form_validation->set_message('_particulars', 'The Amount cannot be less than the negotiated Down Payment');
                return FALSE;
            } else {
                return TRUE;
            }
        } elseif ($str == 'installment') {
            return TRUE;
        } else {
            return TRUE;
        }
    }

    function statement($rm_id) {
        $records = $this->bill->get_statement(array('rm_id' => $rm_id));
        $rm = $this->room->get_room(array('rm_id' => $rm_id));
        $data['rm'] = $rm[0]['room_name'];
        $data['x'] = $records;
        //$x = $this->building->reg_form_drops();
        $deb =0; $cred =0;
        if($records) {
            foreach($records as $x) {
                if($x['particulars']=='RENT_BILL_OCCUPIED_X'){$deb += 0;$cred += 0;}else{$deb += $x['bill_amount'];$cred += $x['pay_amount'];}
//                $deb += $x['bill_amount'];
//                $cred += $x['pay_amount'];
            }
        }
        $data['deb'] = $deb;
        $data['cred']=$cred;
        $this->x['active'] = 'ACC';
        $this->load->view('accounts_header');
        $this->load->view('xx_menu', $this->x);
        $this->load->view('view_statement', $data);
        $this->load->view('xx_footer');
    }

    function ten_statement($id) {
        $ten = $this->tenant->Get(array('tenant_id' => $id));
        $records = $this->bill->get_ten_statement(array('id' => $id));
        $data['x'] = $records;
        $data['name'] = $ten;
        $deb = 0;$cred=0;
        if($records) {
            foreach($records as $x) {
                if($x['particulars']=='RENT_BILL_OCCUPIED_X'){$deb += 0;$cred += 0;}else{$deb += $x['bill_amount'];$cred += $x['pay_amount'];}

            }
        }
        $data['deb'] = $deb;$data['cred']=$cred;

        //$x = $this->building->reg_form_drops();
        $this->x['active'] = 'ACC';
        $this->load->view('accounts_header');
        $this->load->view('xx_menu', $this->x);
        //print_r($data);
        $this->load->view('view_statement', $data);
        $this->load->view('xx_footer');
    }

    function schedule_payment($building_id) {
        $rooms = $this->room->get_debtors(array('b_id' => $building_id));
        $rooms_string = NULL;
        foreach ($rooms as $room) {
            $rooms_string .= "<option value=" . $room['rm_id'] . ">" . $room['room_name'] . "</option>";
        }
        $data['rooms'] = $rooms_string;
        $this->form_validation->set_rules('num', 'Number of Installments', 'trim|required|integer');
        $i = $this->input->post('num');
        for ($x = 1; $x <= $i; $x++) {
            $this->form_validation->set_rules('amount' . $i, 'Amount ' . $i, 'trim|required|integer');
        }

        if ($this->form_validation->run()) {
            $rm_id = $this->input->post('room');
            $room = $this->room->get_room(array('rm_id' => $rm_id));
            $debit = $room[0]['debit'];
            $tenant_id = $room[0]['tenant_id'];
            $total = 0;
            for ($i = 1; $i <= $this->input->post('num'); $i++) {
                $total += $this->input->post('amount' . $i);
            }
            if ($total >= $debit) {
                $options = array('s_ten_id' => $tenant_id,
                    's_rm_id' => $rm_id);

                for ($i = 1; $i <= $this->input->post('num'); $i++) {
                    $options['s_date'] = date('Y-m-d', strtotime($this->input->post('date' . $i)));
                    $options['s_amount'] = $this->input->post('amount' . $i);
                    $this->schedule->Add($options);
                }

                redirect('bills/view_schedule/' . $this->session->userdata('building_id'));
            } else {
                echo "You do not total up what you owe.";
            }
        //redirect('bills/installments/'.$this->input->post('room').'/'.$this->input->post('num'));
        }
        $this->load->view('accounts_header');
        $this->x['active'] = 'ACC';
        $this->load->view('xx_menu', $this->x);
        $this->load->view('payment_scheduling', $data);
        $this->load->view('xx_footer');
    }

    function get_room_debtors() {
        $debtor_room_data = $this->room->get_room(array('rm_id' => $this->input->post('rm_id')));

        echo json_encode(array('data' => $debtor_room_data[0]));
        return;
    }

    function bill_statement($rm_id) {
        $data['x'] = $this->bill->get_bills(array('b_id'=>$this->session->userdata('building_id'), 'rm_id'=>$rm_id));
        $rm = $this->room->get_room_name(array('rm_id'=>$rm_id));
        $data['rm'] = $rm[0]['room_name'];

        $this->load->view('accounts_header');
        $this->x['active'] = 'ACC';
        $this->load->view('xx_menu', $this->x);
        $this->load->view('bill_statement', $data);
        $this->load->view('xx_footer');
    }

    function view_schedule($b_id) {
        $schedule = $this->schedule->get(array('b_id' => $b_id, 'status' => 'DUE'));
        $data['schedules'] = $schedule;
        //$x = $this->building->reg_form_drops();
        $this->x['active'] = 'ACC';
        $this->load->view('accounts_header');
        $this->load->view('xx_menu', $this->x);
        $this->load->view('payment_schedule', $data);
        $this->load->view('xx_footer');
    }

    function test() {
        $rm_id = $this->input->post();
        $room = $this->room->get_room(array('rm_id' => $rm_id['rm_id']));
        $debit = $room[0]['debit'];

        echo "<input type='button'  id='button' class='greenBtn right' value='DEBIT = " . $debit . "'/>";
    }

    function num_installments() {
        $x = $this->input->post();
        $num_installments = $x['num_installments'];

        for ($i = 1; $i <= $num_installments; $i++) {
            echo "
                        <label>Date: </label>
                        <div class='formRight'><input type='text' id='date" . $i . "' name='date" . $i . "' class='datepicker' /></div>


                        <label>Amount:</label>
                        <div class='formRight'><input type='text' id='amount" . $i . "' name='amount" . $i . "' class='validate[required]'/></div>

                    ";
        }
    }

    function installments($room_id, $num) {
        $room = $this->room->get_room(array('rm_id' => $room_id));
        $data['room'] = $room;
        $data['num'] = $num;
        //$x = $this->building->reg_form_drops();
        $this->x['active'] = 'ACC';
        $this->load->view('accounts_header');
        $this->load->view('xx_menu', $this->x);
        $this->load->view('schedule', $data);
        $this->load->view('xx_footer');
    }

    public function payment_settings() {
    //print_r($this->session->all_userdata());
        $particulars = array(
            array('pName' => 'Rent'),
            array('pName' => 'UMEME'),
            array('pName' => 'Down Payment'),
            array('pName' => 'Security Deposit'),
            array('pName' => 'Cheque Penalty')
        );
        $currencies = array(
            array('cName' => 'UGX'),
            array('cName' => 'USD'),
            array('cName' => 'POUNDS')
        );
        //$rooms = $this->room->get_all_room_names();
        $rooms = $this->room->get_room_namesx();        
        $n_rooms = NULL;
        foreach ($rooms as $row) {
            $n_rooms[] = array('Id' => $row['rm_id'], 'rName' => $row['f_name']." ".$row['l_name']." - ".$row['room_name']."");
        }
        echo json_encode(array('particulars' => $particulars, 'currencies' => $currencies, 'rooms' => $n_rooms));
        return;
    }

    public function room_tenant_info() {
        $room = $this->room->get_room_display(array('rm_id' => $this->input->post('rm_id')));
        //print_r($room[0]);return;
        $schedules = $this->schedule->get_due_schedules(array('rm_id' => $this->input->post('rm_id')));
        $options = array('status' => TRUE, 'room' => $room[0]);
        if (count($schedules) > 0) {
            $str = "<table cellpadding='0' cellspacing='0' width='100%' class='tableStatic'>";
            $f = true;
            foreach ($schedules as $schedule) {
                $bal = $schedule['s_amount'] - $schedule['s_cleared'];
                $num = $schedule['s_num'];
                $id = $schedule['s_id'];
                if ($f) {
                    $str .= "<tr>
                                <td>Installment: " . $num . "</td>
                                <td width='150px' align='center'><a href='#' title='Deposit on Installment' id='sch'>" . $bal . "</a><input style='display:none' id='x' value='" . $id . "' /></td>

                            </tr>";
                    $f = FALSE;
                } else {
                    $str .= "<tr>
                                <td>Installment: " . $num . "</td>
                                <td width='150px' align='center'>" . $bal . "</td>
                            </tr>";
                }
            }
            $str .= "</table>";
            $options['schedule'] = $str;
            $options['s_id'] = $id;
        }
        $penalties = $this->bill->get_b_chqs(array('rm_id'=>$this->input->post('rm_id'),'ten_id'=>$room[0]['tenant_id']));
        if(count($penalties) > 0){
            $string = "<table cellpadding='0' cellspacing='0' width='100%' class='tableStatic'>";
            $f = true;
            $num = 1;
            foreach ($penalties as $penalty) {
                $bal = $penalty['penalty'] - $penalty['amount_clrd'];                
                $id = $penalty['id'];
                if ($f) {
                    $string .= "<tr>
                                <td>Cheque Penalty: " . $num . "</td>
                                <td width='150px' align='center'><a href='#' title='Pay Penalty' id='schx'>" . $bal . "</a><input style='display:none' id='xy' value='" . $id . "' /></td>

                            </tr>";
                    $f = FALSE;
                } else {
                    $string .= "<tr>
                                <td>Cheque Penalty: " . $num . "</td>
                                <td width='150px' align='center'>" . $bal . "</td>
                            </tr>";
                }
            }
            $string .= "</table>";
            $options['penalty'] = $string;
            $options['p_id'] = $id;
        }

        echo json_encode($options);
        return;
    }

    private function check_if_paid($rm,$particular) {
        return $this->bill->check_if_paid($rm,$particular);
    }
    private function check_if_dp_paid($rm) {
        return $this->room->check_status($rm);
    }
    public function make_payment() {
//    print_r($this->input->post());
//    return;
        foreach ($this->input->post('payments') as $payment) {
            if($payment['particular']['pName'] =='Down Payment' && $this->check_if_dp_paid($this->input->post('room_id'))) {
                echo json_encode(array('status'=>FALSE,'msg'=>'Down Payment already paid by Room!'));
                return;
            }
            if($payment['particular']['pName'] =='Security Deposit' && $this->check_if_paid($this->input->post('room_id'),'Security Deposit')) {
                echo json_encode(array('status'=>FALSE,'msg'=>'Security Deposit already paid by Room!'));
                return;
            }
            if($payment['particular']['pName'] =='Rent' && !$this->check_if_dp_paid($this->input->post('room_id'))) {
                echo json_encode(array('status'=>FALSE,'msg'=>'Down Payment not yet paid by Room!'));
                return;
            }
        }
        $rate = $this->cur->get_cur();
        //(int)str_replace(',','',$var);
        $rec = $this->bill->add_receipt();
        $rc_nm = $rec['name'];
        $b_curr = $this->session->userdata('currency');

        foreach ($this->input->post('payments') as $k=>$payment) {
        //print_r($payment);
        //return;
            if ($b_curr == 'USD' && $this->input->post('converted')!='false') {
                $payment['disp_vat'] = round($payment['disp_vat'] / $this->input->post('rate'), 2);
                $payment['real_amount'] = $payment['dollar_eqv'];
                $payment['x_rate'] = $this->input->post('rate');
            }
            $x = (int)$payment['real_amount'];
            $msg = '';
            $rows = $this->bill->get_bill_date(array('rm_id'=>$this->input->post('room_id')));

            if($payment['particular']['pName'] == 'UMEME') {
                $re_bal = $rows[0]['debit_umeme']-$rows[0]['credit_umeme']-(int) str_replace(',', '', $payment['amount']);
                $old_bal =  $rows[0]['debit_umeme']-$rows[0]['credit_umeme'];
            }elseif($payment['particular']['pName'] == 'Cheque Penalty'){
                $re_bal = 0;
                $old_bal =  0;
            }
            else {
                $re_bal = ($rows[0]['debit']-$rows[0]['credit']-(int) str_replace(',', '', $payment['amount']));
                $old_bal =  ($rows[0]['debit']-$rows[0]['credit']);
            }
            $options = array('records_rm_id' => $this->input->post('room_id'),
                'particulars' => $payment['particular']['pName'],
                'd_payment' => date('Y-m-d', strtotime($this->input->post('pdate'))),
                're_bal' =>  $re_bal,
                'old_bal' =>  $old_bal,
                'mode' => $payment['mode']['mName'],
                'pay_month' => date('F'),
                'pay_year' => date('Y'),
                'payer' => $this->input->post('from'),
                'rec_num' => $rc_nm);

            $options['vat'] = $payment['disp_vat'];
            $options['pay_amount'] = (int) str_replace(',', '', $payment['amount']);
           
            if(isset($payment['x_rate'])) {
                $options['pay_amount_shs'] = $payment['ugx_eqv'];
                $options['x_rate'] = $payment['x_rate'];
            }
            $cr = $this->room->get_down_payment(array('rm_id' => $this->input->post('room_id')));
            $tenant_id = $cr[0]['tenant_id'];

            //$options['re_bal'] = ($cr[0]['credit'] - $cr[0]['debit']);
            $credit = $cr[0]['credit'] + (int) str_replace(',', '', $payment['amount']);
            $options2 = array('m_id' => $this->input->post('room_id'), 'cr' => $credit);
            $options['tenant_id'] = $tenant_id;
            if ($payment['mode']['mName'] == 'Cheque') {
                $options['cheque'] = $payment['xnum'];
                $x = $this->bill->check_exists(array('cheque'=>$options['cheque']));
                if($x==FALSE) {
                //continue;
                }else {
                    echo json_encode(array('status' => false, 'msg' => 'That Cheque is already used!'));
                    return;
                }
            } elseif ($payment['mode']['mName'] == 'Bank slip') {
                $options['slip'] = $payment['xnum'];
                $x = $this->bill->check_exists(array('slip'=>$options['slip']));
                if($x==FALSE) {
                //continue;
                }else {
                    echo json_encode(array('status' => false, 'msg' => 'That Bank Slip is already used!'));
                    return;
                }
            } elseif ($payment['mode']['mName'] == 'TT') {
                $options['TT'] = $payment['xnum'];
                $x = $this->bill->check_exists(array('TT'=>$options['TT']));
                if($x==FALSE) {
                //continue;
                }else {
                    echo json_encode(array('status' => false, 'msg' => 'That TT is already used!'));
                    return;
                }
            }
            //print_r($payment);
            if ($payment['particular']['pName'] == 'Down Payment') {
                $d_p = $cr[0]['d_payment'];
                if ($d_p == (int) str_replace(',', '', $payment['amount'])) {
                    $billedx = $this->bill->get_bill(array('records_rm_id' => $this->input->post('room_id')));
                    if ($billedx) {
                        
                    //$rows = $this->bill->get_bill_date($this->input->post('room_id'));
                        $billed = '';
                        $n = 0;
                        $inv = $this->bill->add_invoice();
                        $inv_name = $inv['name'];
                        $billed .= '<b>' . $rows[0]['room_name'] . '</b>, </br>';
                        $n +=1;
                        $optionsx = array(
                            'rm_id' => $this->input->post('room_id'),
                            'debit' => $rows[0]['debit'],
                            'rm_cost' => $rows[0]['rm_cost'],
                            'bill_date' => date('Y-m-d')
                        );
                        $bill = $this->bill->UpdateRooms($optionsx);
                        //$rows = $this->bill->get_bill_date(array('rm_id'=>$this->input->post('room_id')));//ppp
                        $option = array(
                            'records_rm_id' => $this->input->post('room_id'),
                            'tenant_id' => $rows[0]['tenant_id'],
                            're_bal' =>  $rows[0]['rm_cost'],
                            'old_bal' =>  $rows[0]['debit']-$rows[0]['credit'],
                            'd_payment' => date('Y-m-d'),
                            'particulars' => 'RENT_BILL_OCCUPIED',
                            'rec_num' => $inv_name,
                            'pay_month' => date('F'),
                            'bill_amount' => $rows[0]['rm_cost'],
                            'pay_year' => date('Y')
                        );                        
                        $record = $this->bill->update_records($option);
                    } else {
                        $rows = $this->bill->get_bill_date(array('rm_id'=>$this->input->post('room_id')));
                        //return;
                        $billed = '';
                        $n = 0;
                        $inv = $this->bill->add_invoice();
                        $inv_name = $inv['name'];
                        $billed .= '<b>' . $rows[0]['room_name'] . '</b>, </br>';
                        $n +=1;
                        $optionsx = array(
                            'rm_id' => $this->input->post('room_id'),
                            'debit' => $rows[0]['debit'],
                            'rm_cost' => $rows[0]['rm_cost'],
                            'bill_date' => date('Y-m-d')
                        );
                        $bill = $this->bill->UpdateRooms($optionsx);
                        $option = array(
                            'records_rm_id' => $this->input->post('room_id'),
                            'tenant_id' => $rows[0]['tenant_id'],
                            're_bal' => $rows[0]['rm_cost'],
                            'old_bal' =>  $rows[0]['debit']-$rows[0]['credit'],
                            'd_payment' => date('Y-m-d'),
                            'particulars' => 'RENT_BILL_OCCUPIED',
                            'rec_num' => $inv_name,
                            'pay_month' => date('F'),
                            'bill_amount' => $rows[0]['rm_cost'],
                            'pay_year' => date('Y')
                        );
                        //print_r($rows);
                        $record = $this->bill->Add_bill($option);
                    }
                    $optionsy = array(
                        'rm_id' => $this->input->post('room_id'),
                        'credit' => $rows[0]['credit'],
                        'rm_status' => 'OCCUPIED',
                        'rm_date'=> date('Y-m-d'),
                        'creidt2' => $payment['real_amount']
                    );
                    //echo '------------------------------------';
                    $bill = $this->bill->UpdateRooms($optionsy);
                    $ten = $this->tenant->edit(array('id'=>$rows[0]['tenant_id'], 'status'=>'CURRENT'));
                    //echo '------------------------------------';
                    $rows = $this->bill->get_bill_date(array('rm_id'=>$this->input->post('room_id')));
                    $optionsxx = array(
                        'records_rm_id' => $this->input->post('room_id'),
                        'tenant_id' => $rows[0]['tenant_id'],
                        're_bal' =>  $rows[0]['debit']-$rows[0]['credit']-(int) str_replace(',', '', $payment['amount']),
                        'old_bal' =>  $rows[0]['debit']-$rows[0]['credit'],
                        'd_payment' => date('Y-m-d'),
                        'mode' => $payment['mode']['mName'],
                        'particulars' => 'Down Payment',
                        'rec_num' => $rc_nm,
                        'pay_month' => date('F'),
                        'pay_amount' => (int) str_replace(',', '', $payment['amount']),
                        'pay_amount_shs' => $payment['ugx_eqv'],                        
                        'pay_year' => date('Y')
                    );
                    if($payment['mode']['mName']=='Cheque'){$optionsxx['cheque']=$payment['xnum'];}
                        if($payment['mode']['mName']=='TT'){$optionsxx['TT']=$payment['xnum'];}
                        if($payment['mode']['mName']=='Bank slip'){$optionsxx['slip']=$payment['xnum'];}
                    $this->bill->add_payment($optionsxx);
                } else {
                    $msg = "Down Payment Error: The amount entered is not equal to the negotiated amount.";
                    echo json_encode(array('status' => FALSE, 'msg' => $msg));
                    return;
                }
                $this->room->update_room($options2);
            } elseif($payment['particular']['pName'] == 'UMEME') {
                $data = array('rm_id' => $this->input->post('room_id'), 'cr' => (int) str_replace(',', '', $payment['amount']));
                $this->room->update_room_umeme($data);
                $this->bill->add_payment($options);
            }elseif($payment['particular']['pName'] == 'Cheque Penalty'){
                $rx_id = $this->bill->add_payment($options);
                $pen_data = array(
                    'p_rm_id',
                    'p_ten_id',
                    'p_date',
                    'p_amount',
                    'p_amount_clrd',
                    'p_cheque',
                    'p_rec_id');

            }else {
            //if (isset($payment['month']['mtName']) && isset($payment['year']['nyear'])) {
                if (isset($payment['month'])) {
                    $sub = explode('-', $payment['month']);
                    $options['pay_month'] = $sub[0];
                    $options['pay_year'] = $sub[1];
                }
                $receipt_no = $this->bill->add_payment($options);
                $this->room->update_room($options2);
            }
        //$this->room->update_room($options2);
        }
        $rets = $this->bill->get_by_id($this->input->post('room_id'), 'rooms', 'credit,debit,credit_umeme,debit_umeme', 'rm_id');
        $curr_bal = (float) $rets['debit'] - (float) $rets['credit'];
        $um_bal = (float) $rets['debit_umeme'] - (float) $rets['credit_umeme'];
        echo json_encode(array('status' => true, 'msg' => $msg,'um_bal'=>$um_bal, 'curr_bal' => $curr_bal, 'rec_no' => $rc_nm));
        return;
    }
    public function revenue($rm_id) {
        $records = $this->bill->get_rev_statement(array('rm_id' => $rm_id));
        $total=null;
        foreach ($records as $row) {
        //            $revenue = $this->building->GetRevenueTotal(array('rm_id' => $rm_id));
            $total += $row['pay_amount'];
        }
        $data['total'] = $total;
        $data['x'] = $records;
        $this->x['active'] = 'ACC';
        $this->load->view('accounts_header');
        $this->load->view('xx_menu', $this->x);
        $this->load->view('view_rev_statement', $data);
        $this->load->view('xx_footer');
  public 