<?php
	
AUTH['required']=true;
require 'server.php';
require_once("auth.php");
if(AUTH['status'])
{
	getProfile($uname);
}
	public function getProfile($uname)
	{	$username=$uname;
		$user = new player;
		$user->setPlayer($username);
		$userdetails = array();
		$userdetails['username'] = $user->username;
		$userdetails['score'] = $user->score;
		$userdetails['level'] = $user->level;
		$userdetails['disqualified'] = $user->disqualified;
		$userdetails['tchests'] = $user->tchests;
//		$userdetails['currentq'] = $user->currentq;
		$userdetails['levelquestions'] = $user->levelQuestions;
		http_respond(200,$userdetails);
	}
?>
	
