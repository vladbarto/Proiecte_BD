CREATE TABLE `colocviu_bartolomei`.`client` (`id_c` INT NOT NULL AUTO_INCREMENT , `nume` VARCHAR(30) NOT NULL , `adresa` VARCHAR(100) NOT NULL , PRIMARY KEY (`id_c`)) ENGINE = InnoDB; 
CREATE TABLE `colocviu_bartolomei`.`factura` (`id_f` INT NOT NULL AUTO_INCREMENT , `data` DATE NOT NULL DEFAULT CURRENT_TIMESTAMP , `nr_pagini` DOUBLE NOT NULL , `cost_pagina` DOUBLE NOT NULL , `nr_zile` DOUBLE NOT NULL DEFAULT '0' , `valoare` DOUBLE NOT NULL , `tva` DOUBLE NOT NULL , `valoare_totala` INT NOT NULL , `id_c` INT NOT NULL , PRIMARY KEY (`id_f`)) ENGINE = InnoDB; 
ALTER TABLE `factura` ADD CONSTRAINT `factura_refera_client_id_c_fk` FOREIGN KEY (`id_c`) REFERENCES `client`(`id_c`) ON DELETE RESTRICT ON UPDATE RESTRICT; 
CREATE TABLE `colocviu_bartolomei`.`localitate` (`id_l` INT NOT NULL AUTO_INCREMENT , `denumire` VARCHAR(20) NOT NULL , PRIMARY KEY (`id_l`)) ENGINE = InnoDB; 
CREATE TABLE difuzare(id_f INT NOT NULL, id_l INT NOT NULL, datai DATE NOT NULL, datas DATE NOT NULL CHECK (datas>=datai));
ALTER TABLE `difuzare` ADD CONSTRAINT `loc_refera_factura_id_f_fk` FOREIGN KEY (`id_f`) REFERENCES `factura`(`id_f`) ON DELETE RESTRICT ON UPDATE RESTRICT; 
ALTER TABLE `difuzare` ADD CONSTRAINT `loc_refera_factura_id_l_fk` FOREIGN KEY (`id_l`) REFERENCES `localitate`(`id_l`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `difuzare` ADD PRIMARY KEY(`id_f`, `id_l`); 