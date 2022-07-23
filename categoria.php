<?php

require "include/dbms.inc.php";
require "include/template2.inc.php";
include "include/tags/utility.inc.php";
session_start();

$main= new Template("dhtml/blank-min.html");

$body = new Template("dhtml/store.html");
$utility=new utility();


$category= (isset($_GET['category'])) ? trim($_GET['category']) : '';

$items = 20;

if(isset($_GET['page'])? $_GET['page'] : ''){
    $page=$_GET['page'];
} else {
    $page = 1;
}

$offset = ($page-1)*$items;

$oid=$mysqli->query("SELECT id_prodotto FROM prodotto,categoria WHERE prodotto.id_categoria=categoria.id_categoria AND categoria.id_categoria=$category LIMIT $offset,$items ");

while($row = $oid->fetch_array()){
    $body->setContent("product",$utility->product_icon($row["id_prodotto"]));
}

$body->setContent("category",$category);

$main->setContent("body",$body->get());
$main->close();



?>