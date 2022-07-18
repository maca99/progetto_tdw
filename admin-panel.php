
<?php

    session_start();
    require "include/dbms.inc.php";
	require "include/template2.inc.php";
    require "include/auth.inc.php";
    include "include/tags/utility.inc.php";


    $main= new Template("dhtml/admin-panel.html");
    $utility=new utility();

    $user = $_SESSION['user']['username'];

    $result = $mysqli ->query("SELECT Gruppi_id_gruppi FROM utente_has_gruppi WHERE utente_has_gruppi.Utente_username = '".$_SESSION['user']['username']."' ");
    while($row = mysqli_fetch_array($result)){
        $uid = $row["Gruppi_id_gruppi"];
        
    if($uid == 1){
        header("Location:index.php");
    }
    }


    $main->close();
?>