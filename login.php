<?php
    require "include/dbms.inc.php";
	require "include/template2.inc.php";
    session_start();

    if(isset($_GET['errors'])){

    }
    $main=new Template('dhtml/blank-min.html');
    $body=new Template('dhtml/login.html');

    $main->setContent("body",$body->get());
    $main->close();
?>