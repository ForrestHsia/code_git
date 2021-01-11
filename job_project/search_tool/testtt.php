<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
    <title>Endries Taiwan System</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>

<?php
//$result是factory.php submit過來的product各項內容
include ("connecDB.php");//NG: 把connecDB.php檔案移到E:\XAMPP\htdocs\xampp\www\searching_tool下
$dblink = mysql_select_db ("sample") ; 
//為什麼不可以用"SELECT * FROM `test`;"? 星號哪裡不行了?
$dbresult = mysql_query("SELECT * FROM `sample` ORDER BY `Year` asc;");//以下為product表格
echo "<table border=3>";
echo "<tr><td>PO/NCMR/RFQ</td><td>PN</td><td>Q'ty</td><td>Supplier</td><td>Date</td><td>Reserved&nbspDays</td><td color=red >Location</td><td>Comment</td><td>PPAP</td><td>Cancellation</td></tr></br>";
while($final = mysql_fetch_array($dbresult,MYSQL_ASSOC)){
foreach ($final as $final_1){
if ($final["Status"] != ""){
echo $final["Date"];
echo "<tr><td>".$final["PO/NCMR/RFQ"]."</td><td>".$final["PN"]."</td><td>".$final["Qty"]."</td><td>".$final["Supplier"]."</td><td>".$final["Date"]."</td><td>".$final["Days"]."</td><td color=red>".$final["Location"]."</td><td>".$final["Comment"]."</td><td>".$final["PPAP"]."</td><td>".$final["Cancellation"]."</td></tr>";
}
break;
}
break;
}


?>
</body>
</html>