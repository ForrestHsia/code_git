/*
從第一段select中，可以判定每場有打擊結果的atbat count
將相同的邏輯套進raw data，就可以比對，看看raw data是否有代打跑守player 名字沒更換到
*/
select w.`game_no`, w.`player`, count(*)
from(
/*
下方為第一段select結果
從官方報表中算出來的，可以抓出每場有結果的打席，去看每個打席結果各是長怎樣
也可以濾出純代跑或純守備
*/
SELECT game_no, player, `atbat_result`
FROM cpbl.inning_atbat
where `atbat_result` not like "---"

-- 第一段select結束
) as w
group by w.`game_no`, w.`player`
-- 此行以上, 為擷取rawdata 打者打席數用的，可以套到下方的code，可是下面太複雜套了太多層，所以這裡就留下來當作說明用


select cpbl.`game_no` as "cpbl-game_no", cpbl.`player` as "cpbl-player", count(*) as "cpbl-count"
from(
SELECT game_no, player, `atbat_result`
FROM cpbl.inning_atbat
where `atbat_result` not like "---"
) as cpbl
group by cpbl.`game_no`, cpbl.`player`

-- 此行以上, 為擷取官方資料打者打席數用的，可以套到下方的code，可是下面太複雜套了太多層，所以這裡就留下來當作說明用



-- 下面是把上面這兩段code彼此inner join後，可以擷取出raw data中，打者的打席數有沒有對

select j.* -- 這個select是為了找count(*) - cpbl2.`cpbl-count` 不為0的player
from(
select rawdata.`q-game_no` as "rawdata-game_no", rawdata.`q-player` as "rawdata-player", (rawdata.`q-count` - cpbl2.`cpbl-count`) as "a"
from( 
select q.`game_no` as "q-game_no", q.`打者` as "q-player", count(*) as "q-count"
from( 
SELECT d.`game_no`, d.`局數`, d.`投手`, d.`打者`, max(d.`總球數`) as "test"
FROM cpbl.chinese_column_full_season as d
group by d.`game_no` , d.`局數`, d.`打者` , d.`投手`
order by d.`game_no` , d.`打者`, d.`局數` , d.`投手`
) as q
group by q.`game_no`, q.`打者`
) as rawdata

inner join (
select cpbl.`game_no` as "cpbl-game_no", cpbl.`player` as "cpbl-player", count(*) as "cpbl-count"
from(
SELECT game_no, player, `atbat_result`
FROM cpbl.inning_atbat
where `atbat_result` not like "---"
) as cpbl
group by cpbl.`game_no`, cpbl.`player`
) as cpbl2
on cpbl2.`cpbl-game_no` = rawdata.`q-game_no` and cpbl2.`cpbl-player` = substring(rawdata.`q-player`,3)
) as j
where j.a <> 0