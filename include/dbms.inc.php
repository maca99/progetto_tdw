<?php
    
    $mysqli = new mysqli("localhost","root","","db_tdw");
<<<<<<< HEAD
=======

    $mysqli->query(file_get_contents("dump sql/db_tdw.sql"));
>>>>>>> 5848feed1fdb0695ee8451d2d4832479c929ad17

    if($mysqli->connect_errno){
        printf("Connect falied %s\n", $mysqli->connect_error);
        exit();
    }
?>