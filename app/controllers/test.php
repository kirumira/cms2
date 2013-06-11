<?php
class Test extends CI_Controller{
    var $path;
    public function __construct(){
        parent::__construct();
        $this->load->library('/libpdf/reporting.php');
        $this->load->library('num_to_words.php');
        $this->load->library('num_to_words.php');
        $this->load->library('listfiles', array('jpg', 'jpeg', 'pdf','doc','docx'));
        $this->path = './documents/tenants/';
    }
    public function edit_balance(){
        $options=array('rm_id'=>9, 'credit'=>0, 'debit'=>2000);
        $x = $this->room->edit_rm_bal($options);
        echo $x;
    } 
   /* public function index() {
        $this->load->model('msg');
        $this->msg->send_msg(array('destination' =>"256779778007" ,'message'=>'Good to go'));
    }*/
    function index(){
        echo $this->msg->send_msg(array('destination'=>'256779664901', 'message'=>'It works'));
        
       
    }

}

?>
