<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//session_start();

class Test_controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('date');
    }

    public function index() {
        //$this->load->view('tests/test_dropd');
        echo date('F');
        //echo strtotime('2012-12-24');
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

}
