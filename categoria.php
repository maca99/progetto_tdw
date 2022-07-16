<?php

require "include/dbms.inc.php";
require "include/template2.inc.php";
include "include/tags/utility.inc.php";
session_start();

$main= new Template("dhtml/blank-min.html");

$body = new Template("dhtml/store.html");
$utility=new utility();


$category= (isset($_GET['category'])) ? trim($_GET['category']) : '';
$limit=(isset($_POST['limit'])) ? trim($_POST['limit']) : 20;
//$sorted= (isset($_POST['sorted'])) ? trim($_POST['sorted']) : "Popular";

$oid=$mysqli->query("SELECT id_prodotto FROM prodotto,categoria WHERE prodotto.id_categoria=categoria.id_categoria AND categoria.id_categoria=$category ");

while($row = $oid->fetch_array()){
    $body->setContent("product",$utility->product_icon($row["id_prodotto"]));
}

$main->setContent("body",$body->get());
$main->close();



?>