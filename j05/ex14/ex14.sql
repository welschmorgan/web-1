SELECT `etage_salle` AS 'etage', AVG(`nbr_siege`) AS 'sieges'
FROM `db_mwelsch`.`salle` WHERE 1 GROUP BY `etage_salle`
ORDER BY `etage_salle` ASC
