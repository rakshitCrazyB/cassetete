<!--
/*
 * Copyright (C) 2014 crazyb(Rakshit) , SageEx(Arindam) , Codez266()Sumit)
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
 -->

<?php
require("server.php");
$AUTH['required']=true;


require_once("auth.php");

$CHV['METHOD'] = 1;
$CHV[1] = array(
    	"id" => '/[0-9]{3}/',
   	"answer" => '/[a-zA-z0-9_]+/',
	);

require_once 'chv.php';
if($allOK==false|| $AUTH['status']==0)
{
	$arr['error']="chv check failed";
	http_respond(403,$arr);
}
else
{		
		checkAnswer($jsobj['id'],$jsobj['answer'],$uname);
}
function checkAnswer($qid,$answer,$uname)// answer,qid feilds
	{
		$current=new player();
		$current->setPlayer($uname);
		$flag=0;
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
			if($answer == $question->answer)
			{
				$scobt=$question->cscore;
				$current->score+=$question->cscore;
				$current->levelquestions[$qid] = 2;
				$user = $current->username;
				$timeAns = time();
				$query = "UPDATE `Questions-$user` SET `Attempts` = `Attempts`+1 ,`Time Answered`=$timeAns , `Obtained Score`=$scobt WHERE `Question ID` = '$qid'	";
				$db_connection = $GLOBALS['db_connection'];
				if(!isset($db_connection))
				{
					http_respond(500);
				}
				else
				{
					mysqli_query($db_connection,$query);//query to increment attempts
					$tosend['stat']=1;
					http_respond(200,$tosend);
				}
			}
			else
			{
				$query = "UPDATE `Questions-$uname` SET `Attempts` = `Attempts`+1  WHERE `Question ID` = '$qid'	";
				$db_connection = $GLOBALS['db_connection'];
				if(!isset($db_connection))
				{
					http_respond(500);
				}
				else
				{
					mysqli_query($db_connection,$query);//query to increment attempts
					$tosend['stat']=0;
					http_respond(200,$tosend);
				}
				
			}
		
	}
	
?>
