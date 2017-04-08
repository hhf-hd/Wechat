<?php
	$Hour = date("H");
//	echo $Hour;
	
	$CurrentTime = "1128";
	
	//connect database
	$con = mysql_connect("localhost","root","hhf150076");
	mysql_select_db("Student", $con);
	if(!$con)
	{
		echo "failed";
	}
	
	
	$Res_Game_ID = mysql_query("SELECT DISTINCT Game_TempID FROM Game_Temp_Student_Sub 
	WHERE Game_TempID LIKE '%$CurrentTime%'");
	while($Raw = mysql_fetch_array($Res_Game_ID))
	{//first while
		
		$Game_ID = $Raw["Game_TempID"];
		//get the Game_ID 
		echo "Game_ID is ".$Game_ID;
		echo "<br/>";
		
		//get the num of the student and judge
		$Student_Num = 0;
		$Judge_Num = 0;
		
		
		$Student_Res =mysql_query("SELECT * FROM Game_Temp_Student_Sub WHERE Game_TempID='$Game_ID'");
		$Judge_Res =mysql_query("SELECT * FROM Game_Temp_Judge_Sub WHERE Game_TempID='$Game_ID'");
		while($Raw2 = mysql_fetch_array($Student_Res))
		{
			echo $Raw2["Game_PlayerID"];
			$Student_Num = $Student_Num+1;
			echo "<br/>";
		}
		echo "judge <br/>";
		while($Raw3 = mysql_fetch_array($Judge_Res))
		{
			echo $Raw3["Game_JudgeID"];
			$Judge_Num = $Judge_Num+1;
			echo "<br/>";
		}
		echo "Student_Num is ".$Student_Num;
		echo "Judge_Num is ".$Judge_Num;
		//single student to reminder
		if($Student_Num%2==1)
		{
			$Student_Num = $Student_Num-1;
		}
		if($Student_Num == 0)
		{
			echo "just a student<br/>";
			$Student_Res =mysql_query("SELECT * FROM Game_Temp_Student_Sub WHERE Game_TempID='$Game_ID'");
			while($Game_PlayerX_ID = mysql_fetch_array($Student_Res))
			{
			$Game_PlayerX_ID = $Game_PlayerX_ID["Game_PlayerID"];
			echo "odd left Game_PlayerX_ID".$Game_PlayerX_ID;
			$Update ="UPDATE Game_Temp_Student_Sub SET Game_Temp_Status=-1 WHERE 
			Game_PlayerID='$Game_PlayerX_ID' AND Game_TempID='$Game_ID'";
			mysql_query($Update);
			echo "<br/>";
			}
			
			continue;
			
		}
		//echo "<br/>";
		//echo "Student_Num is ".$Student_Num;
		if($Judge_Num*2<$Student_Num)
		{
			$Student_Num = $Judge_Num*2;
			$Student_Num_Temp = $Student_Num_Temp-$Student_Num;
			$Bool_Student_Judge_Change = 2;
			
		}
		if($Judge_Num*2>$Student_Num)
		{
			$Judge_Num = $Student_Num/2;
			$Judge_Num_Temp = $Judge_Num_Temp-$Judge_Num;
			$Bool_Student_Judge_Change =1;
			
		}
		/*
		echo "<br/>";
		echo "now Judge_Num  is ".$Judge_Num."and Student_Num is ".$Student_Num;
		echo "<br/>";
		//get the num of Student and judge
		echo "Student temp is ".$Student_Num_Temp;
		echo "<br/>";
		echo "Judge temp is ".$Judge_Num_Temp;
		echo "<br/>";
		echo "judge or student change".$Bool_Student_Judge_Change;
		echo "<br/>";
		*/
		
		$Position = 1;
		$Student_Res =mysql_query("SELECT * FROM Game_Temp_Student_Sub WHERE Game_TempID='$Game_ID'");
		$Judge_Res =mysql_query("SELECT * FROM Game_Temp_Judge_Sub WHERE Game_TempID='$Game_ID'");
		for($i=0;$i<$Judge_Num;$i++)
		{
			$Game_PlayerX_ID = mysql_fetch_array($Student_Res);
			$Game_PlayerX_ID = $Game_PlayerX_ID["Game_PlayerID"];
			$Game_PlayerY_ID = mysql_fetch_array($Student_Res);
			$Game_PlayerY_ID = $Game_PlayerY_ID["Game_PlayerID"];
			$Game_JudgeID = mysql_fetch_array($Judge_Res);
			$Game_JudgeID = $Game_JudgeID["Game_JudgeID"];
			//change the status of the Game_Temp_Student_Sub and Game_Temp_Judge_Sub
			$Update ="UPDATE Game_Temp_Student_Sub SET Game_Temp_Status=1 WHERE 
			Game_PlayerID='$Game_PlayerX_ID' AND Game_TempID='$Game_ID'";
			mysql_query($Update);
			$Update ="UPDATE Game_Temp_Student_Sub SET Game_Temp_Status=1 WHERE 
			Game_PlayerID='$Game_PlayerY_ID' AND Game_TempID='$Game_ID'";
			mysql_query($Update);
			$Update ="UPDATE Game_Temp_Judge_Sub SET Game_Temp_Status=1 WHERE 
			Game_JudgeID='$Game_JudgeID' AND Game_TempID='$Game_ID'";
			mysql_query($Update);
			
			
			echo "Game_PlayerX_ID".$Game_PlayerX_ID;
			echo "<br/>";
			echo "Game_PlayerY_ID".$Game_PlayerY_ID;
			echo "<br/>";
			echo "Game_JudgeID".$Game_JudgeID;
			echo "<br/>";
			$Position_Temp = $Position;
			
			if($Position<10)
			{
				$Position = "0".$Position;
			}
			
			$Game_Temp_ID = $Game_ID.$Position;
			$Position = $Position_Temp+1;
			echo "Game_ID is ".$Game_Temp_ID;
			echo "<br/>";
			//the left Student and judge
			$Ins = "INSERT INTO Game_Data(Game_ID,Game_PlayerX_ID,Game_PlayerY_ID,Game_Judge_ID,Game_Pos)
			values('$Game_Temp_ID','$Game_PlayerX_ID','$Game_PlayerY_ID','$Game_JudgeID',$Position_Temp) ";
			mysql_query($Ins);
		}
		
		//print the left judge or Student
		while($Game_JudgeID = mysql_fetch_array($Judge_Res))
		{
			$Game_JudgeID = $Game_JudgeID["Game_JudgeID"];
			echo "left Game_JudgeID".$Game_JudgeID;
			echo "<br/>";
			$Update ="UPDATE Game_Temp_Judge_Sub SET Game_Temp_Status=-1 WHERE 
			Game_JudgeID='$Game_JudgeID' AND Game_TempID='$Game_ID'";
			mysql_query($Update);
		}
		
		while($Game_PlayerX_ID = mysql_fetch_array($Student_Res))
		{
			$Game_PlayerX_ID = $Game_PlayerX_ID["Game_PlayerID"];
			echo "odd left Game_PlayerX_ID".$Game_PlayerX_ID;
			$Update ="UPDATE Game_Temp_Student_Sub SET Game_Temp_Status=-1 WHERE 
			Game_PlayerID='$Game_PlayerX_ID' AND Game_TempID='$Game_ID'";
			mysql_query($Update);
			echo "<br/>";
		}
				
		$Num = $Num+1;
		echo "<br/>";
	}//first while

	

	
?>
