<?php


class login_model extends CI_Model{
    
    public function __construct(){
        parent::__construct();
    }

    public function validate_user(){
        if($this->input->post('username')==''||$this->input->post('username')=='Email'){
            return "username";
        }else if($this->input->post('password')==''||$this->input->post('password')=='Password'){
            return "password";
        }else{
            $query1 = 'SELECT * FROM `users` WHERE `name_user`="'.$this->input->post('username').'" AND `name_password`=PASSWORD("'.$this->input->post('password').'")';
            //$query = $this->db->get_where('users',array('name_user'=>$this->input->post('username'),'name_password'=>($this->input->post('password'))));
            $query = $this->db->query($query1);
            $data = array();
            //////
            
            /////
            
            if($query->num_rows()>0){
//                foreach($query->result() as $row){
//                    $data[]= array('loggedin_id'=>$row->name_id,'email'=>$row->name_user,'fname'=>$row->name_first, 'lname'=>$row->name_last, 'picpath'=>$row->name_pic_path);
//                }
                return true;
            }else{
                return false;
            }
        }
    }
    
}

?>
