<?php
    session_start(); 
  
    require "include/template2.inc.php";
    require "include/dbms.inc.php";
    require "include/auth.inc.php";

    $main = new Template("dhtml/blank-min.html");
    $body = new Template("dhtml/welcome.html");
    
    $result = $mysqli->query("
    SELECT DISTINCT script FROM utente LEFT JOIN (utente_has_gruppi,gruppi,gruppi_has_servizi,servizi) 
    ON(utente.username=utente_has_gruppi.Utente_username 
    AND utente_has_gruppi.Gruppi_id_gruppi=gruppi_has_servizi.gruppi_idgruppi 
    AND gruppi_has_servizi.servizi_idservizi=servizi.idservizi) WHERE utente.username='".$_SESSION['user']['username']."'");
    $result->fetch_assoc();

    foreach($result as $script){
        echo  $script['script'];
        echo "<br>";
    }

    $body->setContent("email",$_SESSION['user']['email']);


    $main->setContent("body", $body->get());
    $main->close();
?>