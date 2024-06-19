<?php

require_once("config.php");
$matkul = $_GET['Mata_Kuliah'];
$json = file_get_contents('php://input');
$data = json_decode($json);

$dbconn = pg_connect($connection_string);
$sqlstring = "DELETE FROM Mahasiswa_MataKuliah WHERE Mata_Kuliah ='{$matkul}'";
$query = pg_query($dbconn, $sqlstring);

if($query){
    echo "Delete Data Success";
}else{
    echo "Delete Data Fail";
}

?>