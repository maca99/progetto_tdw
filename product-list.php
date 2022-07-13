<?php
    require "include/dbms.inc.php";
	require "include/template2.inc.php";
    include "include/tags/utility.inc.php";

	$body= new Template("dhtml/product-list.html");
    $main= new Template("dhtml/blank-min.html");
    $utility=new utility();

    $result=$mysqli->query("SELECT * FROM prodotto LEFT JOIN (categoria) ON( prodotto.id_categoria=categoria.id_categoria)");
    while($row=mysqli_fetch_array($result)){
        $body->setContent("nome",$row['nome']);
        $body->setContent("categoria",$row['nome_categoria']);
        $img=$mysqli->query("SELECT idimmagine FROM immagine WHERE prodotto_idprodotto='".$row['id_prodotto']."' LIMIT 1");
        if(mysqli_num_rows($img)<1){
            $body->setContent("immagine","<img src='dhtml/img/not_found.png'>");
        }else{
            $res=mysqli_fetch_array($img);
            $tag=$tag=$res['idimmagine'];
            $body->setContent("immagine","<img src=show.php?id=$tag>");
        }

    }


 

    $main->setContent("body",$body->get());
    $main->close();
?>