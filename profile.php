<?php
    require "include/dbms.inc.php";
	require "include/template2.inc.php";
    include "include/tags/utility.inc.php";
    session_start();

	$body= new Template("dhtml/profile.html");
    $main= new Template("dhtml/blank-min.html");

    $main->setContent("body",$body->get());
    $main->close();
?>