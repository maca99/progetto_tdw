<?php
	require "include/dbms.inc.php";
	require "include/template2.inc.php";

	$main= new Template("dhtml/blank.html");
    $body= new Template("dhtml/product.html");


	//$id= isset($_GET['product_code'])? $_GET['product_code'] : '';

<<<<<<< HEAD
	$oid=$mysqli->query('SELECT * FROM product '); 

	while(($row = $oid->fetch_assoc()) !== null){
		
	}

	/*
	foreach($resdss as $key => $value) {
=======
	$oid=$mysqli->query("SELECT * FROM `prodotto` WHERE idprodotto= $id"); 
	
	$data = $oid->fetch_assoc();
	foreach($data as $key => $value) {
>>>>>>> 5848feed1fdb0695ee8451d2d4832479c929ad17
		$body->setContent($key, $value);
	}*/


<<<<<<< HEAD
	$body->close();
=======
	$main->setContent("body",$body->get());
	$main->close();
>>>>>>> 5848feed1fdb0695ee8451d2d4832479c929ad17
?>