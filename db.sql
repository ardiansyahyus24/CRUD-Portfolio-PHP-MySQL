sql
-- Buat database
CREATE DATABASE IF NOT EXISTS crud_portfolio CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE crud_portfolio;

-- Tabel profile (satu baris)
CREATE TABLE IF NOT EXISTS profile (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(150) NOT NULL,
  email VARCHAR(150) NOT NULL,
  bio TEXT,
  photo VARCHAR(255),
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Tabel experiences
CREATE TABLE IF NOT EXISTS experiences (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(200) NOT NULL,
  organization VARCHAR(200),
  description TEXT,
  start_date DATE,
  end_date DATE,
  image VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Insert contoh profile (editable)
INSERT INTO profile (name, email, bio) VALUES ('Nama Kamu', 'email@domain.com', 'Bio singkat tentang dirimu.');

-- Insert contoh pengalaman
INSERT INTO experiences (title, organization, description, start_date, end_date) VALUES
('Internship Web Dev', 'PT. Contoh', 'Mengembangkan modul CRUD menggunakan PHP dan MySQL.', '2024-06-01', '2024-08-31'),
('Volunteer Cleanup', 'Komunitas Lingkungan', 'Koordinator tim dalam aksi bersih pantai.', '2025-05-24', '2025-05-24');
