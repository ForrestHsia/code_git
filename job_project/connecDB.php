<?php
//資料庫連線設定檔，hostname或者是其他資料都可以用使用者資料庫作索引，一個一個key太不科技了
$db_host = "localhost";
$db_id = "forresthsia";
$db_password = "6@hbo90230446";

// database link   
$db_link = mysql_connect($db_host,$db_id,$db_password);
if (!$db_link) die("Failed to Connec to DataBase, Please contact <a href='mailto:forrest.hsia@endries.com'>ForrestHsia</a>.");
//setup character set and collation
mysql_query("SET NAMES 'utf8'");

?>