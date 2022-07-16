<?php
session_start();
    require "include/auth.inc.php";
    require "include/dbms.inc.php";
	require "include/template2.inc.php";
    

	$body= new Template("dhtml/wishlist.html");
    $main= new Template("dhtml/blank-min.html");
    
    

    

    $main->setContent("body",$body->get());
    $main->close();
?>