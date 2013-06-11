<?php

class Msg extends CI_Model {


    function __construct() {
        parent::__construct();
    }

    function send_msg($options=array()) {
    	$url = 'http://121.241.242.114:8080/bulksms/bulksms';
		$handle = curl_init($url);
		curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);

		$data = array(
			"username"=>"cd1-cranemgtsys",
			"password"=>"cms123",
			"type"=>"0", 
			"dlr"=>"1", 
			"destination"=>$options['destination'], 
			"source"=>"CMS", 
		    "message"=>$options['message']);

		curl_setopt($handle,  CURLOPT_POST, TRUE);
		//curl_setopt($handle,  CURLOPT_HTTPHEADER, array('Content-Type: text'));
		curl_setopt($handle,  CURLOPT_POSTFIELDS, $data);


		/* Get the HTML or whatever is linked in $url. */
		$response = curl_exec($handle);

		/* Check for 404 (file not found). */
		$httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);

		//echo $httpCode;

		curl_close($handle);
    }
}
?>
