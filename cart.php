<?php
session_start();
require "include/dbms.inc.php";
require "include/template2.inc.php";
include "include/tags/utility.inc.php";

    $body= new Template("dhtml/cart.html");
    $main= new Template("dhtml/blank-min.html");
    $utility=new utility();

    if(isset($_POST['remove'])){
        unset($_SESSION['cart']);
    }

    $main->setContent("body",$body->get());
    $main->close();
?>