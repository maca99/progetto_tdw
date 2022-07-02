<?php
	require "include/dbms.inc.php";
	require "include/template2.inc.php";

	

	function product_icon($id){

			$main= new Template("dhtml/prodotto_index.html");
			$id=$_GET['product_code'];

			$oid=$mysqli->query("SELECT * FROM `prodotto` WHERE idprodotto= $id ");

			if(mysqli_num_rows($oid) != 1){
				echo("prodotto non trovato");
				exit();
			}

			$data = $oid->fetch_assoc();
			foreach($data as $key => $value) {
				$main->setContent($key, $value);
			}

			$result=$mysqli->query("SELECT idimmagine FROM `immagine` WHERE  prodotto_idprodotto = $id LIMIT 1");
			if(mysqli_num_rows($result)!=1){
				echo("prodotto senza immagine");
				//prodotto senza immagine
				exit();
			}else{
				while($row = mysqli_fetch_array($result)){
					$tag=$row['idimmagine'];
					$img="<img src=show.php?id=$tag>";
					$main->setContent("immagine",$tag);
				}
			}
		return $main->get();
}


	
?>