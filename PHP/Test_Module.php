<?php


	$Winner_ID = $_POST["Winner_ID"];
	$Loser_ID = $_POST["Loser_ID"];
	$Winner_Score = $_POST["Winner_Score"];
	$Loser_Score = $_POST["Loser_Score"];
	$Judge_ID = $_POST["Judge_ID"];
	$Score =$Winner_Score-$Loser_Score;
//	echo $Winner_ID.$Loser_ID.$Winner_Score.$Loser_Score.$Judge_ID;
//	echo $Score;
	$con = mysql_connect("localhost","root","hhf150076");
	mysql_select_db("Student", $con);
	if(!$con)
	{
		echo "failed";
	}
	
	//get the information of  winner
	$Winner_OpenID = mysql_query("select User_OpenID from Student_Data where Student_ID='$Winner_ID'");
	$Winner_OpenID = mysql_fetch_array($Winner_OpenID);
	$Winner_OpenID = $Winner_OpenID['User_OpenID'];
	echo "Winner_ID is ".$Winner_OpenID;
	echo "<br/>";
	$Winner_Name = mysql_query("select Student_Name from Student_Data where Student_ID='$Winner_ID'");
	$Winner_Name = mysql_fetch_array($Winner_Name);
	$Winner_Name = $Winner_Name['Student_Name'];
	echo "Winner_Name is ".$Winner_Name;
	echo "<br/>";
	
	//get the information of loser
	$Loser_OpenID = mysql_query("select User_OpenID from Student_Data where Student_ID='$Loser_ID'");
	$Loser_OpenID = mysql_fetch_array($Loser_OpenID);
	$Loser_OpenID = $Loser_OpenID['User_OpenID'];
	echo "Loser_ID is ".$Loser_OpenID;
	echo "<br/>";
	$Loser_Name = mysql_query("select Student_Name from Student_Data where Student_ID='$Loser_ID'");
	$Loser_Name = mysql_fetch_array($Loser_Name);
	$Loser_Name = $Loser_Name['Student_Name'];
	echo "Loser_Name is ".$Loser_Name;
	echo "<br/>";
	
	//get the information about judge
	$Judge_OpenID = mysql_query("select User_OpenID from Judge_Data where Judge_ID='$Judge_ID'");
	$Judge_OpenID = mysql_fetch_array($Judge_OpenID);
	$Judge_OpenID = $Judge_OpenID['User_OpenID'];
	$Judge_Hours = mysql_query("select Work_Hours from Judge_Data where Judge_ID='$Judge_ID'");
	$Judge_Hours = mysql_fetch_array($Judge_Hours);
	$Judge_Hours = $Judge_Hours['Work_Hours'];
	$Judge_Name = mysql_query("select Judge_Name from Judge_Data where Judge_ID='$Judge_ID'");
	$Judge_Name = mysql_fetch_array($Judge_Name);
	$Judge_Name = $Judge_Name['Judge_Name'];
	echo "Judge_OpenId is ".$Judge_OpenID."<br/>";
	echo "Judge_Hours is ".$Judge_Hours." hours<br/>";
	echo "Judge_Name is ".$Judge_Name;
	
	
	//save picture
	if ($_FILES["file"]["error"] > 0)
    {
		echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
	else
    {
		echo "Upload: " . $_FILES["file"]["name"] . "<br />";
		echo "Type: " . $_FILES["file"]["type"] . "<br />";
		echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
		echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
		if (file_exists("upload/" . $_FILES["file"]["name"]))
		{
			echo $_FILES["file"]["name"] . " already exists. ";
		}
		else
		{
			if(move_uploaded_file($_FILES["file"]["tmp_name"],"upload/".$_FILES["file"]["name"])==0)
			{
				echo "error";
			}
			else
			{
			echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
			}
		}
    }
		
	$SELECT = "SELECT * FROM Game_Data WHERE Game_Judge_ID='$Judge_ID'	AND 
	(Game_PlayerX_ID='$Winner_ID' or Game_PlayerY_ID='$Winner_ID') AND
	(Game_PlayerX_ID='$Loser_ID' or Game_PlayerY_ID='$Loser_ID') AND Game_Status=0";
	$SELECT = mysql_query($SELECT);
	$Res = mysql_fetch_array($SELECT);
	echo "Game_ID is ".$Res["Game_ID"]."</br>";
	$Res = $Res["Game_ID"];
	$Contest_Date = "20".mb_substr($Res,0,2,"UTF-8")."-".mb_substr($Res,2,2,"UTF-8");
	$Contest_Date = $Contest_Date."-".mb_substr($Res,4,2,"UTF-8")."-".mb_substr($Res,6,1,"UTF-8").":";
	$Contest_Date = $Contest_Date.mb_substr($Res,7,2,"UTF-8");
	$Game_Time = mb_substr($Res,6,3,"UTF-8");
	echo "game_Time is ".$Game_Time;
	$Game_Pos = mb_substr($Res,9,1,"UTF-8");
	if($Game_Pos==0)
	{
		$Game_Pos = mb_substr($Res,10,1,"UTF-8");
		echo "Game_Pos is ".$Game_Pos;
	}
	else
	{
		$Game_Pos = mb_substr($Res,9,2,"UTF-8");
		echo "Game_Pos is ".$Game_Pos;
	}
	mysql_query("UPDATE Game_Data SET Game_Time='$Game_Time' WHERE Game_ID='$Res'");
	mysql_query("UPDATE Game_Data SET Game_Pos='$Game_Pos' WHERE Game_ID='$Res'");
	echo $Contest_Date;
	echo $Res;
	if(isset($Res["Game_ID"])!=FALSE)
	{
	$Update_Winner = "UPDATE Student_Data SET Student_Score=Student_Score+$Score WHERE Student_ID='$Winner_ID'";
	mysql_query($Update_Winner);
	$Update_Loser = "UPDATE Student_Data SET Student_Score=Student_Score-$Score WHERE Student_ID='$Loser_ID'";
	mysql_query($Update_Loser);
	$Update_Judge = "UPDATE Judge_Data SET Work_Hours=Work_Hours+1 WHERE Judge_ID='$Judge_ID' ";
	mysql_query($Update_Judge);
	$Game_PlayerX_ID_IS = "SELECT Game_PlayerX_ID FROM Game_Data WHERE Game_ID='$Res'";
	$Game_PlayerX_ID_IS = mysql_query($Game_PlayerX_ID_IS);
	$Game_PlayerX_ID_IS = mysql_fetch_array($Game_PlayerX_ID_IS);
	$Game_PlayerX_ID_IS = $Game_PlayerX_ID_IS["Game_PlayerX_ID"];
	echo "Game_Player_ID_IS is ".$Game_PlayerX_ID_IS;
	if($Winner_ID==$Game_PlayerX_ID_IS)
	{
		echo "Winner_ID is  Game_PlayerX_ID ";
		mysql_query("UPDATE Game_Data SET Game_ScoreX=50 WHERE Game_ID='$Res'");
		mysql_query("UPDATE Game_Data SET Game_ScoreY='$Loser_Score' WHERE Game_ID='$Res'");
	}
	else
	{
		mysql_query("UPDATE Game_Data SET Game_ScoreY=50 WHERE Game_ID='$Res'");
		mysql_query("UPDATE Game_Data SET Game_ScoreX='$Loser_Score' WHERE Game_ID='$Res'");
		echo "Winner_ID is  Game_PlayerY_ID ";
	}
	
	
	
	}
	else
	{
		echo "unput error";
	}
	
	//send the message
	
function https_request($url)
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
	
	$appid = "wx0b6b6a2ba0927086";
	$appsecret = "a2a83f0da28e374ae3f89afef9127c76";
	$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
	$output = https_request($url);
	$jsoninfo = json_decode($output, true);
	$access_token = $jsoninfo["access_token"];
//	echo "Access_token is ".$access_token;

$url = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$access_token;
 
$data_Win = array(
    'First' => array(
        'value' => '同学你好！',
        'color' => '#FF0000'
    ),
    'Name' => array(
        'value' => $Winner_Name,
        'color' => '#FF0000'
    ),
    'Date' => array(
        'value' => $Contest_Date,
        'color' => '#FF0000'
    ),
	'Score' => array(
        'value' => $Score,
        'color' => '#FF0000'
    ),
    'Remark' => array(
        'value' => '祝比赛顺利！',
        'color' => '#FF0000'
    )
);
$data_Lose = array(
    'First' => array(
        'value' => '同学你好！',
        'color' => '#FF0000'
    ),
    'Name' => array(
        'value' => $Loser_Name,
        'color' => '#FF0000'
    ),
    'Date' => array(
        'value' => $Contest_Date,
        'color' => '#FF0000'
    ),
	'Score' => array(
        'value' => $Score,
        'color' => '#FF0000'
    ),
    
    'Remark' => array(
        'value' => '祝比赛顺利！',
        'color' => '#FF0000'
    )
);
$data_Judge = array(
    'First' => array(
        'value' => '同学你好！',
        'color' => '#FF0000'
    ),
    'Name' => array(
        'value' => $Judge_Name,
        'color' => '#FF0000'
    ),
    'Date' => array(
        'value' => $Contest_Date,
        'color' => '#FF0000'
    ),
	'Hours' => array(
        'value' => $Judge_Hours,
        'color' => '#FF0000'
    ), 
    'Remark' => array(
        'value' => '祝顺利！',
        'color' => '#FF0000'
    )
);


/*
//暂时不发送信息
$template_msg_Win=array('touser'=>$Winner_OpenID,
'template_id'=>'ideeEADwRMlXYKzqPMje0E0IqI-fJ0Aqs-vAgjkJT3g','topcolor'=>'#FF0000','data'=>$data_Win);

$template_msg_Lose=array('touser'=>$Loser_OpenID,
'template_id'=>'dsp3GcOeq5UUQ2vyN2YeiRnLpr2SdTS-Ky-pxPTClh0','topcolor'=>'#FF0000','data'=>$data_Lose);

$template_msg_Judge=array('touser'=>$Judge_OpenID,
'template_id'=>'jMP_SClsXp8Z5RvQgArSzoKz7EY9iz0yj0iTik8t2hE','topcolor'=>'#FF0000','data'=>$data_Judge);
 
 
$curl = curl_init($url);
$header = array();
$header[] = 'Content-Type: application/x-www-form-urlencoded';
curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
// 不输出header头信息
curl_setopt($curl, CURLOPT_HEADER, 0);
// 伪装浏览器
curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36');
// 保存到字符串而不是输出
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
// post数据
curl_setopt($curl, CURLOPT_POST, 1);
// 请求数据
curl_setopt($curl,CURLOPT_POSTFIELDS,json_encode($template_msg_Win));
$response = curl_exec($curl);
curl_setopt($curl,CURLOPT_POSTFIELDS,json_encode($template_msg_Lose));
$response = curl_exec($curl);
curl_setopt($curl,CURLOPT_POSTFIELDS,json_encode($template_msg_Judge));
$response = curl_exec($curl);
curl_close($curl);
echo $response;

*/

?>


