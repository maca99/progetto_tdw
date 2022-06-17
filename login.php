<?php
    session_start();

    require "include/dbms.inc.php";
	require "include/template2.inc.php";

    $main=new Template('dhtml/blank-min.html');
    $body=new Template('dhtml/login.html');


    if(isset($_POST['login'])) {

        $email = $_POST["email"];
        $password = $_POST["password"];


        $oid=$mysqli->query("SELECT * FROM 'cliente' WHERE email='$email' AND password='$password'");
        if(mysqli_num_rows($oid)!=1){

            $_SESSION['logged'] = 1;
            $_SESSION['username']=$username;
             //header("location: /index.php");
            $errors="login effettuato";

        }else {
            $body->setContent("errors","Credenziali errate");

        }

    } else {

        $main->setContent("body",$body->get());
        $main->close();

    }

?>