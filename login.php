<?php

    require "include/dbms.inc.php";
	require "include/template2.inc.php";
    session_start();

    $main=new Template('dhtml/blank-min.html');
    $body=new Template('dhtml/login.html');


    $is_invalid = false;

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $email = mysqli_real_escape_string($mysqli, $_POST["email"]);
        $password = mysqli_real_escape_string($mysqli, $_POST["password"]);

        $result = $mysqli -> query("SELECT * FROM utente WHERE email = '$email' AND `password` = '$password' ");
            
        $user = $result -> fetch_assoc();

        if($user){

            if($password == $_POST["password"]){
                
                session_start();

                $_SESSION["user_id"] = $user["idUtente"];

                header("Location:welcome.php");
                exit;

            }
        }

        $is_invalid= true;
    }




/*
    if(isset($_POST["login"])){

        if(empty($_POST["email"]) && empty($_POST["password"])){
            echo '<script>alert("Both Fields are required")</script>';
        } else {
            $email = mysqli_real_escape_string($mysqli, $_POST["email"]);
            $password = mysqli_real_escape_string($mysqli, $_POST["password"]);
            //$password = md5($password);

            $result = $mysqli -> query("SELECT * FROM utente WHERE email = '$email' AND `password` = '$password' ");
            
            $user = $result -> fetch_assoc();
            if($user) {
                if($_POST["password"]== $password){
                    
                    session_start();

                    $_SESSION["user_id"] = $user["idUtente"];
                    header("Location: welcome.php");
                    exit;
                }

            }
        }
        
    }
*/

    $main->setContent("body",$body->get());
    $main->close();
?>