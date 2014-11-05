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
 * AUTH['uname'] The username of authenticated user
 * AUTH['user'] The user object of authenticated user
 */
require_once("httprespond.php");

$AUTH['status'] = false;
$AUTH['uname'] = null;
$AUTH['user'] = null;
$uname = null;

if($AUTH['required']) {
	session_start();
	
	if(isset($_SESSION['username'])) {
		$AUTH['uname'] = $_SESSION['username'];
		$AUTH['status'] = true;
		
		require_once('userclass.php');
		$AUTH['user'] = new player();
    	$AUTH['user']->setPlayer($AUTH['uname']);
	} else {
		http_respond(401);
	}
}


?>
