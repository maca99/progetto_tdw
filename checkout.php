<?php

        require "include/dbms.inc.php";
        require "include/template2.inc.php";
    
        $main=new Template('dhtml/blank.html');
        $body=new Template('dhtml/checkout.html');

        $main->setContent("body",$body->get());
        $main->close();

?>