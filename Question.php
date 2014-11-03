<?php
	require("httprespond.php");
	class Question
	{
		static $levelcost = 20;//the level cost of each level
		public $id,$type,$hint,$numopened,$numsolved,$bscore,$cscore,$cost;
		public $image,$text;
		//type is either 1,2 or 3
		//1->ImageOnly
		//2->text only
		//3->image and text
		public function Question($no,$ns,$id,$type,$hint,$basescore,$image = null,$text = null)
		{
			$this->type = $type;
			$this->hint = $hint;
			$this->bscore = basescore();
			$this->cscore = currscore();
			$this->numopened = no;
			$this->numsolved = ns;
			$this->id = $id;
			$this->image = $image;
			$this->text = $text;
			$this->cost = cost();

		}
		public function cost()
		{
			return 
		}
		public function basescore()
		{
			return
		}
		public function currscore()
		{
			return
		}
		public static function getQuestion($id)
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
						
						case 1:return new Question($no,$ns,$id,$result['Type'],$result['Hint'],$bs,$result['Question Picture']);
						break;
						case 2:return new Question($no,$ns,$id,$result['Type'],$result['Hint'],$bs,null,$result['Question Text']);
						break;
						case 3:return new Question($no,$ns,$id,$result['Type'],$result['Hint'],$bs,$result['Question Picture'],$result['Question Text']);
						break;
					}
					;
					

				}
			}
		}
		function write_back()
		{
				if(!isset($db_connection))
				{
					http_respond(500);
				}
				else
				{
					$query1 = "UPDATE QuestionSolved SET `Num Opened` = '$numopened' WHERE `Question ID` = $id";
					$query1 = "UPDATE QuestionSolved SET `Num Solved` = '$numsolved' WHERE `Question ID` = $id";
					$result=mysqli_query($db_connection,$query);					
				}
		}
	}
?>
