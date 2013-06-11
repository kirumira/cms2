<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Authex{

 function Authex()
 {
     $CI =& get_instance();

     //load libraries
     $CI->load->database();
     $CI->load->library("session");
 }

 function get_userdata()
 {
     $CI =& get_instance();

     if( ! $this->logged_in())
     {
         return false;
     }
     else
     {
          $query = $CI->db->get_where("userz", array("ID" => $CI->session->userdata("userz_id")));
          return $query->row();
     }
 }

 function logged_in()
 {
     $CI =& get_instance();
     return ($CI->session->userdata("userz_id")) ? true : false;
 }

 function login($email, $password)
 {
     $CI =& get_instance();

     $data = array(
         "email" => $email,
         "password" => sha1($password)
     );

     $query = $CI->db->get_where("userz", $data);

     if($query->num_rows() !== 1)
     {
         /* their username and password combination
         * were not found in the databse */

         return false;
     }
     else
     {
         //update the last login time
         $last_login = date("Y-m-d H-i-s");

         $data = array(
             "last_login" => $last_login
         );

         $CI->db->update("userz", $data);

         //store user id in the session
         $CI->session->set_userdata("userz_id", $query->row()->ID);

         return true;
     }
 }

 function logout()
 {
     $CI =& get_instance();
     $CI->session->unset_userdata("userz_id");
 }

 function register($email, $password)
 {
     $CI =& get_instance();

     //ensure the email is unique
     if($this->can_register($email))
     {
         $data = array(
             "email" => $email,
             "password" => sha1($password)
         );

         $CI->db->insert("userz", $data);

         return true;
     }

     return false;
 }

 function can_register($email)
 {
     $CI =& get_instance();

     $query = $CI->db->get_where("userz", array("email" => $email));

     return ($query->num_rows() < 1) ? true : false;
 }
}