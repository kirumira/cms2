<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of uploads
 *
 * @author Obadeiah
 */
class Uploads extends CI_Model {
    function __construct()
    {
        parent::__construct();
            
    }
    
    public function insert_t_pic_path($filename,$id){
        $data = array('pic_path'=>$filename);
        $this->db->update('tenants',$data,array('id' => $id));
    }
    public function insert_l_pic_path($filename, $id){
        $data = array('pic_path'=>$filename);
        $this->db->update('landlords', $data, array('id' => $id));
    }
    public function insert_u_pic_path($filename, $id){
        $data = array('name_pic_path'=>$filename);
        $this->db->update('users', $data, array('name_id' => $id));
    }
    public function insert_floor_plan_path($filename, $id){
        $data = array('flr_plan'=>$filename);
        $this->db->update('floors', $data, array('f_id' => $id));
    }
}
?>
