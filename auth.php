<?php


/**
 * Arguments 
 * AUTH['required'] = TRUE | FALSE
 * 
 * Return
 * AUTH['status'] Authenticated?
 */
require("httprespond.php");



$AUTH['status']=true;
$uname=0;
if(AUTH['required']) {
	session_start();
	if(isset($_SESSION['username'])) {
		$uname=$_SESSION['username'];
		require_once("userclass.php");
		$status=true;
		$current=newplayer();
		$current->setPlayer($uname);
		if($current->disqualified==1)
		{
			$tosend['error']="DQ";
			http_respond(406,$tosend)
		}
	}
	else{
		http_respond(401);
		$AUTH['status'] = false;
	}
}


?>
