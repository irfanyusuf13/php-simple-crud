<?php

require_once("config.php");

$nidn = $_GET["NIDN"];

$json = file_get_contents('php://input');
$data = json_decode($json);
$dbconn = pg_connect($connection_string);

    $sqlstring3 = "UPDATE Dosen SET Dosen= '{$data->Dosen}' WHERE NIDN ={$nidn}";
    $query3 = pg_query($dbconn, $sqlstring3);

    if($query3){
        echo "Update Data Dosen Success";
    }else{
        echo "Update Data Dosen Fail";
    }

?>
