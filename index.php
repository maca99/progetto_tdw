<?php
    require "include/dbms.inc.php";
	require "include/template2.inc.php";
    include "include/tags/utility.inc.php";
    session_start();

	$body= new Template("dhtml/index.html");
    $main= new Template("dhtml/blank-min.html");
    $utility=new utility();

   
    //new products
    $result=$mysqli->query("SELECT id_prodotto FROM prodotto,categoria WHERE prodotto.id_categoria=categoria.id_categoria AND nome_categoria='Laptops' order by prodotto.data ASC LIMIT 10");
    $result2=$mysqli->query("SELECT id_prodotto FROM prodotto,categoria WHERE prodotto.id_categoria=categoria.id_categoria AND nome_categoria='Smartphone' order by prodotto.data ASC LIMIT 10");
    $result3=$mysqli->query("SELECT id_prodotto FROM prodotto,categoria WHERE prodotto.id_categoria=categoria.id_categoria AND nome_categoria='Fotocamere' order by prodotto.data ASC LIMIT 10");
    $result4=$mysqli->query("SELECT id_prodotto FROM prodotto,categoria WHERE prodotto.id_categoria=categoria.id_categoria AND nome_categoria='Accessori' order by prodotto.data ASC LIMIT 10");

    while($row=mysqli_fetch_array($result)){
        $body->setContent("product1",$utility->product_icon($row['id_prodotto']));
    }
    while($row=mysqli_fetch_array($result)){
        $body->setContent("product2",$utility->product_icon($row['id_prodotto']));
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

    $result1=$mysqli->query("SELECT prodotto.id_prodotto FROM categoria LEFT JOIN prodotto ON( categoria.id_categoria = prodotto.id_categoria ) left JOIN ordine_has_prodotto ON( prodotto.id_prodotto = ordine_has_prodotto.id_prodotto ) WHERE nome_categoria='Laptops' GROUP BY prodotto.id_prodotto ORDER BY COUNT(ALL ordine_has_prodotto.pezzi) LIMIT 10");
    $result2=$mysqli->query("SELECT prodotto.id_prodotto FROM categoria LEFT JOIN prodotto ON( categoria.id_categoria = prodotto.id_categoria ) left JOIN ordine_has_prodotto ON( prodotto.id_prodotto = ordine_has_prodotto.id_prodotto ) WHERE nome_categoria='Smartphone' GROUP BY prodotto.id_prodotto ORDER BY COUNT(ALL ordine_has_prodotto.pezzi) LIMIT 10");
    $result3=$mysqli->query("SELECT prodotto.id_prodotto FROM categoria LEFT JOIN prodotto ON( categoria.id_categoria = prodotto.id_categoria )LEFT JOIN ordine_has_prodotto ON( prodotto.id_prodotto = ordine_has_prodotto.id_prodotto ) WHERE nome_categoria='Fotocamere' GROUP BY prodotto.id_prodotto ORDER BY COUNT(ALL ordine_has_prodotto.pezzi) LIMIT 10");
    $result4=$mysqli->query("SELECT prodotto.id_prodotto FROM categoria LEFT JOIN prodotto ON( categoria.id_categoria = prodotto.id_categoria ) LEFT JOIN ordine_has_prodotto ON( prodotto.id_prodotto = ordine_has_prodotto.id_prodotto ) WHERE nome_categoria='Accessori' GROUP BY prodotto.id_prodotto ORDER BY COUNT(ALL ordine_has_prodotto.pezzi) LIMIT 10");
    
    while($row=$result1->fetch_array()){
        $body->setContent("product5",$utility->product_icon($row['id_prodotto']));
    }
    while($row=$result2->fetch_array()){
        $body->setContent("product6",$utility->product_icon($row['id_prodotto']));
    }
    while($row=$result3->fetch_array()){
        $body->setContent("product7",$utility->product_icon($row['id_prodotto']));
    }
    while($row=$result4->fetch_array()){
        $body->setContent("product8",$utility->product_icon($row['id_prodotto']));
    }


    
    $result9=$mysqli->query("SELECT id_prodotto FROM prodotto,categoria WHERE prodotto.id_categoria=categoria.id_categoria AND categoria.nome_categoria='Laptops' order by prodotto.data ASC LIMIT 10");
    $result10=$mysqli->query("SELECT id_prodotto FROM prodotto,categoria WHERE prodotto.id_categoria=categoria.id_categoria AND categoria.nome_categoria='Smartphone' order by prodotto.data ASC LIMIT 10");
    $result11=$mysqli->query("SELECT id_prodotto FROM prodotto,categoria WHERE prodotto.id_categoria=categoria.id_categoria AND categoria.nome_categoria='Fotocamere' order by prodotto.data ASC LIMIT 10");

    while($row = mysqli_fetch_array($result9)){
        $body->setContent("product9",$utility->product_widget($row['id_prodotto']));
    } 

    while($row=mysqli_fetch_array($result10)){
        $body->setContent("product10",$utility->product_widget($row['id_prodotto']));
    } 

    while($row=$result11->fetch_array()){
        $body->setContent("product11",$utility->product_widget($row['id_prodotto']));
    }




    $main->setContent("body",$body->get());
    $main->close();
?>