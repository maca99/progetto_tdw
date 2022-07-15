<?php
    session_start();
    require "include/template2.inc.php";
    require "include/dbms.inc.php";
    require "include/auth.inc.php";

    $main = new Template("dhtml/blank-min.html");
    $body = new Template("dhtml/welcome.html");

    $body->setContent("email",$_SESSION['user']['email']);

    $main->setContent("body", $body->get());
    $main->close();
?>