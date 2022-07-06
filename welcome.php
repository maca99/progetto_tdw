<?php

    session_start();

    require "include/dbms.inc.php";
	require "include/template2.inc.php";
    include "include/tags/utility.inc.php";


	$body= new Template("dhtml/welcome.html");
    $main= new Template("dhtml/blank-min.html");

    if(isset($_SESSION["user_id"])){
        $uid = $_SESSION["user_id"];
        $result = $mysqli -> query("SELECT * FROM utente WHERE idUtente = $uid  ");

        while($user = $result-> fetch_assoc()){
            $body->setContent("email",$user["email"]);
        }
    } else {
        echo "<p><a href='login.php'>Log in</a></p>";
    }
    $main->setContent("body",$body->get());
    $main->close();
?>