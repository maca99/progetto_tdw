<?php
    session_start();
    require "include/dbms.inc.php";
	require "include/template2.inc.php";
    

   
    $main=new Template('dhtml/blank-min.html');
    $body=new Template('dhtml/login.html'); 
    if(isset($_GET['errors'])){
        $body->setContent("error",$_GET['errors']);
    }

    $main->setContent("body",$body->get());
    $main->close();
?>