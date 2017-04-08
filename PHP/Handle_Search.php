

<?php

//用URL传参数到个人中心即可

	$Condition = $_POST["Condition"];
	$Key_Word = $_POST["Key_Word"];
//	echo $Key_Word;
//	echo $Condition;
	if($Condition == "Student_Name")
	{
		$Student_Name = $Key_Word;
		//connect database
		$Con = mysql_connect("localhost","root","hhf150076");
		mysql_select_db("Student",$Con);
		
		$Student_Res = mysql_query("SELECT * FROM Student_Data WHERE Student_Name='$Student_Name'");
		$Student_Res = mysql_fetch_array($Student_Res);
		$ID = $Student_Res["Student_ID"];
		$Time =$Student_Res["Student_Time"];
		$Score =$Student_Res["Student_Score"];
		$Rank =$Student_Res["Student_Rank"];
		$Headimgurl = $Student_Res["Student_Headimgurl"];
		$User_OpenID = $Student_Res["User_OpenID"];
		header("Location: http://www.personalwebhhf.cn/PHP/Search_Student.php?openid=$User_OpenID");

	}
	else if($Condition == "Student_ID")
	{
		$Student_ID =$Key_Word;
		
		$Con = mysql_connect("localhost","root","hhf150076");
		mysql_select_db("Student",$Con);
		
		$Student_Res = mysql_query("SELECT * FROM Student_Data WHERE Student_ID=$Student_ID");
		$Student_Res = mysql_fetch_array($Student_Res);
		$ID = $Student_Res["Student_ID"];
		$Time =$Student_Res["Student_Time"];
		$Score =$Student_Res["Student_Score"];
		$Rank =$Student_Res["Student_Rank"];
		$Headimgurl = $Student_Res["Student_Headimgurl"];
		$User_OpenID = $Student_Res["User_OpenID"];
		header("Location: http://www.personalwebhhf.cn/PHP/Search_Student.php?openid=$User_OpenID");
	
		
	}
	

?>