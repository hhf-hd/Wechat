<?php

$CurrentTime = date("H");
	$PlayerNum = 0;
	$j = 0;
	if($CurrentTime>7)
	{
		//select Player and Judge
		$Res =mysql_query("SELECT Game_PlayerID FROM Game_Temp_Student_Sub where Game_TempID='$Time' ");
		$JudgeRes =mysql_query("SELECT Game_JudgeID FROM Game_Temp_Judge_Sub where Game_TempID='$Time' ");
		//get the num of palyer and judge
		$PlayerNum = mysql_num_rows($Res);
		$JudgeNum =mysql_num_rows($JudgeRes);
		echo "num of player and judge is ".$PlayerNum." ".$JudgeNum;
		echo "<br/>";
		//make playerunm=2*judgenum
		if($PlayerNum%2== 1)
		{
			$PlayerNum = $PlayerNum-1;
		}
		if($PlayerNum == 0)
		{
//			echo " only one ";
//			echo "<br/>";
		}
		if($PlayerNum/2 == $JudgeNum)
		{
//			echo "equal";
//			echo "<br/>";
		}
		else if($PlayerNum/2>$JudgeNum)
		{
//			echo "Student enough";
//			echo "<br/>";
			$PlayerNum = 2*$JudgeNum;
		}
		else 
		{
			
			$JudgeNum = $PlayerNum/2;
		}
//	echo "PlayerNum=".$PlayerNum."   ";
//	echo "   JudgeNum = ".$JudgeNum;
//	echo "<br>";
	for($j=0 ;$j<$PlayerNum ;$j = $j+2 )
	{
		
		$Pos = $j/2+1;
		if($Pos<10)
		{
			$Pos = "0".$Pos;
		}
		$Game_Judge_ID = mysql_fetch_array($JudgeRes);
		$Game_Judge_ID = $Game_Judge_ID['Game_JudgeID'];
		echo "JudgeID is ".$Game_Judge_ID;
		echo "<br>";
		$PlayerX = mysql_fetch_array($Res);
		$PlayerX = $PlayerX['Game_PlayerID'];
		echo "PlayerID is ".$PlayerX;
		echo "<br>";
		$PlayerY = mysql_fetch_array($Res);
		$PlayerY = $PlayerY['Game_PlayerID'];
		echo "PlayerID is ".$PlayerY;
		echo "<br>";
		$Game_ID = $Time.$Pos;
		echo $Game_ID;
		echo "<br>";
		$StartGame = "INSERT INTO Game_Data(Game_ID,Game_PlayerX_ID,Game_PlayerY_ID,Game_Judge_ID) 
		values('$Game_ID',$PlayerX,$PlayerY,$Game_Judge_ID)";
		mysql_query($StartGame);
	}
	}
	
	?>
