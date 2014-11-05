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
$AUTH['required']=true;
require 'server.php';
require_once("auth.php");
	
function canAdvance($uname,$current)
{
	$currLevel=$current->level;
	$i=0;
	$ne=2;	//This is the minimum no. of questions the player has to answer in each round to get to the next round.
		    //Change this value to modify this minimum number of questions.
	foreach($current->levelquestions as $q)
	{ 	//for all level questions
		if($q['qstate']==2)
		{				//checking if answered
			$i++;
		}
	}
	if($i<$ne)
	{
		$arr['error']="required number of qs not answered";
		http_respond(403,$arr);
	}
	if($i>=$ne)
	{
		$current->level++;
		//$current->score+=(advance_score_bonus);
		$current->write_back();
		$arr['stat']="1";
		http_respond(200,$arr);
	}		
}
canAdvance($AUTH['uname'],$AUTH['user']);

?>
