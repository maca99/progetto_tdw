<?php
	require "include/dbms.inc.php";
	require "include/template2.inc.php";
	include "include/tags/utility.inc.php";

	$main= new Template("dhtml/blank.html");
    $body= new Template("dhtml/product.html");
	$utility=new utility();

	$id= isset($_GET['product_code'])? $_GET['product_code'] : '';


	//informazioni sul prodotto
	$oid=$mysqli->query("SELECT * FROM prodotto,categoria WHERE id_prodotto= $id AND prodotto.id_categoria=categoria.id_categoria");
	if(mysqli_num_rows($oid) != 1){
		echo("prodotto non trovato");
		exit();
	}

	$data = $oid->fetch_assoc();
	foreach($data as $key => $value) {
		$body->setContent($key, $value);
	}

	//prodotti correlati
	$categoria=$data['id_categoria'];
	$prodotto=$data['id_prodotto'];
	$result=$mysqli->query("SELECT id_prodotto FROM prodotto,categoria WHERE  prodotto.id_categoria=categoria.id_categoria AND categoria.id_categoria=$categoria AND id_prodotto!=$prodotto LIMIT 4");

	while($row = mysqli_fetch_array($result)){
		$body->setContent("correlati",$utility->product_icon($row['id_prodotto']));
	}

	//immaginni prodotto
	$result=$mysqli->query("SELECT idimmagine FROM `immagine` WHERE  prodotto_idprodotto = $id");
	 while($row = mysqli_fetch_array($result)){
        $id_immagine = $row['idimmagine'];
		$body->setContent("immagini","<img src=show.php?id=$id_immagine>");
        $body->setContent("immagine","<img src=show.php?id=$id_immagine>");
    }


	//recensioni 
	$body->setContent("rating",$utility->rating($id));


	$main->setContent("body",$body->get());
	$main->close();
?>