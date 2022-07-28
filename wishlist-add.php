<?php
session_start();
    require "include/dbms.inc.php";
    require "include/auth.inc.php";
    
    $product=isset($_REQUEST['product_code'])? $_REQUEST['product_code']:"";


    $oid=$mysqli->query("SELECT * FROM prodotto WHERE id_prodotto=$product");
    if(mysqli_num_rows($oid)!=1){
    } else{

        $wid=$mysqli->query("SELECT id_wishlist FROM wishlist WHERE wishlist.username='".$_SESSION['user']['username']."'");
        while($row=mysqli_fetch_array($wid)){
            $new_wish=$row['id_wishlist'];
        }

        $result= $mysqli->query("INSERT INTO wishlist_has_prodotto (id_wishlist,id_prodotto) VALUES ($new_wish,$product) ");
    }
    
    header("Location: wishlist.php");
?>