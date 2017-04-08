<!DOCTYPE>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0, maximum-scale=1.0,user-scalable=no">
<title>Handle Game</title>
<style type="text/css">
#HDU_img 
{
	margin-top:30%;
	margin-left:10%;

}
</style>
<body>

<div id="HDU_img">
	<img src="http://www.personalwebhhf.cn/photo/wechat/HDU_black.jpeg">
</div>
<?php
	$Openid = $_COOKIE['openid'];
	$TEl = $_POST["Tel"];
	$Time = $_POST["Time"];
//	echo $Openid;
//	echo $TEl;
	echo $Time;
	$con = mysql_connect("localhost","root","hhf150076");
	mysql_select_db("Student", $con);
	if(!$con)
	{
		echo "failed";
	}
	$ID = mysql_query("select Student_ID from Student_Data where User_OpenID='$Openid'");
	$ID = mysql_fetch_array($ID);
	$ID = $ID['Student_ID'];
//	echo $ID;
/*	$Res = mysql_query("SELECT Game_ID FROM Game_Data WHERE Game_PlayerX_ID=14055115 ");
	while($raw =mysql_fetch_array($Res))
	{
		echo $raw['Game_ID'];
		echo "</br>";
	}
*/	
	$Ins = "INSERT INTO Game_Temp_Sub VALUES($Time,$ID,$TEl)";
//	mysql_query($Ins);
	$Num = 0;
	$Res =mysql_query("SELECT Game_TempID FROM Game_Temp_Sub");
	echo $Res;
	while($raw = mysql_fetch_array($Res))
	{
		if($raw['Game_TempID'] == $Time)
		{
			$Num=$Num+1;
		}
		echo $raw['Game_TempID'];
		echo "</br>";
	}
	echo "</br>";
	echo $Num;
	if($Num>30)
	{
		header("Location: http://www.personalwebhhf.cn/Wechat/Start_Game_Full.html");
	}
		header("Location: http://www.personalwebhhf.cn/Wechat/Start_Game_Success.html");
	
	
?>
</body>
</html>
	
	
