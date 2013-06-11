<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//session_start();

class Payments extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!($this->session->userdata('is_logged_in'))) {
            echo json_encode(array('logged_out' => true));
            redirect(base_url() . 'login');
        }
        $this->load->model('building');
        $this->load->model('floor');
        $this->load->model('room');
        $this->load->model('cur');
        $this->x = $this->building->reg_form_drops();
        $this->x['floor_names'] = $this->floor->get_all_floors();
    }

    public function index() {
        $rate = $this->cur->get_cur();
        if (count($rate) == 0) {
            $rate[0]['rate'] = 'undefined';
        }
        //$x = $this->building->reg_form_drops();
        $q = $this->building-> get_by_id($this->session->userdata('building_id'), 'buildings', 'p_o_box, b_district ');
        
        $data = array('rate'=>$rate[0]['rate'], 'currency' => $rate[0]['currency'], 'id' => $rate[0]['id'], 'p_o_box'=>$q['p_o_box'], 'b_district'=>$q['b_district']);
        $gg = $this->room->get_by_id($this->session->userdata('building_id'),'buildings','b_type','b_id');
        $data['b_type'] = $gg['b_type'];
        $this->x['active'] = 'ACC';
        $this->load->view('accounts_header');
        $this->load->view('xx_menu', $this->x);
        $this->load->view('payment_page', $data);
        $this->load->view('xx_footer');
    }

    public function get_rooms() {
        $rooms_x = $this->room->get($options = array('rooms_b_id' => $this->session->userdata('building_id')));
        $rooms_string = "";
        foreach ($rooms_x as $room) {
            $rooms_string .= "<option value=" . $room['rm_id'] . ">" . $room['room_name'] . "</option>";
        }
        echo json_encode(array('rooms_string' => $rooms_string, 'rooms' => $rooms_x));
    }

    function view_payments($date) {
        $records = $this->bill->get_payments_made_by_date($date);
        $tpay = 0;
        $tvat = 0;
        $revenue = $this->cur->get_total(array('rooms_b_id' => $this->session->userdata('building_id'), 'd_receipt'=>  $date));
        $tpay += $revenue[0]['tpay'];
        $tvat += $revenue[0]['tvat'];

        $um = $this->cur->get_umeme_total(array('rooms_b_id' => $this->session->userdata('building_id'), 'd_receipt'=>  $date));
        $data['tpay'] = $tpay;
        $data['tvat'] = $tvat;
        $data['payments'] = $records;
        $data['tumeme'] = $um[0]['tpay'];
        //$x = $this->building->reg_form_drops();
        $this->x['active'] = 'ACC';
        $this->load->view('accounts_header');
        $this->load->view('xx_menu', $this->x);
        $this->load->view('view_payments', $data);
        $this->load->view('xx_footer');
    }
public function payments_made() {
        $q = $this->bill->get_all_payments();

       $options = array();
        foreach ($q as $v) {
            $options1['receipt'] = $v['rec_num'];
            $options1['pay_amount'] = $v['pay_amount'];
            $options1['vat'] = $v['vat'];
            $options1['records_rm_id'] = $v['records_rm_id'];
            $options1['re_bal'] = $v['re_bal'];
            $options1['ammount'] = (str_replace(',', '', $v['vat'])+str_replace(',', '', $v['pay_amount']));
            $options[] = $options1;
        }
        echo json_encode(array('options' => $options));
        return;
    }
    

    public function payments_edit() {

        if(str_replace(',', '', $this->input->post('rc_vat'))>0){
            $vat = ((18/118)*str_replace(',', '', $this->input->post('n_amount')));
           
        }else{
            $vat = 0;
        }
       $options = array(
                    'rec_num' => $this->input->post('rc_no'),
                    'records_rm_id'=>$this->input->post('records_rm_id'),
                    'credit'=>(str_replace(',', '', $this->input->post('n_amount'))-$this->input->post('o_amount')),
                    'pay_amount' => str_replace(',', '', $this->input->post('n_amount'))-$vat,
                    're_bal'=> (str_replace(',', '',$this->input->post('re_bal'))+($this->input->post('o_amount'))-str_replace(',', '', $this->input->post('n_amount'))),
                    'vat' => $vat
                );

       if(str_replace(',', '', $this->input->post('n_amount'))>0){
        $bill = $this->bill->Update_cr($options);        
       }else{
        $ddd = $this->bill->delete_tx($this->input->post('rc_no'));
       }

       $ccccc = $this->room->update_room_credit($options);

         $options2 = array(
                    'a_receipt' => $this->input->post('rc_no'),
                    'f_pay_amount' => str_replace(',', '', $this->input->post('n_amount'))-$vat,
                    'f_vat' => $vat,
                    'i_vat' => ((18/118)*str_replace(',', '', $this->input->post('o_amount'))),
                    'i_pay_amount' => str_replace(',', '', $this->input->post('rc_pay')),
                    'adjusted_by' => $this->session->userdata('name_first')." ".$this->session->userdata('name_last')
                );

        $bill = $this->bill->add_re_payment($options2);

        echo json_encode(array('status' => true));
        return;
    }

     public function cr(){
        $data['cr']= $this->bill->get_cr();
        //$x = $this->building->reg_form_drops();
        $this->x['active'] = 'ACC';
        $this->load->view('accounts_header');
        $this->load->view('xx_menu', $this->x);
        $this->load->view('view_cr', $data);
        $this->load->view('xx_footer');
    }
}




?>
