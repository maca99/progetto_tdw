<?php
    session_start();
    require "include/dbms.inc.php";
	require "include/template2.inc.php";
    include "include/tags/utility.inc.php";


	$body= new Template("dhtml/confirmed-order.html");
    $main= new Template("dhtml/blank-min.html");
    $utility=new utility();

    $id= isset($_GET['id_ordine'])? $_GET['id_ordine'] : '';


    $result=$mysqli->query("SELECT * FROM ordine LEFT JOIN (ordine_has_prodotto,prodotto,categoria) ON(ordine.id_ordine=ordine_has_prodotto.id_ordine AND ordine_has_prodotto.id_prodotto=prodotto.id_prodotto AND prodotto.id_categoria=categoria.id_categoria) WHERE ordine.id_ordine=$id ");
    if(!$result){
        echo $mysqli->error;
        exit;
    }
    while($row=mysqli_fetch_array($result)){
        $body->setContent("id_prodotto",$row['id_prodotto']);
        $body->setContent("nome",$row['nome']);
        $body->setContent("categoria",$row['nome_categoria']);

        //immagine
        $img=$mysqli->query("SELECT * FROM immagine WHERE prodotto_idprodotto='".$row['id_prodotto']."' LIMIT 1");
        if(mysqli_num_rows($img)!=1){
            $body->setContent("immagine","<img width='100' height='100' src='dhtml/img/not_found.png'>");
        }else{
            $res=mysqli_fetch_array($img);
            $tag=$res['idimmagine'];
            $img="<img width='100' height='100' src=show.php?id=$tag>";
            $body->setContent("immagine",$img);
            }
        
    }

    $main->setContent("body",$body->get());
    $main->close();
?>