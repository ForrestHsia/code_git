-- 下為inning score疊加語法，是把官方text_html的box score疊加起來 
SELECT a.game_no,
a.inning,
sum(b.home_score) as home_score_verification,
sum(b.away_score) as away_score_verification
FROM inning_score a, inning_score b
where a.game_no = b.game_no and a.inning >= b.inning
group by a.game_no, a.inning


-- 下為raw data 得分篩選，取得每場每局比數，目的是要與上述的官方text_html的box score疊加做比對
SELECT c.`game_no`, c.`局數`, max(c.`主隊得分`) as "c.主隊得分", max(c.`客隊得分`) as "c.客隊得分"
FROM `test_chinese_column_full_season` c
group by c.`game_no`, c.`局數`
order by c.`game_no` ASC, c.`局數` ASC


/*
-- 同場加映，若只是想要知道raw data每場最終比數不看局數的話，那要這樣子寫
SELECT c.`game_no`, max(c.`主隊得分`) as "c.主隊得分", max(c.`客隊得分`) as "c.客隊得分"
FROM `test_chinese_column_full_season` c
group by c.`game_no`
order by c.`game_no` ASC
*/
