<?php
    require "include/auth.inc.php";
    require "include/dbms.inc.php";
	require "include/template2.inc.php";
    include "include/tags/utility.inc.php";
    session_start();

	$body= new Template("dhtml/wishlist.html");
    $main= new Template("dhtml/blank-min.html");
    $utility=new utility();

    $main->setContent("body",$body->get());
    $main->close();
?>