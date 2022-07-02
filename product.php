<?php
	require "include/dbms.inc.php";
	require "include/template2.inc.php";

	$main= new Template("dhtml/blank.html");
    $body= new Template("dhtml/product.html");

	$id= isset($_GET['product_code'])? $_GET['product_code'] : '';


	//informazioni sul prodotto
	$oid=$mysqli->query("SELECT * FROM `prodotto` WHERE id_prodotto= $id ");

	if(mysqli_num_rows($oid) != 1){
		echo("prodotto non trovato");
		exit();
	}

	$data = $oid->fetch_assoc();
	foreach($data as $key => $value) {
		$body->setContent($key, $value);
	}

	//recensioni

	$star=$mysqli->query("SELECT AVG() FROM recensione //da fini");



	$result=$mysqli->query("SELECT idimmagine FROM `immagine` WHERE  prodotto_idprodotto = $id");
	 while($row = mysqli_fetch_array($result)){
        $id_immagine = $row['idimmagine'];
		$body->setContent("immagini","<img src=show.php?id=$id_immagine>");
        $body->setContent("immagine","<img src=show.php?id=$id_immagine>");
    }


	$main->setContent("body",$body->get());
	$main->close();
?>