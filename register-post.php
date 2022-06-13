<?php

	session_start();
	require "include/dbms.inc.php";
	require "include/template2.inc.php";

	$username = (isset($_POST['username'])) ? trim($_POST['username']) : '';
	$password = (isset($_POST['password'])) ? trim($_POST['password']) : '';
	$first_name = (isset($_POST['first_name'])) ? trim($_POST['first_name']) : '';
	$last_name = (isset($_POST['last_name'])) ? trim($_POST['last_name']) : '';
	$email = (isset($_POST['email'])) ? trim($_POST['email']) : '';

	if(isset($_POST['submit'])&& $_POST['submit']== 'Register')
	{
		$errors = array();
		//verifica che i campi obbligatori siano stati compilati
		if(empty($username)){
			$errors[]='Username non inserita.';
		}

		//controlla se il nome utente è già registrato
		$oid=$mysqli->query("SELECT username FROM utente WHERE username = $username");
		if(mysqli_num_rows($oid)>0)
		{
			$errors[]='This username already exists';
			$username='';
		}
		mysqli_free_result($oid);

		if(empty($password)){
			$errors[]='Password non inserita.';
		}
		if(empty($first_name)){
			$errors[]='Nome non inserito.';
		}
		if(empty($last_name)){
			$errors[]='Cognome non inserito.';
		}
		if(empty($email)){
			$errors[]='Email non inserita.';
		}

		if(count($errors) > 0) {
			//quando si è verificato almeno un errore
		}else{
			//quando va tutto bene

			$oid=$mysqli->query("INSERT INTO utente (id_user ,username, password, first_name , last_name)
				VALUES 
					(NULL, $username, $password, $first_name, $last_name)");
			
			$user_id = $mysqli->insert_id();

			/* aggiunta di altre informazioni dell'utente */



			/* salvataggio dati nella sessione */
			$_SESSION['logged'] = 1;
			$_SESSION['username']=$username;


		}
	}
?>