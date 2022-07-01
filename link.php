<?php
    require "include/dbms.inc.php";

    $id= isset($_GET['product_code'])? $_GET['product_code'] : '';

    $oid=$mysqli->query("SELECT idimmagine FROM `immagine` WHERE  idimmagine=$id");

    while ($row = mysqli_fetch_array($result)){
        $id = $row['idimmagine'];
        echo "<a href=\"show.php?id=".$id."\"> </a><br />";
    }
    
    
?>