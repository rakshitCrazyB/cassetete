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
	class Question
	{
		static $levelcost = 20;//the level cost of each level
		public $id,$type,$hint,$numopened,$numsolved,$bscore,$cscore,$cost,$answer;
		public $image,$text;
		//type is either 1,2 or 3
		//1->ImageOnly
		//2->text only
		//3->image and text
		function Question($answer,$no,$ns,$id,$type,$hint,$image = null,$text = null)
		{
			$this->answer=$answer;
			$this->type = $type;
			$this->hint = $hint;
			//$this->bscore = basescore();
			//$this->cscore = currscore();
			$this->numopened = $no;
			$this->numsolved = $ns;
			$this->id = $id;
			$this->image = $image;
			$this->text = $text;
			//$this->cost = cost();

		}
		function cost()
		{
			return 0;
		}
		function basescore()
		{
			return 0;
		}
		function currscore()
		{
			return 0;
		}
		function write_back()
		{
			$db_connection = $GLOBALS['db_connection'];
			if(!isset($db_connection))
			{
				http_respond(500);
			}
			else
			{
				$numopened=$this->numopened;
				$numsolved=$this->numsolved;
				$id=$this->id;
				$query1 = "UPDATE QuestionSolves SET `Num Opened` = $numopened WHERE `Question ID` = $id";
				$query2 = "UPDATE QuestionSolves SET `Num Solved` = $numsolved WHERE `Question ID` = $id";
				$result=mysqli_query($db_connection,$query1);
				if(!$result)
				{
					http_respond(500);
				}	
				$result=mysqli_query($db_connection,$query2);
				if(!$result)
				{
					http_respond(500);
				}
											
			}
		}
}
 function getQuestion($id)
		{
			$db_connection = $GLOBALS['db_connection'];
			$bs = 40;
			if(isset($id))
			{
				if(!isset($db_connection))
				{
					http_respond(500);
				}
				else
				{	
					$query="SELECT * from `QuestionSolves` WHERE `Question ID` = $id";
					$result = mysqli_fetch_array(mysqli_query($db_connection,$query));
					$no=$result['Num Opened'];
					$ns=$result['Num Solved'];
					$query = "SELECT * from `Questions` WHERE `Question ID` = $id";
					$result = mysqli_fetch_array(mysqli_query($db_connection,$query));
					//return new Question($id,$result['Type'],$result['Hint'],$result['Answer Regular'],$result['Base Score']);
					switch($result['Type'])
					{
						
						case 1:return new Question($result['Answer Regular'],$no,$ns,$id,$result['Type'],$result['Hint'],$result['Question Picture']);
						break;
						case 2:return new Question($result['Answer Regular'],$no,$ns,$id,$result['Type'],$result['Hint'],null,$result['Question Text']);
						break;
						case 3:return new Question($result['Answer Regular'],$no,$ns,$id,$result['Type'],$result['Hint'],$result['Question Picture'],$result['Question Text']);
						break;
					}
					
					

				}
			}
		}
		
		
	
?>
