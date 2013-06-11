<?php
class Upload3 extends CI_Controller {

	function __construct()
	{
		parent::__construct();
                if (!($this->session->userdata('is_logged_in'))){
                    echo json_encode(array('logged_out'=>true));
                    redirect(base_url() . 'login');
                }
		$this->load->helper(array('form', 'url'));
                $this->load->model('uploads');
	}

        public function uploadImage(){
            $status = "";
            $msg = "";
            $filename='';
            $file_element_name = 'txtURL2';//Name of input field
            $u_id = $this->input->post('user_id');


            if (empty($_POST['title'])){
                $status = "error";
                $msg = "Please enter a title";
            }

            if ($status != "error"){

                //$targetPath = ''.date('Y').'/'.date('m').'/';
                $targetPath = 'uploads/users/';

                if(!file_exists(str_replace('//','/',$targetPath))){
                    mkdir(str_replace('//','/',$targetPath), 0777, true);
                }

                $config['upload_path'] = $targetPath;
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size'] = 150000;
                $config['file_name']='user_'.$u_id; //File name you want
                $config['encrypt_name'] = FALSE;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if(!$this->upload->do_upload($file_element_name)){
                    $status = false;
                    $msg = $this->upload->display_errors('', '');
                }
                else{
                    $data = $this->upload->data();
                    $filename = $targetPath.$data['file_name'];
//                    $this->uploads->insert_t_pic_path($filename,$t_id);
                    $this->uploads->insert_u_pic_path($filename, $u_id);
                    if($this->session->userdata('name_id')==$u_id){
                        $this->session->set_userdata(array("name_pic_path"=>$filename));
                    }
                    $status = true;
                }
                //@unlink($_FILES[$file_element_name]);
            }

            echo json_encode(array('status' => $status, 'msg' => $msg,'path'=>base_url().$filename));
    }

}
?>
