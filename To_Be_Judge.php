<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0, maximum-scale=1.0,user-scalable=no">
<title>Start Game</title>
<style type="text/css">
body {
	background:#B3B3B3;
}
#img {
	margin-left:35%;
	margin-top:20%;
	width:20em;
	width:100px;
	height:100px;
	border-radius:50px;
	border:solid rgb(100,100,100) 1px;
	overflow:hidden;
	background:#BFBFBF;
}
#ID_Name {
	margin-left:25%;
	margin-top:10%;
	margin-right:10%;
	word-spacing:10px;
	background:#BBBBBB;
	font-size:1.5em;
}
#login_module {

	margin-top:1%;
	margin-left:8%;
}
#Submit_data {
	margin-left:35%;
	font-size:1.1em;
	
}

input.S{
	font-size:1.1em;
	width:8em;
}
select.S{
	font-size:1.4em;
	width:8.5em;
	
}
input.su {
	font-size:1.2em;

}
td {
	font-size:1.3em;
}
span.time {
	font-size:1.4em;
}
</style>
<script language="javascript" >
function fsubmit(obj)
{
	obj.submit();
}

function Check_ID(objText)
{
	if(!objText.value)
	{
		objText.focus();
		var NUM="手机号不能为空";
		document.getElementById("Check_ID_blank").innerHTML="<span Style='font-size:0.3em;'>"+NUM+"</span>";
		return;
	}
}
</script>
<body>
<div id="img" >

<img src="<?php
    $Openid = $_GET['openid'];
	
	$con = mysql_connect("localhost","root","hhf150076");
	mysql_select_db("Student", $con);
	if(!$con)
	{
		echo "failed";
	}
	$Pic = mysql_query("select Student_Headimgurl from Student_Data where User_OpenID='$Openid'");
	$Pic = mysql_fetch_array($Pic);
	$Pic = $Pic['Student_Headimgurl'];
	echo $Pic ;
	
	?>"  height='100' width='100' />
	
	
</div>	
<div id="ID_Name">
<?php
	$Openid = $_GET['openid'];
	
	$con = mysql_connect("localhost","root","hhf150076");
	mysql_select_db("Student", $con);
	if(!$con)
	{
		echo "failed";
	}
	$ID = mysql_query("select Student_ID from Student_Data where User_OpenID='$Openid'");
	$ID = mysql_fetch_array($ID);
	$ID = $ID['Student_ID'];
	$Name = mysql_query("select Student_Name from Student_Data where User_OpenID='$Openid'");
	$Name = mysql_fetch_array($Name);
	$Name = $Name['Student_Name'];
	echo "<span > ID:$ID </sapn> <span> Name:$Name</span>";
	
?>
</div>
<div id="login_module">
   <form name="login_form" id="login_form" method="post" action="http://www.personalwebhhf.cn/PHP/Handle_To_Be_Judge.php">
    <fieldset>
      <table>
		 
		   <span class="time">时间：</span>	  
		   <select name="Time" class="S">
			<option value="161128530">2016-11-28 5:30</option>
			<option value="161128600">2016-11-28 6:00</option>
			<option value="161128630">2016-11-28 6:30</option>
			<option value="161128700">2016-11-28 7:00</option>
			<option value="161128730">2016-11-28 7:30</option>
			<option value="161128800">2016-11-28 8:00</option>
			<option value="161128830">2016-11-28 8:30</option>
			
		  </select> 
		 
	    <tr>
		  <td>TELE：</td>
		  <td><input class="S" type="text" name="Tel"  onblur="Check_ID(this)" onfocus="Check_ID_Focus(this)" ></td>
		  <td><span id="Check_ID_blank" ></span></td>
		</tr>	
		
	  </table>
	  </fieldset>
	</form>
	<div id="Submit_data">
		<input  class="su" type="button"  value="报名" onClick="javascript:fsubmit(document.login_form);"/>
	</div>
</div>
</body>
</html>




