CREATE DATABASE sbdtugas

CREATE TABLE Mahasiswa (
    NIM BIGINT PRIMARY KEY,
    Nama VARCHAR(50),
    Semester INT
);

CREATE TABLE Dosen (
    NIDN BIGINT PRIMARY KEY,
    Dosen VARCHAR(50)
);

CREATE TABLE Mahasiswa_MataKuliah (
    Mata_Kuliah VARCHAR(50),
    NIM BIGINT,
    NIDN BIGINT
);

