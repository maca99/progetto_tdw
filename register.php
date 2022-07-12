<?php
	session_start();
	require "include/dbms.inc.php";
	require "include/template2.inc.php";

	$password = (isset($_POST['password']) && strlen($_POST['pass']) > 5) ?  md5($password) : '';
	$username=(isset($_POST['username'])) ? trim($_POST['username']) : '';
	$nome = (isset($_POST['nome'])) ? trim($_POST['nome']) : '';
	$cognome = (isset($_POST['cognome'])) ? trim($_POST['cognome']) : '';


	$main=new Template('dhtml/blank-min.html');
	$body=new Template('dhtml/register.html');

	if(isset($_POST['submit'])&& $_POST['submit']== 'Register')
	{
		$errors = array();
		//verifica che i campi obbligatori siano stati compilati
		if(empty($username)){
			$errors['username']='Username non inserita.';
		}elseif(empty($password)){
			$errors['password']='Password non inserita.'
		}elseif(empty($nome) || empty($cognome)){
			$errors['']=' non inserita.'
		}else{//controlla se l'email sia già inserita
			$oid2=$mysqli->query("SELECT * FROM utente WHERE username='".$_POST['username']."' ");
			if(mysqli_num_rows($oid2) > 0)
			{
				$errors[]='Questa username è già registrata';
			}
		}	


		if(count($errors) > 0){
			foreach($errors as $key=>$error){
				$body->setContent($key, $error);
				$body->setContent("errors", "ert");
			}
		}else{
			//quando va tutto bene
			$oid=$mysqli->query("INSERT INTO utente (id_user ,username, password, nome , cognome)
				VALUES 
					(NULL, $username, $password, $nome, $cognome)");
			
			$user_id = $mysqli->insert_id();
			
			header("location: login.php");
		}
	}
	$main->setContent("body",$body->get());
	$main->close();

?>