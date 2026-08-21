CREATE DATABASE stok;

USE stok;

CREATE TABLE admin(
    id int AUTO_INCREMENT PRIMARY KEY,
    nama varchar(100),
    kontak int(11),
    email varchar(100)
);

CREATE TABLE gudang(
    id int AUTO_INCREMENT PRIMARY KEY,
	nama_gudang varchar(100),
    lokasi_gudang varchar(100)
);

CREATE TABLE supplier(
	id int AUTO_INCREMENT PRIMARY KEY,
    nama varchar(100),
    kontak int(11),
    nama_barang varchar(100)
);

CREATE TABLE inven (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_admin INT,
    id_supplier INT,
    id_gudang INT,
    nama_barang VARCHAR(100),
    jenis_barang ENUM('ringan', 'berat'),
    kuantitas_stok INT,
    lokasi_barang VARCHAR(100),
    serial_number VARCHAR(100),
    FOREIGN KEY (id_admin) REFERENCES admin(id),
    FOREIGN KEY (id_supplier) REFERENCES supplier(id),
    FOREIGN KEY (id_gudang) REFERENCES gudang(id)
);