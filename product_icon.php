<?php
	require "include/dbms.inc.php";
	require "include/template2.inc.php";

	

	if(isset($_GET['product_code']))
	{
		$main= new Template("dhtml/prodotto_index.html");

		$oid=$mysqli->query("SELECT * FROM `prodotto` WHERE idprodotto= $id ");

		if(mysqli_num_rows($oid) != 1){
			echo("prodotto non trovato");
			exit();
		}

		$data = $oid->fetch_assoc();
		foreach($data as $key => $value) {
			$body->setContent($key, $value);
		}

		$result=$mysqli->query("SELECT idimmagine FROM `immagine` WHERE  prodotto_idprodotto = $id LIMIT 1");
		if(mysqli_num_rows($result)!=1){
			//prodotto senza immagine
			exit();
		}else{
			$tag="<img src=show.php?id=$result>";
			$body->setContent("immagine",$tag);
		}
		


		$main->close();
	}else{
		echo("prodotto non trovato");
	}

	
?>