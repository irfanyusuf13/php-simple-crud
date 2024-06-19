<?php

require_once("config.php");
$dbconn = pg_connect($connection_string);
$tampil = pg_query($dbconn, "SELECT * FROM Dosen");
$data = pg_fetch_all($tampil);
$jsonData = json_encode($data, JSON_PRETTY_PRINT);

echo $jsonData
?>


