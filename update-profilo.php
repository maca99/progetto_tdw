<?php
	session_start();
	require "include/dbms.inc.php";
	require "include/template2.inc.php";
    require "include/auth.inc.php";

    $main=new Template("dhtml/blank-min.html");
    $body=new Template("dhtml/profile.html");

    if(isset($_POST['submit'])){
        $oid=$mysqli->query("UPDATE cliente 
                            SET  indirizzo='".$_POST['inidrizzo']."',citta='".$_POST['citta']."',paese='".$_POST['paese']."',cap='".$_POST['cap']."',telefono='".$_POST['telefono']."'  
                            WHERE cliente.username='".$_SESSION['user']['username']."'");
        if($oid){
            header("Location: index.php");
        }
    }


    $main->setContent("body",$body->get());
    $main->close();

?>