<?php
    session_start();
    require "include/dbms.inc.php";
    //require "include/auth.inc.php";
	require "include/template2.inc.php";

	$body= new Template("dhtml/product-list.html");
    $main= new Template("dhtml/admin-panel.html");

    $result=$mysqli->query("SELECT * FROM prodotto LEFT JOIN (categoria) ON( prodotto.id_categoria=categoria.id_categoria)");
    while($row=mysqli_fetch_array($result)){
        $body->setContent("id_prodotto",$row['id_prodotto']);
        $body->setContent("nome",$row['nome']);
        $body->setContent("id_categoria",$row['id_categoria']);
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