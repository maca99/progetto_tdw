<?php
    require "include/dbms.inc.php";
    require "include/template2.inc.php";

    
    $main= new Template("dhtml/blank-min.html");

    $search = mysqli_real_escape_string($mysqli,$_REQUEST['search']);
    if($_POST['category'] != 0){
        $category=$_POST['category'];
    }
    if(isset($category)){
        echo $category;
        $result = $mysqli->query("SELECT * FROM prodotto LEFT JOIN (categoria) ON( prodotto.id_categoria=categoria.id_categoria) WHERE prodotto.id_categoria='".$category."' AND nome LIKE '".$search."%'");
        if(!$result){
            echo $mysqli->error;
        }
    }else{
        $result = $mysqli->query("SELECT * FROM prodotto LEFT JOIN (categoria) ON( prodotto.id_categoria=categoria.id_categoria) WHERE nome LIKE '".$search."%'");
    }
    
    $indice=1;
    if(mysqli_num_rows($result)==0){
        $body = new Template("dhtml/fallied-search.html");
        $body->setContent("ricerca",$search);
    }else{
        $body= new Template("dhtml/search.html");
        while ($row = mysqli_fetch_array($result)){ 
        $body->setContent("id_prodotto",$row['id_prodotto']);
        $body->setContent("id_categoria",$row['id_categoria']);
        $body->setContent("nome",$row['nome']);
        $body->setContent("categoria",$row['nome_categoria']);
        $body->setContent("prezzo",$row['prezzo']);
        $body->setContent("indice",$indice);
        $indice++;

        
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
    }
        

    

        $main->setContent("body",$body->get());
        $main->close();

?> 