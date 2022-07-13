<?php
    require "include/dbms.inc.php";
    session_start();


    //post: id_prodotto,name,email,text,rating
    $id_prodotto=$_POST['product'];
    $name = (isset($_POST['name'])) ? $_POST['name'] : '';
    $commento = (isset($_POST['text'])) ? $_POST['text'] : '';
    $voto = (isset($_POST['rating'])) ? $_POST['rating'] : '';
    $email = (isset($_POST['email'])) ? $_POST['email'] : '';

    if(empty($name)||empty($email)||empty($commento)||empty($voto)){
        header("Location: product.php?product_code=$id_prodotto");
    }
    //controllo se l'utente ha già fatto una recensione e in caso la modifico
    $oid=$mysqli->query("SELECT * FROM recensione WHERE id_prodotto='$id_prodotto' AND email='$email'");
    echo $mysqli->error;
 
    if(mysqli_num_rows($oid)!=0){
        $oid=$mysqli->query("UPDATE recensione SET voto='$voto',commento='$commento' WHERE email='$email' AND id_prodotto='$id_prodotto");
    }else{
    $oid=$mysqli->query("INSERT INTO recensione(id_recensione,id_prodotto,voto,commento,name,email)
            VALUES (NULL,'$id_prodotto','$voto','$commento','$name','$email')");  
    }
    echo $mysqli->error;
    

    //temporanea poi reindirizzo alla pagina di tutte le recensioni
    header("Location: product.php?product_code=".$id_prodotto);
    
?>