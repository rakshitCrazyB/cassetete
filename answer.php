<?php
require("server.php");
AUTH['required']=true;
require_once("auth.php");
$chv['METHOD'] = 2;
$chv[1] = array(
    	"id" => '/[0-9]{3}/'
    	"answer" => '/[a-zA-z0-9_]/'
	);
require 'chv.php';
if(!allOK||!AUTH['status'])
{
	$arr['error']="chv check failed";
	http_respond(403,$arr);
}
else
{
		checkAnswer($jsobj['qid'],$jsobj['answer']);
}
public function checkAnswer($qid,$answer)// answer,qid feilds
	{
		$current=new player();
		$current->setPlayer($uname);
		$flag=0
		for($i=0;$i<sizeof($current->levelquestions);$i++)
		{
			if($current->levelquestions[$i]['qid']==$qid)
			{
				$flag++;
				if($current->levelquestions[$i]['qstate']==2)
				{
					http_respond(400);   // already answered
				}
			}
		}
		if($flag==0)
		{
			http_respond(400);//question not in levelquestions array
		}
			$question = getQuestion($qid);
			if($answer] == $question->answer)
			{
				$scobt=$question->cscore;
				$current['score']+=$question->cscore;
				$current->levelquestions[$qid] = 2;
				$user = $current->username;
				$timeAns = time()
				$query = "UPDATE `Questions-$user` SET `Attempts` = `Attempts`+1 ,`Time Answered`=$timeans , `Obtained Score`=$scobt WHERE `Question ID` = '$question->id'	";
				$db_connection = $GLOBALS['db_connection'];
				if(!isset($db_connection))
				{
					http_respond(500);
				}
				else
				{
					mysqli_query($db_connection,$query);//query to increment attempts
					http_respond(200);
				}
			}
		
	}
	
?>
