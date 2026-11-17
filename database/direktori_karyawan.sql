CREATE DATABASE IF NOT EXISTS direktori_karyawan;

USE direktori_karyawan;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE divisi (
    id_divisi INT AUTO_INCREMENT PRIMARY KEY,
    nama_divisi VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE karyawan (
    id_karyawan INT AUTO_INCREMENT PRIMARY KEY,
    nik VARCHAR(30) NOT NULL UNIQUE,
    nama VARCHAR(100) NOT NULL,
    jenis_kelamin ENUM('Laki-laki', 'Perempuan'),
    email VARCHAR(100),
    no_telepon VARCHAR(20),
    alamat TEXT,
    jabatan VARCHAR(100),
    id_divisi INT,
    tanggal_masuk DATE,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_karyawan_divisi
    FOREIGN KEY (id_divisi)
    REFERENCES divisi(id_divisi)
    ON UPDATE CASCADE
    ON DELETE SET NULL
);

INSERT INTO divisi (nama_divisi) VALUES
('Human Resource'),
('Keuangan'),
('IT'),
('Pemasaran'),
('Operasional');