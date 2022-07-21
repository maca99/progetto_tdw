<?php
    require "include/dbms.inc.php";
    require "include/template2.inc.php";

    $body= new Template("dhtml/search.html");
    $main= new Template("dhtml/blank-min.html");

    $search = mysqli_real_escape_string($mysqli,$_REQUEST['search']);

    $result = $mysqli->query("SELECT * FROM prodotto LEFT JOIN (categoria) ON( prodotto.id_categoria=categoria.id_categoria) WHERE nome LIKE '%".$search."%'");

    while ($row = mysqli_fetch_array($result)){ 
        $body->setContent("id_prodotto",$row['id_prodotto']);
        $body->setContent("nome",$row['nome']);
        $body->setContent("categoria",$row['nome_categoria']);
        
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