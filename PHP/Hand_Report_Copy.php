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
	
	$SELECT = "SELECT * FROM Game_Data WHERE Game_Judge_ID='$Judge_ID'	AND 
	(Game_PlayerX_ID='$Winner_ID' or Game_PlayerY_ID='$Winner_ID') AND
	(Game_PlayerX_ID='$Loser_ID' or Game_PlayerY_ID='$Loser_ID') AND Game_Status=0";
	$SELECT = mysql_query($SELECT);
	$Res = mysql_fetch_array($SELECT);
	echo $Res["Game_ID"];
	
	if ($_FILES["file"]["error"] > 0)
    {
		echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
	else
    {
		echo "if error".$_FILES["file"]["error"]."<br/>";
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
	/*	
	$Update_Winner = "UPDATE Student_Data SET Student_Score=Student_Score+$Score WHERE Student_ID='$Winner_ID'";
	mysql_query($Update_Winner);
	$Update_Loser = "UPDATE Student_Data SET Student_Score=Student_Score-$Score WHERE Student_ID='$Loser_ID'";
	mysql_query($Update_Loser);
	$Update_Judge = "UPDATE Judge_Data SET Work_Hours=Work_Hours+1 WHERE Judge_ID='$Judge_ID' ";
	mysql_query($Update_Judge);
*/	
	
	
	
	
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
	echo "Access_token is ".$access_token;

$url = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$access_token;//access_token改成你的有效值
 
$data1 = array(
    'First' => array(
        'value' => '同学你好！',
        'color' => '#FF0000'
    ),
    'Name' => array(
        'value' => '黄鸿飞',
        'color' => '#FF0000'
    ),
    'Date' => array(
        'value' => '2016—11-28 5:30',
        'color' => '#FF0000'
    ),
	'Score' => array(
        'value' => '42',
        'color' => '#FF0000'
    ),
    
    'Remark' => array(
        'value' => '祝比赛顺利！',
        'color' => '#FF0000'
    )
);
$data1 = array(
    'First' => array(
        'value' => '同学你好！',
        'color' => '#FF0000'
    ),
    'Name' => array(
        'value' => '黄鸿飞',
        'color' => '#FF0000'
    ),
    'Date' => array(
        'value' => '2016—11-28 5:30',
        'color' => '#FF0000'
    ),
	'Score' => array(
        'value' => '42',
        'color' => '#FF0000'
    ),
    
    'Remark' => array(
        'value' => '祝比赛顺利！',
        'color' => '#FF0000'
    )
);
$template_msg=array('touser'=>$Winner_OpenID,
'template_id'=>'ideeEADwRMlXYKzqPMje0E0IqI-fJ0Aqs-vAgjkJT3g','topcolor'=>'#FF0000','data'=>$data1);
 
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
curl_setopt($curl,CURLOPT_POSTFIELDS,json_encode($template_msg));
$response = curl_exec($curl);
curl_close($curl);
echo $response;


?>


