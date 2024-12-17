-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS denunciasDB;
USE denunciasDB;

-- Tabla: Tipos_Denuncias
CREATE TABLE IF NOT EXISTS Tipos_Denuncias (
    idTipoDenuncia INT AUTO_INCREMENT PRIMARY KEY,
    NombreDenuncia VARCHAR(255) NOT NULL
);

-- Tabla: Estados_Denuncias
CREATE TABLE IF NOT EXISTS Estados_Denuncias (
    idEstadoDenuncia INT AUTO_INCREMENT PRIMARY KEY,
    NombreDenuncia VARCHAR(255) NOT NULL
);

-- Tabla: Provincias
CREATE TABLE IF NOT EXISTS Provincias (
    idProvincia INT AUTO_INCREMENT PRIMARY KEY,
    NombreProvincia VARCHAR(255) NOT NULL
);

-- Tabla: Cantones
CREATE TABLE IF NOT EXISTS Cantones (
    idCanton INT AUTO_INCREMENT PRIMARY KEY,
    idProvincia INT NOT NULL,
    NombreCanton VARCHAR(255) NOT NULL,
    FOREIGN KEY (idProvincia) REFERENCES Provincias(idProvincia)
      ON UPDATE CASCADE
      ON DELETE CASCADE
);

-- Tabla: Usuarios
CREATE TABLE IF NOT EXISTS Usuarios (
    idUsuario INT AUTO_INCREMENT PRIMARY KEY,
    idProvincia INT NOT NULL,
    idCanton INT NOT NULL,
    Nombre VARCHAR(255) NOT NULL,
    Apellido VARCHAR(255) NOT NULL,
    Correo VARCHAR(255) NOT NULL,
    Telefono VARCHAR(25),
    Cedula VARCHAR(50),
    Password VARCHAR(255) NOT NULL,
    isAdmin BINARY(1) NOT NULL DEFAULT 0,
    DetalleDireccion VARCHAR(500),
    FOREIGN KEY (idProvincia) REFERENCES Provincias(idProvincia)
      ON UPDATE CASCADE
      ON DELETE CASCADE,
    FOREIGN KEY (idCanton) REFERENCES Cantones(idCanton)
      ON UPDATE CASCADE
      ON DELETE CASCADE
);

-- Tabla: Denuncias
CREATE TABLE IF NOT EXISTS Denuncias (
    idDenuncias INT AUTO_INCREMENT PRIMARY KEY,
    idUsuario INT NOT NULL,
    idProvincia INT NOT NULL,
    idCanton INT NOT NULL,
    idTipoDenuncia INT NOT NULL,
    idEstadoDenuncia INT NOT NULL,
    DescripcionDenuncia VARCHAR(500),
    Fecha DATETIME NOT NULL,
    DetalleUbicacion VARCHAR(500),
    FOREIGN KEY (idUsuario) REFERENCES Usuarios(idUsuario)
      ON UPDATE CASCADE
      ON DELETE CASCADE,
    FOREIGN KEY (idProvincia) REFERENCES Provincias(idProvincia)
      ON UPDATE CASCADE
      ON DELETE CASCADE,
    FOREIGN KEY (idCanton) REFERENCES Cantones(idCanton)
      ON UPDATE CASCADE
      ON DELETE CASCADE,
    FOREIGN KEY (idTipoDenuncia) REFERENCES Tipos_Denuncias(idTipoDenuncia)
      ON UPDATE CASCADE
      ON DELETE CASCADE,
    FOREIGN KEY (idEstadoDenuncia) REFERENCES Estados_Denuncias(idEstadoDenuncia)
      ON UPDATE CASCADE
      ON DELETE CASCADE
);
