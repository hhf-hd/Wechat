<!DOCTYPE>
<html>
<body>
<?php

	$appid = "wx0b6b6a2ba0927086";
	$appsecret = "a2a83f0da28e374ae3f89afef9127c76";
	
	if(isset($_GET['code']))
	{
		$code = $_GET['code'];		
	}
	else
	{
		echo "no code";
	}
	$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$appsecret&code=$code&grant_type=authorization_code";
	$output = https_request($url);
	$jsoninfo = json_decode($output, true);
	$access_token = $jsoninfo["access_token"];//获取了access_token
	$openid= $jsoninfo["openid"];//获取openid
	
	$user_url = "https://api.weixin.qq.com/sns/userinfo?access_token=$access_token&openid=$openid&lang=zh_CN";
	$user_infomation = https_request($user_url);
	$user_json = json_decode($user_infomation,true);
//	var_dump($user_json);
	$Openid = $user_json['openid'];

	$con = mysql_connect("localhost","root","hhf150076");//连接数据库
	mysql_select_db("Student", $con);//选择数据库
	$Res = mysql_query("select User_OpenID from Student_Data");//查询符合的Student_ID
	$Flag=1;
	while($raw = mysql_fetch_array($Res))
	{
			if($Openid == $raw['User_OpenID'])
			{
			//	setcookie("openid",$Openid,time()+3600*2);
				header("Location: http://www.personalwebhhf.cn/Wechat/Personal_Center.php?openid=$Openid");
				$Flag=0;
			}
	}
	if($Flag!=0)
	{
	header("Location: http://www.personalwebhhf.cn/Wechat/Student_Register.html");
	}
	function https_request($url,$data = null){
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
?>

</body>
</html>
