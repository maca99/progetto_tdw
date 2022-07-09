<?php
session_start();
require "include/dbms.inc.php";

$product=(isset($_GET['product']))? $_GET['product']:'';
$action=(isset($_GET['action']))? $_GET['action']:'';

if(isset($product)){
    $oid=$mysqli->query("SELECT * FROM prodotto WHERE id_prodotto=$product");
    if($oid->num_rows() != 0){
        if(!isset($_SESSION['cart']['item'][$product])){
            $_SESSION['cart']['item'][$product]=
        }
    }
}


?>