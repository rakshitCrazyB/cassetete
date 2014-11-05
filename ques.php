<?
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
 
 
 // TODO reduce cost from score
require("server.php");

$AUTH['required']=true;
require_once("auth.php");

$CHV['METHOD'] = 0;
$CHV[0] = array(
    "qno" => '/[0-9]{2}/',
);
require_once('chv.php');

function tosend($player)
{
    $tosend['type'] = $q->type;
    $tosend['bscore'] = $q->bscore;
	$tosend['cscore'] = $q->cscore;
    $tosend['id'] = $q->id;
    $tosend['image']= $q->image;
	$tosend['text'] = $q->text;
	retrun $tosend;    
}

function questioncall($jsobj, $uname, $current)	
{	
	$cost = getQuestionCost();
	$value = $jsobj['qno'];	
	
	if($current->score < $cost) {
		$tosend['error']="not enough score";	
		http_respond(403, $tosend);
	} else if(intval($value/10) != $current->level)	{
		$tosend['error'] = "wrong level";	
		http_respond(403, $tosend);	
	} else {
		$flag = 0;
		foreach($current->levelquestions as $qarr) if($qarr['qno'] == $value) {
		    $value = $qarr['qid'];
    	    $q = getQuestion($value);
			$flag++;
			$c = $qarr['qstate'];

			if($c == 0) { //Question unopened
				$q->numopened++;
				$q->write_back();
				$d = time();
				$qry = "update `Questions-$uname` set `Time Opened`=$d where `Question ID`=$value";
				$db_connection = $GLOBALS['db_connection'];
				$result = mysqli_query($db_connection,$qry);
				if($result == false) {
					http_respond(500);
				}
				$tosend=tosend($q);
			} else if ($c == 1) { //Question opnened, unanswered
                $tosend=tosend($q);	
			} else if($c == 2) { //Question answered
				$tosend['error'] = "Already Ansered";	
				http_respond(403, $tosend);
			}						
		}
		
		if($flag == 0) {
		    $tosend = null;
			$error['error'] = "question ${value} does not exist.";
			http_respond(401, $error);
		}	
	}
	http_respond(200,$tosend);
}
		

questioncall($jsobj, $AUTH['uname'], $AUTH['user']);
?>
