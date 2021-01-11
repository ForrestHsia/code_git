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
<br/>

<!-- nav bar -->
<table id="nav" width="750" border="0" align="center" cellpadding="0" cellspacing="2">
<tr ALIGN="center" VALIGN="center">
<td width="75" height="25" id="home">Home</td> 
<td width="75" height="25" id="plating"><a href="http://localhost/www/search_tool/plating.php">Plating Factory</a></td> 
<td width="75" height="25" id="factory"><a href="http://localhost/www/search_tool/factory.php">Screw Factory</a></td> 
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
<?php
include  ("connecDB.php");
?>
<script language="javascript"> 
function ValidateNumber(e, pnumber)
{
    if (!/^\d+[.]?\d*$/.test(pnumber))
    {
        e.value = /^\d+[.]?\d*/.exec(e.value);
    }
    return false;
}
</script>
<table id="body" width="750" style="border-style:solid; border-width:thin;" align="center" cellpadding="0" cellspacing="0">
<!-- Product 選單-->
<tr>
<td class="Product" width="250" align="center">
 <br />
  <form method="POST" action="http://localhost/www/search_tool/index_result.php">
  Choose a Product Type:<br />
  <select name="product[]" id="product" multiple="multiple" size=10>
  <?php
  //Product type select
$dblink = mysql_select_db ("product");
  $result = mysql_query("SELECT DISTINCT `product` FROM `product` ORDER BY `product` ASC");
  while ($final= mysql_fetch_array($result,MYSQL_ASSOC)){
  echo "<option value=\"".$final["product"]."\">".$final["product"]."</option>";
}
  ?>  
</select>  
 </td>

 <td class="Diameter" width="250" align="left">
 <br/>
 <!--Diameter and Length input-->

  Please input the range:<br/>
  Diameter: <input type="text" style="ime-mode:disabled" onkeyup="return ValidateNumber(this,value)" name="diameter[]" size=10 /></br>
  Length: <input  nkeydown="onlyEng();"type="text" style="ime-mode:disabled" onkeyup="return ValidateNumber(this,value)" name="length[]" size=10 /></br>
  Unit: <input type="radio" name="unit[]" value="mm" checked /><b>Metric</b>&nbsp;&nbsp; or &nbsp;&nbsp;<input type="radio" name="unit[]" value="inch"/><b>Inch</b>
  </td>
 </tr>

<!-- finish -->
<tr>
  <td class="finish" width="250" align="center">
  <br>
  Choose a Finish:<br>
   <select name="finish[]" id="finish" multiple="multiple" size=10>
   <option value="Any" selected>Any</option>
   <?php
   // Finish Select
   //這裡持保留態度，應該是要從product裡面拉finish出來才對
  $dblink = mysql_select_db ("plating") ; 
  $result = mysql_query("SELECT `No`,`Plating` FROM `process` ORDER BY `No` ASC");
  while ($final= mysql_fetch_array($result,MYSQL_ASSOC)){;
  echo "<option value=\>".$final["Plating"]."</option>";
}
  ?>   
   </select>
  </td>
  <td class="Material" width="250" align="center">
 <br />
  Choose a Material:<br />
  <select name="material[]" id="material" multiple="multiple" size=10/>
  <option value="Any" selected>Any</option>
  <?php
  //Materia select，這裡指的是利用material type來sorting想要的廠商，所以要用product_material
  $dblink = mysql_select_db ("product");
  $result = mysql_query("SELECT `Type` FROM `materia` ORDER BY `Type` ASC");
  while ($final= mysql_fetch_array($result,MYSQL_ASSOC)){;
echo "<option value=\>".$final["Type"]."</option>";
}
  ?> 
</select>  
 </td>
 <?php
 /*20140811 總覺得...
 熱處理這個部份很多魚
<!-- Heat Treatment -->  
  <td class="heat_treatment" width="250" align="center">
  <br />Choose a Heat Treatment:<br />
   <select name="heat_treatment[]" id="heat_treatment" multiple="multiple" size=10>
    <option value="Any" selected>Any</option>

   // Heat Treatment Select
//同上，應該是要從product裡面拉finish出來才對
  $dblink = mysql_select_db ("plating") ; 
  $result = mysql_query("SELECT `no.`,`plating` FROM `process` ORDER BY `No.` ASC");
  while ($final= mysql_fetch_array($result,MYSQL_ASSOC)){;
  echo "<option value=\"".$final["plating"]."\">".$final["plating"]."</option>";
}
  
    </select>
  </td>
  */
  ?>
  </tr>
  
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