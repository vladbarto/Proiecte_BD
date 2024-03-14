CREATE TABLE Client(
        id_c NUMBER(3, 0) CONSTRAINT client_id_c_pk PRIMARY KEY,
        nume VARCHAR2(30) CONSTRAINT client_nume_notNull NOT NULL,
        adresa VARCHAR2(100) CONSTRAINT client_adresa_notNULL NOT NULL);

CREATE TABLE Factura(
        id_f NUMBER(3, 0) CONSTRAINT factura_id_f_pk PRIMARY KEY,
        data DATE CONSTRAINT factura_data_notNull NOT NULL,
nr_pagini NUMBER(4,0) CONSTRAINT factura_nr_pagini_notNull NOT NULL,
        cost_pagina NUMBER(4, 0) CONSTRAINT factura_cost_pagina_notNull NOT NULL,
        nr_zile NUMBER(3, 0) DEFAULT 0,
valoare NUMBER(8, 2),
        tva NUMBER(8, 2),
id_c NUMBER(3, 0) CONSTRAINT factura_refera_client_id_c_fk REFERENCES Client(id_c));

CREATE TABLE localitate(
        id_l NUMBER(3, 0) CONSTRAINT localitate_id_l_pk PRIMARY KEY,
        denumire VARCHAR2(20) CONSTRAINT localitate_denumire_notNull NOT NULL);

CREATE TABLE difuzare(
        id_f NUMBER(3, 0) CONSTRAINT loc_refera_factura_id_f_fk REFERENCES Factura(id_f),
        id_l NUMBER(3, 0) CONSTRAINT loc_refera_factura_id_l_fk REFERENCES Localitate(id_l),
        datai DATE,
datas DATE);

ALTER TABLE Factura
ADD (valoare_totala NUMBER(8, 2));

--5.02--
ALTER TABLE Factura
        ADD CONSTRAINT factura_tva_check CHECK (tva = 0.19*valoare);

ALTER TABLE Client
        ADD CONSTRAINT constr_client_firma CHECK ((nume like 'Firma%' AND adresa like '%sediu social%') OR (nume not like 'Firma%' AND adresa like '%'));

INSERT INTO Client VALUES (1, 'John Doe', 'Lieblings strasse');
INSERT INTO Client VALUES (2, 'Firma SC Impex SRL', 'Cluj-Napoca sediu social Str. Bucuresti, nr. 57');
INSERT INTO Client VALUES (3, 'Marius Nistor', 'Satu Mare str. Fantanele, nr. 83');
INSERT INTO Client VALUES (4, 'Marius Balan', 'Cluj-Napoca str. Taberei, nr. 3');
INSERT INTO Client VALUES (5, 'Bonte Anca', 'Oradea, str. Posada, nr. 12');
INSERT INTO Client VALUES (6, 'Firma Polar SA', 'Baciu, sediu social str. Nadasului, nr. 8');

INSERT INTO Localitate
        VALUES (1, 'Oradea');
INSERT INTO Localitate
        VALUES (2, 'Arad');
INSERT INTO Localitate
        VALUES (3, 'Lugoj');
INSERT INTO Localitate
        VALUES (4, 'Alesd');
INSERT INTO Localitate
        VALUES (5, 'Biharia');
INSERT INTO Localitate
        VALUES (6, 'Sanmartin');
INSERT INTO Localitate
        VALUES (7, 'Salonta');
INSERT INTO Localitate
        VALUES (8, 'Tileagd');
INSERT INTO Localitate
        VALUES (9, 'Sanpaul');
INSERT INTO Localitate
        VALUES (10, 'Salistea Noua');
INSERT INTO Localitate
        VALUES (11, 'Ciurila');
INSERT INTO Localitate
        VALUES (12, 'Nadasel');
INSERT INTO Localitate
        VALUES (13, 'Baciu');
INSERT INTO Localitate
        VALUES (14, 'Cluj-Napoca');

INSERT INTO Factura (id_f, data, nr_pagini, cost_pagina, id_c)
VALUES (101, '23-JAN-2022', 10, 15, 2);
INSERT INTO Factura (id_f, data, nr_pagini, cost_pagina, id_c)
VALUES (102, '01-DEC-2022', 3, 30, 4);
INSERT INTO Factura (id_f, data, nr_pagini, cost_pagina, id_c)
VALUES (103, '27-MAR-2022', 5, 17, 6);
INSERT INTO Factura (id_f, data, nr_pagini, cost_pagina, id_c)
VALUES (104, '19-AUG-2021', 3, 100, 4);
INSERT INTO Factura (id_f, data, nr_pagini, cost_pagina, id_c)
VALUES (105, '16-JAN-2020', 4, 19, 1);
INSERT INTO Factura (id_f, data, nr_pagini, cost_pagina, id_c)
VALUES (106, '08-FEB-2022', 8, 30, 5);
INSERT INTO Factura (id_f, data, nr_pagini, cost_pagina, id_c)
VALUES (107, '27-JAN-2003', 23, 6, 5);
INSERT INTO Factura (id_f, data, nr_pagini, cost_pagina, id_c)
VALUES (108, '16-DEC-2001', 23, 7, 3);

INSERT INTO Difuzare (id_f, id_l, datai, datas)
VALUES (107, 1, '29-NOV-2022', '15-FEB-2023');
INSERT INTO Difuzare (id_f, id_l, datai, datas)
VALUES (103, 2, '01-FEB-2022', '06-FEB-2022');
INSERT INTO Difuzare (id_f, id_l, datai, datas)
VALUES (101, 3, '11-MAR-2020', '13-MAR-2020');
INSERT INTO Difuzare (id_f, id_l, datai, datas)
VALUES (102, 4, '11-MAY-2021', '15-AUG-2021');
INSERT INTO Difuzare (id_f, id_l, datai, datas)
VALUES (102, 5, '16-OCT-2022', '24-DEC-2022');
INSERT INTO Difuzare (id_f, id_l, datai, datas)
VALUES (107, 7, '20-NOV-2020', '16-DEC-2020');
INSERT INTO Difuzare (id_f, id_l, datai, datas)
VALUES (108, 9, '12-JUL-2020', '03-MAR-2021');
INSERT INTO Difuzare (id_f, id_l, datai, datas)
VALUES (102, 9, '10-JUL-2020', '04-AUG-2020');
INSERT INTO Difuzare (id_f, id_l, datai, datas)
VALUES (101, 11, '01-MAR-2021', '02-MAR-2021');
INSERT INTO Difuzare (id_f, id_l, datai, datas)
VALUES (108, 14, '15-FEB-1998', '06-DEC-1998');
INSERT INTO Difuzare (id_f, id_l, datai, datas)
VALUES (105, 14, '16-DEC-2001', '01-MAR-2002');
INSERT INTO Difuzare (id_f, id_l, datai, datas)
VALUES (104, 3, '15-FEB-2018', '23-FEB-2018');
INSERT INTO Difuzare (id_f, id_l, datai, datas)
VALUES (104, 8, '16-FEB-2018', '17-FEB-2018');

UPDATE Factura
SET nr_zile = nr_zile + (SELECT SUM(datas - datai) FROM Difuzare WHERE difuzare.id_f = Factura.id_f);
UPDATE FACTURA
SET nr_zile = 0 WHERE nr_zile IS NULL;
UPDATE Factura
SET Valoare = (nr_pagini*cost_pagina*nr_zile);
UPDATE Factura
SET tva = (.19*valoare);
UPDATE Factura
SET valoare_totala = valoare + tva;
--5.03--
SELECT *
        FROM Factura
        WHERE valoare >= 500 AND valoare <= 1000
ORDER BY data DESC, valoare ASC;

SELECT denumire 
FROM Localitate
WHERE denumire like '%j%'
ORDER BY denumire ASC;

--5.04--
SELECT c.nume
        FROM Client c JOIN Factura f ON (c.id_c = f.id_c) JOIN Difuzare d ON (d.id_f = f.id_f) JOIN Localitate l ON (d.id_l = l.id_l)
WHERE l.denumire IN ('Oradea', 'Alesd');

SELECT '('||d.id_l || ', ' || e.id_l||')' AS "(id_l1, id_l2)"
FROM Difuzare d JOIN Difuzare e ON (d.id_f = e.id_f) JOIN Factura f ON (d.id_f = f.id_f)
WHERE d.id_l != e.id_l AND d.id_l < e.id_l AND ((d.datai+f.nr_zile BETWEEN e.datai AND e.datas) OR (e.datai+f.nr_zile BETWEEN d.datai AND d.datas));

--5.05--
SELECT DISTINCT L.Denumire AS Denumire
        FROM Difuzare d JOIN Localitate L ON (d.id_l = L.id_l)
WHERE 100 > (SELECT valoare
FROM Factura
WHERE id_f = d.id_f) AND (
        d.datai IN (select date'2022-10-01' + level - 1
from dual
connect by level <= (
date'2022-10-31' - date'2022-10-01' + 1
))
OR d.datas IN (select date'2022-10-01' + level - 1
from dual
connect by level <= (
date'2022-10-31' - date'2022-10-01' + 1
))
);

SELECT c.Nume, f.id_f, f.nr_zile
        FROM Client c JOIN Factura f ON (c.id_c = f.id_c)
WHERE f.nr_zile < ALL (SELECT nr_zile
                       FROM Factura
                       WHERE id_f != f.id_f) AND f.data BETWEEN '01-JAN-2022' AND '31-DEC-2022';

--5.06--
SELECT l.Denumire, sum(f.nr_pagini)
FROM Localitate l LEFT OUTER JOIN Difuzare d ON (l.id_l = d.id_l) LEFT OUTER JOIN Factura f ON (f.id_f = d.id_f)
WHERE SYSDATE BETWEEN d.datai AND d.datas
        GROUP BY l.Denumire;

SELECT MIN(valoare_totala) AS Minim, MAX(valoare_totala) AS Maxim, TRUNC(AVG(valoare_totala), 3) AS Medie
FROM Factura
WHERE TO_CHAR(data, 'YYYY') = '2022';

--5.07--
INSERT INTO Factura
        VALUES (123, '02-OCT-2022', 4, 4, 10, 160, 30.4, 1, 190.4);

DELETE Factura
WHERE id_f NOT IN (SELECT id_f FROM Difuzare);

--ALTER TABLE Factura
  --      Disable CONSTRAINT factura_tva_check;

ALTER TABLE Factura 
DROP CONSTRAINT factura_tva_check;       

ALTER TABLE Factura 
ADD CONSTRAINT factura_tva_check CHECK (tva > .19*valoare-0.02 AND tva < .19*valoare+0.02);

UPDATE Factura
SET valoare = valoare - 0.05*valoare,
        tva = tva - 0.05*tva,
        valoare_totala = valoare_totala - .05*valoare_totala
WHERE nr_zile > 20;

--5.08--
--a)--
CREATE OR REPLACE TRIGGER ins_del_difuzare_trig
        BEFORE INSERT OR DELETE ON Difuzare FOR EACH ROW
BEGIN
        IF INSERTING THEN
UPDATE Factura
SET nr_zile = nr_zile + (:NEW.datas - :NEW.datai)
WHERE :NEW.id_f = id_f;
UPDATE Factura
SET valoare = nr_pagini*cost_pagina*nr_zile, tva = .19*nr_pagini*cost_pagina*nr_zile
WHERE :NEW.id_f = id_f;
UPDATE Factura
SET valoare_totala = valoare+tva
WHERE :NEW.id_f = id_f;
ELSIF DELETING THEN
        UPDATE Factura
        SET nr_zile = nr_zile - (:OLD.datas - :OLD.datai)
WHERE :OLD.id_f = id_f;
UPDATE Factura
SET valoare = nr_pagini*cost_pagina*nr_zile, tva = .19*nr_pagini*cost_pagina*nr_zile
WHERE :OLD.id_f = id_f;
UPDATE Factura
SET valoare_totala = valoare+tva
WHERE :OLD.id_f = id_f;
END IF;
END;


--Test Insert
INSERT INTO Difuzare (id_f, id_l, datai, datas)
VALUES (101, 1, '07-MAR-2022', '14-MAR-2022');

--Pentru vizualizarea modificarilor (testare):
select * from factura
        where id_f = 101;

--Test Delete
delete Difuzare
        Where id_f = 101 AND id_l = 1;

--Pentru vizualizarea modificarilor (testare):
select * from factura
        where id_f = 101;

--b)--
CREATE OR REPLACE TRIGGER prevent_edit_datai_trig
        BEFORE UPDATE OF datai, datas ON Difuzare FOR EACH ROW
BEGIN
        IF SYSDATE > :NEW.datai THEN
RAISE_APPLICATION_ERROR(-20016, 'Nu se poate actualiza in BD o difuzare cu data de inceput ulterioara datei curente.');
END IF;
END;

--c)--
CREATE VIEW Facturi_John_Doe AS
SELECT id_f, data, nr_pagini, cost_pagina, nr_zile, valoare, tva, valoare_totala,
        denumire AS localitate, datai, datas
FROM Client NATURAL JOIN Factura NATURAL JOIN
Difuzare NATURAL JOIN Localitate
WHERE nume = 'John Doe';

CREATE OR REPLACE TRIGGER add_factura_johndoe_trig
INSTEAD OF INSERT ON facturi_john_doe
DECLARE
v_id_c client.id_c%TYPE;
v_id_f factura.id_f%TYPE;
v_exista_id_l localitate.id_l%TYPE;
v_id_l_nou localitate.id_l%TYPE;
BEGIN 
SELECT id_c INTO v_id_c 
FROM client 
WHERE nume = 'John Doe'; 
SELECT Count(*) INTO v_id_f 
FROM Factura 
WHERE id_f = :NEW.id_f; 
IF v_id_f = 0 THEN 
INSERT INTO Factura (id_f, data, nr_pagini, cost_pagina, nr_zile, id_c) 
VALUES (:NEW.id_f, :NEW.data, :NEW.nr_pagini, :NEW.cost_pagina, 0, v_id_c); 
END IF; 
SELECT COUNT(*) INTO v_exista_id_l 
FROM Localitate 
WHERE denumire = :NEW.localitate; 
IF v_exista_id_l = 0 THEN 
SELECT MAX(id_l) + 1 INTO v_id_l_nou 
FROM Localitate;
INSERT INTO Localitate (id_l, denumire) 
VALUES (v_id_l_nou, :NEW.localitate);
ELSE
SELECT id_l INTO v_id_l_nou 
FROM Localitate 
WHERE denumire = :NEW.localitate; 
END IF; 
INSERT INTO Difuzare (id_f, id_l, datai, datas) 
VALUES (:NEW.id_f, v_id_l_nou, :NEW.datai, :NEW.datas); 
END;
	
	INSERT INTO facturi_john_doe (id_f, data, nr_pagini, cost_pagina, nr_zile, localitate, datai, datas)
VALUES (128, '07-MAR-2023', 5, 10, 0, 'Cioanca', '14-FEB-2023', '15-FEB-2023');
--Bibliografie>
--https://blogs.oracle.com/sql/post/how-to-generate-days-weeks-or-months-between-two-dates-in-oracle-database


