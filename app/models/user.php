<?php

class User extends CI_Model {

    var $table = 'users';

    function __construct() {
        parent::__construct();
    }

    function Add($options = array()) {
        $query = "INSERT INTO `".$this->table."` (`name_first`, `name_last`, `name_user`, `name_password`, `name_group`) VALUES
                    ('".$options['name_first']."', '".$options['name_last']."', '".$options['name_user']."', PASSWORD('".$options['name_password'].
                    "'), ".$options['name_group'].")";
        //$this->db->insert($this->table, $options);
        //$q_str = "INSERT INTO `users` `(`name_first`, `name_last`, `name_user`, `name_password`, `name_group`) VALUES (".$options['name_first'].",".$options['name_last'].",".$options['name_user'].", PASSWORD(".$options['name_password']."),".$options['name_group'].")";
        $QUERY = $this->db->query($query);
        return $this->db->insert_id();
    }
    function Add_Agent($options=array()) {
        $this->db->insert('agents', $options);
        return $this->db->insert_id();
    }
    function Get_Agents_data($options=array()){
        $this->db->select('id, name, number');
        if(isset($options['agent_id']))
            $this->db->where('agents.id', $options['agent_id']);
        $query = $this->db->get('agents');
        return $query->result_array();
    }
    
    function get_agents_excel_data($options=array()) {
        $agents = $this->get_all_agents();
        $data_array = array(); $data_array2 = array();
        foreach($agents as $agent){
            $data = $this->get_agent_excel_data(array('agent_id'=>$agent['id']));
            $data_array2[] = array('agent_name'=>$this->get_agent_name($agent['id']),'tenant_name'=>'', 'date'=>'','room'=>'','building'=>'');
            foreach($data as $x){
                $data_array['agent_name']='';
                $data_array['tenant_name'] = $x['tenant_name'];
                $data_array['room'] = $x['room'];
                $data_array['building'] = $x['building'];
                $data_array['date'] = $x['status'];
                $data_array2[] = $data_array;
            }
        }
        return $data_array2;
    }
    private function get_agent_name($agent_id){
        $this->db->select('name');
        $this->db->where('agents.id', $agent_id);
        $query = $this->db->get('agents');
        $q = $query->result_array();
        return $q[0]['name'];
    }
    function get_agent_excel_data($options=array()){
        $this->db->select('f_name, l_name, room_name, b_name, name, status');
        $this->db->where('agents.id', $options['agent_id']);
        $this->db->join('tenants', 'agents.id = tenants.agent', 'LEFT');
        $this->db->join('rooms', 'tenants.room_id = rooms.rm_id');
        $this->db->join('buildings', 'tenants.tenants_b_id = buildings.b_id');
        $query = $this->db->get('agents');
        $Q = $query->result_array();
        $data = array(); $data2 = array();
        foreach($Q as $row){
            $data['tenant_name'] = $row['f_name']. ' '. $row['l_name'];
            $data['building'] = $row['b_name']; 
            $data['room'] = $row['room_name'];
            $data['name'] = $row['name'];
            $data['status'] = $row['status'];
            $data2[] = $data;
        }
        return $data2;
    }
    private function get_all_agents($options=array()){
        $this->db->select('id');
        $query = $this->db->get('agents');
        return $query->result_array();
    }
    function get_all_agent_excel_data($options=array()) {
        $this->db->select('f_name, l_name, room_name, b_name, name');
        $this->db->join('tenants', 'agents.id = tenants.agent', 'LEFT');
        $this->db->join('rooms', 'tenants.room_id = rooms.rm_id');
        $this->db->join('buildings', 'tenants.tenants_b_id = buildings.b_id');
        $query = $this->db->get('agents');
        return $query->result_array();
    }
    function Update($options = array()) {
        if (!$this->_required(array('name_id'), $options)) {
            return FALSE;
        }
        if (isset($options['name_first']))
            $this->db->set('name_first', $options['name_first']);
        if (isset($options['name_last']))
            $this->db->set('name_last', $options['name_last']);
        if (isset($options['name_user']))
            $this->db->set('name_user', $options['name_user']);
        if (isset($options['name_password']))
            $this->db->set('name_password', $options['name_password']);
        if (isset($options['name_group']))
            $this->db->set('name_group', $options['name_group']);

        $this->db->update($this->table);
        return $this->db->affected_rows();
    }

    function Get_Name($id) {
        $query = $this->db->get_where($this->table, array('name_id' => $id));
        return $query->result_array();
    }

    function Get_list(){
        $query = $this->db->query("SELECT *  FROM `users`");
//        echo "Sila";
//        $this->db->select('*');
//       // $this->db->from('users');
//        $query = $this->db->get('users');
        return $query->result_array();
    }
    function Get_List1($options = array()) {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->join('user_types', 'users.name_group=user_types.id', 'LEFT');
        if (isset($options['name_id']))
            $this->db->where('name_id', $options['name_id']);
        if (isset($options['name_user']))
            $this->db->where('name_user', $options['name_user']);
        if (isset($options['name_password']))
            $this->db->where('name_password', $options['name_password']);
        if (isset($options['name_group']))
            $this->db->where('name_group', $options['name_group']);
        $query = $this->db->get();
        return $query->result_array();
    }

    function Get($options = array()) {
        if ($options == null) {
            $query = $this->db->get($this->table);
        } else {
            $str_query = "SELECT * FROM " . $this->table . " WHERE `name_user` = '" . $options['name_user'] . "' AND `name_password` = PASSWORD('" . $options['name_password'] . "')";
            $QUERY = $this->db->query($str_query);
            return $QUERY->result_array();
        }
    }

    function Get_UsersType($options=array()){
       $this->db->select('*');
        $query= $this->db->get('user_types');
        return $query->result_array();
    }

    function Login($vals = array()) {
        
        $arrayd = array('name_first' => $vals[0]['name_first'],
            'name_last' => $vals[0]['name_last'],
            'name_id' => $vals[0]['name_id'],
            'name_group' => $vals[0]['name_group'],
            'name_user' => $vals[0]['name_user'],
            'name_pic_path' => $vals[0]['name_pic_path'],
            'is_logged_in' => TRUE);
        $ci = & get_instance();
        $ci->session->set_userdata($arrayd);
        return true;
    }

    function Delete($options = array()) {
        
    }

    function check_username($name_user) {
        $query = $this->db->get_where($this->table, array('name_user' => $name_user));
        if ($query->num_rows() != 0) {
            //Username exists already
            return FALSE;
        } else {
            //Username doesn't exist
            return TRUE;
        }
    }

    function _SetDefaults($defaults, $options) {
        return array_merge($defaults, $options);
    }

    function _required($required, $data) {
        foreach ($requird as $field) {
            if (!isset($data[$field])) {
                return FALSE;
            }
        }
        return TRUE;
    }
function Login2($vals = array()) {
    //print_r($vals);return;
        $arrayd = array('name_first' => $vals[0]['l_name_first'],
            'name_last' => $vals[0]['l_name_last'],
            'name_id' => $vals[0]['id'],
            'name_user' => $vals[0]['l_email'],
            'user_type' => 'landlord',
            'name_pic_path' => $vals[0]['pic_path'],
            'is_logged_in' => TRUE);
        $ci = & get_instance();
        $ci->session->set_userdata($arrayd);
        //session_start();
        return true;
    }

}