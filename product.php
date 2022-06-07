<?php
	//require "include/dbms.inc.php";
	require "include/template2.inc.php";

    $body= new template("dhtml/product.html");

	$id= isset($_GET['product_code'])? $_GET['product_code'] : '';

	$oid=$mysqli->query('SELECT * FROM product WHERE id_prodotto = "' . mysqli_real_escape_string($id) .'"'); 

	if (!$oid) {
		// error
	}
	if ($oid->num_rows == 0) {
		// item does not exist 
	} 
	$data = $oid->fetch_assoc();
	foreach($data as $key => $value) {
		$body->setContent($key, $value);
	}



	$body->close();
?>