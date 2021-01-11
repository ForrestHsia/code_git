<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
    <title>Endries Taiwan System</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>

<?php
//$result是factory.php submit過來的product各項內容
$result = @array("supplier"=>$_POST['supplier']);
$result_supplier = $result["supplier"];
include ("connecDB.php");//NG: 把connecDB.php檔案移到E:\XAMPP\htdocs\xampp\www\searching_tool下
$dblink = mysql_select_db ("product") ; 
//為什麼不可以用"SELECT * FROM `test`;"? 星號哪裡不行了?
$dbresult = mysql_query("SELECT `Product`,`Vendor Name`,`Unit`,`L-Max`,`L-min`,`D-Max`,`D-min`,`Material`,`Comment` FROM `product` ORDER BY `Vendor Name` asc;");//以下為product表格
echo "<table border=3>";
echo "<tr><td>Vendor</td><td>Product</td><td>Unit</td><td>L-Max</td><td>L-Min</td><td>D-Max</td><td>D-Min</td><td>Material</td><td>Comment</td></tr></br>";
while($final = mysql_fetch_array($dbresult,MYSQL_ASSOC)){
foreach ($final as $final_1){
for ($i=0;$i<count($result_supplier);$i++){
if ($final["Vendor Name"] == $result_supplier[$i]){
echo "<tr><td>".$final["Vendor Name"]."</td><td>".$final["Product"]."</td><td>".$final["Unit"]."</td><td>".$final["L-Max"]."</td><td>".$final["L-min"]."</td><td>".$final["D-Max"]."</td><td>".$final["D-min"]."</td><td>".$final["Material"]."</td><td>".$final["Comment"]."</td></tr>";
}
}
break;
}
}

?>
</body>
</html>