<?php
include 'include/dbms.inc.php';
if (isset($_GET['id']))
{
    $id = intval($_GET['id']);
    
    $result = $mysqli->query("SELECT * FROM immagine WHERE idimmagine= '$id'");
    $row = mysqli_fetch_array($result);
    $id_img = $row['idimmagine'];
    $type = $row['type'];
    $img = $row['immagine'];
    if (!$id_img)
    {
        echo "Id sconosciuto";
    }else{
        header ("Content-type: $type");
        echo $img;
    }
}else{
    echo "Impossibile soddisfare la richiesta.";
}
?>