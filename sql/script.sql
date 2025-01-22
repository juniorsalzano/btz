create database btz;
use btz;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  zip_code VARCHAR(10),
  address VARCHAR(255),
  neighborhood VARCHAR(100),
  city VARCHAR(100),
  state VARCHAR(50),
  access_level VARCHAR(1) NOT NULL DEFAULT 'U',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Inserir o primeiro usuário administrador
INSERT INTO users (name, email, password, zip_code, address, neighborhood, city, state, access_level)
VALUES (
  'Admin', 
  'admin@example.com', 
  '$2y$10$.6m3HOvAmUzgxsyiBhHM7OyFQ2sfHEE29BIgVTe3p404IrJbrh4Z6', --password: admin
  '00000-000', 
  'Admin Address', 
  'Admin Neighborhood', 
  'Admin City', 
  'Admin State', 
  'A'
);