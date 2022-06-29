<?php
    require "include/dbms.inc.php";

    //post: id_prodotto,name,email,text,rating
    $id_prodotto=$_POST['id_prodotto'];
    $name = (isset($_POST['name'])) ? trim($_POST['name']) : '';
    $text = (isset($_POST['text'])) ? trim($_POST['text']) : '';
    $rating = (isset($_POST['rating'])) ? trim($_POST['rating']) : '';
    $email = (isset($_POST['email'])) ? trim($_POST['email']) : '';
    $data=now();

    if(empty($name)||empty($email)||empty($text)||empty($rating)){
        header("redirect: product.php?product_code=$id_prodotto");
    }

    $mysqli->query("INSERT INTO recensione(prodotto_idprodotto,voto,commento,data,name,email)
    VALUES ($id_prodotto,$rating,$text,$data,$name,$email)");

    
?>