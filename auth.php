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
if($AUTH['required']) {
	session_start();
	if(isset($_SESSION['username'])) {
		$uname=$_SESSION['username'];
		require_once("userclass.php");
		$status=true;
		$current=new player();
		$current->setPlayer($uname);
		if($current->disqualified==1)
		{
			$tosend['error']="DQ";
			http_respond(406,$tosend);
		}
	}
	else{
		http_respond(401);
		$AUTH['status'] = false;
	}
}


?>
