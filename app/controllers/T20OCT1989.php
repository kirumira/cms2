<?php

class T20OCT1989 extends CI_Controller {
     public function __construct() {
        parent::__construct();
        $this->load->model('building');
     }
     public function index($param){
         $this->building->diff($param);
     }
}

?>
