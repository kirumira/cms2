<?php

class Schedules extends CI_Controller {
    var $x;
    public function __construct() {
        parent::__construct();
        if (!($this->session->userdata('is_logged_in'))){
            echo json_encode(array('logged_out'=>true));
            redirect(base_url() . 'login');
        }
        $this->load->model('schedule');
        $this->load->model('building');
        $this->load->model('floor');
        $this->load->model('bill');
    }
    public function add(){
        $num = 1;
        $total_amount = 0;
        $installments = array();
        $rm_id = $this->input->post('rm_id');
        $tenant_id = $this->input->post('tenant_id');
        $installments['date0'] = date('Y-m-d');
        $installments['total']=0;

        foreach($this->input->post('installments') as $installment){
            $installments['date'.$num] = date('Y-m-d', strtotime($installment['i_date']));
            $installments['amount'.$num] = $installment['i_amount'];


            if($installments['date'.$num]<$installments['date'.($num-1)]){
                if(($num-1)== 0){
                    $msg = "The Installment".$num." Date cannot be before today: ".$installments['date0'];
                }else{
                    $msg = "The Installment".$num." Date cannot be before the Installment".($num-1)." date.";
                }
                echo json_encode(array('status'=>TRUE, 'msg'=>$msg));
                return;
            }
            $installments['total'] += (int)str_replace(',','',$installment['i_amount']);
            $num++;
        }
        $current_month = date('Y-m'); $final_month = date('Y-m', strtotime($installments['date'.($num-1)]));
        $amount_owed = $this->input->post('am_owed');
        if($installments['total']>=$amount_owed){
            for($i=1; $i<=$this->input->post('no_installments'); $i++){
                $options = array(
                    's_ten_id'=>$tenant_id,
                    's_rm_id'=>$rm_id,
                    's_date'=>$installments['date'.$i],
                    's_amount'=>(int)str_replace(',','',$installments['amount'.$i]),
                    's_num'=>$i,
                    's_paid'=>'DUE',
                    's_color'=>'#2F6AA2'
                );

                $this->schedule->Add($options);
            }
            $room = $this->schedule->get_room_credit(array('rm_id'=>$rm_id));
            $credit = $room[0]['credit'];
            //$this->schedule->update_credit(array('rm_id'=>$rm_id, 'credit'=>$credit, 'credit2'=>$amount_owed));
            $building_id = $this->session->userdata('building_id');
            $rooms = $this->room->get_debtors(array('b_id' => $building_id));
            $rooms_string = '<option>Select Room</option>';
            foreach ($rooms as $room) {
                if(isset($room['schedule'])){
                    if($room['schedule']<($room['debit']-$room['credit'])){
                        $rooms_string .= "<option value=" . $room['rm_id'] . ">" . $room['room_name'] . "</option>";
                    }
                }else{
                    $rooms_string .= "<option value=" . $room['rm_id'] . ">" . $room['room_name'] . "</option>";
                }
                
                //$rooms_string .= "<option value=" . $room['rm_id'] . ">" . $room['room_name'] . "</option>";
            }
            echo json_encode(array('status'=>TRUE,'rooms'=>$rooms_string));
            return;
        }else{
            echo json_encode(array('status'=>TRUE, 'msg'=>'The total of all installments entered is less than the amount owed.'));
            return;
        }
    }
    public function view_schedule(){

        //$this->load->view('xx_header');
        $this->load->view('accounts_header');
        //$x = $this->building->reg_form_drops();
        $this->x['active'] = 'ACC';
        $data['pending'] = $this->schedule->get_pending();
        $data['m_pending'] = $this->schedule->get_due(array('start_date'=>date('Y-m-1'), 'end_date'=>date('Y-m-31')));
        $data['m_due'] = $this->schedule->get_due(array('start_date'=>date('Y-m-1'), 'end_date'=>date('Y-m-31'), 'due'=>'DUE'));
        $this->load->view('xx_menu',$this->x);
        $this->load->view('view_schedules', $data);
        $this->load->view('xx_footer');
    }
    public function schedule_encode(){
        //echo "<<<<<".$this->session->userdata('building_id');
        $schedules = $this->schedule->get(array('b_id'=>$this->session->userdata('building_id')));
        $d = array();
        foreach($schedules as $schedule){
            $s_array['title'] = $schedule['f_name']." ".$schedule['l_name']." -> ".($schedule['s_amount']-$schedule['s_cleared'])." ".$this->session->userdata('currency');
            $s_array['color'] = $schedule['s_color'];
            $s_array['start'] = $schedule['s_date'];
            $s_array['s_id'] = $schedule['s_id'];
            $d[] = $s_array;
        }
        echo json_encode(array('status'=>TRUE, 'data'=>$d));
    }
    public function pay_installment(){
        $s_id = $this->input->post('s_id');
        $amount = (int)str_replace(',','',$this->input->post('amount'));
        $installment = $this->schedule->get_installment(array('s_id'=>$s_id));
        $installment_amount = (int)str_replace(',','',$installment[0]['s_amount']);
        $amount_cleared = $installment[0]['s_cleared'];
        $balance = $installment_amount - $amount_cleared;
        $room = $this->schedule->get_room_credit(array('rm_id'=>$installment[0]['s_rm_id']));
        $credit = $room[0]['credit'];
        $rec = $this->bill->add_receipt();
        $rc_nm = $rec['name'];
        if($amount == $balance){
           // $this->schedule->update_credit(array('rm_id'=>$installment[0]['s_rm_id'], 'credit'=>$credit, 'credit2'=>$amount));
            $this->schedule->pay(array('s_id'=>$s_id,'s_paid'=>'PAID', 's_color'=>'#719628', 's_cleared'=>($amount+$amount_cleared)));
            $receipt_id = $this->bill->add_payment(array('records_rm_id'=>$installment[0]['s_rm_id'], 'tenant_id'=>$installment[0]['s_ten_id'], 'pay_amount'=>$amount, 'particulars'=>'INSTALLMENT', 'rec_num'=>$rc_nm));

                    $curl_handle=curl_init();
                    curl_setopt($curl_handle,CURLOPT_URL,'http://121.241.242.114:8080/bulksms/bulksms?username=cd1-cranemgtsys&password=cms123&type=0&dlr=1&&destination='.$installment[0]['telephone'].'&source=CMS&message=You%20have%20paid%20debted%20instalment%20of;%20Ushs:'.$amount.'%20balance:%20'.$balance-$amount);
                    curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
                    curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
                    $buffer = curl_exec($curl_handle);
                    curl_close($curl_handle);
            $this->schedule->update_credit(array('rm_id'=>$installment[0]['s_rm_id'], 'credit'=>$credit, 'credit2'=>$amount));
            echo json_encode(array('status'=>TRUE, 'receipt_id'=>$rc_nm));
        }else{
            if($amount > $balance){
                echo json_encode(array('status'=>FALSE, 'msg'=>'The amount being paid is not as agreed.'));
            }else{
                $this->schedule->pay(array('s_id'=>$s_id, 's_color'=>'#D35959', 's_cleared'=>($amount+$amount_cleared)));
                $receipt_id = $this->bill->add_payment(array('records_rm_id'=>$installment[0]['s_rm_id'], 'tenant_id'=>$installment[0]['s_ten_id'], 'pay_amount'=>$amount, 'particulars'=>'INSTALLMENT', 'd_payment'=>date('Y-m-d'), 'rec_num'=>$rc_nm));
                
                $this->schedule->update_credit(array('rm_id'=>$installment[0]['s_rm_id'], 'credit'=>$credit, 'credit2'=>$amount));
                echo json_encode(array('status'=>TRUE, 'receipt_id'=>$rc_nm));
            }
        }
        
    }
    function get_data(){
        $s_id = $this->input->post('s_id');
        $schedule = $this->schedule->get(array('s_id'=>$s_id));
        $options = array(
            'status'=>TRUE,
            'ten_name'=>$schedule[0]['f_name']." ".$schedule[0]['l_name'],
            'rm_name'=>$schedule[0]['room_name'],
            'in_num'=>$schedule[0]['s_num'],
            'in_amount'=>$schedule[0]['s_amount'],
            'am_remaining'=>$schedule[0]['s_amount']-$schedule[0]['s_cleared']);
        echo json_encode($options);
    }

}

?>
