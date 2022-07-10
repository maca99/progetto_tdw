<?php
require "include/dbms.inc.php";
session_start();
    
    $product=(isset($_POST['product'])? $_POST['product']:'');
    $quantity=(isset($_POST['quantity'])? $_POST['quantity']:'');
    $color=(isset($_POST['color'])? $_POST['color']:'');
    $size=(isset($_POST['size'])? $_POST['size']:'');;

    $oid=$mysqli->query("SELECT * FROM prodotto WHERE id_prodotto=$product");
    if(mysqli_num_rows($oid)!=1){
        //errore
    }else{

        if($_POST['action']=="add"){
            if(isset($_SESSION['cart'][$product])){
                $_SESSION['cart'][$product]['quantity']=$_SESSION['cart'][$product]['quantity']+$quantity;
            }else{
                $_SESSION['cart'][$product]['id']=$product;
                $_SESSION['cart'][$product]['quantity']=$quantity;
                $_SESSION['cart'][$product]['color']=$color;
                $_SESSION['cart'][$product]['size']=$size;
            }
        }

        if($_POST['action']=="remove"){
            if(isset($_SESSION['cart'][$product]) && $_SESSION['cart'][$product]['quantity']>$quantity){
                $_SESSION['cart'][$product]['quantity']=$_SESSION['cart'][$product]['quantity']-$quantity;
            }elseif($_SESSION['cart'][$product]>$quantity){
                unset($_SESSION['cart'][$product]);
            }
        }
        header("Location: product.php?product_code=$product");
       

    }



?>