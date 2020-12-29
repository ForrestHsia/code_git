<?php
//因應大局, 所以多生了變數做inning
$colspan = (int)$table_tr_tdcolspan[1]->plaintext;
//因應官方html tag太複雜, 故另生一個td_title的array, 方便拿值
$td_title = array();
//因應官方html tag太複雜, 故另生一個atbat_input的array, 方便拿值
$atbat_input = array();
foreach($table_tr as $k => $y){
//取到table -> tr -> td -> td
	$table_tr_td = $y -> find("td");
	for ($j=0;$j<2;$j++){
//先以迴圈把event_inning跟atbat_order確認好
		$td_title_text = $table_tr_td[$j] -> plaintext;
//此處的$td_title_text原本是打算把不必要的跳行字元或空白拿掉, 但是看了一下表格發現跳行字元與空白在棒球紀錄表上是有其意義的, 就先把它留著了
//應該會把跳行字元或空白另行編碼或者一律轉成全形空白, 這樣在MySQL下SQL指令時會比較好作業
		$td_title_text = str_replace(array("\r", "\n", "\r\n", "\n\r"," "), '', $td_title_text);
		array_push($td_title, $td_title_text);
	}
	for ($j=2;$j<11;$j++){
//因為表單設計並沒有for MySQL的形式, 所以$td_title[2] = "守備位置"算是重新設計後, 再硬插到array裡面去多做一個column
		$td_title[2] = "守備位置";
		$td_title_text = $table_tr_td[$j] -> plaintext;
		$td_title_text = str_replace(array("\r", "\n", "\r\n", "\n\r"," "), '', $td_title_text);
//因為守備位置這個column硬插了進去, 所以整個array的排序就重新變成了$td_title[$j+1] = $td_title_text
		$td_title[$j+1] = $td_title_text;
	}
	for ($j=11;$j<count($table_tr_td);$j++){
//這裡的array sequence設計, 是為了因應大局, 更有甚者是第1局就大局, 這都會讓array sequence變得很不規則難處理
//此處紀錄的是兩個大局的場次 game_no = 14(第1局) & game_no = 9(非第1局) 若要做修正請以此兩場為範例
		$td_title_text = (int)$table_tr_td[$j] -> plaintext;
//如果大局局數與前面的td_title相同, 就硬插><, 其他的照排
		if($td_title_text == $colspan){
			array_push($td_title, $colspan);echo "<BR>";
		}
//把所有擷取出來的都一口氣倒入$td_title, 做一個完整的td_title
		array_push($td_title, $td_title_text);
		}
		break;
}
//到了這一行, td_title每場最完整開有的sequence, 後續的存取才會完整, 也因為td_title算是global變數, 不會有出了迴圈就歸零的情形
foreach($table_tr as $k => $y){
//此處的$table_tr_td, 算是正式開始取每場比賽要的值, 也是因為tag很複雜, 只好用硬塞的方式塞到global變數$atbat_input裡面
	$table_tr_td = $y -> find("td");
	$i = 0;
	while($i<count($table_tr_td)){
		$v = $table_tr_td[$i] -> plaintext;
//這裡是確認點, 請不要任意移除
		echo "第".$a."場, ".$home_away_spliter[$h]." team, 第".$i."個td ";
		echo $td_title[$i].": ".$v;
		echo "<BR>";
//硬塞塞完才做$i++, 不然值會跳一格, 要切記不要再出包, 浪費這種確認的時間很白癡
		array_push($atbat_input,$v);
		$i++;
		}
		print_r($atbat_input);
//這裡做MySQL atbat_by_atbat的輸入
		@$gamequery = 
		'INSERT INTO atbat_by_atbat (game_no, team, event_inning, atbat_order, position, player, atbats, rbi, score, hit, homerun, balls, k)
		 VALUES("'.$a.'","'.$td_title[3].'","'.$atbat_input[0].'","'.$atbat_input[1].'","'.$atbat_input[2].'","'.$atbat_input[3].'","'.$atbat_input[4].'","'.$atbat_input[5].'","'.$atbat_input[6].'","'.$atbat_input[7].'","'.$atbat_input[8].'","'.$atbat_input[9].'","'.$atbat_input[10].'")';
		mysql_query($gamequery);
		for($u=12;$u<count($td_title);$u++){
//這裡做inning_atbat的輸入, 但是因為simple html dom parser很吃記憶體, 所以只好每次擷取完就塞進去mysql, 然後再把atbat_input清空免得記憶體爆掉><
			@$gamequery1 = 
			'INSERT INTO inning_atbat (game_no, player, atbat_inning, atbat_result)
			 VALUES("'.$a.'","'.$atbat_input[3].'","'.$td_title[$u].'","'.$atbat_input[$u].'")';
			mysql_query($gamequery1);
		}
//這裡就是清空的動作
		$atbat_input=array();
		echo "<BR>";
		echo "<BR>";
}
//這裡是確認點, 請不要任意移除, 確認td_title的資訊有排對
print_r($td_title);echo "<BR>";

?>