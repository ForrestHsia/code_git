此為2016年的作品，把MLB每場比賽的pitch f/x資料下載後，在local PC上面database
隨機選取檔案做demo用


．griddownload.php
以fopen下載各個需要的xml


．atbatfetch.php
把inning_all.xml/inning_hit.xml裡面的每個打者該場比賽的每個atbat取出並input table


．gamefetch.php
把grid.xml/rawboxscore.xml/players.xml/linescore.xml裡面的資訊倒進去一張table裡面


．pitchfetch.php
把inning_all.xml裡面的每個pitch information取出並輸入到table