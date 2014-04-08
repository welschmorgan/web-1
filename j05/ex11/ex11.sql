SELECT UPPER(f.nom) AS 'NOM', f.prenom, a.prix
FROM `mwelsch`.`fiche_personne` AS f
LEFT JOIN `mwelsch`.`membre` AS m  ON f.id_perso = m.id_fiche_perso
LEFT JOIN `mwelsch`.`abonnement` AS a ON m.id_abo = a.id_abo
WHERE CAST(a.prix AS UNSIGNED) > 42
ORDER BY f.nom ASC, f.prenom ASC
