<?php
	require "include/dbms.inc.php";
	require "include/template2.inc.php";

    $body= new Template("dhtml/product.html");;


	$id= isset($_GET['product_code'])? $_GET['product_code'] : '';

	$oid=$mysqli->query("SELECT * FROM `prodotto` WHERE idprodotto= $id"); 
	
	$data = $oid->fetch_assoc();
	foreach($data as $key => $value) {
		$body->setContent($key, $value);
	}


	$body->close();
?>