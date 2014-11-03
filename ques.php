<?	
	require("server.php");
AUTH['required']=true;
require_once("auth.php");
$chv['METHOD'] = 1;
$chv[1] = array(
    	"id" => '/[0-9]{3}/'
	);
require 'chv.php';
if(!allOK||!AUTH['status'])
{
	$arr['error']="chv check failed";
	http_respond(403,$arr);
}
else
{
	questioncall( $jsobj,$uname);
}
	
	
function questioncall( $jsobj,$uname)	
{	
	$value=$jsobj['id'];	
	$current=newplayer();
	$current->setPlayer($uname);


		$current->setPlayer($uname);
		if(score<cost)
		{
			$tosend['error']="not enough score";	
			http_respond(403,$tosend);
		}
		else if(intval($value/100)!=$current->level)
		{
			$tosend['error']="wrong level";	
			http_respond(403,$tosend);	
		}			
		elseif
		{		$b=$current->levelquestions;
				for($i=0;$i<sizeof($b);$i++)
				{
					$q=getQuestion($value);
					if($b[$i]['id']==$value();
					{
						$c=$b[$i]['qstate'];
						if(value==0)
						{
							$q->numopened++;
							$q->write_back();
							$d=time();
							$qry="update `Question-$uname` set `Time Opened`=$d where `Question ID`=$value";
							$result=mysqli_query($db_connection,$qry);
							if($result==false)
							{
								http_respond(500);
							}
							$tosend['type'] = $q->type;
							$tosend['bscore'] = $q->basescore;
							$tosend['cscore'] = $q->basescore;
							$tosend['id'] = $q->$id;
							$tosend['image']= $image;
							$tosend['text'] = $text;
						}
						else if (value==1)
						{
							$tosend['type'] = $q->type;
							$tosend['bscore'] = $q->basescore;
							$tosend['cscore'] = $q->basescore;
							$tosend['id'] = $q->$id;
							$tosend['image']= $image;
							$tosend['text'] = $text
						}
						
						esle if(value==2)
						{
							$tosend['error']="Already Ansered";	
							http_respond(403,$tosend);
						}						
					}
				}
				$tosend['type'] = $q->type;
				$tosend['bscore'] = $q->basescore;
				$tosend['cscore'] = $q->basescore;
				$tosend['id'] = $q->$id;
				$tosend['image']= $image;
				$tosend['text'] = $text;
				
		
		}
		http_respond(200,$tosend);
}
		


?>
