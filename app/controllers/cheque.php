<?php

class Cheque extends CI_Controller {

    var $x;
    public function __construct() {
        parent::__construct();
        if (!($this->session->userdata('is_logged_in'))) {
            echo json_encode(array('logged_out' => true));
            redirect(base_url() . 'login');
        }
        $this->load->model('bill');
        $this->load->model('building');
        $this->load->model('floor');
        $this->x = $this->building->reg_form_drops();   
        $this->x['floor_names'] = $this->floor->get_all_floors(); 
    }
    public function index(){
        $data['cheques'] = $this->bill->get_bounced_cheques();
        //$x = $this->building->reg_form_drops();
        $this->x['active'] = 'ACC';
        $this->load->view('accounts_header');
        $this->load->view('xx_menu', $this->x);
        $this->load->view('view_bounced_cheqs', $data);
        $this->load->view('xx_footer');
    }

    public function get_all_cheques() {
        $q = $this->bill->get_all_cheques();
        $options = array();
        foreach ($q as $v) {
            $options1['cheque'] = $v['cheque'];
            $options1['pay_amount'] = $v['pay_amount']+$v['vat'];
            $options1['amountx'] = $v['pay_amount'];
            $rm_nm = $this->bill->get_by_id($v['records_rm_id'], 'rooms', 'room_name', 'rm_id');
            $options1['room'] = $rm_nm['room_name'];
            $options1['rm_id'] = $v['records_rm_id'];
            $xx = $this->bill->get_by_id($v['tenant_id'], 'tenants', 'f_name,l_name,telephone', 'id');
            $options1['tenant'] = $xx['f_name'] . ' ' . $xx['l_name'];
            $options1['tn_id'] = $v['tenant_id'];
            $options1['tn_4n'] = $xx['telephone'];
            $options1['receit_no'] = $v['receit_no'];
            $options[] = $options1;
        }
        echo json_encode(array('options' => $options));
        return;
    }
    public function get_cheque_data(){
        $s_id = $this->input->post('p_id');
        $schedule = $this->bill->get_cheque_data(array('p_id'=>$s_id));
        $options = array(
            'status'=>TRUE,
            'ten_name'=>$schedule[0]['f_name']." ".$schedule[0]['l_name'],
            'rm_name'=>$schedule[0]['room_name'],
            'in_num'=>$schedule[0]['s_num'],
            'in_amount'=>$schedule[0]['s_amount'],
            'am_remaining'=>$schedule[0]['s_amount']-$schedule[0]['s_cleared']);
        echo json_encode($options);
    }
    public function cheque_data(){
        $pen_id = $this->input->post('pen_id');
        $options=$this->bill->get_bounced_cheque_data(array('pen_id'=>$pen_id));
        echo json_encode(array('data'=>$options));
        return;
    }
    public function pay_penalty(){
        $pen_id = $this->input->post('penalty_id');
        $amount = $this->input->post('amount');
        $x = $this->bill->pay_penalty(array('pen_id'=>$pen_id, 'amount'=>$amount));
        $data = $this->bill->get_bounced_cheque_data(array('pen_id'=>$pen_id));
        $options=array(
            'records_rm_id'=>$data['room'],
            'tenant_id'=>$data['tenant'],
            'd_payment'=>date('Y-m-d'),
            'pay_amount'=>$amount,
            'particulars'=>'CHEQUE PENALTY',
            'pay_month'=>date('F'),
            'pay_year'=>date('Y'));
        $this->bill->add_payment($options);
        echo json_encode(array('status'=>TRUE));
        return;
    }

    public function reg_bounced_cheque() {
        $data = $this->input->post();
        $rm = $this->bill->get(array('rm_id' => $data['room']));
        $option = array(
            'details' => $data['details'],
            'amount' => $data['amount'],
            'penalty' => $data['penalty'],
            'cheque'=> $data['cheque'],
            'tenant'=> $data['tenant'],
            'room'=> $data['room'],
            'rec_id' => $data['rec_id'],
            'amount_clrd'=>0
        );
        $q = $this->bill->reg_bounced_cheque($option);
        //$this->bill->Update(array('rm_cost' => ($data['amount'] + $data['penalty']), 'debit' => $rm[0]['debit']));
        $inv = $this->bill->add_invoice();
        $inv_name = $inv['name'];
        
        $options2 = array(
                        'records_rm_id' => $data['room'],
                        'tenant_id' => $data['tenant'],
                        //'bill_amount' => ((float)str_replace(',', '',$data['amount']) + (float)str_replace(',', '',$data['penalty'])),
                        'bill_amount' => (float)str_replace(',','',$data['real_amount']),
                        're_bal' =>  $rm[0]['debit']+(float)str_replace(',', '',$data['real_amount']) - $rm[0]['credit'],
                        'old_bal'=>$rm[0]['debit'] - $rm[0]['credit'],
                        'd_payment' => date('Y-m-d'),
                        'particulars' => 'BOUNCED CHEQUE',
                        'rec_num' => $inv_name,
                        'pay_month' => date('F'),
                        'pay_year' => date('Y'),
                        'cheque' => $data['cheque']
                    );
                    //print_r($data);return;
        $record = $this->bill->Add_bill($options2);
        $this->bill->update_cheq_debit(array('rm_id'=>$data['room'], 'debit' =>$rm[0]['debit']+(float)str_replace(',', '',$data['real_amount'])));
        $rm = $this->bill->get(array('rm_id' => $data['room']));

        $options3 = array('records_rm_id' => $data['room'],
                        'tenant_id' => $data['tenant'],
                        'bill_amount' => (float)str_replace(',', '',$data['penalty']),
                        're_bal' => $rm[0]['debit'] - $rm[0]['credit'],
                        'old_bal'=>$rm[0]['debit'] - $rm[0]['credit'],
                        'd_payment' => date('Y-m-d'),
                        'particulars' => 'BOUNCED CHEQUE PENALTY',
                        'rec_num' => $inv_name,
                        'pay_month' => date('F'),
                        'pay_year' => date('Y'),
                        'cheque' => $data['cheque']);       

        $record = $this->bill->Add_bill($options3);
//        $options4 = array(array(
//                    'p_rm_id'=>$data['room'],
//                    'p_ten_id'=> $data['tenant'],
//                    'p_date'=> date('Y-m-d'),
//                    'p_amount'=>(float)str_replace(',', '',$data['penalty']),
//                    'p_amount_clrd'=>0,
//                    'p_cheque'=> $data['cheque'],
//                    'p_rec_id'=>$record));
//        $this->penalty->add_penalty($options4);
        $this->bill->update_cheq_debit(array('rm_id'=>$data['room'], 'debit' =>$rm[0]['debit']+(float)str_replace(',', '',$data['penalty'])));
        $x = $this->bill->delete_record($data['rec_id']);

        if ($q) {
            $status = true;
        }else
            $status = false;
        echo json_encode(array('status' => $status, 'inv_num'=>$inv_name, 'aob'=>$x));
        return;
    }

}

?>
