<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0, maximum-scale=1.0,user-scalable=no">
<title>Find Others</title>
<style type="text/css">

</style>
<body>
<?php
	
	$Openid = $_GET['openid'];
	$con = mysql_connect("localhost","root","hhf150076");
	mysql_select_db("Student", $con);
	if(!$con)
	{
		echo "failed";
	}
	
	$Name = mysql_query("select Student_Nickname from Student_Data where User_OpenID='$Openid'");
	$Name = mysql_fetch_array($Name);
	$Name = $Name['Student_Nickname'];
//	echo " <span> Name:$Name</span>";
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
//	echo " <span>Score:$Score </span><span>Rank:$Rank </span>";
	$Que = mysql_query("SELECT ID FROM Location where User_OpenID='$Openid' ORDER BY ID DESC");
	$ID = mysql_fetch_array($Que);
	$ID = $ID['ID'];
	//echo $ID;
	$Que = mysql_query("SELECT Loca_Lat FROM Location where ID=$ID ");
	$Lat = mysql_fetch_array($Que);
	$Lat = $Lat['Loca_Lat'];
//	echo $Lat;
	$Que = mysql_query("SELECT Loca_Lon FROM Location where ID=$ID ");
	$Lon = mysql_fetch_array($Que);
	$Lon = $Lon['Loca_Lon'];
//	echo $Lon;
	header("Location: http://www.personalwebhhf.cn/Map.html");
	



?>
</body>
</html>





