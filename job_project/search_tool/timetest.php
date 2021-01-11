<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
    <title>Endries Taiwan System</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>

<?php
function getToday(){
	$today = getdate();
	date("Y/m/d H:i");  //日期格式化
	$year=$today["year"]; //年 
	$month=$today["mon"]; //月
	$day=$today["mday"];  //日
 
	if(strlen($month)=='1')$month='0'.$month;
	if(strlen($day)=='1')$day='0'.$day;
	$today=$year."-".$month."-".$day;
	//echo "今天日期 : ".$today;
 
	return $today;
}

//$result是factory.php submit過來的product各項內容
include ("connecDB.php");//NG: 把connecDB.php檔案移到E:\XAMPP\htdocs\xampp\www\searching_tool下
$dblink = mysql_select_db ("sample") ; 
//為什麼不可以用"SELECT * FROM `test`;"? 星號哪裡不行了?
$dbresult = mysql_query("SELECT * FROM `timetest` ORDER BY `Year` asc;");//以下為product表格
$final = mysql_fetch_array($dbresult,MYSQL_ASSOC);
$time = $final["Date"];
$today = gettoday();
$TimeDifference = round((strtotime($today)-strtotime($time))/3600/24);




?>
</body>
</html>