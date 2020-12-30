<?php
header("Content-Type:text/html; charset=utf-8");
include_once('simple_html_dom.php');
include_once('mysql_cpbl_link.php');
// 取game

for($a=1;$a<=240;$a++){
	$game = file_get_html("D:/xampp/htdocs/www/cpbl_data/game/".$a.".html");
//主客場一起擷取	
	$home_away_spliter = array("A","B");
	for($h=0;$h<2;$h++){
//找出主客場的tableta3, tabletb3
		$table = $game -> find('table[id=TableT'.$home_away_spliter[$h].'3]');
//find功能必須要對object才能作用, $table本身是長度1的array, 可是array裡面那個東西是object, 所以就用$table[0]再跑一次, 而邏輯是來自這個文章: https://xyz.cinc.biz/2012/10/phpphp-simple-html-dom-parser.html
		$table_tr = $table[0] -> find('tr');

/*官方紀錄的網站標籤太多
我們需要的表格是tableta3, tableta4, tabletb3,tabletb4(還有其他的, 一下記不起來)
是這樣包的<table id=tableta3><tr><td>球員資訊</td></tr></table>
所以要用下面這個迴圈把td之間的plaintext拿出來
另, 考慮到有打大局得分的當局格式會更複雜, 故針對大局有parser 1X1, parser 2X1, 跟parser 2X2
2X2是有人打了兩個大局XD ><
*/
        $table_tr_tdcolspan = $table_tr[0] -> find('[colspan=2]');
//確認點請勿移除, 不然讀頁面眼睛會瞎掉 @@
		echo "確認點".count($table_tr_tdcolspan)."<BR>";
		if(isset($table_tr_tdcolspan[1]->plaintext)){
			if(2>=count($table_tr_tdcolspan)){
				require("D:/xampp/htdocs/www/cpbl_data/atbat_parser_2X1.php");
			}elseif(3 == count($table_tr_tdcolspan)){
				require("D:/xampp/htdocs/www/cpbl_data/atbat_parser_2X2.php");
			}
			}else{
				require("D:/xampp/htdocs/www/cpbl_data/atbat_parser_1X1.php");
			}
			echo "<BR>";
	}
}
$gamequerya = "delete FROM `atbat_by_atbat` where `player` like '%打%';" ;
$gamequeryb = "delete FROM `atbat_by_atbat` where `position` like '合計';" ;
$gamequeryc = "delete FROM `inning_atbat` WHERE `player` LIKE '%打%';" ;
$gamequeryd = "delete FROM `inning_atbat` WHERE `atbat_result` LIKE '';" ;
mysql_query($gamequerya);
mysql_query($gamequeryb);
mysql_query($gamequeryc);
mysql_query($gamequeryd);

?>