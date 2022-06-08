<?php

    session_start();
    
    require "include/template2.inc.php";
    require "include/dbms.inc.php";
    require "include/auth.inc.php";


    if (!isset($_REQUEST['step'])) {
        $_REQUEST['step'] = 0;
    }

    $form = new Template("electro/dtml/product-add.html");

    switch ($_REQUEST['step']) { 
        case 0: // form emission
            
            break;
        case 1: // transaction

            $oid = $mysqli->query("INSERT INTO news VALUES (
                    NULL,
                    '{$_SESSION['user']['username']}',
                    '{$_REQUEST['nome']}',
                    '{$_REQUEST['prezzo']}',
                    '{$_REQUEST['descrizione_breve']}',
                    '{$_REQUEST['descrizione']}',
                    '{$_REQUEST['dettagli']}')
                ");
            if (!$oid) {
                $main->setContent("message", "10");
            } else {
                $main->setContent("message", "00");
            }

            break;



    }



    $main->setContent("body", $form->get());
    $main->close();

?>