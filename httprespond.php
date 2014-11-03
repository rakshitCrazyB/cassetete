<?php

function http_respond($httpstatcode,$array=false)
{
	http_response_code($httpstatuscode);
	header('Content-Type: application/json');
	if($array!=false){
		echo json_encode($array);
	}
	die();
}

?>
