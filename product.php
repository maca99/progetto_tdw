<?php
	//require "include/dbms.inc.php";
	require "include/template2.inc.php";

    $body= new template("dhtml/product.html");

	$id= isset($_GET['product_code'])? $_GET['product_code'] : '';

	$query='SELECT * FROM product WHERE id_prodotto = "' . mysqli_real_escape_string($id) .'"';
	$result=$mysqli->query($query); 
	$product=$result->fetch_assoc();

	$body->setContent('title',"prodotto");
	$body->setContent('nome',$product['nome']);
	$body->setContent('prezzo',$product['prezzo']);
	$body->setContent('descrizione_breve',$product['descrizione_breve']);

	$body->close();
?>