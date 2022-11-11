<?php 
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $host = 'localhost';
    $login = 'root';
    $pass = 'root';
    $db = 'socium';
    $conn = mysqli_connect($host,$login,$pass,$db);
?>