<?php
    session_start();
    $_SESSION['user'] = (array)json_decode($_POST['user']);
    echo isset($_SESSION['user']);
?>