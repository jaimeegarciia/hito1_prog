CREATE TABLE entradas (
                          id INT AUTO_INCREMENT PRIMARY KEY,
                          autor_email VARCHAR(100) NOT NULL,
                          titulo VARCHAR(255) NOT NULL,
                          contenido TEXT NOT NULL,
                          fecha_publicacion DATE NOT NULL,
                          imagen TEXT
);
