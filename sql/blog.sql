CREATE DATABASE IF NOT EXIST blog_master_1;
use blog_master_1;

CREATE TABLE usuarios(
id          int(255) auto_increment not null,
nombre      varchar(100) not null,
apellidos   varchar(100) not null,
email       varchar(255) not null,
password    varchar(255) not null,
fecha       date not null,
CONSTRAINT pk_usuarios PRIMARY KEY(id),
CONSTRAINT uq_email UNIQUE(email)
)ENGINE=InnoDb;

CREATE TABLE categorias(
id      int(255) auto_increment not null,
nombre  varchar(100),
CONSTRAINT pk_categorias PRIMARY KEY(id)
)ENGINE=InnoDb;

CREATE TABLE entradas(
id              int(255) auto_increment not null,
usuario_id      int(255) not null,
categoria_id    int(255) not null,
titulo          varchar(255) not null,
descripcion     MEDIUMTEXT,
fecha           date not null,
CONSTRAINT pk_entradas PRIMARY KEY(id),
CONSTRAINT fk_entrada_usuario FOREIGN KEY(usuario_id) REFERENCES usuarios(id),
CONSTRAINT fk_entrada_categoria FOREIGN KEY(categoria_id) REFERENCES categorias(id) ON DELETE NO ACTION
)ENGINE=InnoDb;

/* INSERTANDO DATOS EN categorias*/
INSERT categorias VALUES (null,'Acción');
INSERT categorias VALUES (null,'Rol');
INSERT categorias VALUES (null,'Deportes');
INSERT categorias VALUES (null,'Plataformas');

/* INSERTANDO DATOS EN categorias*/
INSERT entradas VALUES (null,4,2,'Jugando con SQL','sql',CURDATE());
INSERT entradas VALUES (null,4,1,'Guia de GTA Vice City', 'GTA',CURDATE());
INSERT entradas VALUES (null,4,3,'Nuevos jugadores de Fórmula 1','Review de Fórmula 1',CURDATE());
INSERT entradas VALUES (null,4,1,'Review de fornite Online','Todo sobre fornite',CURDATE());
INSERT entradas VALUES (null,4,1,'Review de chinos bailando','Todo sobre chinos bailando',CURDATE());