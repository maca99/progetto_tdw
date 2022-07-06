<?php

require "include/dbms.inc.php";
require "include/template2.inc.php";
include "include/tags/utility.inc.php";

$main= new Template("dhtml/blank-min.html");
$utility=new utility();


$categoryId= (isset($_GET['category'])) ? trim($_GET['category']) : '';
$limit=(isset($_POST['limit'])) ? trim($_POST['limit']) : 20;
$sorted= (isset($_POST['sorted'])) ? trim($_POST['sorted']) : "Popular";

$oid=$mysqli->query("SELECT id_prodotto FROM prodotto,categoria WHERE prodotto.id_categoria=categoria.id_categoria AND categoria.id_categoria=$categoryId LIMIT $limit");


if(!$oid){
    $body = new Template("dhtml/404.html");
} else {
    $body = new Template("dhtml/store.html");

    while($row = $oid->fetch_array()){
        echo("porco dio");
    }
} 

$main->setContent("body",$body->get());
$main->close();



?>