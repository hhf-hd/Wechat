

<?php
	
	$ID = $_POST["ID"];
	$Password = $_POST["Password"];
	$Student_Type = $_POST["Student_Type"];//获取传输的数据
	$OpenID = $_COOKIE["openid"];
	$Nickname = $_COOKIE["nickname"];
	$Headimgurl = $_COOKIE["headimgurl"];
//	echo $OpenID;
//	echo $Nickname;
//	echo $Headimgurl;
	$con = mysql_connect("localhost","root","hhf150076");//连接数据库
	mysql_select_db("Student", $con);//选择数据库
	if($Student_Type=="选手")//为选手的操作
	{
		$Res = mysql_query("select Student_ID from Student_Data");//查询符合的Student_ID
		while($raw = mysql_fetch_array($Res))
		{
			if($ID == $raw['Student_ID'])
			{
			/*	$Name = mysql_query("select Student_Name from Student_Data where Student_ID=$ID");
				$Name = mysql_fetch_array($Name);
				$Name = $Name['Student_Name'];//查询出选手的名字
			*/
				$Try = mysql_query("select Student_Password from Student_Data where Student_ID=$ID");
				$Try = mysql_fetch_array($Try);
				$Try = $Try['Student_Password'];//获取到该学生的password
				$Reg = mysql_query("select Student_Register from Student_Data where Student_ID=$ID");
				$Reg = mysql_fetch_array($Reg);
				$Reg = $Reg['Student_Register'];
			/*	$Set_Password = "update Student_Data set Student_Password='$Password' where Student_ID=$ID ";
				mysql_query($Set_Password);
			*/
				
				if($Reg ==1)
				{
					header("Location: http://www.personalwebhhf.cn/Wechat/Register_Repeat.html");
				}				 
				else if($Try == $Password)
				{ 
					$Set_ID = "update Student_Data set User_OpenID='$OpenID' where Student_ID=$ID ";
					$Set_Nickname = "update Student_Data set Student_Nickname='$Nickname' where Student_ID=$ID ";
					$Set_Headimgurl = "update Student_Data set Student_Headimgurl='$Headimgurl' where Student_ID=$ID ";
					mysql_query($Set_ID);
					mysql_query($Set_Nickname);
					mysql_query($Set_Headimgurl);
					mysql_query("update Student_Data set Student_Register=1 where Student_ID=$ID ");//注册赋为1,表示注册了
					header("Location: http://www.personalwebhhf.cn/Wechat/Register_Success.html");			
				}
				else 
				{
					header("Location: http://www.personalwebhhf.cn/Wechat/Register_Error.html");
				}
			}
		}
	}
	
	if($Student_Type=="裁判")//为选手的操作
	{
		$Res = mysql_query("select Judge_ID from Judge_Data");//查询符合的Judge_ID
		while($raw = mysql_fetch_array($Res))
		{
			if($ID == $raw['Judge_ID'])
			{
			/*	$Name = mysql_query("select Student_Name from Student_Data where Student_ID=$ID");
				$Name = mysql_fetch_array($Name);
				$Name = $Name['Student_Name'];//查询出选手的名字
			*/
				$Try = mysql_query("select Judge_Password from Judge_Data where Judge_ID=$ID");
				$Try = mysql_fetch_array($Try);
				$Try = $Try['Judge_Password'];//获取到该学生的password
				$Reg = mysql_query("select Judge_Register from Judge_Data where Judge_ID=$ID");
				$Reg = mysql_fetch_array($Reg);
				$Reg = $Reg['Judge_Register'];
			/*	$Set_Password = "update Student_Data set Student_Password='$Password' where Student_ID=$ID ";
				mysql_query($Set_Password);
			*/
				
				if($Reg ==1)
				{
					header("Location: http://www.personalwebhhf.cn/Wechat/Register_Repeat.html");
				}				 
				else if($Try == $Password)
				{ 
					$Set_ID = "update Judge_Data set User_OpenID='$OpenID' where Judge_ID=$ID ";
					$Set_Nickname = "update Judge_Data set Judge_Nickname='$Nickname' where Judge_ID=$ID ";
					$Set_Headimgurl = "update Judge_Data set Judge_Headimgurl='$Headimgurl' where Judge_ID=$ID ";
					mysql_query($Set_ID);
					mysql_query($Set_Nickname);
					mysql_query($Set_Headimgurl);
					mysql_query("update Judge_Data set Judge_Register=1 where Judge_ID=$ID ");//注册赋为1,表示注册了
					header("Location: http://www.personalwebhhf.cn/Wechat/Register_Success.html");			
				}
				else 
				{
					header("Location: http://www.personalwebhhf.cn/Wechat/Register_Error.html");
				}
			}
		}
	}
	
	mysql_close($con);
?>



