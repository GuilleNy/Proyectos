
-- Creación de la base de datos
DROP DATABASE IF EXISTS technoshop;
CREATE DATABASE IF NOT EXISTS technoshop;
USE technoshop;

-- Tabla Clientes 
CREATE TABLE Clientes (
    dni VARCHAR(10) NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    fecha_nacimiento DATE,
    email VARCHAR(255) NOT NULL,
    clave VARCHAR(100) NOT NULL,
    PRIMARY KEY (dni)
) ENGINE=InnoDB;

-- Tabla Pedidos
CREATE TABLE Pedidos (
    num_pedido INT NOT NULL AUTO_INCREMENT,
    dni VARCHAR(10) NOT NULL,
    fecha_venta DATE,
    importe_total DECIMAL(10,2) NOT NULL,
    PRIMARY KEY (num_pedido),
    FOREIGN KEY (dni) REFERENCES Clientes(dni)
) ENGINE=InnoDB;

-- Tabla Categorias
CREATE TABLE Categorias (
    id_categoria INT NOT NULL AUTO_INCREMENT,
    nombre_categoria VARCHAR(100) NOT NULL,
    PRIMARY KEY (id_categoria)
) ENGINE=InnoDB;

-- Tabla Productos
CREATE TABLE Productos (
    id_producto INT NOT NULL AUTO_INCREMENT,
    id_categoria INT,
    nombre_producto VARCHAR(100) NOT NULL,
    precio_unidad DECIMAL(10,2) NOT NULL,
    num_unidades INT NOT NULL,
    descuento DECIMAL(10,2),
    PRIMARY KEY (id_producto),
    FOREIGN KEY (id_categoria) REFERENCES Categorias(id_categoria)
) ENGINE=InnoDB;

-- Tabla LineasPedido
CREATE TABLE LineasPedido (
    num_pedido INT NOT NULL,
    num_linea INT NOT NULL,
    id_producto INT NOT NULL,
    importe_unidad DECIMAL(10,2) NOT NULL,
    unidades_pedidas INT NOT NULL,
    PRIMARY KEY (num_pedido, num_linea),
    FOREIGN KEY (num_pedido) REFERENCES Pedidos(num_pedido),
    FOREIGN KEY (id_producto) REFERENCES Productos(id_producto)
) ENGINE=InnoDB;

-- Insertar datos en Clientes
INSERT INTO Clientes (dni, nombre, apellidos, fecha_nacimiento, email, clave) VALUES
('12345678A', 'Juan', 'Perez', '1980-05-15', 'juan.perez@example.com','APerez'),
('23456789B', 'Ana', 'Garcia', '1990-08-20', 'ana.garcia@example.com', 'BGarcia'),
('34567890C', 'Luis', 'Martinez', '1975-12-30', 'luis.martinez@example.com','CMartinez');

-- Insertar datos en Pedidos
INSERT INTO Pedidos (num_pedido, dni, fecha_venta, importe_total) VALUES
(1, '12345678A', '2025-02-01', 1420.00),
(2, '23456789B', '2025-02-05', 3125.00);

-- Insertar datos en Categorias
INSERT INTO Categorias (nombre_categoria) VALUES
('TV'),
('Tablet'),
('Laptop');

-- Insertar datos en Productos (2 por categoría)
INSERT INTO Productos (id_categoria, nombre_producto, precio_unidad, num_unidades, descuento) VALUES
(1, 'Samsung QLED 55"', 800.00, 5, 50.00),
(1, 'LG OLED 48"', 900.00, 3, 75.00),
(2, 'iPad Air', 700.00, 10, 30.00),
(2, 'Samsung Galaxy Tab S8', 650.00, 8, 20.00),
(3, 'Dell XPS 13', 1200.00, 4, 100.00),
(3, 'MacBook Air M2', 1300.00, 6, 150.00);

-- Insertar datos en LineasPedido
INSERT INTO LineasPedido (num_pedido, num_linea, id_producto, importe_unidad, unidades_pedidas) VALUES
(1, 1, 1, 750.00, 1),
(1, 2, 3, 670.00, 1),
(2, 1, 6, 1150.00, 2),
(2, 2, 2, 825.00, 1);
