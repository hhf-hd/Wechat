<?php
/**
  * wechat php test
  */

//define your token
define("TOKEN", "huanghongfei");
$wechatObj = new wechatCallbackapiTest();
$wechatObj->responseMsg();
//$wechatObj->valid();

class wechatCallbackapiTest
{
    /*public function valid()
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
            echo $echoStr;
            exit;
        }
    }*/

    public function responseMsg()
    {
        //get post data, May be due to the different environments
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

          //extract post data
        if (!empty($postStr)){
                
                  $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $RX_TYPE = trim($postObj->MsgType);

                switch($RX_TYPE)
                {
					
                    case "text":
                        $resultStr = $this->handleText($postObj);
                        break;
					case "image":
						$resultStr = $this->handleImage($postObj);
						break;
					case "voice":
						$resultStr = $this->handleVoice($postObj);
						break;
                    case "event":
                        $resultStr = $this->handleEvent($postObj);
                        break;
					case "location":
						$resultStr = $this->handleLocation($postObj);
						break;
					case "link":
						$resultStr = $this->handleLink($postObj);
						break;

                    default:
                        $resultStr = "Unknow msg type: ".$RX_TYPE;
                        break;
                }
                echo $resultStr;
        }else {
            echo "";
            exit;
        }
    }

    public function handleText($postObj)
    {
        $fromUsername = $postObj->FromUserName;
        $toUsername = $postObj->ToUserName;
        $keyword = trim($postObj->Content);
        $time = time();
        $textTpl = "<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[%s]]></MsgType>
                    <Content><![CDATA[%s]]></Content>
                    <FuncFlag>0</FuncFlag>
                    </xml>";             
        if(!empty( $keyword ))
        {
            $msgType = "text";			
		//	$Str = mb_substr($keyword,-2,2,"UTF-8");
			$Key = mb_substr($keyword,0,2,"UTF-8");
			$con = mysql_connect("localhost","root","hhf150076");//link to database
			if(!$con)//success or not 
			{
				$keyword="error";
			}
			else
			{
			mysql_select_db("Student",$con);//chose databases 
			$res = mysql_query("select Student_ID from Student_Data");
			while($raw = mysql_fetch_array($res))
				{
					if($keyword==$raw['Student_ID'])
					{
						
						$name=mysql_query("select  Student_Name from  Student_Data where Student_ID=$keyword ");
						//$keyword = "hello ".$name['Student_Name']." please input password";
						$name = mysql_fetch_array($name);
						$name = $name['Student_Name'];
						$keyword = "hello ".$name." please input password";
						break;
					}
				
				}
			
			}
			
            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $keyword);
            echo $resultStr;
        }else{
            echo "Input something...";
        }
    }

    public function handleEvent($object)
    {
        $contentStr = "";
        switch ($object->Event)
        {
            case "subscribe":
                $contentStr = "TEST subscribe User_ID: ".$object->FromUserName;
                break;
			case "CLICK":	
				$contentStr = $object->EventKey;
				
				switch($contentStr)
				{
					case "register":
						$contentStr = "Please input Student_ID";
						break;
					case "link_us":
					    $contentStr = " my email: h.hong.fei@foxmail.com "."\n"." wechat: Waiting_S0"."\n"." Tel: 15957108625";
						break;
					
					default:
						$contentStr = "other click event";
						break;
				}
				break;	
			case "LOCATION":
						$Latitude = $object->Latitude;
						$Longitude = $object->Longitude;
						$User = $object->FromUserName;
						$contentStr ="Latitude: ".$Latitude."\nLongitude :".$Longitude.$User;
						$con = mysql_connect("localhost","root","hhf150076");//link to database
						if(!$con)//success or not 
						{
							$keyword="error";
						}
						mysql_select_db("Student",$con);//chose databases 
					//	$Ins = "INSERT INTO Location(User_OpenID,Loca_Lat,Loca_Lon) VALUES('$User','$Latitude','$Longitude')";
					//	mysql_query($Ins);
						break;
            default :
                $contentStr = "handleEvent ".$object->Event;
                break;
        }
        $resultStr = $this->responseText($object, $contentStr);
        return $resultStr;
    }
	
	public function handleImage($object)
	{
		$contentStr = "image";
		$resultStr = $this->responseText($object, $contentStr);
		return $resultStr;
	}
	
	public function handleVoice($object)
	{
		$contentStr = "voice";
		$resultStr = $this->responseText($object,$contentStr);
		return $resultStr;
	}
	
	public function handleLocation($object)
	{
		$contentStr = "location";
		$resultStr = $this->responseText($object,$contentStr);
		return $resultStr;
	}

	public function handleLink($object)
	{
		$contentStr = "link";
		$resultStr = $this->responseText($object,$contentStr);
		return $resultStr;
	}

    public function responseText($object, $content, $flag=0)
    {
        $textTpl = "<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[text]]></MsgType>
                    <Content><![CDATA[%s]]></Content>
                    <FuncFlag>%d</FuncFlag>
                    </xml>";
        $resultStr = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time(), $content, $flag);
        return $resultStr;
    }

    private function checkSignature()
    {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];    
                
        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );
        
        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }
}

?>