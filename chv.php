<?php

/** 
 * Arguments 
 * CHV[idx] = an array representing the required arguments and their matching regex
 * CHV['METHODS'] = binary number representing the methods you wish to handle.
 * 
 * Return 
 * CHV['CALL_METHOD'] the method actually used.
 * CHV['ALL_OKAY'] 
 */


if($_SERVER['REQUEST_METHOD']=='POST'){
$jsobj=json_decode($_POST['parcel']);}
if($_SERVER['REQUEST_METHOD']=='POST'){
$jsobj=json_decode($_GET['parcel']);}
	// $id=$jsobj['id'];
	// $answer=$jsobj['answer'];	
	// $uname=$_SESSION['username'];
function hasMethod($num)
{
	return $CHV['METHOD'] & (1 << $num);
}

$chv_methods = array(
    0 => 'GET',
    1 => 'POST',
    2 => 'PUT',
    //3 => "DELETE",
);

$allOK=TRUE;

for ($i = 0; $i < 4; $i ++) if (hasMethod($i)) {
	if ($_SERVER['REQUEST_METHOD'] == $chv_methods[$i]) {
		$CHV['CALL_METHOD'] = $chv_methods[$i];
		foreach ($CHV[$i] as $arg => $regex) {
			$temp=filter_var($jsobj['$arg'],FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>"$regex")));
			if($temp==false){
				$allOK=false;
				break;
			}
		}


		break;
	}
}



?>
