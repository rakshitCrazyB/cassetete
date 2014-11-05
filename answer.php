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
 //TODO add score obtained to score

require("server.php");

$AUTH['required']=true;
require_once("auth.php");

$CHV['METHOD'] = 1;
$CHV[1] = array(
    "qno" => '/[0-9]{2}/',
   	"answer" => '/[a-zA-z0-9_]+/',
);
require_once 'chv.php';
	
function checkAnswer($qno, $answer, $uname, $current)
{
    $qid = 0;
	foreach($current->levelquestions as $qarr) if($qarr['qno'] == $qno) {
		$qid = $qarr['qid'];
		if($qarr['qstate'] == 2) {
		    $error['error'] = "already answered";
			http_respond(400, $error);
		}
	}
	
	if($qid == 0) {
	    //question not in levelquestions array
		http_respond(400);
	}
	
	$question = getQuestion($qid);
	if($answer == $question->answer) {
		$scobt = getQuestionCurrScore($question);
		$timeAns = time();	

		$query = "UPDATE `Questions-$uname` 
		            SET `Attempts`=`Attempts` + 1,`Time Answered`=$timeAns, `Obtained Score`=$scobt 
		            WHERE `Question ID` = '$qid';";

		questionAnsweredCorrect($question, $current);
		
		$question->numsolved++;
		$current->score += $scobt;

		$tosend['stat'] = 1;
        $responseCode = 200;
	} else {
		$query = "UPDATE `Questions-$uname` SET `Attempts` = `Attempts`+1  WHERE `Question ID` = '$qid'	";	

        questionAnsweredIncorrect($question, $current);

		$tosend['stat'] = 0;
	    $responseCode = 406;
	}
	
	$result=dbquery($query);
	
	$question->write_back();	
	$current->write_back();
	
	http_respond($responseCode, $tosend);
}


checkAnswer($CHV['CALL_ARGS']['qno'],$CHV['CALL_ARGS']['answer'],$AUTH['uname'],$AUTH['user']);
	
?>
