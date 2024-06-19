<?php

require_once("config.php");
$nim = $_GET['NIM'];
$json = file_get_contents('php://input');
$data = json_decode($json);

$dbconn = pg_connect($connection_string);
$sqlstring = "DELETE FROM Mahasiswa WHERE NIM ={$nim}";
$query = pg_query($dbconn, $sqlstring);

if($query){
    echo "Delete Data Success";
}else{
    echo "Delete Data Fail";
}

?>