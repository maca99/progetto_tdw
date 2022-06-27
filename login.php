<?php
    session_start();

    require "include/dbms.inc.php";
	require "include/template2.inc.php";

    $main=new Template('dhtml/blank-min.html');
    $body=new Template('dhtml/login.html');


    if(isset($_POST['submit']) && $_POST['submit']=='register' ) {

        $email = $_POST["email"];
        $password = $_POST["password"];


        $result=$mysqli->query("SELECT * FROM utente WHERE email='".$_POST['email']."' AND password='".$_POST['password']."' ");
        if(mysqli_num_rows($result) != 1){
           $body->setContent("errors","Credenziali errate");
        }else {
            $_SESSION['logged'] = 1;
            //$_SESSION['username']=$username;
            
            $body->setContent("errors","sei loggato");
           // header("location: dhtml\product.html");
        }

    } 

    $main->setContent("body",$body->get());
    $main->close();


?>