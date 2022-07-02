<?php
    require "include/dbms.inc.php";
	require "include/template2.inc.php";
    include "include/tags/utility.inc.php";

	$body= new Template("dhtml/index-copia.html");
    $main= new Template("dhtml/blank-min.html");
    $utility=new utility();

    $body->setContent("product",$utility->product_icon(1));
    
    $main->setContent("body",$body->get());
    $main->close();
?>