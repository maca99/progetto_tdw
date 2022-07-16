<?php
    session_start();
    require "include/dbms.inc.php";
	require "include/template2.inc.php";
    include "include/tags/utility.inc.php";
    

	$body= new Template("dhtml/profile.html");
    $main= new Template("dhtml/blank-min.html");

    $main->setContent("body",$body->get());
    $main->close();
?>