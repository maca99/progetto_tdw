<?php
    require "include/dbms.inc.php";
	require "include/template2.inc.php";
    include "include/tags/utility.inc.php";

	$body= new Template("dhtml/product-list.html");
    $main= new Template("dhtml/blank-min.html");
    $utility=new utility();

    $result=$mysqli->query("SELECT id_prodotto,nome FROM prodotto");
    while($row=mysqli_fetch_array($result)){
        $body->setContent("product",$row['nome']);
        $body->setContent("id_prodotto",$row['id_prodotto']);
    }

    if(isset($_POST['id_prodotto'])){

    $id = mysqli_real_escape_string($mysqli,$_POST['id_prodotto']);

    $del = $mysqli -> query("DELETE FROM prodotto WHERE id_prodotto = '".$id."'") or die(mysqli_error($mysqli));
    if($del){
        echo "deleted";
    } else{
        echo "error";
    }
    }
    $main->setContent("body",$body->get());
    $main->close();
?>