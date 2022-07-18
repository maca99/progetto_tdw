<?php
    session_start();
    require "include/dbms.inc.php";

    if(isset($_POST['id_prodotto'])){

    $id = mysqli_real_escape_string($mysqli,$_POST['id_prodotto']);

    $del = $mysqli -> query("DELETE FROM prodotto WHERE id_prodotto = '".$id."'") or die(mysqli_error($mysqli));

    if($del){
        echo "<script>alert('Delete Successful.'); window.location='product-list.php'</script>";
        
    } else{
        echo "<script>alert('Delete Failed.');</script>";
    }
    
    
    }

?>