<?php
    require "include/dbms.inc.php";
    require "include/template2.inc.php";
    include "include/tags/utility.inc.php";
    session_start();

    $main= new Template("dhtml/blank-min.html");
    $body = new Template("dhtml/checkout.html");


    if(isset($_SESSION['cart'])){
        foreach($_SESSION['cart'] as $item){
            $id=$item['id'];
            $oid=$mysqli->query("SELECT * FROM prodotto WHERE prodotto.id_prodotto=$id ");
            $data = $oid->fetch_assoc();
            $total= $data['prezzo'] * $item['quantity'];

            //dati
            $body->setContent("totale",$total);

        }
    }else{
        header("Location: index.php");
    }


    $main->setContent("body",$body->get());
    $main->close();
?>