    DROP DATABASE bibliotecaBD;
    CREATE DATABASE bibliotecaBD;
    USE bibliotecaBD;
    --
    -- creo tablas
    -- 
    CREATE TABLE `editorial` (
        `idEditorial` bigint(20) NOT NULL,
        `nombreEditorial` varchar(50) NOT NULL,
        `editorialDeshabilitado` timestamp NULL DEFAULT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

    CREATE TABLE `autor` (
        `idAutor` bigint(20) NOT NULL,
        `nombreAutor` varchar(50) NOT NULL,
        `apellidoAutor` varchar(50) NOT NULL,
        `lugarNacimiento` varchar(50) NOT NULL,
        `fechaNacimiento` date NOT NULL,
        `autorDeshabilitado` timestamp NULL DEFAULT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

    CREATE TABLE `libro` (
        `idLibro` bigint(20) NOT NULL ,
        `nombreLibro` varchar(50) NOT NULL,
        `cantidadPag` bigint(20) NOT NULL,
        `idioma` varchar(50) NOT NULL,
        `anioPublicacion` int(10)NOT NULL,
        `idAutor` bigint(20) NOT NULL,
        `idEditorial` bigint(20) NOT NULL,
        `libroDeshabilitado` timestamp NULL DEFAULT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
    --
    -- asigno claves primarias y foraneas a cada tabla
    --
  ALTER TABLE  `editorial`
    ADD PRIMARY KEY(`idEditorial`),
    ADD UNIQUE KEY `idEditorial` (`idEditorial`),
    MODIFY `idEditorial` bigint(20) NOT NULL AUTO_INCREMENT;
   
  
  ALTER TABLE `autor`
    ADD PRIMARY KEY(`idAutor`),
    ADD UNIQUE KEY `idAutor` (`idAutor`),
    MODIFY `idAutor` bigint(20) NOT NULL AUTO_INCREMENT;

   ALTER TABLE `libro`
    ADD PRIMARY KEY(`idLibro`),
    ADD UNIQUE KEY `idLibro` (`idLibro`),
    MODIFY `idLibro` bigint(20) NOT NULL AUTO_INCREMENT;

   ALTER TABLE `libro` 
    ADD CONSTRAINT `fkcautor` FOREIGN KEY (`idAutor`) REFERENCES `autor` (`idAutor`) ON UPDATE CASCADE,
    ADD CONSTRAINT `fkceditorial` FOREIGN KEY (`idEditorial`) REFERENCES `editorial` (`idEditorial`) ON UPDATE CASCADE;
    
  
    --
    -- hago algunos inserts 
    --
    INSERT INTO `editorial`(`nombreEditorial`) VALUES
        ('Emecé'),
        ('Sudamericana'),
        ('Editorial Latina'); 

    INSERT INTO `autor` (`nombreAutor` ,`apellidoAutor` ,`lugarNacimiento`,`fechaNacimiento`) VALUES
    ('Jorge Luis','Borges','Argentina','1989-08-24 '),
    ('Julio','Cortazar','Belgica','1914-08-26 '),
    ('Roberto','Arlt','Argentina','1900-04-26 '),
    ('Ernesto','Sabato','Argentina','1911-06-24 ');

    INSERT INTO `libro` (`nombreLibro`,`cantidadPag`,`idioma`,`idAutor`,`idEditorial`, `anioPublicacion`) VALUES 
    ('Atlas',100,'Español',1,1,1984),
    ('Rayuela',300,'Español',2,2,1963),
    ('El juguete rabioso',400,'Español',3,3,1926),
    ('El túnel',200,'Español',4,2,1948);