<?php
    require "include/dbms.inc.php";
	require "include/template2.inc.php";
    include "include/tags/utility.inc.php";

	$body= new Template("dhtml/index-copia.html");
    $main= new Template("dhtml/blank-min.html");
    $utility=new utility();

   
    //new products
    $result1=$mysqli->query("SELECT id_prodotto FROM prodotto,categoria WHERE prodotto.id_categoria=categoria.id_categoria AND nome_categoria='Laptops' order by prodotto.data ASC LIMIT 10");
    $result2=$mysqli->query("SELECT id_prodotto FROM prodotto,categoria WHERE prodotto.id_categoria=categoria.id_categoria AND nome_categoria='Smartphone' order by prodotto.data ASC LIMIT 10");
    $result3=$mysqli->query("SELECT id_prodotto FROM prodotto,categoria WHERE prodotto.id_categoria=categoria.id_categoria AND nome_categoria='Fotocamere' order by prodotto.data ASC LIMIT 10");
    $result4=$mysqli->query("SELECT id_prodotto FROM prodotto,categoria WHERE prodotto.id_categoria=categoria.id_categoria AND nome_categoria='Accessori' order by prodotto.data ASC LIMIT 10");

    while($row = mysqli_fetch_array($result1)){
        $body->setContent("product1",$utility->product_icon($row['id_prodotto']));
    } 

    while($row=mysqli_fetch_array($result2)){
        $body->setContent("product2",$utility->product_icon($row['id_prodotto']));
    } 

    while($row=$result3->fetch_array()){
        $body->setContent("product3",$utility->product_icon($row['id_prodotto']));
    }

    while($row=$result4->fetch_array()){
        $body->setContent("product4",$utility->product_icon($row['id_prodotto']));
    }

    //top selling

    $result5=$mysqli->query("SELECT prodotto.id_prodotto FROM categoria LEFT JOIN prodotto ON( categoria.id_categoria = prodotto.id_categoria ) left JOIN ordine_has_prodotto ON( prodotto.id_prodotto = ordine_has_prodotto.id_prodotto ) WHERE nome_categoria='Laptops' GROUP BY prodotto.id_prodotto ORDER BY COUNT(ALL ordine_has_prodotto.pezzi) LIMIT 10");
    $result6=$mysqli->query("SELECT prodotto.id_prodotto FROM categoria LEFT JOIN prodotto ON( categoria.id_categoria = prodotto.id_categoria ) left JOIN ordine_has_prodotto ON( prodotto.id_prodotto = ordine_has_prodotto.id_prodotto ) WHERE nome_categoria='Smartphone' GROUP BY prodotto.id_prodotto ORDER BY COUNT(ALL ordine_has_prodotto.pezzi) LIMIT 10");
    $result7=$mysqli->query("SELECT prodotto.id_prodotto FROM categoria LEFT JOIN prodotto ON( categoria.id_categoria = prodotto.id_categoria )LEFT JOIN ordine_has_prodotto ON( prodotto.id_prodotto = ordine_has_prodotto.id_prodotto ) WHERE nome_categoria='Fotocamere' GROUP BY prodotto.id_prodotto ORDER BY COUNT(ALL ordine_has_prodotto.pezzi) LIMIT 10");
    $result8=$mysqli->query("SELECT prodotto.id_prodotto FROM categoria LEFT JOIN prodotto ON( categoria.id_categoria = prodotto.id_categoria ) LEFT JOIN ordine_has_prodotto ON( prodotto.id_prodotto = ordine_has_prodotto.id_prodotto ) WHERE nome_categoria='Accessori' GROUP BY prodotto.id_prodotto ORDER BY COUNT(ALL ordine_has_prodotto.pezzi) LIMIT 10");
    
    while($row=$result5->fetch_array()){
        $body->setContent("product5",$utility->product_icon($row['id_prodotto']));
    }
    while($row=$result6->fetch_array()){
        $body->setContent("product6",$utility->product_icon($row['id_prodotto']));
    }
    while($row=$result7->fetch_array()){
        $body->setContent("product7",$utility->product_icon($row['id_prodotto']));
    }
    while($row=$result8->fetch_array()){
        $body->setContent("product8",$utility->product_icon($row['id_prodotto']));
    }


    $main->setContent("body",$body->get());
    $main->close();
?>