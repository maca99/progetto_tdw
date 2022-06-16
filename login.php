<?php
    session_start();

    require "include/dbms.inc.php";
	require "include/template2.inc.php";

    $errorMsg="";

    if(isset($_POST['login'])) {

        $email = $_POST["email"];
        $username = $_POST["username"];
        $password = $_POST["password"];


        $oid=$mysqli->query("SELECT * FROM  WHERE email='$email' AND assword='$password'");
        $result=mysqli_query($mysqli,$oid);
        $conta=mysqli_num_rows($result);

        if($conta>=1){
            session_start();
            $_SESSION['logged'] = 1;
            $_SESSION['username']=$username;
            header("Location: /index.php");

        } else {

            echo "Identificazione non riuscita: nome utente o password errati <br />";
            echo "Torna a pagina di <a href=\"login.htm\">login</a>";
        
        }

    } else {
    
        $main=new Template('dhtml/blank-min.html');
        $body=new Template('dhtml/login.html');
        $main->setContent("body",$body->get());
        $main->close();

    }

?>