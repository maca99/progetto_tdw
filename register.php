<?php
	session_start();
	require "include/dbms.inc.php";
	require "include/template2.inc.php";

	$password = (isset($_POST['password'])) ? trim($_POST['password']) : '';
	$cognome = (isset($_POST['nome'])) ? trim($_POST['nome']) : '';
	$nome = (isset($_POST['cognome'])) ? trim($_POST['cognome']) : '';
	$email = (isset($_POST['email'])) ? trim($_POST['email']) : '';
	$main=new Template('dhtml/blank-min.html');
	$body=new Template('dhtml/register.html');

	if(isset($_POST['submit'])&& $_POST['submit']== 'Register')
	{
		$errors = array();
		//verifica che i campi obbligatori siano stati compilati
		if(empty($email)){
			$errors['email']='Email non inserita.';
		}else{//controlla se l'email sia già inserita
			$oid2=$mysqli->query("SELECT * FROM utente WHERE email='".$_POST['email']."' ");
			if(mysqli_num_rows($oid2) > 0)
			{
				header("location: login.php");
			}
		}	
		

		if(empty($password)){
			$errors['password']='Password non inserita.';
		}
		if(empty($nome)){
			$errors['nome']='Nome non inserito.';
		}
		if(empty($cognome)){
			$errors['cognome']='Cognome non inserito.';
		}

		if(count($errors) > 0){
			foreach($errors as $key=>$error){
				$body->setContent($key, $error);
				$body->setContent("errors", "ert");
			}
		}else{
			//quando va tutto bene
			$oid=$mysqli->query("INSERT INTO utente ( email, password, nome , cognome)
				VALUES 
					('".$email."','".$password."','".$nome."','".$cognome."') ");
			

			/* aggiunta di altre informazioni dell'utente */

			/* salvataggio dati nella sessione */
			$_SESSION['logged'] = 1;
			$_SESSION['email']=$email;
			//header("location: index.php");
		}
	}
	$main->setContent("body",$body->get());
	$main->close();

?>