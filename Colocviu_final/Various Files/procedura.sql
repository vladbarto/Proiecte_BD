/*PENTRU: 05.04A
INITIAL: "SELECT c.nume, c.adresa, f.id_f, l.denumire
        FROM Client c JOIN Factura f ON (c.id_c = f.id_c) JOIN Difuzare d ON (d.id_f = f.id_f) JOIN Localitate l ON (d.id_l = l.id_l)
        WHERE l.denumire IN ('".$localitate1."', '".$localitate2."');"
CU PROCEDURA:*/
DROP PROCEDURE `p_perechiLoc`; CREATE DEFINER=`root`@`localhost` PROCEDURE `p_perechiLoc`(IN `loc1` VARCHAR(30), IN `loc2` VARCHAR(30))
    NOT DETERMINISTIC CONTAINS SQL SQL SECURITY DEFINER SELECT c.nume, c.adresa, f.id_f, l.denumire
FROM Client c JOIN Factura f ON (c.id_c = f.id_c) JOIN Difuzare d ON (d.id_f = f.id_f) JOIN Localitate l ON (d.id_l = l.id_l)
WHERE l.denumire IN (loc1, loc2)