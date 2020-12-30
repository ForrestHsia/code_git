
-- 20201215 SQL code OK, 可以
/*
此段code是為了將CPBL 官網的text atbat result跟raw data放在一起看
主要是進行比對用

*/
UPDATE (select c.*, e.*
from test_inning_atbat as c,(
-- 以下這段 Line6 ~ Line12, 是20201214 inner join成功的一張表單，後續也要注意到, 跨表搜尋時, column name如果相同, 後續要再用該column作比對用的話會NG， 
select a.`game_no` as "a_game_noa", a.`局數`, a.`投手`, a.`打者`, a.`總球數`, a.`結果`
from test_chinese_column_full_season as a
inner join(  
SELECT d.`game_no`, d.`局數`, d.`投手`, d.`打者`, max(d.`總球數`) as "test"
FROM test_chinese_column_full_season as d
group by d.`game_no` , d.`局數` , d.`打者`, d.`投手` ) as b 
on a.`game_no` = b.`game_no` and a.`局數` = b.`局數` and a.`打者` = b.`打者` and a.`投手` = b.`投手` and a.`總球數` = b.`test`
) as e
where c.`game_no` = e.`a_game_noa` and c.`atbat_inning` = e.`局數` and c.`player`=substring(e.`打者`,3)
) as g, test_chinese_column_full_season as a
set a.`cpbl_atbat_result` = g.`atbat_result`
where g.`game_no` = a.`game_no` and g.`atbat_inning` = a.`局數` and g.`player`=substring(a.`打者`,3)

