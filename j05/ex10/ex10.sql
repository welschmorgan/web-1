SELECT `titre` AS 'Titre', `resum` AS 'Resume', `annee_prod`
FROM `mwelsch`.`film` AS f
INNER JOIN `mwelsch`.`genre` AS g ON g.`id_genre` = f.`id_genre`
WHERE g.`nom` = 'erotic'
