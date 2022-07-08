<?php
	require "include/dbms.inc.php";
	require "include/template2.inc.php";
	include "include/tags/utility.inc.php";

	$main= new Template("dhtml/blank.html");
    $body= new Template("dhtml/product.html");
	$utility=new utility();

	$id= isset($_GET['product_code'])? $_GET['product_code'] : '';


	//informazioni sul prodotto
	$oid=$mysqli->query("SELECT * FROM prodotto,categoria WHERE prodotto.id_prodotto= $id AND prodotto.id_categoria=categoria.id_categoria ");

	
	if(mysqli_num_rows($oid) != 1){
		echo("prodotto non trovato");
		exit();
	}
	$data = $oid->fetch_assoc();
	
	
	foreach($data as $key => $value) {
		$body->setContent($key, $value);
		$main->setContent($key, $value);
	}

	//colore e grandezze
	$body->setContent("size", $utility->size($id));
	$body->setContent("color", $utility->color($id));
	


	//numero di recensioni
	$oid=$mysqli->query("SELECT COUNT(*)as num_rew ,AVG(recensione.voto) as voto FROM recensione WHERE id_prodotto= $id");
	$num=$oid->fetch_assoc();
	$body->setContent("num_rew", $num['num_rew']);

	//icone stelle valutazione
	$star = (isset($num['voto'])) ? (int)$num['voto'] : 5;
	for($i=0;$i<5;$i++){
		if($i<$star){
		   $tag="<i class='fa fa-star'></i>"; 
		}else{
			$tag="<i class='fa fa-star-o'></i>"; 
		}
		$body->setContent("stelle",$tag);
	}
	

	//numero di recensioni
	$oid=$mysqli->query("SELECT COUNT(*)as num_rew ,AVG(recensione.voto) as voto FROM recensione WHERE id_prodotto= $id");
	$num=$oid->fetch_assoc();
	$body->setContent("num_rew", $num['num_rew']);

	//icone stelle valutazione
	$star = (isset($num['voto'])) ? (int)$num['voto'] : 5;
	for($i=0;$i<5;$i++){
		if($i<$star){
		   $tag="<i class='fa fa-star'></i>"; 
		}else{
			$tag="<i class='fa fa-star-o'></i>"; 
		}
		$body->setContent("stelle",$tag);
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


	//tabella recensioni 
	$body->setContent("rating",$utility->rating($id));
	$body->setContent("reviews",$utility->reviews($id));


	$main->setContent("body",$body->get());
	$main->close();
?>