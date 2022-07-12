<?php

    require "include/dbms.inc.php";
	require "include/template2.inc.php";
    session_start();

    $main=new Template('dhtml/blank-min.html');
    $body=new Template('dhtml/login.html');

    $main->setContent("body",$body->get());
    $main->close();
?>