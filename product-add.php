<?php

    session_start();
    
    require "include/template2.inc.php";
    require "include/dbms.inc.php";
    require "include/auth.inc.php";

    $main = new Template("dhtml/blank-min.html");
    $body = new Template("dhtml/product-add.html");

   


    if(isset($_POST["submit"])){

        $nome=$_POST['nome'];
        $prezzo=$_POST['prezzo'];
        $descrizione=$_POST['descrizione'];
        $descrizione_breve=$_POST['descrizione_breve'];
        $dettagli=$_POST['dettagli'];
        $categoria=$_POST['categoria'];


        $oid = $mysqli->query("INSERT INTO prodotto  (id_prodotto,nome,prezzo,descrizione_breve,descrizione,dettagli,id_categoria) 
                VALUES (NULL,'$nome','$prezzo','$descrizione_breve','$descrizione','$dettagli',$categoria)");
        if($oid){

            $id_prodotto=mysqli_insert_id($mysqli);
            
            //verifica se il file è stato caricato
            $result = is_uploaded_file($_FILES["userImage"]["tmp_name"]);

            //Check if the user has selected an image

            if(!$result){
                $error="Please select an image to upload";
            }else{

                //Get the contents of the image

                    $size = $_FILES['userImage']['size'];
                    if($size > 16000){
                        echo"il file è troppo grande!";
                        exit();
                    }
                    $type= $_FILES['userImage']['type'];
                    $immagine=file_get_contents($_FILES['userImage']['tmp_name']);
                    $immagine=addslashes($immagine);
                    
                    //Insert the image into the database
                    $query = $mysqli->query("INSERT INTO immagine (immagine,prodotto_idprodotto,type) VALUES ('$immagine','$id_prodotto','$type')");
            }
            if($query){
                header("Location: product-list.php");
            }else{
                header("Location: product-add.php?error=$error");
            }
        }else{
            $error=$mysqli->error;
            header("Location: product-add.php?error=$error");
        }
    }
    if(isset($_GET['error'])){
        $body->setContent("error",$_GET['error']);
    }


    $main->setContent("body", $body->get());
    $main->close();

?>