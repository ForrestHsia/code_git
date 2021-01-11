<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
    <title>Endries Taiwan System</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>



<body>
<!--from logo -->
<script language="javascript">

$(function(){
$('body').hide().fadeIn(3000);

});

</script>
<table id="logo" width="750" style="border-style:solid; border-width:thin;" align="center" cellpadding="0" cellspacing="0">
<tr>
<td width="750" rowspan="5"><img src="http://10.14.1.4/www/endries.jpG" align="center" alt="Endries Home"><!--NG:把圖片路徑改掉，這樣太難看-->Searching System</td>

<!--from login -->
<tr>
<td class="login" colspan="2" align="center">Please Log in below</td>
</tr>
<tr>
<td class="login"><form action="pitch.php" method="post">Username: </td><td class="login"><input type="text" name="user" size="20" /></td>
</tr>
<tr>
<td class="pass">Password: </td><td class="login"><input type="password" name="pass"/></td>
</tr>
<tr>
<td class="login" align="center" colspan="2"><input type="submit" name="login" value="Sign In"/></form></td>
</tr>
</table>
<br />

<!-- nav bar -->
<table id="nav" width="750" border="0" align="center" cellpadding="0" cellspacing="2">
<tr ALIGN="center" VALIGN="center">
<td width="75" height="25" id="home"><a href="http://10.14.1.4/www/search_tool/index.php">Home</a></td> 
<td width="75" height="25" id="plating"><a href="http://10.14.1.4/www/search_tool/plating.php">Plating Factory</a></td> 
<td width="75" height="25" id="factory"><a href="http://10.14.1.4/www/search_tool/factory.php">Screw Factory</a></td> 
<td width="75" height="25" id="sample"><a href="http://10.14.1.4/www/search_tool/sample.php">Sample Management</a></td> 
<td width="75" height="25" id="SampleManagementInput">Sample Management Input</td> 
</tr>
</table>
<br />
<!-- nav bar end -->

<!-- title -->
<table id="title" width="750" align="center" cellpadding="0" cellspacing="0" style="border-top-style: solid; border-left-style: solid; border-right-style: solid; border-top-width:thin; border-left-width:thin; border-right-width:thin;">
<tr>
<td class="td1" align="center"><b>Searching Tool</b></td>
</tr>
</table>

<!-- content start -->
<?php
include  ("connecDB.php");
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
$today = gettoday();
?>

<table id="body" width="750" style="border-style:solid; border-width:thin;" align="center" cellpadding="0" cellspacing="0">
<!-- RFQ/NCMR/PO sample -->
<tr>
  <td class="index" width="250" align="center">
  <form method="POST" action="http://10.14.1.4/www/search_tool/sample_result.php">
  <br>
  Please input the index:<br/>
  Part Number: <input type="text" name="pn[]" size=10 /></br>
  </td>
  </tr>
  </table>
  <table id="title" width="750" align="center" cellpadding="0" cellspacing="0" style="border-top-style: solid; border-left-style: solid; border-right-style: solid; border-top-width:thin; border-left-width:thin; border-right-width:thin;">
<tr>
<td class="td1" align="center"><b>Samples that are overdue should be thrown:</b></td>
</tr>
<tr>
<td align="center">
 <?php
  $dblink = mysql_select_db ("sample") ; 
$dbresult = mysql_query("SELECT * FROM `sample` ORDER BY `Year` asc;");//以下為product表格
echo "<table border=3>";
echo "<tr><td>PO/NCMR/RFQ</td><td>PN</td><td>Q'ty</td><td>Supplier</td><td>Date</td><td>Overdue&nbspDays</td><td>Location</td><td>Action</td></tr></br>";
while($final = mysql_fetch_array($dbresult,MYSQL_ASSOC)){
foreach ($final as $final_1){
$time_1 = round((strtotime($today)-strtotime($final["Date"]))/3600/24);
$time = $time_1 - 365*3 ; 
if ($final["Status"] =="" and $final["Location"] != "" and $time >0){

echo "<tr><td>".$final["PO/NCMR/RFQ"]."</td><td>".$final["PN"]."</td><td>".$final["Qty"]."</td><td>".$final["Supplier"]."</td><td>".$final["Date"]."</td><td>".$final["Days"]."</td><td>".$final["Location"]."</td><td><a href=throw.php?id=".$final["No"].">Revise</a></td></tr>";

}
break;
}
}
?>
</select>  
</td>
</tr>
</table>
<br>
 <table id="title" width="750" align="center" cellpadding="0" cellspacing="0" style="border-top-style: solid; border-left-style: solid; border-right-style: solid; border-top-width:thin; border-left-width:thin; border-right-width:thin;">
<tr>
<td class="td1" align="center"><b>If you are not sure about the PN, PO or any one of the index, below option maybe your choice.
<br>Or, you can ask Forrest for advanced sorting.
</b></td>
</tr>
</table>

<table id="body" width="750" style="border-style:solid; border-width:thin;" align="center" cellpadding="0" cellspacing="0"> 
  <tr>
  <td class="year1" width="250" align="center">
 <br />
  Begin of Year:<br />
  <select name="year1[]" id="year1" size=10/>
  
  <?php
  //Product type select
  $dblink = mysql_select_db ("sample");
  $result = mysql_query("SELECT distinct `Year` FROM `sample` ORDER BY `Year` ASC");
  while ($final= mysql_fetch_array($result,MYSQL_ASSOC)){
  echo "<option value=\"".$final["Year"]."\">".$final["Year"]."</option>";
}
  ?>   
</select>  
 </td>
 <td class="year2" width="250" align="center">
 <br />
  End of Year:<br />
  <select name="year2[]" id="year1" size=10/>
  
  <?php
  //Product type select
  $dblink = mysql_select_db ("sample");
  $result = mysql_query("SELECT distinct `Year` FROM `sample` ORDER BY `Year` ASC");
  while ($final= mysql_fetch_array($result,MYSQL_ASSOC)){
  echo "<option value=\"".$final["Year"]."\">".$final["Year"]."</option>";
}
  ?>   
</select>  
 </td>
 
<!--提交button-->
<tr>
<td class="button" colspan="3" align="center">
<input type="submit" value="Submit"/>
</form>
</td>
</tr>
<tr>
<td class="closing" colspan="3" align="left">
<br>Copyright © 2013 Endries TW Branch.<br>All content appearing on this website is owned by Endries Inc.</br></td>
</tr>
</table>
</body>
</html>