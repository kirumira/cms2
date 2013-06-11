<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!($this->session->userdata('is_logged_in'))){
            echo json_encode(array('logged_out'=>true));
            redirect(base_url() . 'login');
        }
        $this->load->model('audittrails');
        $this->load->model('user');
        $this->load->model('building');
    }

    public function index() {
        $options = null; //It can't be null
        $user_data = $this->user->Get_List($options);
        $data = array('users' => $user_data);
        //print_r($data);
        $x = $this->building->reg_form_drops();
        $x['active'] = 'SM';
        $this->load->view('xx_header');
        $this->load->view('xx_menu',$x);
        $this->load->view('view_users', $data);
        $this->load->view('xx_footer');
    }
    public function reg_form(){
        $types = $this->user->Get_UsersType();
        $user_type = '';
        foreach ($types as $type) {
            $user_type .= "<option value=" . $type['id'] . ">" . $type['type'] . "</option>";
        }
        $form = '            
            <table style="width:300px;">
                    <tr>
                        <th>User Type:</th>
                        <td><select style="width:260px; max-height: 140px; margin-bottom:5px; margin-top:5px;" class="selectElement" name="select" id="regugroup" tabindex="2">
                            <option value="Select Option">Select Option</option>
                            '.$user_type.'
                            </select>
                        </td>
                     </tr>
                    <tr>
                        <th>First Name: </th>
                        <td ><input type="text" name="regular" id="regufname" value=""/></td>                
                    </tr>            
                    <tr>
                        <th>Last Name: </th>
                        <td ><input type="text" name="regular" id="regulname" value=""/></td>
                    </tr>            
                    <tr>
                        <th>Email:</th>
                        <td ><input type="text" name="regular" id="reguemail" value=""/></td>
                    </tr>
                    <tr>
                        <th>Password:</th>
                        <td ><input type="password" name="regular" id="regupw" value=""/></td>
                    </tr> 
                    <tr>
                        <th>Confirm Password:</th>
                        <td ><input type="password" name="regular" id="regucpw" value=""/></td>
                    </tr>

                </table>';
        echo $form;
        return;
    }

    public function add() {
        
        $options = array(
            'name_first' => $this->input->post('f_name'),
            'name_last' => $this->input->post('l_name'),
            'name_user' => $this->input->post('email'),
            'name_password' => $this->input->post('pass'),
            'name_group'=> $this->input->post('u_type')                
        );
        $this->user->Add($options);
        $log_array = array('audit_action' => $this->session->userdata('name_first') . " " . $this->session->userdata('name_last') . " added a new user: " . $this->input->post('name_first') . " " . $this->input->post('name_last'));
        $this->audittrails->log_details($log_array);
        echo json_encode(array('status'=>true));
        exit;
    }
    public function add_agent(){
        $options = array('name'=>$this->input->post('name'), 'number'=>$this->input->post('phone'));
        $this->user->Add_Agent($options);
        echo json_encode(array('status'=>TRUE));
    }
    public function get_all_agents(){
        $agents = $this->user->Get_Agents_data();
        $v = '<option>Select Option</option>';
        foreach($agents as $agent){
            $v .= '<option value='.$agent['id'].'>'.$agent['name'].'</option>';
        }
        echo json_encode(array('status'=>TRUE, 'dataX'=>$v));
    }
    public function all_users() {
        $options = null; //It can't be null
        $user_data = $this->user->Get_List($options);
        //$data = $this->landlord->GetAll();
        //print_r($data);
        $t = '';
        foreach ($user_data as $v) {
            $t.= '<option value="' . $v['name_id'] . '">' . $v['name_first'] . ' ' . $v['name_last'] . '</option>';
        }
        echo json_encode(array('status' => true, 'data' => $t));
        exit;
    }

    public function view_audit_trail() {
        $audit_data = $this->audittrails->view_details();
        $data['audit_data'] = $audit_data;
        $x = $this->building->reg_form_drops();
        $x['active'] = 'SM';
        $this->load->view('xx_header');
        $this->load->view('xx_menu',$x);
        $this->load->view('view_audit_trail', $data);
        $this->load->view('xx_footer');
    }

    public function _validate($str) {
        $this->load->model('user');
        if ($this->user->check_username($str)) {
            return TRUE;
        } else {
            $this->form_validation->set_message('_validate', 'Email already exists');
            return FALSE;
        }
    }

    public function email_in_outlook($to_email) {
        echo "Need to email in outlook.";
    }

}