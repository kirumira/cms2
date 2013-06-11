<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();

class Accounts extends CI_Controller {

    var $file;
    var $path;

    public function __construct()
    {
    	parent::__construct();
        if (!($this->session->userdata('is_logged_in'))){
            echo json_encode(array('logged_out'=>true));
            redirect(base_url() . 'login');
        }
        $this->load->helper('file');
	$this->load->helper('download');
	$this->load->helper('directory');
        $this->path = './php/uploads/';
        $this->load->library('listfiles', array('jpg', 'jpeg', 'pdf','doc','docx'));
        $this->load->model('building');
        $this->load->model('user');
        $this->load->model('tenant');
        $this->load->model('room');
    }

	public function index()
	{           
            $building_data = $this->building->GetBuilding(array('building_id'=>$this->session->userdata('building_id')));
            $data['buildings'] = $building_data;
            $ci = & get_instance();
//            $ci->session->unset_userdata('building_id');
//            $ci->session->unset_userdata('building_name');
            $x = $this->building->reg_form_drops();
            $x['active'] = 'ACC';
            $this->load->view('xx_header');
            $this->load->view('xx_menu',$x);
            $this->load->view('view_building_list', $data);
            $this->load->view('xx_footer');
	}
}