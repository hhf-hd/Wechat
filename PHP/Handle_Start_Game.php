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
	
	//use a hidden input to post Openid
/*
	$Openid1 = $_POST["openid"];
	echo $Openid;
	echo "<br/>";
	echo $Openid1;
	*/
	
	if(isset($Openid)==false)
	{
		header("Location: http://www.personalwebhhf.cn/Wechat/No_Qualification.html");
	}
	else
	{
		
		$TEL = $_POST["Tel"];//telephone
		$Time = $_POST["Time"];// time to hold the game
		//	echo "your Openid is ".$Openid;
		$con = mysql_connect("localhost","root","hhf150076");
		mysql_select_db("Student", $con);
		if(!$con)
		{
			echo "failed";
		}
		//get player student_ID
		$ID = mysql_query("select Student_ID from Student_Data where User_OpenID='$Openid'");
		$ID = mysql_fetch_array($ID);
		$ID = $ID['Student_ID'];
		//insert into a temp table
		$Res =mysql_query("SELECT Game_PlayerID FROM Game_Temp_Student_Sub WHERE Game_TempID='$Time'");
		while($raw = mysql_fetch_array($Res))
		{
			echo $raw['Game_PlayerD'];
			echo "<br/>";
			if($raw['Game_PlayerD'] == $ID)
			{
				header("Location: http://www.personalwebhhf.cn/Wechat/Start_Game_Full.html");
			}
		
		}
		$Num = 0;
		$Res =mysql_query("SELECT Game_TempID FROM Game_Temp_Student_Sub");
		while($raw = mysql_fetch_array($Res))
		{
			if($raw['Game_TempID'] == $Time)
			{
				$Num=$Num+1;
			}
		
		}
	
		if($Num>30)
		{
			header("Location: http://www.personalwebhhf.cn/Wechat/Start_Game_Full.html");
		}
		else
		{
			header("Location: http://www.personalwebhhf.cn/Wechat/Start_Game_Success.html");
		}
	
		$Ins = "INSERT INTO Game_Temp_Student_Sub VALUES('$Time','$ID','$TEL',0)";
		mysql_query($Ins);
	
	}
	
	
	
	
/*
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
*/
/*	
		//to send a template message
	$appid = "wx0b6b6a2ba0927086";
		$appsecret = "a2a83f0da28e374ae3f89afef9127c76";
		$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
		$output = https_request($url);
		$jsoninfo = json_decode($output, true);
		$access_token = $jsoninfo["access_token"];
		echo $access_token;
		$Template = array
		(
		'touser' => "$Openid",
		'template_id' = "ideeEADwRMlXYKzqPMje0E0IqI-fJ0Aqs-vAgjkJT3g",
		'url' => "http://weixin.qq.com/download",
		'topcolor' => "#7B68EE",
		'Data' = array
		(
			'First' => array(
				'value' => 'boardcast',
				'color' => '#FF000'
			),
			'Name' => array(
				'value' => 'boardcast',
				'color' => '#FF000'
			),
			'Date' => array(
				'value' => 'boardcast',
				'color' => '#FF000'
			),
			'Score' => array(
				'value' => '$Score',
				'color' => '#FF000'
			),
			'Remark' => array(
				'value' => 'boardcast',
				'color' => '#FF000'
			)
		)
	);
		
	
	
	}
	
	
	function https_request($url,$data = null)
	{
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
		if (!empty($data)){
			curl_setopt($curl, CURLOPT_POST, 1);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		}
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($curl);
		curl_close($curl);
		return $output;
	}

	*/
	
	
	
?>
</body>
</html>
	
	
