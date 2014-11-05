<?php

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

require("server.php");
$AUTH['required']=true;


require_once("auth.php");

$CHV['METHOD'] = 1;
$CHV[1] = array(
    	"qno" => '/[0-9]{2}/',
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
		checkAnswer($jsobj['qno'],$jsobj['answer'],$uname);
}
function checkAnswer($qno,$answer,$uname)// answer,qid feilds
	{
		$current=new player();
		$current->setPlayer($uname);
		$flag=0;
		foreach($current->levelquestions as $b)
		{
		    if($b['qno']==$qno)
		    {
		        $qid=$b['qid'];
		    }
		}
		for($i=0;$i<sizeof($current->levelquestions);$i++)
		{

			if($current->levelquestions[$i]['qid']==$qid)
			{
				$flag++;
				if($current->levelquestions[$i]['qstate']==2)
				{
				    $error['error']="alredy answered";
					http_respond(400,$error);   // already answered
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
				$user = $current->username;
				$timeAns = time();
				
				$scobt=50;////////to be changed
				$query = "UPDATE `Questions-$user` SET `Attempts` = `Attempts`+1 ,`Time Answered`=$timeAns , `Obtained Score`=$scobt WHERE `Question ID` = '$qid'	";
				$db_connection = $GLOBALS['db_connection'];
				if(!isset($db_connection))
				{
					
					http_respond(500);
				}
				else
				{	
					$question->cscore=50;/////to be changed
					$result=mysqli_query($db_connection,$query);//query to increment attempts
					$q=getQuestion($qid);
					$q->numsolved++;
					$q->write_back();
					$current->score+=$question->cscore;
					$current->write_back();
					if(!$result)
					{
						http_respond(500);
					}
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
					$result=mysqli_query($db_connection,$query);//query to increment attempts
					if(!$result)
					{
						http_respond(500);
					}
					$tosend['stat']=0;
					http_respond(200,$tosend);
				}
				
			}
		
	}
	
?>
