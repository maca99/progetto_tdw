<?php
	require "include/dbms.inc.php";
	require "include/template2.inc.php";

	$main= new Template("dhtml/blank.html");
    $body= new Template("dhtml/product.html");


	$id= isset($_GET['product_code'])? $_GET['product_code'] : '';

	$oid=$mysqli->query("SELECT * FROM `prodotto` WHERE idprodotto= $id ");

	if(mysqli_num_rows($oid) != 1){
		echo("prodtto non trovato");
		exit();
	}

	$data = $oid->fetch_assoc();
	foreach($data as $key => $value) {
		$body->setContent($key, $value);
	}


	$main->setContent("body",$body->get());
	$main->close();
?>