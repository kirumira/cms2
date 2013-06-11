<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('audittrails');
        $this->load->model('user');
    }

    public function index() {
        $this->form_validation->set_rules('username','Email','trim|required|valid_email|callback__check_login');
        $this->form_validation->set_rules('password','Password','trim|required');
        
        if($this->form_validation->run()) {
        //login successfull re-route to project
            
            $options = array('name_user'=>$this->input->post('username'),'name_password'=>$this->input->post('password'));
            $vals = $this->user->Get($options);
            //$this->session->sess_destroy();
            $res = $this->user->Login($vals);
            if($res) {
                $ip = $this->input->ip_address();
                if($this->input->valid_ip($ip)) {
                    $log_array = array('audit_action'=>$this->session->userdata('name_first')." ".$this->session->userdata('name_last')." logged in from IP Address: ".$ip);
                    $this->audittrails->log_details($log_array);                   
                }
                 redirect('buildings');
            }
        }elseif($this->input->post('username')!=null && $this->input->post('password')!=null)   {
            //login successfull re-route to project
                $this->load->model('landlord');
                $options = array('name_user'=>$this->input->post('username'),'name_password'=>$this->input->post('password'));                
                $vals = $this->landlord->Get2($options);
                if(!$vals){redirect(base_url());}
                $res = $this->user->Login2($vals);
                
                if($res) {
                    $ip = $this->input->ip_address();
                    if($this->input->valid_ip($ip)) {
                        $log_array = array('audit_action'=>$this->session->userdata('name_first')." ".$this->session->userdata('name_last')." logged in from IP Address: ".$ip);
                        $this->audittrails->log_details($log_array);                    
                    }
                    redirect('buildings/xx');
                }
            }
        $this->load->view('login');
        //$this->load->view('tests/invoice');
    }
    
    function logout() {
        $log_array = array('audit_action'=>$this->session->userdata('name_first')." ".$this->session->userdata('name_last')." logged out.");
        $this->session->sess_destroy();
        redirect(base_url());
    }

    function _check_login($username) {
        if($this->input->post('username')) {
            $this->load->model('user');
            $options = array('name_user'=>$this->input->post('username'), 'name_password'=>$this->input->post('password'));
            $vals = $this->user->Get($options);
            if($vals) {
                return true;
            }
        }
        $this->form_validation->set_message('username','Your Email / Password combination is invalid.');
        return false;
    }
}