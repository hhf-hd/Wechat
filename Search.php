
<!DOCTYPE>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0, maximum-scale=1.0,user-scalable=no">
<title>Login Interface</title>
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
		var NUM="学号不能为空";
		document.getElementById("Check_ID_blank").innerHTML="<span Style='font-size:0.3em;'>"+NUM+"</span>";
		return;
	}
}

function Check_Password(objText)
{
	if(!objText.value)
	{
		objText.focus();
		var Password_Str="密码不能为空";
		document.getElementById("Check_Password_blank").innerHTML="<span style=' font-size:0.3em ;'>"+Password_Str+"</span>";
		return;
	}
}
function Check_Type(objText)
{
	if(!objText.value)
	{
		objText.focus();
		var Type="类型不能为空";
		document.getElementById("Check_Type_blank").innerHTML="<span style='font-size:0.3em ;'>"+Type+"</span>";
		
	}
	if(objText.value!="裁判"&&objText.value!="选手")
	{
		var Ill = "非法输入";
		document.getElementById("Check_Type_blank").innerHTML="<span style=' font-size:0.3em;'>"+ILL+"</span>";
	}
	return ;
	
} 
function Check_ID_Focus(objText)
{
	document.getElementById("Check_ID_blank").innerHTML="";
		return;

}
function Check_Password_Focus(objText)
{
	document.getElementById("Check_Password_blank").innerHTML="";
		return;

}
function Check_Type_Focus(objText)
{
	document.getElementById("Check_Type_blank").innerHTML="";
		return;

}
</script>
<style type="text/css">
body {
	background-color:B3B3B3;
}
#login_module {

	margin-top:1%;
	margin-left:8%;
}
#Title_Header {
	margin-top:48%;
	margin-left:30%;
	font-size:1.4em;
}
#Submit_data {
	margin-left:35%;
	font-size:1.1em;
	
}

input.S{
	font-size:1.1em;
	width:8em;
}
input.su {
	font-size:1.2em;

}
td {
	font-size:1.3em;
}
</style>
</head>
<body>
<p id="Title_Header">杭州电子科技大学</p>

<div id="login_module">
   <form name="login_form" id="login_form" method="post" action="http://www.personalwebhhf.cn/PHP/Handle_Search.php">
    <fieldset>
      <table>
	  
	   <span class="time">条件：</span>	  
		   <select name="Condition" class="S">
		   
			<option value="Student_Name">姓名</option>
			<option value="Student_ID">学号</option>
				
			</select> 
		
		<tr>
		  <td>关键字：</td>
		  <td><input class="S" type="text" name="Key_Word" onblur="Check_Password(this)" onfocus="Check_Password_Focus(this)" ></td>
		  <td><span id="Check_Password_blank" ></span></td>
		</tr>
		
		
	  </table>
	  </fieldset>
	</form>
	<div id="Submit_data">
		<input  class="su" type="button"  value="绑定" onClick="javascript:fsubmit(document.login_form);"/>
	</div>
</div>
</body>
</html>
	
	
	