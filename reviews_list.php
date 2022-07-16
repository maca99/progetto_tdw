<?php
    require "include/dbms.inc.php";
	require "include/template2.inc.php";
    include "include/tags/utility.inc.php";
    session_start();

	$body= new Template("dhtml/reviews_list.html");
    $main= new Template("dhtml/blank-min.html");
    $utility=new utility();

    $id_prodotto = isset($_GET['product_code'])? $_GET['product_code'] : '';
    /*
    $name = (isset($_POST['name'])) ? $_POST['name'] : '';
    $commento = (isset($_POST['text'])) ? $_POST['text'] : '';
    $voto = (isset($_POST['rating'])) ? $_POST['rating'] : '';
    */
    $result= $mysqli->query("SELECT * FROM prodotto WHERE id_prodotto=$id_prodotto");
    while($row=mysqli_fetch_array($result)){
        $body->setContent("product",$row["nome"]);
    }


    $oid=$mysqli->query("SELECT * FROM recensione WHERE id_prodotto='$id_prodotto'");
    if(mysqli_num_rows($oid)>0){
        while($row=mysqli_fetch_array($oid)){
            $body->setContent("name",$row['name']);
            $body->setContent("data",$row['data']);
            $body->setContent("commento",$row['commento']);
        } 
    }else{
        $error="Ancora nessuna recensione disponibile";
        $body->setContent("error",$error);

    }

  

    $body->setContent("rating",$utility->rating($id_prodotto));


    $main->setContent("body",$body->get());
    $main->close();
?>