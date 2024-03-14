INSERT INTO Client VALUES (1, 'John Doe', 'Lieblings strasse');
INSERT INTO Client VALUES (2, 'Firma SC Impex SRL', 'Cluj-Napoca sediu social Str. Bucuresti, nr. 57');
INSERT INTO Client VALUES (3, 'Marius Nistor', 'Satu Mare str. Fantanele, nr. 83');
INSERT INTO Client VALUES (4, 'Marius Balan', 'Cluj-Napoca str. Taberei, nr. 3');
INSERT INTO Client VALUES (5, 'Bonte Anca', 'Oradea, str. Posada, nr. 12');
INSERT INTO Client VALUES (6, 'Firma Polar SA', 'Baciu, sediu social str. Nadasului, nr. 8');
INSERT INTO Client VALUES (8, 'Clement Turpin', 'Chanse Elisee, nr. 5');
INSERT INTO Client VALUES (9, 'Firma SC Amiral SRL', 'Cluj-Napoca sediu social Str. Campina, nr. 42');
INSERT INTO Client VALUES (10, 'Alex Jula', 'Satu Mare str. Fantanele, nr. 45');
INSERT INTO Client VALUES (11, 'Marius Chioran', 'Cluj-Napoca str. Taberei. nr. 3');
INSERT INTO Client VALUES (12, 'Rahela Linaru', 'Oradea, calea Clujului, nr. 2');
INSERT INTO Client VALUES (13, 'Firma CBA GMBH', 'Nadasel, sediu social DN7, nr. 7');

INSERT INTO Factura (id_f, data, nr_pagini, cost_pagina, id_c)
VALUES (101, '2022-01-23', 10, 15, 2);
INSERT INTO Factura (id_f, data, nr_pagini, cost_pagina, id_c)
VALUES (102, '2022-12-01', 3, 30, 4);
INSERT INTO Factura (id_f, data, nr_pagini, cost_pagina, id_c)
VALUES (103, '2022-03-27', 5, 17, 6);
INSERT INTO Factura (id_f, data, nr_pagini, cost_pagina, id_c)
VALUES (104, '2021-08-19', 3, 100, 4);
INSERT INTO Factura (id_f, data, nr_pagini, cost_pagina, id_c)
VALUES (105, '2021-01-16', 4, 19, 1);
INSERT INTO Factura (id_f, data, nr_pagini, cost_pagina, id_c)
VALUES (106, '2022-02-08', 8, 30, 5);
INSERT INTO Factura (id_f, data, nr_pagini, cost_pagina, id_c)
VALUES (107, '2003-01-27', 23, 6, 5);
INSERT INTO Factura (id_f, data, nr_pagini, cost_pagina, id_c)
VALUES (108, '2001-12-16', 23, 7, 3);
INSERT INTO `factura` (`id_f`, `data`, `nr_pagini`, `cost_pagina`, `nr_zile`, `valoare`, `tva`, `valoare_totala`, `id_c`) VALUES
('109', '2022-05-27', '4', '2', '0', '0', '0', '0', '9'),
('110', '2023-02-15', '10', '2', '0', '0', '0', '0', '1'), ('111', '2023-04-04', '2', '1', '0', '0', '0', '0', '5');

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

INSERT INTO Difuzare (id_f, id_l, datai, datas)
VALUES (107, 1, '2022-11-29', '2023-02-15');
INSERT INTO Difuzare (id_f, id_l, datai, datas)
VALUES (103, 2, '2022-02-01', '2022-02-06');
INSERT INTO Difuzare (id_f, id_l, datai, datas)
VALUES (101, 3, '2020-03-11', '2020-03-13');
INSERT INTO Difuzare (id_f, id_l, datai, datas)
VALUES (102, 4, '2021-05-11', '2021-08-15');
INSERT INTO Difuzare (id_f, id_l, datai, datas)
VALUES (102, 5, '2022-10-16', '2022-12-24');
INSERT INTO Difuzare (id_f, id_l, datai, datas)
VALUES (107, 7, '2020-11-20', '2020-12-16');
INSERT INTO Difuzare (id_f, id_l, datai, datas)
VALUES (108, 9, '2020-07-20', '2021-03-03');
INSERT INTO Difuzare (id_f, id_l, datai, datas)
VALUES (102, 9, '2020-07-10', '2020-08-04');
INSERT INTO Difuzare (id_f, id_l, datai, datas)
VALUES (101, 11, '2021-03-01', '2021-03-02');
INSERT INTO Difuzare (id_f, id_l, datai, datas)
VALUES (108, 14, '1998-02-15', '1998-12-06');
INSERT INTO Difuzare (id_f, id_l, datai, datas)
VALUES (105, 14, '2001-12-16', '2002-03-01');
INSERT INTO Difuzare (id_f, id_l, datai, datas)
VALUES (104, 3, '2018-02-15', '2018-02-23');
INSERT INTO Difuzare (id_f, id_l, datai, datas)
VALUES (104, 8, '2018-02-16', '2018-02-17');
INSERT INTO `difuzare` (`id_f`, `id_l`, `datai`, `datas`) VALUES ('111', '7', '2023-01-18', '2023-01-23');
INSERT INTO `difuzare` (`id_f`, `id_l`, `datai`, `datas`) VALUES ('110', '2', '2023-02-09', '2023-02-11'), ('109', '6', '2022-11-15', '2022-11-17');

UPDATE `difuzare` SET `datai` = '2022-11-20', `datas` = '2022-12-16' WHERE `difuzare`.`id_f` = 107 AND `difuzare`.`id_l` = 7;
UPDATE Factura
SET nr_zile = nr_zile + (SELECT SUM(datas - datai) FROM Difuzare WHERE difuzare.id_f = Factura.id_f);
UPDATE Factura
SET Valoare = (nr_pagini*cost_pagina*nr_zile);
UPDATE Factura
SET tva = (.19*valoare);
UPDATE Factura
SET valoare_totala = valoare + tva;