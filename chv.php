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
 * CHV[idx] = an array representing the required arguments and their matching regex
 * CHV['METHODS'] = binary number representing the methods you wish to handle.
 * 
 * Return 
 * CHV['CALL_METHOD'] the method actually used.
 * CHV['ALL_OKAY'] 
 */


$chv_methods = array(
    0 => 'GET',
    1 => 'POST',
    2 => 'PUT',
    //3 => "DELETE",
);
$chv_vars = array(
    0 => $_GET,
    1 => $_POST,
    //2 => $_PUT,
);



	// $id=$jsobj['id'];
	// $answer=$jsobj['answer'];	
	// $uname=$_SESSION['username'];
function hasMethod($num,$chvmeth)
{
	if($chvmeth==$num)
	{
		return TRUE;
	}
	return false;	
}


$allOK=null;
$temp;
for ($i = 0; $i < 2; $i ++) if (hasMethod($i,$CHV['METHOD']))
{
	if ($_SERVER['REQUEST_METHOD'] == $chv_methods[$i]) 
	{
	        $allOK=TRUE;
      		$jsobj = $chv_vars[$i];
		//$CHV['CALL_METHOD'] = $chv_methods[$i];
		foreach ($CHV[$i] as $arg => $regex) 
		{
			$temp[$i]=filter_var($jsobj[$arg],FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>"$regex")));
			if($temp[$i]==false)
			{		
				$allOK=false;
				break;
			}
		}
		break;
	}
}



?>
