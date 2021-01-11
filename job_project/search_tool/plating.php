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
<td width="75" height="25" id="plating_factory">Plating Factory</td> 
<td width="75" height="25" id="screw_factory"><a href="http://10.14.1.4/www/search_tool/factory.php">Screw Factory</a></td> 
<td width="75" height="25" id="sample"><a href="http://10.14.1.4/www/search_tool/sample.php">Sample Management</a></td> 
<td width="75" height="25" id="SampleManagementInput">Sample Management Input</td> 
</tr>
</table>
<br/>
<!-- nav bar end -->

<!-- title -->
<table id="title" width="750" align="center" cellpadding="0" cellspacing="0" style="border-top-style: solid; border-left-style: solid; border-right-style: solid; border-top-width:thin; border-left-width:thin; border-right-width:thin;">
<tr>
<td class="td1" align="center"><b>Plating Searching Tool</b></td>
</tr>
</table>

<!-- content start -->
<table id="body" width="750" style="border-style:solid; border-width:thin;" align="center" cellpadding="0" cellspacing="0">
<tr>
<!-- finish -->
 <form method="POST" action="http://10.14.1.4/www/search_tool/plating_result.php">
  <td class="finish" width="250" align="center">
  <br />
  Choose a Finish:<br />
   <select name="finish[]" id="finish" multiple="multiple" size=10>
   <option value="Any" selected>Any</option>
   <?php
   // Finish Select
  include  ("connecDB.php");
  $dblink = mysql_select_db ("plate") ; 
  $result = mysql_query("SELECT `plating` FROM `option`");
  while ($final= mysql_fetch_array($result,MYSQL_ASSOC)){
  echo "<option value=\"".$final["plating"]."\">".$final["plating"]."</option>";
  }
  ?>   
   </select>
  </td>
  <!-- plater -->
  <td class="plater" width="250" align="center">
  <br />
  Choose a Plater:<br />
   <select name="plater[]" id="plater" multiple="multiple" size=10>
   <option value="Any" selected>Any</option>
   <?php
   // Plater Select
  include  ("connecDB.php");
  $dblink = mysql_select_db ("plate") ; 
  $result = mysql_query("SELECT `supplier`,`supplier_e` FROM `plater`");
  while ($final= mysql_fetch_array($result,MYSQL_ASSOC)){;
  echo "<option value=\"".$final["supplier_e"]."\">".$final["supplier_e"]."_".$final["supplier"]."</option>";
}
  ?>   
   </select>
  </td>

  
  
  </tr>
  <tr>
<!--提交button-->
<tr>
<td class="button" colspan="3" align="center">
</br>Perspective: <input type="radio" name="perspective[]" value="plating" checked /><b>Sorting By Plating</b>&nbsp;&nbsp;&nbsp; <input type="radio" name="perspective[]" value="plater" /><b>Sorting By Plater</b>
</br></br><input type="submit" value="Submit"/>
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