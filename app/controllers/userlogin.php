<?php

class Userlogin extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('login_model');
        $this->load->model('audittrails');
        $this->load->helper('file');
        $this->load->helper('date');
        $this->load->helper('array');
        $this->load->helper('cookie');
    }

    public function index(){
        if(isset($_COOKIE['cmscookie'])){
            redirect('buildings');
        }else{
            $this->load->view('login');
        }
    }

    public function authenticator(){
      $this->form_validation->set_rules('username','Email','trim|required|callback__check_login');
      $this->form_validation->set_rules('password','Password','trim|required');
      if($this->form_validation->run()){
            $query = $this->login_model->validate_user();
            //print_r($query);
            if($query){// if the user's credentials have been validated
                $this->load->model('user');
                $options = array('name_user'=>$this->input->post('username'),'name_password'=>$this->input->post('password'));
                $vals = $this->user->Get($options);
                $res = $this->user->Login($vals);
                if($res) {
                    $ip = $this->input->ip_address();
                    if($this->input->valid_ip($ip)) {
                        $log_array = array('audit_action'=>$this->session->userdata('name_first')." ".$this->session->userdata('name_last')." logged in from IP Address: ".$ip);
                        $this->audittrails->log_details($log_array);
                        redirect('buildings');
                    }
                }    
            }else{
                //echo 'ssafgdfzfbdfgdf-2';
                $this->load->view('login');
            }
      }else{
          //echo 'ssafgdfzfbdfgdf';
          $this->load->view('login');
      }
     
    }

    public function exit_status($str){
	echo json_encode(array('status'=>$str));
	exit;
    }

}

?>
