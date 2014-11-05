<?php /*
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
class player
{
	public  $username, $score,$level,$disqualified,$tchests,$levelquestions=array();//qno( accordin to user table),qid, qstate(0-unopned,1- opened,2-answereed) qvalue///make funct for qvalue
			
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
		$level=$this->level;
		$qry="select * from `Questions-$uname` where `Question ID` like '$level%'";
		$result=mysqli_query($db_connection,$qry);
		if($result==false)
		{
			http_respond(500);
		}
		else
		{
			while($row=mysqli_fetch_array($result))
			{
				$temp['qno']=$row['Question Number'];
				$temp['qid']=$row['Question ID'];
				if($row['Time Opened']==-1 && $row['Time Answered']==-1)
				{
					$temp['qstate']=0;
				}	
				else if($row['Time Opened']!=-1 && $row['Time Answered']==-1)
				{	
					$temp['qstate']=1;
				}
				else
				{								
					$temp['qstate']=2;
				}
				$this->levelquestions[]=$temp;
			}				
		}
	}

	function write_back()
	{
		$level=$this->level;
		$score=$this->score;
		$tchests=$this->tchests;
		$username=$this->username;
		$qry="update `ContestantsData` set `Level`=$level ,`Total Score`=$score,`Tchests Unlocked`=$tchests where `Username`='$username'";
		$db_connection = $GLOBALS['db_connection'];
		$result=mysqli_query($db_connection,$qry);
		if(!$result)
		{
			http_respond(500);
		}
	}	
}	

?>
