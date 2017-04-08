
<?php  

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
	
	$Winner_OpenID = mysql_query("select User_OpenID from Student_Data where Student_ID='$Winner_ID'");
	$Winner_OpenID = mysql_fetch_array($Winner_OpenID);
	$Winner_OpenID = $Winner_OpenID['User_OpenID'];
//	echo $Winner_OpenID;
	
/*	$Update_Winner = "UPDATE Student_Data SET Student_Score=Student_Score+$Score WHERE Student_ID='$Winner_ID' ";
	mysql_query($Update_Winner);
	$Update_Loser = "UPDATE Student_Data SET Student_Score=Student_Score-$Score WHERE Student_ID='$Loser_ID' ";
	mysql_query($Update_Loser);
	$Update_Judge = "UPDATE Judge_Data SET Work_Hours=Work_Hours+1 WHERE Judge_ID='$Judge_ID' ";
	mysql_query($Update_Judge);
*/	
	$appid = "wx0b6b6a2ba0927086";
	$appsecret = "a2a83f0da28e374ae3f89afef9127c76";
	$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
	$output = https_request($url);
	$jsoninfo = json_decode($output, true);
	$access_token = $jsoninfo["access_token"];
	echo "Access_token is ".$access_token;
	
	
/*	$Template = array
	(
		'touser' => $Winner_OpenID,
		'template_id' = "ideeEADwRMlXYKzqPMje0E0IqI-fJ0Aqs-vAgjkJT3g",
		'url' => "http://weixin.qq.com/download",
		'topcolor' => "#7B68EE",
		'Data' = array
		(
			'First' => array(
				'value' => urlencode("this is "),
				'color' => '#FF000'
			),
			'Name' => array(
				'value' => urlencode("this is "),
				'color' => '#FF000'
			),
			'Date' => array(
				'value' => urlencode("this is "),
				'color' => '#FF000'
			),
			'Score' => array(
				'value' => urlencode("this is "),
				'color' => '#FF000'
			),
			'Remark' => array(
				'value' => urlencode("this is "),
				'color' => '#FF000'
			),
		)
	);
	
	
	*/
	$template=array( 
'touser'=>$Winner_OpenID, 
'template_id'=>"Ka5315Z0lu8CFkltBeTWrKXQS3vdRA1w4MC8lL_whAo",    //模板的id 
'url'=>"http://weixin.qq.com/download", 
'topcolor'=>"#FF0000", 
'data'=>array( 
	'Name'=>array('value'=>urlencode("njjjjjjjjj"),'color'=>'#00008B'),    //函数传参过来的name      
	'Date'=>array('value'=>urlencode("fddljnbg"),'color'=>'#00008B'),   //时间
	'Score'=>array('value'=>urlencode("fddljnbg"),'color'=>'#00008B'),	
) 
); 
/*	$Json_Template = json_encode($Template);
	$URL = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".$access_token;
	$Res = https_request($URL,urldecode($Json_Template));
	echo $Res;
	echo "hdhxjvhbsh";
*/	
	echo "<br>";
	echo "这是";
	$json_template=json_encode($template);
	echo "<br>";
	echo "这是yg";	
	$url="https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".$access_token; 
	echo "<br>";
	echo "这是gfnbrn";
	$res=http_request($url,urldecode($json_template));
	echo "<br>";
	echo "这是fhmnjdgmfynl,";	
	if ($res[errcode]==0)
	{
		echo '消息发送成功!'; 
	}		
	echo "<br>";
	echo "这是一个测试";
	
	

?>


