<?php
    
    $mysqli = new mysqli("localhost","root","C@vasinni99","db_tdw");

    $mysqli->query(file_get_contents("dump sql/db_tdw.sql"));

    if($mysqli->connect_errno){
        printf("Connect falied %s\n", $mysqli->connect_error);
        exit();
    }
?>