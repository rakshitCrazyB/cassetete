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
if($AUTH['status'])
{
	getProfile($uname);
}
	function getProfile($uname)
	{	$username=$uname;
		$user = new player;
		$user->setPlayer($username);
		$userdetails = array();
		$userdetails['username'] = $user->username;
		$userdetails['score'] = $user->score;
		$userdetails['level'] = $user->level;
		$userdetails['disqualified'] = $user->disqualified;
		$userdetails['tchests'] = $user->tchests;
		$b=array();
		foreach($user->levelquestions as $a)
		{
		   $temp['qno']=$a['qno'];
		   $temp['qstate']=$a['qstate'];
		   $b[]=$temp;
		}
		$userdetails['levelquestions'] = $b;
		http_respond(200,$userdetails);
	}
?>
	
