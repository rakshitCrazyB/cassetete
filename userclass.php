<?php 
	require("httprespond.php");
	class player
	{
		public  $username, $score,$level,$disqualified,$tchests,$levelquestions=array();//qid, qstate(0-unopned,1- opened,2-answereed) qvalue
		
	
		function setPlayer($uname)
		{
			$this->username=$uname;
			include("support/dbcon.php"); 
			$qry="select * from Contestants where username='$uname'";
			$result=mysqli_query($db_connection,$qry);
			if($result==false)
			{
				http_respond(500);
			}
			if(mysqli_num_rows($result)==1)
			{
				$row=mysqli_fetch_array($result);
				$this->disqualified=$row['Disqualified'];
			}
			$qry="select * from ContestantsData where username='$uname'";
			$result=mysqli_query($db_connection,$qry);
			if($result==false)
			{
				http_respond(500);
			}
			if(mysqli_num_rows($result)==1)
			{
				$row=mysqli_fetch_array($result);
				$this->level=$row['Level'];
				$this->	score=$row['Total Score'];
				$this->tchests=$row['TChests Unlocked'];
			}
			$qry="select * from `Questions` where qid like '1%'";
			$result=mysqli_query($db_connection,$qry);
			if($result!=false)
			{
				while($row=mysqli_fetch_array($result))
				{	
					
					$temp['qid']=$row['Question ID'];
					$a=$row['Question ID'];
					$qry="select * from `Questions-$uname` where qid='$a'";
					$result=mysqli_query($db_connection,$qry);
					if($result!=false)
					{
						if(mysqli_num_rows($result)==0)
						{
							$temp['qstate']=0;
						}	
						else if(mysqli_num_rows($result)!=0)
						{	
							$row2=mysqli_fetch_array($result);
							if($row2['Time Answered']==-1)
							{	
								$temp['qstate']=1;
							}
							else
							{
								$temp['qstate']=2;
							}
						}
					}
					else
					{
						http_respond(500);
					
					}
					$this->levelquestions[]=$temp;
				}
			}
			else
			{
				http_respond(500);
			}
		}
		
		function write_back()
		{
			$qry="update `ContestantsData` set `Level`=`$level' ,`Total Score`=$score,`Tchests Unlocked`=$tchests where `Username`=$username";
			$result=mysqli_query($db_connection,$qry);
			if(!$result)
			{
				http_respond(500);
			}
		}
			 
		
}	
						
						
					
				
				s
									
					
			
		
		 
