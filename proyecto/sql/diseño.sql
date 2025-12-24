CREATE TABLE usuarios(
    id int(255) auto_increment NOT NULL,
    nombres varchar(100) NOT NULL,
    apellidos varchar(100) NOT NULL,
    email varchar(255) NOT NULL,
    password varchar(255) NOT NULL,
    fecha date NOT NULL,
    CONSTRAINT pk_usuarios PRIMARY KEY (id),
    CONSTRAINT uq_email UNIQUE (email)
);
CREATE TABLE categorias(
    id int(255) auto_increment NOT NULL,
    nombre varchar(100) NOT NULL, 
    CONSTRAINT pk_categorias PRIMARY KEY (id)
) engine=InnoDB;
CREATE TABLE entradas(
    id int(255) auto_increment not null,
    usuario_id int(255) not null,
    categoria_id int(255) not null,
    titulo varchar(255) not null,
    descripcion MEDIUMTEXT,
    fecha date not null,
    CONSTRAINT pk_entradas PRIMARY KEY (id),
    CONSTRAINT fk_usuario FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    CONSTRAINT fk_categoria FOREIGN KEY (categoria_id) REFERENCES categorias(id) ON DELETE CASCADE
)engine=InnoDB;