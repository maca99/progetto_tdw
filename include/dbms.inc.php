<?php
    
    $mysqli = new mysqli("localhost","root","","db_tdw");

    if($mysqli->connect_errno){
        printf("Connect falied %s\n", $mysqli->connect_error);
        exit();
    }
?>