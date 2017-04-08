<?php

$appid = "wx0b6b6a2ba0927086";
$appsecret = "a2a83f0da28e374ae3f89afef9127c76";
$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
$redirect_url = "http://www.personalwebhhf.cn/PHP/Oauth2.php";

$output = https_request($url);
$jsoninfo = json_decode($output, true);
$access_token = $jsoninfo["access_token"];


$jsonmenu = '{
      "button":[
      {
            "name":"约赛",
           "sub_button":[
            {
               "type":"view",
               "name":"个人中心",
               "url":"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx0b6b6a2ba0927086&redirect_uri=http://www.personalwebhhf.cn/PHP/Oauth2_Personal_Center.php&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect"
            },
            {
               "type":"view",
               "name":"发起约赛",
               "url":"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx0b6b6a2ba0927086&redirect_uri=http://www.personalwebhhf.cn/PHP/Oauth2_Start_Game.php&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect"
            },
            {
               "type":"view",
               "name":"积分榜",
               "url":"http://www.personalwebhhf.cn/Wechat/Leaderboard.php"
            },
            {
               "type":"view",
               "name":"学号绑定",
               "url":"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx0b6b6a2ba0927086&redirect_uri=http://www.personalwebhhf.cn/PHP/Oauth2.php&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect"
            }
            ]
       },
       {
           "name":"事物处理",
           "sub_button":[
            {
               "type":"view",
               "name":"担当裁判",
               "url":"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx0b6b6a2ba0927086&redirect_uri=http://www.personalwebhhf.cn/PHP/Oauth2_To_Be_Judge.php&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect"
            },
            {
               "type":"view",
               "name":"汇报",
               "url":"http://www.personalwebhhf.cn/Wechat/Report.html"
            },
            {
                "type":"view",
                "name":"评价",
                "url":"http://map.baidu.com/"
            },
			{
				"type":"view",
				"name":"发现",
				"url":"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx0b6b6a2ba0927086&redirect_uri=http://www.personalwebhhf.cn/PHP/Oauth2_Find_Others.php&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect"
			}
			]
       

       },
	   {
		   "type":"click",
		   "name":"联系我们",
		   "key":"link_us"
	   }
	   ]
 }';


$url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$access_token;
$result = https_request($url, $jsonmenu);
var_dump($result);

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