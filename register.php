<?php
	session_start();
	require "include/dbms.inc.php";
	require "include/template2.inc.php";


	$main=new Template('dhtml/blank-min.html');
	$body=new Template('dhtml/register.html');

	if(isset($_POST['submit'])){

		$password = (isset($_POST['password']) && strlen($_POST['password']) > 5) ?  md5($_POST['password']) : '';
		$username=(isset($_POST['username'])) ? trim($_POST['username']) : '';
		$nome = (isset($_POST['nome'])) ? trim($_POST['nome']) : '';
		$cognome = (isset($_POST['cognome'])) ? trim($_POST['cognome']) : '';

		$errors = array();
		//verifica che i campi obbligatori siano stati compilati
		if(empty($nome) || empty($cognome)){
			$errors['nome']='Nome non inserito';
		}if(empty($password)){
			$errors['password']='Password non valida';
		}if(empty($username)){
			$errors['username']='Username non inserita';
		}else{//controlla se l'email sia già inserita
			$oid=$mysqli->query("SELECT * FROM utente WHERE username= '$username'");
			if(mysqli_num_rows($oid) > 0)
			{
				$errors[]='Questa username è già registrata';
			}
		}	

		if(count($errors) > 0){
			foreach($errors as $key=>$value){
				$body->setContent($key, $value);
			}
		}else{
			//quando va tutto bene
			$oid=$mysqli->query("INSERT INTO utente (id_utente ,username, password, nome , cognome)
				VALUES 
					(NULL, '$username', '$password', '$nome', '$cognome')");
			
			if(!$oid){
				echo $mysqli->error;
				header("location: register.php");
				exit();
			}else{
				header("location: login.php");
			}
			//$user_id = $mysqli->insert_id();
			
			
		}
	}
	$main->setContent("body",$body->get());
	$main->close();

?>