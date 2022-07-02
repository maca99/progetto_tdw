<?php
    require "include/dbms.inc.php";
	require "include/template2.inc.php";
    include "include/tags/utility.inc.php";

	$body= new Template("dhtml/index.html");
    $main= new Template("dhtml/blank-min.html");
    $utility=new utility();

    //new products
    $result1=$mysqli->query("SELECT id_prodotto FROM prodotto join categoria WHERE prodotto.id_categoria=categoria.idcategoria and categoria.nome='Laptops' order by prodotto.data ASC LIMIT 10");
    $result2=$mysqli->query("SELECT id_prodotto FROM prodotto join categoria WHERE prodotto.id_categoria=categoria.idcategoria and categoria.nome='Smartphone' order by prodotto.data ASC LIMIT 10");
    $result3=$mysqli->query("SELECT id_prodotto FROM prodotto join categoria WHERE prodotto.id_categoria=categoria.idcategoria and categoria.nome='Fotocamere' order by prodotto.data ASC LIMIT 10");
    $result4=$mysqli->query("SELECT id_prodotto FROM prodotto join categoria WHERE prodotto.id_categoria=categoria.idcategoria and categoria.nome='Accessori' order by prodotto.data ASC LIMIT 10");

    while($row=$result1->fetch_array()){
        $body->setContent("product1",$utility->product_icon($row['id_prodotto']));
    }
    while($row=$result2->fetch_array()){
        $body->setContent("product2",$utility->product_icon($row['id_prodotto']));
    }
    while($row=$result3->fetch_array()){
        $body->setContent("product3",$utility->product_icon($row['id_prodotto']));
    }
    while($row=$result4->fetch_array()){
        $body->setContent("product4",$utility->product_icon($row['id_prodotto']));
    }

    //top selling

    
    
    $main->setContent("body",$body->get());
    $main->close();
?>