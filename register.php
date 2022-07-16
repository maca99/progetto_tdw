<?php
	session_start();
	require "include/dbms.inc.php";
	require "include/template2.inc.php";


	$main=new Template('dhtml/blank-min.html');
	$body=new Template('dhtml/register.html');

	if(isset($_POST['submit'])){

		$password = (isset($_POST['password']) && strlen($_POST['password']) > 5) ?  md5(md5($_POST['password'])) : '';
		$username=(isset($_POST['username'])) ?$_POST['username'] : '';
		$nome = (isset($_POST['nome'])) ? $_POST['nome'] : '';
		$cognome = (isset($_POST['cognome'])) ? $_POST['cognome'] : '';
		$email = (isset($_POST['email'])) ? $_POST['email'] : '';

		$errors = array();
		//verifica che i campi obbligatori siano stati compilati
		if(empty($nome) || empty($cognome)){
			$errors['nome']='Nome non inserito';
		}if(empty($password)){
			$errors['password']='Password non valida';
		}if(empty($username)){
			$errors['username']='Username non inserita';
		}if(empty($email)){
			$errors['email']='Email non inserita';
		}else{//controlla se l'email sia già inserita
			$oid=$mysqli->query("SELECT * FROM utente WHERE username= '$username'");
			if(mysqli_num_rows($oid) > 0)
			{
				$errors['username']='Questa username è già registrata';
			}
		}	

		if(count($errors) > 0){
			foreach($errors as $key=>$value){
				$body->setContent($key, $value);
			}
		}else{
			//quando va tutto bene
			$oid=$mysqli->query("INSERT INTO utente (id_utente ,username, password, name,email , surname)
				VALUES 
					(NULL, '$username', '$password', '$nome','$email', '$cognome')");
			
			if($oid){
				//assegno all'utente appena creato i privilegi base
				$result=$mysqli->query("INSERT INTO utente_has_gruppi(Utente_username ,Gruppi_id_gruppi)
					VALUES
						('$username','1')");
				if($result){
					header("Location:login.php");
				}else{
					echo $mysqli->error;
				}
					
			}else{
				echo $mysqli->error;
				exit();
			}
			
		}
	}
	$main->setContent("body",$body->get());
	$main->close();

?>