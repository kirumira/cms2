<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Messages extends CI_Controller {
    var $x;
    public function __construct(){
        parent::__construct();
        if (!($this->session->userdata('is_logged_in'))){
            echo json_encode(array('logged_out'=>true));
            redirect(base_url() . 'login');
        }
        $this->load->model('building');
        $this->load->model('floor');
        $this->load->model('message');
        $this->x = $this->building->reg_form_drops();   
        $this->x['floor_names'] = $this->floor->get_all_floors(); 
    }
    public function index(){
        $this->form_validation->set_rules('building','Building','trim|required');
        $this->form_validation->set_rules('message','Message','trim|required|xss_clean');
        if($this->form_validation->run()){
            $options = array('m_bid'=>$this->input->post('building'),
                'm_bid'=>$this->input->post('floor'),
                'm_rmid'=>$this->input->post('room'),
                'm_msg'=>$this->input->post('message'));
            if($this->input->post('sms')!='accepted')
                $options['m_sms'] = 0;
            if($this->input->post('email')!='accepted')
                $options['m_email'] = 0;

           $this->message->add($options);

            //Send Messages here
            redirect('messages/view_sent');
        }

        $building = "<option value=''>--SELECT--</option>";
        $floor = "<option value=''></option>";
        $rooms = "<option value=''></option>";
        $buildings = $this->building->GetBuilding(array());
        foreach ($buildings as $row) {
            $building.="<option value=".$row['b_id'].">".$row['b_name']."</option>";
        }
        $data['buildings']=$building;
        $data['floors'] = $floor;
        $data['rooms'] = $rooms;
        //$x = $this->building->reg_form_drops();
        $this->x['active'] = 'MS';
        $this->load->view('xx_header');        
        $this->load->view('xx_menu',$this->x);
        $this->load->view('send_message', $data);
        $this->load->view('xx_footer');
    }
    public function view_sent(){
        $data['messages'] = $this->message->get_messages();
        
        //$x = $this->building->reg_form_drops();
        $this->x['active'] = 'MS';
        $this->load->view('xx_header');
        $this->load->view('xx_menu',$this->x);
        $this->load->view('messages', $data);
        $this->load->view('xx_footer');
    }
    public function get_building_data(){
        $b_id = $this->input->post('b_id');
        echo "<option >Akampa</option><option >Tim</option>";
    }
}