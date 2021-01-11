<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
    <title>Endries Taiwan System</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>

<?php
//$result是plating.php submit過來的product各項內容
$result = array("finish"=>$_POST['finish'],"plater"=>$_POST['plater'],"perspective"=>$_POST['perspective']);

//將二維矩陣拆解以便後續製作表格
$result_finish = $result["finish"];
//廠商名稱在後台是直接英文的，無須care中文
$result_plater = $result["plater"];
$result_perspective = $result["perspective"];
//以上倒過來的變數沒有錯
include ("connecDB.php");
$dblink = mysql_select_db ("plate");

switch ($result_perspective[0]){
case "plating":
	$dbresult = mysql_query("SELECT * FROM `plating` order by `Plating` ASC ");
	echo "<table border=3>";
	echo "<tr><td>Plating</td><td>Process</td><td>Comment</td><td>Plater</td><td>Special&nbsp;Request</td></tr></br>";
	while($final = mysql_fetch_array($dbresult,MYSQL_ASSOC)){
	foreach ($final as $final_1){
	for ($i=0;$i<count($result_finish);$i++){
	if ($final["Plating"] == $result_finish[$i]){
	echo "<tr><td>".$final["Plating"]."</td><td>".$final["Process"]."</td><td>".$final["Comment"]."</td><td>".$final["Supplier_E"]."</td><td>".$final["Special_Requirement"]."</td></tr>";
	}
	}
	break;
	}
	}
break;
case "plater":
	$dbresult = mysql_query("SELECT * FROM `plating` order by `Supplier_E` ASC ");
	echo "<table border=3>";
	echo "<tr><td>Plater</td><td>Plating</td><td>Process</td><td>Comment</td><td>Special&nbsp;Request</td></tr></br>";
	while($final = mysql_fetch_array($dbresult,MYSQL_ASSOC)){
	foreach ($final as $final_1){
	for ($i=0;$i<count($result_plater);$i++){
	if ($final["Supplier_E"] == $result_plater[$i]){
	echo "<tr><td>".$final["Supplier_E"]."</td><td>".$final["Plating"]."</td><td>".$final["Process"]."</td><td>".$final["Comment"]."</td><td>".$final["Special_Requirement"]."</td></tr>";
	}
	}
	break;
	}
	}

break;
}

?>
</body>
</html>