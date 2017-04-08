<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0, maximum-scale=1.0,user-scalable=no">
<title>Personal Center</title>
<style type="text/css">
body {
	background:#B3B3B3;
}
#img {
	margin-left:35%;
	margin-top:20%;
	width:20em;
	width:100px;
	height:100px;
	border-radius:50px;
	border:solid rgb(100,100,100) 1px;
	overflow:hidden;
	background:#BFBFBF;
	
}
#ID_Name {
	margin-left:25%;
	margin-top:10%;
	margin-right:10%;
	word-spacing:10px;
	background:#BBBBBB;
}
#Time_Score {
	margin-left:25%;
	margin-top:5%;
	margin-right:10%;
	word-spacing:10px;
	background:#BBBBBB;
}
#Rec_Con {
	margin-left:15%;
	margin-top:5%;
	margin-right:10%;
	word-spacing:10px;
	background:#BBBBBB;
}
</style>
<body>
<div id="img" >

	<a href="http://www.personalwebhhf.cn/Wechat/Personal_Setting.html">
	<img src="<?php
    $Openid = $_GET['openid'];
	
	$con = mysql_connect("localhost","root","hhf150076");
	mysql_select_db("Student", $con);
	if(!$con)
	{
		echo "failed";
	}
	$Pic = mysql_query("select Student_Headimgurl from Student_Data where User_OpenID='$Openid'");
	$Pic = mysql_fetch_array($Pic);
	$Pic = $Pic['Student_Headimgurl'];
	echo $Pic ;
	
	?>"  height='100' width='100' />
	</a>
	
	
</div>	
<div id="ID_Name">
<?php
	$Openid = $_GET['openid'];
	
	$con = mysql_connect("localhost","root","hhf150076");
	mysql_select_db("Student", $con);
	if(!$con)
	{
		echo "failed";
	}
	$ID = mysql_query("select Student_ID from Student_Data where User_OpenID='$Openid'");
	$ID = mysql_fetch_array($ID);
	$ID = $ID['Student_ID'];
	$Name = mysql_query("select Student_Name from Student_Data where User_OpenID='$Openid'");
	$Name = mysql_fetch_array($Name);
	$Name = $Name['Student_Name'];
	echo "<span > ID:$ID </sapn> <span> Name:$Name</span>";
	
?>
</div>
<div id="Time_Score">
<?php 
	$Openid = $_GET['openid'];
	
	$con = mysql_connect("localhost","root","hhf150076");
	mysql_select_db("Student", $con);
	if(!$con)
	{
		echo "failed";
	}
	$ID = mysql_query("select Student_ID from Student_Data where User_OpenID='$Openid'");
	$ID = mysql_fetch_array($ID);
	$ID = $ID['Student_ID'];
	$Time = mysql_query("select Student_Time from Student_Data where User_OpenID='$Openid'");
	$Time = mysql_fetch_array($Time);
	$Time = $Time['Student_Time'];
	$Score = mysql_query("select Student_Score from Student_Data where User_OpenID='$Openid'");
	$Score = mysql_fetch_array($Score);
	$Score = $Score['Student_Score'];  //get data from mysql 
	$Rank=1;
	$Que = mysql_query("SELECT Student_Score FROM Student_Data ORDER BY Student_Score DESC");
	while($raw =mysql_fetch_array($Que))
	{
		
		if($raw['Student_Score'] !=$Score)
		{
			$Rank= $Rank+1;
		}
		else 
		{
			break;
		}
		
	}
//	$INSE = "insert into Student_Data(Student_Rank) values($Rank) ";
//	mysql_query($INSE);
	echo "<span >Time:$Time </sapn> <span>Score:$Score </span><span>Rank:$Rank </span>";
	
	?>
</div>
<p>&nbsp;&nbsp;比赛记录</p>
<div id="Rec_Con">
	<p>已预约</p>
	
	<?php
	
	$Openid = $_GET['openid'];
	
	$con = mysql_connect("localhost","root","hhf150076");
	mysql_select_db("Student", $con);
	if(!$con)
	{
		echo "failed";
	}
	$ID = mysql_query("select Student_ID from Student_Data where User_OpenID='$Openid'");
	$ID = mysql_fetch_array($ID);
	$ID = $ID['Student_ID'];
	
	$Name = mysql_query("select Student_Name from Student_Data where User_OpenID='$Openid'");
	$Name = mysql_fetch_array($Name);
	$Name = $Name['Student_Name'];
	
//	echo "Student_ID is ".$ID;
//	echo "<br/>";
	
	$Game_ID = mysql_query("select Game_TempID from Game_Temp_Student_Sub 
	where Game_PlayerID='$ID' AND Game_Temp_Status=0 ");
//	echo "Game_ID is ".$Game_ID;
	while($raw = mysql_fetch_array($Game_ID))
	{
		$Temp = $raw['Game_TempID'];
	//	echo $Temp;
		$Year = mb_substr($Temp,0,2,"GB2312");
		$Month = mb_substr($Temp,2,2,"GB2312");
		$Day =  mb_substr($Temp,4,2,"GB2312");
		$Hour = mb_substr($Temp,6,1,"GB2312");
		$Minute = mb_substr($Temp,7,2,"GB2312");
	
		$Date ="20".$Year."-".$Month."-".$Day;
		echo $Date;
		echo "&nbsp";
		echo $Hour.":".$Minute;
		echo "<br>";
		echo "&nbsp&nbsp";
		
		echo $Name;
		echo "&nbsp&nbsp&nbsp";
		
		echo $ID;
		echo "<br/>";
	}
	
	
	
	
	?>
	
	<p>进行中</p>
	
	<?php
	$Openid = $_GET['openid'];
	
	$con = mysql_connect("localhost","root","hhf150076");
	mysql_select_db("Student", $con);
	if(!$con)
	{
		echo "failed";
	}
	$ID = mysql_query("select Student_ID from Student_Data where User_OpenID='$Openid'");
	$ID = mysql_fetch_array($ID);
	$ID = $ID['Student_ID'];
	$Name = mysql_query("select Student_Name from Student_Data where User_OpenID='$Openid'");
	$Name = mysql_fetch_array($Name);
	$Name = $Name['Student_Name'];
	$Game_ID = mysql_query("select Game_ID from Game_Data where Game_PlayerX_ID='$ID' and Game_Status=0");
	while($raw = mysql_fetch_array($Game_ID))
	{
		$Temp = $raw['Game_ID'];
	//	echo $Temp;
		$Year = mb_substr($raw['Game_ID'],0,2,"GB2312");
		$Month = mb_substr($raw['Game_ID'],2,2,"GB2312");
		$Day =  mb_substr($raw['Game_ID'],4,2,"GB2312");
		$Hour = mb_substr($raw['Game_ID'],6,1,"GB2312");
		$Minute = mb_substr($raw['Game_ID'],7,2,"GB2312");
		$Pos =mb_substr($raw['Game_ID'],9,2,"GB2312");
		
		//judge name
		$Game_Judge_ID = mysql_query("select Game_Judge_ID from Game_Data where Game_ID='$Temp'");
		$Game_Judge_ID = mysql_fetch_array($Game_Judge_ID);
		$Game_Judge_ID = $Game_Judge_ID['Game_Judge_ID'];
		$Judge_Name = mysql_query("select Judge_Name from Judge_Data where Judge_ID='$Game_Judge_ID'");
		$Judge_Name = mysql_fetch_array($Judge_Name);
		$Judge_Name = $Judge_Name['Judge_Name'];
		//another playername
		$Game_PlayerY_ID = mysql_query("select Game_PlayerY_ID from Game_Data where Game_ID='$Temp'");
		$Game_PlayerY_ID = mysql_fetch_array($Game_PlayerY_ID);
		$Game_PlayerY_ID = $Game_PlayerY_ID['Game_PlayerY_ID'];	
		$PlayerY = mysql_query("select Student_Name from Student_Data where Student_ID='$Game_PlayerY_ID'");
		$PlayerY = mysql_fetch_array($PlayerY);
		$PlayerY = $PlayerY['Student_Name'];
		
		$Date ="20".$Year."-".$Month."-".$Day;
		echo $Date;
		echo "&nbsp";
		echo $Hour.":".$Minute;
		echo "<br>";
		echo "<br/>";
		echo "&nbsp&nbsp";
		
		echo $Name." &nbsp&nbsp   ".$PlayerY;
		echo "<br>";
		echo "&nbsp&nbsp";
		
		echo "场地:球台".$Pos;
		echo "&nbsp";
		echo "裁判：".$Judge_Name;
		echo "<br>";
		
		
	}
	$Game_ID = mysql_query("select Game_ID from Game_Data where Game_PlayerY_ID='$ID' and Game_Status=0");
	while($raw = mysql_fetch_array($Game_ID))
	{
		$Temp = $raw['Game_ID'];
	//	echo $Temp;
		$Year = mb_substr($raw['Game_ID'],0,2,"GB2312");
		$Month = mb_substr($raw['Game_ID'],2,2,"GB2312");
		$Day =  mb_substr($raw['Game_ID'],4,2,"GB2312");
		$Hour = mb_substr($raw['Game_ID'],6,1,"GB2312");
		$Minute = mb_substr($raw['Game_ID'],7,2,"GB2312");
		$Pos =mb_substr($raw['Game_ID'],9,2,"GB2312");
		//score
		//judge name
		$Game_Judge_ID = mysql_query("select Game_Judge_ID from Game_Data where Game_ID='$Temp'");
		$Game_Judge_ID = mysql_fetch_array($Game_Judge_ID);
		$Game_Judge_ID = $Game_Judge_ID['Game_Judge_ID'];
		$Judge_Name = mysql_query("select Judge_Name from Judge_Data where Judge_ID='$Game_Judge_ID'");
		$Judge_Name = mysql_fetch_array($Judge_Name);
		$Judge_Name = $Judge_Name['Judge_Name'];
		//another playername
		$Game_PlayerY_ID = mysql_query("select Game_PlayerX_ID from Game_Data where Game_ID='$Temp'");
		$Game_PlayerY_ID = mysql_fetch_array($Game_PlayerY_ID);
		$Game_PlayerY_ID = $Game_PlayerY_ID['Game_PlayerX_ID'];	
		$PlayerY = mysql_query("select Student_Name from Student_Data where Student_ID='$Game_PlayerY_ID'");
		$PlayerY = mysql_fetch_array($PlayerY);
		$PlayerY = $PlayerY['Student_Name'];
		
		$Date ="20".$Year."-".$Month."-".$Day;
		echo $Date;
		echo "&nbsp";
		echo $Hour.":".$Minute;
		echo "<br>";
		echo "<br/>";
		echo "&nbsp&nbsp";
		
		echo $Name." &nbsp&nbsp   ".$PlayerY;
		echo "<br>";
		echo "&nbsp&nbsp";
		
		echo "场地:球台".$Pos;
		echo "&nbsp";
		echo "裁判：".$Judge_Name;
		echo "<br>";
		
		
	}
	
	?>
	<p>已完成</p>
	<?php
	$Openid = $_GET['openid'];
	
	$con = mysql_connect("localhost","root","hhf150076");
	mysql_select_db("Student", $con);
	if(!$con)
	{
		echo "failed";
	}
	$ID = mysql_query("select Student_ID from Student_Data where User_OpenID='$Openid'");
	$ID = mysql_fetch_array($ID);
	$ID = $ID['Student_ID'];
	$Name = mysql_query("select Student_Name from Student_Data where User_OpenID='$Openid'");
	$Name = mysql_fetch_array($Name);
	$Name = $Name['Student_Name'];
	$Game_ID = mysql_query("select Game_ID from Game_Data where Game_PlayerX_ID='$ID' and Game_Status=1");
	while($raw = mysql_fetch_array($Game_ID))
	{
		$Temp = $raw['Game_ID'];
	//	echo $Temp;
		$Year = mb_substr($raw['Game_ID'],0,2,"GB2312");
		$Month = mb_substr($raw['Game_ID'],2,2,"GB2312");
		$Day =  mb_substr($raw['Game_ID'],4,2,"GB2312");
		$Hour = mb_substr($raw['Game_ID'],6,1,"GB2312");
		$Minute = mb_substr($raw['Game_ID'],7,2,"GB2312");
		$Pos =mb_substr($raw['Game_ID'],9,2,"GB2312");
		//score
		$Game_ScoreX = mysql_query("select Game_ScoreX from Game_Data where Game_ID='$Temp'");
		$Game_ScoreX = mysql_fetch_array($Game_ScoreX);
		$Game_ScoreX = $Game_ScoreX['Game_ScoreX'];
		$Game_ScoreY = mysql_query("select Game_ScoreY from Game_Data where Game_ID='$Temp'");
		$Game_ScoreY = mysql_fetch_array($Game_ScoreY);
		$Game_ScoreY = $Game_ScoreY['Game_ScoreY'];
		//judge name
		$Game_Judge_ID = mysql_query("select Game_Judge_ID from Game_Data where Game_ID='$Temp'");
		$Game_Judge_ID = mysql_fetch_array($Game_Judge_ID);
		$Game_Judge_ID = $Game_Judge_ID['Game_Judge_ID'];
		$Judge_Name = mysql_query("select Judge_Name from Judge_Data where Judge_ID='$Game_Judge_ID'");
		$Judge_Name = mysql_fetch_array($Judge_Name);
		$Judge_Name = $Judge_Name['Judge_Name'];
		//another playername
		$Game_PlayerY_ID = mysql_query("select Game_PlayerY_ID from Game_Data where Game_ID='$Temp'");
		$Game_PlayerY_ID = mysql_fetch_array($Game_PlayerY_ID);
		$Game_PlayerY_ID = $Game_PlayerY_ID['Game_PlayerY_ID'];	
		$PlayerY = mysql_query("select Student_Name from Student_Data where Student_ID='$Game_PlayerY_ID'");
		$PlayerY = mysql_fetch_array($PlayerY);
		$PlayerY = $PlayerY['Student_Name'];
		
		$Date ="20".$Year."-".$Month."-".$Day;
		echo $Date;
		echo "&nbsp";
		echo $Hour.":".$Minute;
		echo "<br>";
		echo "&nbsp&nbsp";
		echo $Name." &nbsp&nbsp   ".$PlayerY;
		echo "<br>";
		echo "&nbsp&nbsp";
		echo $Game_ScoreX." &nbsp&nbsp&nbsp   ".$Game_ScoreY;
		echo "<br>";
		echo "&nbsp";
		echo "场地:球台".$Pos;
		echo "&nbsp";
		echo "裁判：".$Judge_Name;
		echo "<br>";
		
		
	}
	$Game_ID = mysql_query("select Game_ID from Game_Data where Game_PlayerY_ID='$ID' and Game_Status=1");
	while($raw = mysql_fetch_array($Game_ID))
	{
		$Temp = $raw['Game_ID'];
	//	echo $Temp;
		$Year = mb_substr($raw['Game_ID'],0,2,"GB2312");
		$Month = mb_substr($raw['Game_ID'],2,2,"GB2312");
		$Day =  mb_substr($raw['Game_ID'],4,2,"GB2312");
		$Hour = mb_substr($raw['Game_ID'],6,1,"GB2312");
		$Minute = mb_substr($raw['Game_ID'],7,2,"GB2312");
		$Pos =mb_substr($raw['Game_ID'],9,2,"GB2312");
		//score
		$Game_ScoreX = mysql_query("select Game_ScoreX from Game_Data where Game_ID='$Temp'");
		$Game_ScoreX = mysql_fetch_array($Game_ScoreX);
		$Game_ScoreX = $Game_ScoreX['Game_ScoreX'];
		$Game_ScoreY = mysql_query("select Game_ScoreY from Game_Data where Game_ID='$Temp'");
		$Game_ScoreY = mysql_fetch_array($Game_ScoreY);
		$Game_ScoreY = $Game_ScoreY['Game_ScoreY'];
		//judge name
		$Game_Judge_ID = mysql_query("select Game_Judge_ID from Game_Data where Game_ID='$Temp'");
		$Game_Judge_ID = mysql_fetch_array($Game_Judge_ID);
		$Game_Judge_ID = $Game_Judge_ID['Game_Judge_ID'];
		$Judge_Name = mysql_query("select Judge_Name from Judge_Data where Judge_ID='$Game_Judge_ID'");
		$Judge_Name = mysql_fetch_array($Judge_Name);
		$Judge_Name = $Judge_Name['Judge_Name'];
		//another playername
		$Game_PlayerY_ID = mysql_query("select Game_PlayerX_ID from Game_Data where Game_ID='$Temp'");
		$Game_PlayerY_ID = mysql_fetch_array($Game_PlayerY_ID);
		$Game_PlayerY_ID = $Game_PlayerY_ID['Game_PlayerX_ID'];	
		$PlayerY = mysql_query("select Student_Name from Student_Data where Student_ID='$Game_PlayerY_ID'");
		$PlayerY = mysql_fetch_array($PlayerY);
		$PlayerY = $PlayerY['Student_Name'];
		
		$Date ="20".$Year."-".$Month."-".$Day;
		echo $Date;
		echo "&nbsp";
		echo $Hour.":".$Minute;
		echo "<br>";
		echo "&nbsp&nbsp";
		echo $Name." &nbsp&nbsp   ".$PlayerY;
		echo "<br>";
		echo "&nbsp&nbsp";
		echo $Game_ScoreY." &nbsp&nbsp&nbsp   ".$Game_ScoreX;
		echo "<br>";
		echo "&nbsp";
		echo "场地:球台".$Pos;
		echo "&nbsp";
		echo "裁判：".$Judge_Name;
		echo "<br>";
		
		
	}
	
	
?>
	
	
	
	
	





</div>

</body>
</html>




<!--
	$ID = mysql_query("select Student_ID from Student_Data where User_OpenID='$Openid'");
	$ID = mysql_fetch_array($ID);
	$ID = $ID['Student_ID'];
	$Name = mysql_query("select Student_Name from Student_Data where User_OpenID='$Openid'");
	$Name = mysql_fetch_array($Name);
	$Name = $Name['Student_Name'];
	$Time = mysql_query("select Student_Time from Student_Data where User_OpenID='$Openid'");
	$Time = mysql_fetch_array($Time);
	$Time = $Time['Student_Time'];
	$Score = mysql_query("select Student_Score from Student_Data where User_OpenID='$Openid'");
	$Score = mysql_fetch_array($Score);
	$Score = $Score['Student_Score'];  //get data from mysql 
	
	
/*	
	echo $Openid;
	echo $Pic;
	echo $ID;
	echo $Name;
	echo $Score;
*/
?>
-->
