<?php

require_once("config.php");
$nim = $_GET["NIM"];

$json = file_get_contents('php://input');
$data = json_decode($json);
$dbconn = pg_connect($connection_string);

    $sqlstring2 = "UPDATE Mahasiswa SET Nama='{$data->Nama}', Semester={$data->Semester} WHERE NIM ={$nim}";
    $query2 = pg_query($dbconn, $sqlstring2); 

    if($query2){
        echo "Update Data Mahasiswa Success";
    }else{
        echo "Update Data Mahasiswa Fail";
    }

?>
