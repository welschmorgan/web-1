SELECT `titre`, `resum` FROM `db_mwelsch`.`film`
 WHERE `titre` LIKE '%42%'
 OR `resum` LIKE '%42%'
 ORDER BY `duree_min` ASC;
