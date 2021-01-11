<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
    <title>Endries Taiwan System</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>



<body>
<!--from logo -->

<table id="logo" width="750" style="border-style:solid; border-width:thin;" align="center" cellpadding="0" cellspacing="0">
<tr>
<td width="750" rowspan="5"><img src="http://localhost/www/endries.jpG" align="center" alt="Endries Home"><!--NG:把圖片路徑改掉，這樣太難看-->Searching System</td>

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
<td width="75" height="25" id="home"><a href="http://localhost/www/search_tool/index.php">Home</a></td> 
<td width="75" height="25" id="plating_factory"><a href="http://localhost/www/search_tool/plating.php">Plating Factory</a></td> 
<td width="75" height="25" id="screw_factory">Screw Factory</a></td>
<td width="75" height="25" id="sample"><a href="http://localhost/www/search_tool/sample.php">Sample Management</a></td> 
<td width="75" height="25" id="SampleManagementInput">Sample Management Input</td> 
</tr>
</table>
<br />
<!-- nav bar end -->

<!-- title -->
<table id="title" width="750" align="center" cellpadding="0" cellspacing="0" style="border-top-style: solid; border-left-style: solid; border-right-style: solid; border-top-width:thin; border-left-width:thin; border-right-width:thin;">
<tr>
<td class="td1" align="center"><b>Searching Tool For Quotation</b></td>
</tr>
</table>

<!-- content start -->
<table id="body" width="750" style="border-style:solid; border-width:thin;" align="center" cellpadding="0" cellspacing="0">
<!-- Product 選單-->
<tr>
<td class="Product" width="250" align="center">
 <br />
  <form method="POST" action="http://localhost/www/search_tool/factory_result.php">
  Choose a Supplier:<br />
  <select name="supplier[]" id="supplier" multiple="multiple" size=10>
  <?php
  //Product type select
  include  ("connecDB.php");//NG: 把coonecDB.php檔案移到E:\XAMPP\htdocs\xampp\www\searching_tool下
  $dblink = mysql_select_db ("product") ; 
  $result = mysql_query("SELECT DISTINCT `Vendor Name` FROM `product` ORDER BY `Vendor Name` ASC");
  while ($final= mysql_fetch_array($result,MYSQL_ASSOC)){
  echo "<option value=\"".$final["Vendor Name"]."\">".$final["Vendor Name"]."</option>";
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
<br>Copyright © 2013 Endries TW Branch.<br>All content appearing on this website owned by Endries Inc.</br></td>
</tr>
</table>
</body>
</html>