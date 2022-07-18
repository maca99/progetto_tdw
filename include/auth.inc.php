<?php

    DEFINE('ERROR_SCRIPT_PERMISSION', 100);
    DEFINE('ERROR_USER_NOT_LOGGED', 200);
    DEFINE('ERROR_OWNERSHIP', 200);

    function crypto($pass) {

        return md5(md5($pass));

    }

    function isOwner($resource, $key = "id") {

        global $mysqli;

        $oid = $mysqli->query("
            SELECT owner_username 
            FROM {$resource} 
            WHERE {$key} = '{$_REQUEST[$key]}'");
        if (!$oid) {
            // error
        }
        
        $data = $oid->fetch_assoc();

        if ($data['owner_username'] != $_SESSION['user']['username']) {

            Header("Location: error.php?code=".ERROR_OWNERSHIP);
            exit;

        }

    }

    if (isset($_POST['username']) and isset($_POST['password'])) {

        $username=$_POST['username'];
        $password=crypto($_POST['password']);

        $oid = $mysqli->query("
            SELECT name,surname,username,email
            FROM utente
            WHERE username = '".$_POST['username']."'
            AND password = '".crypto($_POST['password'])."'");


        if (!$oid) {
            trigger_error("Generic error, level 21", E_USER_ERROR);
        } 

        if ($oid->num_rows > 0) {
            $user = $oid->fetch_assoc();
            $_SESSION['auth'] = true;
            $_SESSION['user'] = $user;
        
            //prende gli script che il gruppo dell'utente può vedere
            $result = $mysqli->query("
            SELECT DISTINCT script FROM utente LEFT JOIN (utente_has_gruppi,gruppi,gruppi_has_servizi,servizi) 
            ON(utente.username=utente_has_gruppi.Utente_username 
            AND utente_has_gruppi.Gruppi_id_gruppi=gruppi.idgruppi
            AND gruppi.idgruppi= gruppi_has_servizi.gruppi_idgruppi 
            AND gruppi_has_servizi.servizi_idservizi=servizi.idservizi) 
            WHERE utente.username='".$_SESSION['user']['username']."'");
            
            if (!$result) {
                trigger_error("Generic error, level 40", E_USER_ERROR);
            }
            
            if(mysqli_num_rows($result) == 1){
              header("Location:login.php?error");
                exit;
            }
            $scripts=array();
            while($data=$result->fetch_assoc()){
                $scripts[$data['script']]=true;
            }
            

            
            $_SESSION['user']['script'] = $scripts;
        
            if (isset($_SESSION['referrer'])) {
                $referrer = $_SESSION['referrer'];
                unset($_SESSION['referrer']);
                Header("Location: {$referrer}");
                exit;
            }
        
        } else {
            Header("Location: login.php");
            echo $mysqli->error;
            exit();
        }

    } else {
        if (!isset($_SESSION['auth'])) {
            $_SESSION['referrer'] = basename($_SERVER['SCRIPT_NAME']);
            Header("Location: login.php?not_auth");
            
            exit;
        } else {

        }
    }

    // user is logged
    if (!isset($_SESSION['user']['script'][basename($_SERVER['SCRIPT_NAME'])] )) {
        if(!$_SESSION['user']['script'][basename($_SERVER['SCRIPT_NAME'])]){
          //controlla se l'utente ha i permessi per quella pagina
            Header("Location: error.php?code=".ERROR_SCRIPT_PERMISSION);
            exit;  
        }
        
    }

?>