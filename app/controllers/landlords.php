<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//session_start();

class Landlords extends CI_Controller {

    var $file;
    var $path;
    var $x;

    public function __construct() {
        parent::__construct();
        if (!($this->session->userdata('is_logged_in'))){
            echo json_encode(array('logged_out'=>true));
            redirect(base_url() . 'login');
        }
        $this->load->model('building');
        $this->load->model('user');
        $this->load->model('landlord');
        $this->load->model('audittrails');
        $this->load->model('floor');
        $this->x = $this->building->reg_form_drops();   
        $this->x['floor_names'] = $this->floor->get_all_floors(); 
    }
    
    public function landlord_details() {
        $id = $this->input->post('landlord_id');
        $options = array('landlord_id' => $id);
        $tenants_details = $this->landlord->Get($options);//mistake-->returns all landlords
        
        $data['id'] = $id;
        $data['l_name_first'] = $tenants_details[0]['l_name_first'];
        $data['l_name_last'] = $tenants_details[0]['l_name_last'];
        $data['l_email'] = $tenants_details[0]['l_email'];
        $data['telephone'] = $tenants_details[0]['telephone'];
        $data['group'] = $tenants_details[0]['group'];
       
        $data['lpath'] = base_url() . $tenants_details[0]['pic_path'];

        //print_r($data);
        $x = array('status' => true, 'data' => $data);
        echo json_encode($x);
        exit;
    }

    public function index() {
        $landlords = $this->landlord->GetAll($options = array());
        //get number of buildings per landlord
        $data['landlords'] = $landlords;
        $options = array();
        foreach ($landlords as $landlord) {
            $buildings = $this->building->Get(array('l_id' => $landlord['id']));
            $num = count($buildings);
            $landlord['b_num'] = $num;            
            $rev = $this->building->Get_Total_Revenue(array('l_id' => $landlord['id']));
            if (isset($rev[0]['subtotal'])) {
                $landlord['revenue'] = $rev[0]['subtotal'];
            } else {
                $landlord['revenue'] = 0;
            }
            $options[] = $landlord;
        }
        $data['landlords'] = $options;
        //$x = $this->building->reg_form_drops();
        $this->load->view('xx_header');
        $this->x['active'] = 'LL';
        $this->load->view('xx_menu',$this->x);
        $this->load->view('view_landlords', $data);
        $this->load->view('xx_footer');
    }

    public function view($id) {
        $landlords = $this->landlord->Get($options = array('landlord_id' => $id));
        $buildings = $this->building->Get(array('l_id' => $id));
        $options2 = array();
        $total = 0;
        foreach ($buildings as $row) {
            $revenue = $this->building->GetRevenue(array('b_id' => $row['b_id']));
            $row['revenue'] = $revenue[0]['subtotal'];
            $options2[] = $row;
            $total += $revenue[0]['subtotal'];
        }
        $data['landlords'] = $landlords;
        $data['buildings'] = $options2;
        $data['total'] = $total;
        $this->load->view('xx_header');
        $this->x['active'] = 'LL';
        $this->load->view('xx_menu',$this->x);
        $this->load->view('view_landloard_details', $data);
        $this->load->view('xx_footer');
    }

    public function view_landlord($id) {
        $landlords = $this->landlord->Get($options = array('landlord_id' => $id));
        $buildings = $this->building->Get(array('l_id' => $id));

        $num = count($buildings);
        $landlord['telephone'] = $landlords[0]['telephone'];
        $landlord['l_email'] = $landlords[0]['l_email'];
        $landlord['b_num'] = $num;
        $options[] = $landlord;

        $data['x'] = $landlords;
        $data['landlords'] = $options;
        $this->load->view('xx_header');
        //$x = $this->building->reg_form_drops();
        $this->x['active'] = 'LL';
        $this->load->view('xx_menu',$this->x);
        $this->load->view('view_landlord_details', $data);
        $this->load->view('xx_footer');
    }

   public function add(){
        $name = $this->landlord->check_name(array('l_name_first'=>$this->input->post('f_name')));
        if($name!=null){
            echo json_encode(array('status'=>false));
        }else{
        $options = array(
                'l_name_first' => $this->input->post('f_name'),
                //'l_name_last' => $this->input->post('l_name'),
                'l_email' => $this->input->post('email'),
                'pass' => $this->input->post('pass'),
                'telephone' => $this->input->post('telephone')
            );
        if($this->input->post('grpType')=='New'){
            //            $group = $this->landlord->check_group();
            $options['group'] = $this->landlord->add_group($options2=array('grp_name'=>$this->input->post('group')));
        }else{
            $options['group'] = $this->input->post('group');
        }
        $landlord_id = $this->landlord->Add($options);
        //$landlord_up = $this->building->Update(array('landlord_id' => $landlord_id));
        $log_array = array('audit_action' => $this->session->userdata('name_first') . " " . $this->session->userdata('name_last') .
            " added a new landlord: " . $this->input->post('f_name') . " " . $this->input->post('l_name'));
        $this->audittrails->log_details($log_array);

        echo json_encode(array('status'=>true));
        }
    }
    public function reg_form(){
        //$groups1 = $this->landlord->GetAll(array());
        $groups1 = $this->landlord->get_group();
        $groups = '';
        foreach ($groups1 as $row) {
            $groups.="<option value=" . $row['grp_id'] . ">" . $row['grp_name'] . "</option>";
        }
        $form = '
            <table style="width:300px;">
                    <tr>
                        <th>Group:</th>
                        <td><select style="width:260px; max-height: 140px; margin-bottom:5px; margin-top:5px;" class="selectElement" name="select" id="reglgroup" tabindex="2">
                            <option value="None">NONE</option><option value="New">New</option>
                            '.$groups.'
                            </select>
                        </td>
                     </tr>
                     <tr style="display:none;" id="n_grp">
                        <th>Group Name:</th>
                        <td><input type="text" name="regular" id="reglnewgrpname" value=""/></td>
                    </tr>
                    <tr>
                        <th>Name: </th>
                        <td style"vertical-align:middle;"><input type="text" name="regular" id="reglfname" value=""/></td>
                    </tr>
                    <tr>
                        <th>Telephone: </th>
                        <td style"vertical-align:middle;"><input type="text" name="regular" id="regltel" value=""/></td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td style"vertical-align:middle;"><input type="text" name="regular" id="reglemail" value=""/></td>
                    </tr>
                     <tr>
                        <th>Password:</th>
                        <td style"vertical-align:middle;"><input type="text" name="regular" id="reglpass" value=""/></td>
                    </tr>

                </table>';
        echo $form;
        return;
    }
    public function add1() {
        $this->form_validation->set_rules('f_name', 'First name', 'trim|required');
        $this->form_validation->set_rules('l_name', 'Last name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('telephone', 'Telephone', 'trim|required|numeric');
        if ($this->form_validation->run()) {
            $options = array(
                'l_name_first' => $this->input->post('f_name'),
                'l_name_last' => $this->input->post('l_name'),
                'l_email' => $this->input->post('email'),
                'group' => $this->input->post('group'),
                'telephone' => $this->input->post('telephone')
            );
            $landlord_id = $this->landlord->Add($options);
            //edit buildings table.
            $landlord_up = $this->building->Update(array('landlord_id' => $landlord_id, 'building_id' => $this->input->post('building')));
            $log_array = array('audit_action' => $this->session->userdata('name_first') . " " . $this->session->userdata('name_last') .
                " added a new landlord: " . $this->input->post('f_name') . " " . $this->input->post('l_name'));
            $this->audittrails->log_details($log_array);
            redirect('landlords');
        }
        $groups = $this->landlord->GetAll(array());
        $group = NULL;
        foreach ($groups as $row) {
            $group.="<option value=" . $row['group'] . ">" . $row['group'] . "</option>";
        }
        $data['groups'] = $group;

        $this->load->view('xx_header');
        //$x = $this->building->reg_form_drops();
        $this->x['active'] = 'LL';
        $this->load->view('xx_menu',$this->x);
        $this->load->view('add_new_landlord', $data);
        $this->load->view('xx_footer');
    }

    public function edit_landlord($landlord_id) {
        $this->form_validation->set_rules('f_name', 'First name', 'trim|required');
        $this->form_validation->set_rules('l_name', 'Last name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('telephone', 'Telephone', 'trim|required|numeric');
        $this->form_validation->set_rules('building', 'Building', 'trim|required');
        if ($this->form_validation->run()) {
            $options = array('landlord_id' => $landlord_id,
                'f_name' => $this->input->post('f_name'),
                'l_name' => $this->input->post('l_name'),
                'email' => $this->input->post('email'),
                'telephone' => $this->input->post('telephone'),
                'building_id' => $this->input->post('building'));
            $this->landlord->edit_landlord($options);
            $log_array = array('audit_action' => $this->session->userdata('name_first') . " " . $this->session->userdata('name_last') .
                " edited details about a landlord: " . $this->input->post('f_name') . " " . $this->input->post('l_name'));
            $this->audittrails->log_details($log_array);
            redirect('landlords');
        }

        $buildings = $this->building->GetBuilding(array());
        $building = NULL;
        foreach ($buildings as $row) {
            $building.="<option value=" . $row['b_id'] . ">" . $row['b_name'] . "</option>";
        }
        $data['buildings'] = $building;
        $data['landlord_data'] = $this->landlord->Get(array('landlord_id' => $landlord_id));
        $this->load->view('xx_header');
        //$x = $this->building->reg_form_drops();
        $this->x['active'] = 'LL';
        $this->load->view('xx_menu',$this->x);
        $this->load->view('edit_landlord', $data);
        $this->load->view('xx_footer');
    }

    public function delete_landlord($landlord_id) {
        $this->landlord->Delete(array('landlord_id' => $landlord_id));
        redirect('landlords');
    }

    public function viewfiles($building_id) {}

    public function all_landlords() {
        $data = $this->landlord->GetAll();
        //print_r($data);
        $t = '';
        foreach ($data as $v) {
            $t.= '<option value="' . $v['id'] . '">' . $v['l_name_first'] . ' ' . $v['l_name_last'] . '</option>';
        }
        echo json_encode(array('status' => true, 'data' => $t));
        exit;
    }
    public function edit() {////by silas
        $id = $this->input->post('landlord_id');
        $details = array('id' => $id,
            'f_name' => $this->input->post('f_name'),
            'name_last' => $this->input->post('name_last'),
            'email' => $this->input->post('email'),
            'group' => $this->input->post('group'),
            'telephone' => $this->input->post('telephone'));

        $this->landlord->edit($details);
        $log_array = array('audit_action' => $this->session->userdata('name_first') . " " . $this->session->userdata('name_last') .
            " Edited details of landlord : " . $this->input->post('f_name'));
        $this->audittrails->log_details($log_array);
        $data = array('status' => true);
        echo json_encode($data);
        exit;
    }

}

