CREATE DATABASE ggod;
USE ggod;

CREATE TABLE GG(
id_gg INT(4) PRIMARY KEY NOT NULL,
telefono INT(9) NOT NULL,
email VARCHAR(50) NOT NULL
);

CREATE TABLE usuarios(
	id_usuario INT(4) AUTO_INCREMENT PRIMARY KEY,
    gg INT(4) NOT NULL,
    nombre VARCHAR(10) NOT NULL,
	apellido VARCHAR(20) NOT NULL,
    email VARCHAR(50) NOT NULL,
    contrasena VARCHAR(20) NOT NULL,
    cel INT(9) NOT NULL,
    direccion VARCHAR(20) NOT NULL,
    rol INT(1) NOT NULL,
    fecha_ingreso DATE,
    FOREIGN KEY(gg) REFERENCES GG(id_gg)
);


CREATE TABLE productos(
	id_producto INT(4) AUTO_INCREMENT PRIMARY KEY,
	gg INT(4) NOT NULL,
	nombre VARCHAR(50) NOT NULL,
    precio INT(9) NOT NULL,
    cantidad INT(9) NOT NULL,
    categoria VARCHAR(20) NOT NULL,
    FOREIGN KEY(gg) REFERENCES GG(id_gg)
);

CREATE TABLE pedidos(
    id_pedido INT(4) AUTO_INCREMENT NOT NULL PRIMARY KEY,
    id_usuario INT(4) NOT NULL,
    cantidad INT(4) NOT NULL,
    Fecha DATE NOT NULL,
    direccion_pedido VARCHAR(30) NOT NULL,
    Estado VARCHAR(20) NOT NULL,
    FOREIGN KEY(id_usuario) REFERENCES usuarios(id_usuario)
);



CREATE TABLE provedores(
    rut VARCHAR(20) NOT NULL PRIMARY KEY,
    cel INT(9) NOT NULL
);

CREATE TABLE materia_prima(
    id_materia_prima INT(4) AUTO_INCREMENT NOT NULL,
    producto_final VARCHAR(10) NOT NULL,
     PRIMARY KEY(id_materia_prima,producto_final) 
);

CREATE TABLE pedidos_tiene(
    id_pedido INT(4) , 
    id_producto INT(4) ,
    id_usuario INT(4),
    FOREIGN KEY(id_usuario) REFERENCES usuarios(id_usuario),
    PRIMARY KEY(id_pedido, id_producto)
);

CREATE TABLE provedor_materia(
    rut INT(4),
    id_materia_prima INT(4) ,
    PRIMARY KEY(rut, id_materia_prima)
);

CREATE TABLE  productos_se_hacen(
    id_materia_prima INT(4) ,
    id_producto INT(4) ,
    PRIMARY KEY(id_materia_prima, id_producto)
);






INSERT INTO GG(id_gg,telefono,email)
VALUES ("1100","099883466","GGod@hotmail.com");


INSERT INTO usuarios (nombre,gg,apellido,email,contrasena,cel,direccion,rol,fecha_ingreso)
VALUES ("benja","1100","gutierrez","admin@hotmail.com","12345","123456789","empalme","3","20201218"),
("romina","1100","rodrigez","empleado@hotmail.com","12345","123456789","pando","2","20201218"),
("giovana","1100","mato","cliente@hotmail.com","12345","123456789","pando","1","");

INSERT INTO productos (nombre,gg,precio,cantidad,categoria)
VALUES ("Hyperx Pulsefire DART Wireless","1100","89","15","mouses"),
("Auricular HyperX Cloud Core 7.1","1100","99","10","auriculares"),
("Teclado HyperX Aloyy Fps Pro","1100","89","8","teclados"),
("Hyperx mouse pad","1100","10","10","pads");



INSERT INTO pedidos (id_usuario,cantidad,Fecha,direccion_pedido,Estado)
VALUES ("1","1","20201218","vivienda 10","Enviando"),
("2","1","20201225","pando","Solicitando");



INSERT INTO pedidos_tiene (id_pedido,id_producto,id_usuario)
VALUES ("1","2","1"),
("2","4","2");
