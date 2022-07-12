<?php

    session_start();
    
    require "include/template2.inc.php";
    require "include/dbms.inc.php";

    $main = new Template("dhtml/blank.html");
    $body = new Template("dhtml/product-add.html");

   


    if(isset($_POST["submit"])){

        $nome=$_POST['nome'];
        $prezzo=$_POST['prezzo'];
        $descrizione=$_POST['descrizione'];
        $descrizione_breve=$_POST['descrizione_breve'];
        $dettagli=$_POST['dettagli'];
        $categoria=$_POST['categoria'];


        $oid = $mysqli->query("INSERT INTO prodotto  (id_prodotto,nome,prezzo,descrizione_breve,descrizione,dettagli,id_categoria) 
        VALUES (NULL,'$nome','$prezzo','$descrizione_breve','$descrizione','$dettagli',$categoria)");
            
        if (!$oid) {
            echo $mysqli->error;
            $main->setContent("message", "10");
        } else {
            $main->setContent("message", "00");
        }
    }


   

    $main->setContent("body", $body->get());
    $main->close();

?>