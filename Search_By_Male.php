<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0, maximum-scale=1.0,user-scalable=no">
<title>Personal Center</title>
<style type="text/css">
body {
	background:#000000;
}
#HDU_img 
{
	margin-top:10%;
	margin-left:10%;
	
}
#img {
	margin-left:10%;
	margin_top:10%;
	word-spacing:23px;
	background:#BFBFBF;
}

*{padding:0;margin:0;border:none;text-decoration:none;}
.button {
	display: inline-block;
	outline: none;
	cursor: pointer;
	text-align: center;
	text-decoration: none;
	font: 16px/100% 'Microsoft yahei',Arial, Helvetica, sans-serif;
	padding: .1em 1em .25em;
	margin-left:0.5em;
	text-shadow: 0 1px 1px rgba(0,0,0,.3);
	-webkit-border-radius: .5em; 
	-moz-border-radius: .5em;
	border-radius: .5em;
	-webkit-box-shadow: 0 1px 2px rgba(0,0,0,.2);
	-moz-box-shadow: 0 1px 2px rgba(0,0,0,.2);
	box-shadow: 0 1px 2px rgba(0,0,0,.5);
}
.button:hover {
	text-decoration: none;
}
.button:active {
	position: relative;
	top: 1px;
}

.blue {
	color: #d9eef7;
	border: solid 1px #0076a3;
	background: #0095cd;
	background: -webkit-gradient(linear, left top, left bottom, from(#00adee), to(#0078a5));
	background: -moz-linear-gradient(top,  #00adee,  #0078a5);
	filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#00adee', endColorstr='#0078a5');
}

.blue:active {
	color: #FF0000;
	background: -webkit-gradient(linear, left top, left bottom, from(#0078a5), to(#00adee));
	background: -moz-linear-gradient(top,  #0078a5,  #00adee);
	filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#0078a5', endColorstr='#00adee');
}

</style>
<script>
function jump1(){
window.location.href="http://www.personalwebhhf.cn/Wechat/Search_By_Male.php";
}

function jump2(){
window.location.href="http://www.personalwebhhf.cn/Wechat/Search_By_Fmale.php";
}

function jump3(){
window.location.href="http://www.personalwebhhf.cn/Wechat/Search.php";
}
</script>
<body >
<div id="HDU_img">
	<img src="http://www.personalwebhhf.cn/photo/wechat/HDU_black.jpeg" />
</div>
<div id="img"  >

	<div id="Male_Female">
	&nbsp;
	<button class="button blue" onclick=javascrtpt:jump1()>男生</button>
	<button class="button blue" onclick=javascrtpt:jump2()>女生</button>
	<button class="button blue" onclick=javascrtpt:jump3()>查询</button>
	
	</div>
<?php	
	$con = mysql_connect("localhost","root","hhf150076");
	mysql_select_db("Student", $con);
	if(!$con)
	{
		echo "failed";
	}
	$Score = mysql_query("SELECT Student_ID,Student_Name,Student_Time,Student_Score,Student_Headimgurl FROM Student_Data WHERE Student_Sex=1 ORDER BY Student_Score DESC");
	$Num = 1;
	while($raw =mysql_fetch_array($Score))
	{
		$Student_ID_N =$raw['Student_ID'];
		$Student_Name_N = $raw['Student_Name'] ;
		$Student_Time_N = $raw['Student_Time'];
		$Student_Score_N = $raw['Student_Score'];
		$Student_Headimgurl_N =$raw['Student_Headimgurl'];
		echo "<img src='{$Student_Headimgurl_N}'  height='80' width='80' align='left'/>
		<span style='font-size:33px';>  第.$Num.名    </span>        
		<span style='font-size:24px';> $Student_ID_N </sapn> <span>$Student_Name_N </span>";
		
		echo "<br>";
		echo "<span style='font-size:24px';> $Student_Time_N </sapn> <span>$Student_Score_N </span>";
		echo "<br>";
		$Num = $Num+1;
		
				
	}
	
	?>
	
</div>		

</body>
</html>





