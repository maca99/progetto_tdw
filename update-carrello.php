<?php
session_start();
require "include/dbms.inc.php";

    
    $product=isset($_REQUEST['product'])? $_REQUEST['product']:"";
    $action=$_REQUEST['action'];
    $quantity=(isset($_POST['quantity'])? $_POST['quantity']:1);
    $color=(isset($_POST['color'])? $_POST['color']:'');
    $size=(isset($_POST['size'])? $_POST['size']:'');


    $oid=$mysqli->query("SELECT * FROM prodotto WHERE id_prodotto=$product");
    if(mysqli_num_rows($oid)!=1){
        //errore
    }else{

        switch($action){
            case "add":
                if(isset($_SESSION['cart'][$product]) && $_SESSION['cart'][$product]['id'] == $product){
                    $_SESSION['cart'][$product]['quantity']=$_SESSION['cart'][$product]['quantity']+$quantity;
                }else{
                    $_SESSION['cart'][$product]['id']=$product;
                    $_SESSION['cart'][$product]['quantity']=$quantity;
                    $_SESSION['cart'][$product]['color']=$color;
                    $_SESSION['cart'][$product]['size']=$size;
                }
                break;
            case "remove":
                    if(isset($_SESSION['cart'][$product]) && $_SESSION['cart'][$product]['quantity']>$quantity){
                        $_SESSION['cart'][$product]['quantity']=$_SESSION['cart'][$product]['quantity']-$quantity;
                    }elseif($_SESSION['cart'][$product]>$quantity){ 
                        unset($_SESSION['cart'][$product]); 
                    }
                    break;
            case "delete":
                    unset($_SESSION['cart'][$product]);
                    break;
        }

        header("Location: product.php?product_code=$product");
       

    }



?>