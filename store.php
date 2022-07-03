<?php
    require "include/dbms.inc.php";
	require "include/template2.inc.php";
    include "include/tags/utility.inc.php";

    $body= new Template("dhtml/store.html");
    $main= new Template("dhtml/blank-min.html");

    


    $main->setContent("body",$body->get());
    $main->close();
?>