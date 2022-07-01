<?php
    require "include/dbms.inc.php";
	require "include/template2.inc.php";

	$body= new Template("dhtml/index.html");
    $main= new Template("dhtml/blank-min.html");
    
    $main->setContent("body",$body->get());
    $main->close();
?>