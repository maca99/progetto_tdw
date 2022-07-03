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
	$oid=$mysqli->query("SELECT AVG(recensione.voto) as recensione,COUNT(*) as numero FROM prodotto,recensione WHERE prodotto.id_prodotto=$id AND prodotto.id_prodotto=recensione.id_prodotto");

	
	$row = $oid->fetch_assoc();
	$star = (isset($row['recensione'])) ? $row['recensione'] : 5;
	$body->setContent("num_rew",$row['numero']);
	for($i=0;$i<$star;$i++){
		$tag="<i class='fa fa-star'></i>";
		$body->setContent("recensione",$tag);
	}



	$result=$mysqli->query("SELECT idimmagine FROM `immagine` WHERE  prodotto_idprodotto = $id");
	 while($row = mysqli_fetch_array($result)){
        $id_immagine = $row['idimmagine'];
		$body->setContent("immagini","<img src=show.php?id=$id_immagine>");
        $body->setContent("immagine","<img src=show.php?id=$id_immagine>");
    }


	$main->setContent("body",$body->get());
	$main->close();
?>