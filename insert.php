<?php

require_once("config.php");
$json = file_get_contents('php://input');
$data = json_decode($json);

$dbconn = pg_connect($connection_string);

if(isset($data->NIM) && isset($data->Nama) && isset($data->Semester)) {
$sqlstring2 = "INSERT INTO Mahasiswa (NIM, Nama, Semester) VALUES ({$data->NIM}, '{$data->Nama}', {$data->Semester})";
$query2 = pg_query($dbconn, $sqlstring2);

if($query2){
    echo "\nInsert Data Success for Mahasiswa";
} else {
    echo "\nInsert Data Fail for Mahasiswa";
}
}

if(isset($data->Mata_Kuliah) && isset($data->NIM) && isset($data->NIDN)) {
    $sqlstring = "INSERT INTO Mahasiswa_MataKuliah (Mata_Kuliah, NIM, NIDN) VALUES ('{$data->Mata_Kuliah}', {$data->NIM}, {$data->NIDN})";
    $query = pg_query($dbconn, $sqlstring);
    
    if($query){
        echo "\nInsert Data Success for Mahasiswa_MataKuliah";
    } else {
        echo "\nInsert Data Fail for Mahasiswa_MataKuliah";
    }
}

if(isset($data->NIDN) && isset($data->Dosen))  {
    $sqlstring3 = "INSERT INTO Dosen (NIDN, Dosen) VALUES ({$data->NIDN}, '{$data->Dosen}')";
    $query3 = pg_query($dbconn, $sqlstring3);

    if($query3){
        echo "\nInsert Data Success for Dosen";
    } else {
        echo "\nInsert Data Fail for Dosen";
    }
}
?>
