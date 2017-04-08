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
	
	
	$appid = "wx0b6b6a2ba0927086";
	$appsecret = "a2a83f0da28e374ae3f89afef9127c76";
	$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
	$output = https_request($url);
	$jsoninfo = json_decode($output, true);
	$access_token = $jsoninfo["access_token"];
	echo "Access_token is ".$access_token;

$url = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$access_token;//access_token改成你的有效值
 
$data = array(
    'first' => array(
        'value' => '有一名客户进行了一次预约！',
        'color' => '#FF0000'
    ),
    'keyword1' => array(
        'value' => '2015/10/5 14:00~14:45',
        'color' => '#FF0000'
    ),
    'keyword2' => array(
        'value' => '都会型SPA',
        'color' => '#FF0000'
    ),
    'keyword3' => array(
        'value' => '1cvvvv',
        'color' => '#FF0000'
    ),
    'keyword4' => array(
        'value' => '上海市浦东新区XXXXSPA馆',
        'color' => '#FF0000'
    ),
    'keyword5' => array(
        'value' => '无',
        'color' => '#FF0000'
    ),
    'remark' => array(
        'value' => '请您务必准时到场为客户提供SPA服务！',
        'color' => '#FF0000'
    )
);
$template_msg=array('touser'=>'oXuLFw9aAWeBrRnyyXf8dqjWImH4',
'template_id'=>'Ka5315Z0lu8CFkltBeTWrKXQS3vdRA1w4MC8lL_whAo','topcolor'=>'#FF0000','data'=>$data);
 
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