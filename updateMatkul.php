<?php

require_once("config.php");
$matkul = $_GET["Mata_Kuliah"];

$json = file_get_contents('php://input');
$data = json_decode($json);
$dbconn = pg_connect($connection_string);

    $sqlstring = "UPDATE Mahasiswa_MataKuliah SET NIM= {$data->NIM}, NIDN ={$data->NIDN} WHERE Mata_Kuliah ='{$matkul}'";
    $query = pg_query($dbconn, $sqlstring);

    if($query){
        echo "Update Data Matakuliah Success";
    }else{
        echo "Update Data Matakuliah Fail";
    }


?>
    