<?php
	session_start();
	require "include/dbms.inc.php";
	require "include/template2.inc.php";
    require "include/auth.inc.php";

    $main=new Template("dhtml/blank-min.html");
    $body=new Template("dhtml/profile.html");


    if(isset($_POST['submit'])){
        $indirizzo=mysqli_real_escape_string($mysqli,$_POST['indirizzo']);
        $citta=mysqli_real_escape_string($mysqli,$_POST['citta']);
        $paese=mysqli_real_escape_string($mysqli,$_POST['paese']);
        $cap=mysqli_real_escape_string($mysqli,$_POST['cap']);
        $telefono=mysqli_real_escape_string($mysqli,$_POST['tel']);


        $oid=$mysqli->query("UPDATE cliente 
                            SET indirizzo='$indirizzo',citta='$citta',paese='$paese',cap='$cap',telefono='$telefono'
                             WHERE username='".$_SESSION['user']['username']."'");
        if($oid){
            header("Location: index.php");
        }else{
            echo $mysqli->error;
            exit;
        }
            

        
    }


    $main->setContent("body",$body->get());
    $main->close();

?>