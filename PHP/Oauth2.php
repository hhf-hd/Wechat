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
	//var_dump($user_json);
	$pic =$user_json['headimgurl'];
	$Openid = $user_json['openid'];
	$Nickname = $user_json['nickname'];
	$City = $user_json['city'];
	$Province = $user_json['province'];
//	echo $pic;
//	echo $Nickname;
	setcookie("openid",$Openid,time()+3600*180);
	setcookie("nickname",$Nickname,time()+3600*180);
	setcookie("headimgurl",$pic,time()+3600*180);
	header("Location: http://www.personalwebhhf.cn/Wechat/Student_Register.html");
	
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
