<?php
    session_start();

        
    require "include/template2.inc.php";
    require "include/dbms.inc.php";
    require "include/auth.inc.php";

    $body=new Template("dhtml/product-update.html");
    $main = new Template("dhtml/admin-panel.html");


    $main->setContent("body", $body->get());
    $main->close();
?>