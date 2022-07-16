<?php
    session_start();
    require "include/dbms.inc.php";
    require "include/template2.inc.php";
    //require "include/auth.inc.php";
    

    $main= new Template("dhtml/blank-min.html");
    $body = new Template("dhtml/checkout.html");
    $total=0;

    if(isset($_SESSION['cart'])){
        foreach($_SESSION['cart'] as $item){
            $id=$item['id'];
            $oid=$mysqli->query("SELECT * FROM prodotto WHERE prodotto.id_prodotto=$id ");
            $data = $oid->fetch_assoc();
            $total= $data['prezzo'] * $item['quantity'];

            //dati
            

        }
    }
    $body->setContent("totale",$total);


    $main->setContent("body",$body->get());
    $main->close();
?>