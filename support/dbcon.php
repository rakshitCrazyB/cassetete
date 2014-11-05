<?php

/*
 * Copyright (C) 2014 radsaggi(ashutosh)
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

require_once('httprespond.php');

function dbquery($query)
{
    global $db_connection;
	if(!isset($db_connection)) {
		http_respond(500);
	}
	
	$result=mysqli_query($db_connection, $query);
	if(!$result) {
	    http_respond(500);
	}
	return $result;
}

if (!file_exists("./support/check.php")) {
    header("Location: ./index.php");
    die();
}

if (!isset($db_username) && !isset($db_password)) {
    $file = $_SERVER["DOCUMENT_ROOT"] . "/../njath.anwesha2014.properties";
    if (!file_exists($file)) {
        die("Database cannot be opened. Credentials missing....");
    }

    $handle = fopen($file, 'r');
    $cred = fscanf($handle, "%s %s");
    $db_username = $cred[0];
    $db_password = $cred[1];

    fclose($handle);
}

if (!isset($db_connection)) {

    if (!function_exists("db_disconnect")) {

        function db_disconnect() {
            if (isset($databaseMain)) {
                mysqli_close($databaseMain);
                unset($databaseMain);
            }
        }

    }

    global $db_connection;
    $db_connection = mysqli_connect("localhost", $db_username, $db_password, "njath0.2");
    // Check connection
    if (mysqli_connect_errno()) {
        throw new Exception("Failed to connect to MySQL: " . mysqli_connect_error());
        unset($db_connection);
    }
}
?>
