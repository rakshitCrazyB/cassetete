<?php
AUTH['required']=true;
require 'server.php';
require_once("auth.php");
if(AUTH['status'])
{
	canAdvance($uname);
}
	public function canAdvance($uname)
	{
		$current = new player();
		$curent->setPlayer($uname);
		$currLevel=$current->level;
		$i=0;

		$ne=6;	//This is the minimum no. of questions the player has to answer in each round to get to the next round.
		//Change this value to modify this minimum number of questions.

		for($q:$current->levelQuestions){ 	//for all level questions
			if($q['value']==2){				//checking if answered
				$i++;
			}
		}
		if($i!=$ne){
			$arr['error']="required number of qs not answered";
			http_respond(403,$arr);
		}
		if($i==$ne)
		{
			$current->level++;
			$current->write_back();
		//$current->score+=(advance_score_bonus);
			http_respond(200);
		}		
	}

?>
