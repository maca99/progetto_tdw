<?php
    require "include/dbms.inc.php";

    $id= isset($_GET['immage_code'])? $_GET['immage_code'] : '';

    $oid=$mysqli->query("SELECT * FROM `immagine` WHERE  idimmagine=$id");
    //*
    //if(mysqli_num_rows($oid) != 1){
    //   exit();
    //}

    $img = $oid->fetch_assoc();
    $type = $img['type'];
    header("Content-type: ".$type);
    return $img['immagine'];
 
?>