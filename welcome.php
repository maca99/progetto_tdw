<?php
    session_start(); 
  
    require "include/template2.inc.php";
    require "include/dbms.inc.php";
    require "include/auth.inc.php";


    
    $result = $mysqli->query("SELECT gruppi.idgruppi FROM utente LEFT JOIN (utente_has_gruppi,gruppi) 
    ON(utente.username=utente_has_gruppi.Utente_username AND utente_has_gruppi.Gruppi_id_gruppi=gruppi.idgruppi)
    WHERE utente.username='".$_SESSION['user']['username']."'");
    if(!$result){
        $mysqli->error;
        exit;
    }
    while($data=$result->fetch_assoc()){
        $type=$data['idgruppi'];
    }

   if(!$type == '1'){
        $main = new Template("dhtml/blank-min.html");
        $body = new Template("dhtml/welcome.html");
   }else{
        $main = new Template("dhtml/admin-panel.html");
        $body = new Template("dhtml/welcome.html");
   }

    $body->setContent("email",$_SESSION['user']['email']);


    $main->setContent("body", $body->get());
    $main->close();
?>