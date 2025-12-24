#INSERTAR
INSERT INTO usuarios VALUES (NULL, 'Daniel', 'Barona', 'dbarona@gmail.com', 'password123', '2024-06-01');
INSERT INTO usuarios VALUES (NULL, 'Cristiano', 'Ronaldo', 'cr7@gmail.com', 'password098', '2025-03-21');
INSERT INTO usuarios VALUES (NULL, 'Esteban', 'Andrada', 'EdeBoca@gmail.com', 'password150', '2023-06-08');

#INSERTAR DATOS EN CAMPOS DETERMINADOS

INSERT INTO usuarios(email, password) VALUES('admin@admin.com', 'admin_root');

# INSERTAR REGISTROS EN CATEGORIA
INSERT INTO categorias VALUES (NULL, 'Accion');
INSERT INTO categorias VALUES (NULL, 'Pelea');
INSERT INTO categorias VALUES (NULL, 'Deportes');
INSERT INTO categorias VALUES (NULL, 'Terror');

# INSERTAR REGISTROS EN ENTRADAS
INSERT INTO entradas VALUES (NULL, 1,1, 'Novedades de GTA VI', 'review GTA VI juego de accion', CURDATE());
INSERT INTO entradas VALUES (NULL, 1,2, 'Peleas en Tekken 8', 'review Tekken 8 juego de pelea', CURDATE());
INSERT INTO entradas VALUES (NULL, 1,3, 'FIFA 24 lanzado', 'review FIFA 24 juego de deportes', CURDATE());
INSERT INTO entradas VALUES (NULL, 1,3, 'Wii deportes', 'review FIFA 24 juego de deportes', CURDATE());

INSERT INTO entradas VALUES (NULL, 2,1, 'CAll of Duty', 'review Call of duty juego de accion', CURDATE());
INSERT INTO entradas VALUES (NULL, 2,2, 'The king of figthers', 'review The king of figthers juego de pelea', CURDATE());
INSERT INTO entradas VALUES (NULL, 2,3, 'W2K19', 'review W2K19 juego de deportes', CURDATE());

INSERT INTO entradas VALUES (NULL, 3,1, 'Red Dead Redemption II', 'review Red Dead Redemption II juego de accion', CURDATE());
INSERT INTO entradas VALUES (NULL, 3,2, 'Mortal Kombat 11', 'review Mortal Kombat 11 juego de pelea', CURDATE());
INSERT INTO entradas VALUES (NULL, 3,3, 'NBA 2K24', 'review NBA 2K24 juego de deportes', CURDATE());