<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tenants extends CI_Controller {
    var $x;
    var $path;
    public function __construct() {
        parent::__construct();

        if (!($this->session->userdata('is_logged_in'))){
            echo json_encode(array('logged_out'=>true));
            redirect(base_url() . 'login');
        }
        $this->load->model('audittrails');
        $this->load->model('building');
        $this->load->model('tenant');
        $this->load->model('room');
        $this->load->model('bill');
        $this->load->model('floor');
        $this->x = $this->building->reg_form_drops();   
        $this->x['floor_names'] = $this->floor->get_all_floors();
        $this->path = './documents/tenants/';
        $this->load->library('listfiles', array('jpg', 'jpeg', 'pdf','doc','docx'));
    }

    public function index() {

        $data['tenants'] = $this->tenant->GetAll(array('building_id' => $this->session->userdata('building_id')));
        $this->x['active'] = 'TN';
        $this->load->view('xx_header');
        if($this->session->userdata('user_type')=='landlord'){
            $this->load->view('xx_menu_l', $this->x);
        }else{
            $this->load->view('xx_menu', $this->x);
        }
        $this->load->view('tenants_details', $data);
        $this->load->view('xx_footer');
    }

    public function view($id) {
        $data['tenants'] = $this->tenant->GetAll(array('id' => $id));
        //$x = $this->building->reg_form_drops();
        $this->load->view('xx_header');
        $this->x['active'] = 'TN';
        $this->load->view('xx_menu', $this->x);
        $this->load->view('tenants_details', $data);
        $this->load->view('xx_footer');
    }

    public function add() {
        //print_r($this->input->post());
        //return;
        $check = $this->tenant->check_name(array('f_name'=>$this->input->post('f_name'), 'l_name'=>$this->input->post('l_name'), 'email'=>$this->input->post('email')));
        $l_name = $this->input->post('l_name');
        if($l_name=='n/a'){
            $l_name = ' ';
        }
        if($check){
            $options = array(
                'f_name' => $this->input->post('f_name'),
                'l_name' => $l_name,
                'tenants_b_id' => $this->session->userdata('building_id'),
                'telephone' => $this->input->post('telephone'),
                'email' => $this->input->post('email'),
                'c_phone' => $this->input->post('c_phone'),
                'phone_2' => $this->input->post('telephone2'),
                'phone_3' => $this->input->post('telephone3'),
                'c_person' => $this->input->post('cp'),
                'purpose' => $this->input->post('purpose'),
                's_date' => date('Y-m-d', strtotime($this->input->post('s_date'))),
                'h_date' => date('Y-m-d', strtotime($this->input->post('h_date'))),
                'd_payment' => (int)str_replace(',','',$this->input->post('d_pay')),
                'deposit' => (int)str_replace(',','',$this->input->post('deposit')),
                'room_id' => $this->input->post('room'),
                'status' => 'POTENTIAL',
                'agent' => $this->input->post('agent')
            );

            $ten = $this->tenant->Add($options);
            //Update rooms table
            $options2 = array('m_id' => $this->input->post('room'),
                'ten' => $ten,
                'stat' => 'PENDING',
                'd_payment' => (int)str_replace(',','',$this->input->post('d_pay')),
                'rm_s_date'=>date('Y-m-d', strtotime($this->input->post('s_date'))),
                'rm_h_date'=>date('Y-m-d', strtotime($this->input->post('h_date'))),
                'rm_date'=>date('Y-m-d'),
                'rm_deposit'=>(int)str_replace(',','',$this->input->post('deposit')));
            $this->room->update_room($options2);
            //Update records table


            $log_array = array('audit_action' => $this->session->userdata('name_first') . " " . $this->session->userdata('name_last') .
                " Added a new tenant: " . $this->input->post('f_name') . "  " . $this->input->post('f_name') . " to building ");
            //$this->audittrails->log_details($log_array);
            echo json_encode(array('status' => true));
            exit;
        }else{
            echo json_encode(array('status'=>FALSE, 'msg'=>'That tenant name or email already exists'));
        }             
    }

    public function addnotes() {
        $options = array(
             'notes_description' => $this->input->post('xnote'),
            'notes_b_id' => $this->session->userdata('building_id'),
            'subject' => $this->input->post('xsubject'),
            'added_by' => $this->session->userdata('name_id')
        );
        if($this->input->post('xtype')=='Tenant'){
            $options['notes_tenant_id'] = $this->input->post('xnames');          
        }else if($this->input->post('xtype')=='Room'){
            $options['note_room_id'] = array(
            'note_room_id' => $this->input->post('xnames') );            
        }elseif($this->input->post('xtype')=='Floor'){
            $options['notes_tenant_id'] = $this->input->post('xnames');;            
        }elseif($this->input->post('xtype')=='Building'){
            $options['notes_b_id'] = $this->input->post('xnames');;            
        }
        
        $this->tenant->addnotes($options);
        $data = array('status' => true);
        echo json_encode($data);
        exit;
    }

    public function edit() {////by silas
        $id = $this->input->post('tenant_id');
        $details = array('id' => $id,
            'f_name' => $this->input->post('f_name'),
            'name_last' => $this->input->post('name_last'),
            'email' => $this->input->post('email'),
            'status' => $this->input->post('status'),
            'h_date' => date('Y-m-d', strtotime($this->input->post('h_date'))),
            's_date' => date('Y-m-d', strtotime($this->input->post('s_date'))),
            'd_payment' => $this->input->post('d_pay'),
            'purpose' => $this->input->post('purpose'),
            'c_person' => $this->input->post('cp'),
            'telephone' => $this->input->post('telephone1'),
            'phone_2' => $this->input->post('telephone2'),
            'phone_3' => $this->input->post('telephone3'),
            'c_phone' => $this->input->post('telephone'));
        $this->tenant->edit($details);
        $log_array = array('audit_action' => $this->session->userdata('name_first') . " " . $this->session->userdata('name_last') .
            " Edited details of tenant : " . $this->input->post('name'));
        $this->audittrails->log_details($log_array);
        $row = '<tr class="gradeA" id="ten_'.$id.'">
                    <td>'.$this->input->post('f_name').' '.$this->input->post('name_last').'</td>
                    <td id="t_fl_'.$id.'">'.$this->input->post('flr_name').'</td>
                    <td id="t_rm_'.$id.'">'.$this->input->post('room').'</td>
                    <td>'.$this->input->post('telephone1').'</td>
                    <td>'.$this->input->post('status').'</td>
                    <td width="20%">
                        <a class="btn14 topDir mr5 tinfo" original-title="More Info" id="'.$id.'" href="#"><img alt="" src="images/icons/dark/cog3.png"/></a>
                        <a class="btn14 topDir mr5 tnotes" original-title="Tenant\'s Notes" id="'.$id.'" href="#"><img alt="" src="images/icons/dark/paperclip.png"/></a>
                        <a class="btn14 topDir mr5 tedit" original-title="Edit" id="'.$id.'" href="#"><img alt="" src="images/icons/dark/pencil.png"/></a>
                        <a class="btn14 topDir mr5 tdel" original-title="Delete" id="'.$id.'" href="#"><img alt="" src="images/icons/dark/trash.png"/></a>
                    </td>
                </tr>';
        $data = array('status' => true,'row'=>$row);
        echo json_encode($data);
        exit;
    }

    public function edit1($id) {
        $options = array('id' => $id);
        $tenants_details = $this->tenant->GetAll($options);
        $this->form_validation->set_rules('f_name', 'First Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('name_last', 'Last Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
        $this->form_validation->set_rules('telephone1', 'Telephone', 'trim|required|integer|xss_clean');
        $this->form_validation->set_rules('cp', 'Contact Person', 'trim|required|xss_clean');
        $this->form_validation->set_rules('telephone', 'Contact Person Telephone', 'trim|required|xss_clean|integer');
        $this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean');
        $this->form_validation->set_rules('h_date', 'Handover Date', 'trim|xss_clean');
        $this->form_validation->set_rules('s_date', 'Starting Date', 'trim|xss_clean');
        $this->form_validation->set_rules('purpose', 'Purpose', 'trim|xss_clean');
        $this->form_validation->set_rules('c_person', 'Contact Person', 'trim|xss_clean');
        $this->form_validation->set_rules('telephone2', 'Telephone 2', 'trim|xss_clean|integer');
        $this->form_validation->set_rules('telephone3', 'Telephone 3', 'trim|xss_clean|integer');
        $this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean');
        $this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean');
        $this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean');

        if ($this->form_validation->run()) {
            $details = array('id' => $id,
                'f_name' => $this->input->post('f_name'),
                'name_last' => $this->input->post('name_last'),
                'email' => $this->input->post('email'),
                'status' => $this->input->post('status'),
                'h_date' => date('Y-m-d', strtotime($this->input->post('h_date'))),
                's_date' => date('Y-m-d', strtotime($this->input->post('s_date'))),
                'd_payment' => $this->input->post('d_pay'),
                'purpose' => $this->input->post('purpose'),
                'c_person' => $this->input->post('cp'),
                'telephone' => $this->input->post('telephone1'),
                'phone_2' => $this->input->post('telephone2'),
                'phone_3' => $this->input->post('telephone3'),
                'c_phone' => $this->input->post('telephone'));
            $this->tenant->edit($details);
            $log_array = array('audit_action' => $this->session->userdata('name_first') . " " . $this->session->userdata('name_last') .
                " Edited details of tenant : " . $this->input->post('name'));
            $this->audittrails->log_details($log_array);
            redirect('tenants');
        } else {
            $data['id'] = $id;
            $data['f_name'] = $tenants_details[0]['f_name'];
            $data['name_last'] = $tenants_details[0]['l_name'];
            $data['email'] = $tenants_details[0]['email'];
            $data['phone1'] = $tenants_details[0]['telephone'];
            $data['phone2'] = $tenants_details[0]['phone_2'];
            $data['phone3'] = $tenants_details[0]['phone_3'];
            $data['c_person'] = $tenants_details[0]['c_person'];
            $data['telephone'] = $tenants_details[0]['c_phone'];
            $data['purpose'] = $tenants_details[0]['purpose'];
            $data['s_date'] = $tenants_details[0]['s_date'];
            $data['h_date'] = $tenants_details[0]['h_date'];
            $data['d_pay'] = $tenants_details[0]['d_payment'];

            $statuses = NULL;
            if (isset($tenants_details[0]['status'])) {
                $statuses = "<option value=" . $tenants_details[0]['status'] . ">" . $tenants_details[0]['status'] . "</option>";
            } else {
                $statuses = "<option >--SELECT--</option>";
            }
            if ($tenants_details[0]['status'] != 'CURRENT')
                $statuses.="<option value='CURRENT'>CURRENT</option>";
            if ($tenants_details[0]['status'] != 'EVICTED')
                $statuses.="<option value='EVICTED'>EVICTED</option>";
            if ($tenants_details[0]['status'] != 'PAST')
                $statuses.="<option value='PAST'>PAST</option>";
            if ($tenants_details[0]['status'] != 'POTENTIAL')
                $statuses.="<option value='POTENTIAL'>POTENTIAL</option>";
            $data['statuses'] = $statuses;

            $x = $this->building->reg_form_drops();
            $this->load->view('xx_header');
            $x['active'] = 'TN';
            $this->load->view('xx_menu', $x);
            $this->load->view('edit_tenant', $data);
            $this->load->view('xx_footer');
        }
    }

    public function tenant_details() {
        $id = $this->input->post('tenant_id');
        $options = array('id' => $id);
        $tenants_details = $this->tenant->GetAll($options);

        $data['id'] = $id;
        $data['f_name'] = $tenants_details[0]['f_name'];
        $data['lname'] = $tenants_details[0]['l_name'];
        $data['email'] = $tenants_details[0]['email'];
        $data['phone1'] = $tenants_details[0]['telephone'];
        $data['phone2'] = $tenants_details[0]['phone_2'];
        $data['phone3'] = $tenants_details[0]['phone_3'];
        $data['c_person'] = $tenants_details[0]['c_person'];
        $data['telephone'] = $tenants_details[0]['c_phone'];
        $data['purpose'] = $tenants_details[0]['purpose'];
        $data['s_date'] = $tenants_details[0]['s_date'];
        $data['h_date'] = $tenants_details[0]['h_date'];
        $data['d_pay'] = $tenants_details[0]['d_payment'];
        $data['floor'] = $tenants_details[0]['flr_name'];
        $data['status'] = $tenants_details[0]['status'];
        $data['tpath'] = base_url() . $tenants_details[0]['pic_path'];

        //print_r($data);
        $x = array('status' => true, 'data' => $data);
        echo json_encode($x);
        exit;
    }

    public function tenant_notes() {
        $id = $this->input->post('tenant_id');
        $options = array('tenant_id' => $id);
        $tenants_details = $this->tenant->Getnotes($options);

        $data['id'] = $id;
        $data['f_name'] = $tenants_details[0]['f_name'];
        $data['lname'] = $tenants_details[0]['l_name'];
        $data['notes_description'] = $tenants_details[0]['notes_description'];
        $data['tpath'] = base_url() . $tenants_details[0]['pic_path'];
        $data['notes_date'] = $tenants_details[0]['notes_date'];
        $x = array('status' => true, 'data' => $data);
        echo json_encode($x);
        exit;
    }

    public function view_past_tenants($b_id) {
        $cleave = $this->room->get_evictions(array('building_id' => $this->session->userdata('building_id')));
        //$aziz = $this->room->get_evictions(array('rooms_b_id' => $this->session->userdata('building_id'), 'pending' => 1));
        $data['tenants'] = $cleave;
        //$data['pending_evictions'] = $aziz;
        //$x = $this->building->reg_form_drops();
        $this->load->view('xx_header');
        $this->x['active'] = 'TN';
        $this->load->view('xx_menu', $this->x);
        $this->load->view('past_tenants', $data);
        $this->load->view('xx_footer');
    }

    public function delete() {
        // $item_details = $this->item->Get2(array('item_id'=>$bi_id));
        $id = $this->input->post('tenant_id');
        $this->tenant->Delete(array('id' => $id));
        //redirect('tenants');
        $data = array('status' => true);
        echo json_encode($data);
        exit;
    }

    public function del_info() {
        $id = $this->input->post('tenant_id');
        //$id,$table_name,$parameter
        $r = $this->building->get_by_id($id, 'tenants', 'f_name,l_name');
        $data = array('tname' => $r['f_name'] . ' ' . $r['l_name']);
        echo json_encode($data);
        exit;
    }

    public function all_tenants() {
        $data = $this->tenant->Get(array('building_id' => $this->session->userdata('building_id')));
        //print_r($data);
        $t = '';
        foreach ($data as $v) {
            $t.= '<option value="' . $v['id'] . '">' . $v['f_name'] . ' ' . $v['l_name'] . '</option>';
        }
        echo json_encode(array('status' => true, 'data' => $t));
        exit;
    }

    public function get_week_notes($id){
        $date = date_create(date('Y-m-d'));
        date_sub($date, date_interval_create_from_date_string(date('w').' days'));
        $dates = $this->generate_dates(date_format($date, 'Y-m-d'),date('Y-m-d'));
        //print_r($dates);
        if($dates != 'error'){
            $q = $this->tenant->get_tenant_notes($dates,$id);
            echo $q;
        }else $tatus = false;
        
    }
    public function get_notes($id,$frdate,$todate){
        $dates = $this->generate_dates($frdate,$todate);
        if($dates != 'error'){
            $data = $this->tenant->get_tenant_notes($dates,$id);
            $status = true;
        }else{
            $status = false;
            $data = '';
        }
        echo json_encode(array('status'=>$status,'data'=>$data));
        return;
    }
    private function generate_dates($fr_date,$to_date){ // generates an array of travel date, return date, and middle days
        $r_date = new DateTime($to_date);
        $t_date= new DateTime($fr_date);
        $days = round(abs($r_date->format('U') - $t_date->format('U')) / (60*60*24));
        if($r_date < $t_date){
            return 'error';
        }else{        
            if($days==0){
                return array($t_date->format('Y-m-d'));
            }else{
                $trav_days[]=$t_date->format('Y-m-d');
                for($i=0;$i<($days);$i++){
                    $add='+1 day';
                    $t_date->modify($add);
                    $trav_days[]=$t_date->format('Y-m-d');
                }
                return $trav_days;
            }
        }    
    }
    public function view_files($tenant_id){
        $ci = & get_instance();
        
        
        $new_path = $this->path. DIRECTORY_SEPARATOR .$tenant_id;
        if (!file_exists($new_path))
            @mkdir($new_path, 0, true);
        $data['ifiles'] = $this->listfiles->getFiles($new_path);
        //print_r($data);
        $this->load->view('xx_header');
        $this->x['active'] = 'TN';
        $this->load->view('xx_menu', $this->x);
        $this->load->view('view_tenant_files',$data);
        $this->load->view('xx_footer');
    }
}