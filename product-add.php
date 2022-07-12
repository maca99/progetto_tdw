<?php

    session_start();
    
    require "include/template2.inc.php";
    require "include/dbms.inc.php";

    $main = new Template("dhtml/blank.html");
    $body = new Template("dhtml/product-add.html");

    $nome=$_POST['nome'];
    $prezzo=$_POST['prezzo'];
    $descrizione=trim($_POST['descrizione']);


    if(isset($_POST["submit"])){

        $oid = $mysqli->query("INSERT INTO prodotto  (id_prodotto,nome,prezzo,descrizione_breve,descrizione,dettagli,id_categoria) 
        VALUES (NULL,'$nome','$prezzo','$descrizione','$descrizione','$descrizione',1)");
            
        if (!$oid) {
            echo $mysqli->error;
            $main->setContent("message", "10");
        } else {
            $main->setContent("message", "00");
        }

        /*
        //verifica se il file è stato caricato
        $result = is_uploaded_file($_FILES["userImage"]["tmp_name"]);

        //Check if the user has selected an image

        if(!$result){
            echo "Please select an image to upload.";
        }else{

            //Get the contents of the image

                $size = $_FILES['userImage']['size'];
                if($size > 2000){
                    echo"il file è troppo grande!";
                    exit();
                }
                $type= $_FILES['userImage']['type'];
                $immagine=file_get_contents($_FILES['userImage']['tmp_name']);
                $immagine=addslashes($immagine);
                
                //Insert the image into the database
                $oid = $mysqli->query("INSERT INTO immagine (immagine,prodotto_idprodotto,type) VALUES ('$image','$id_prodotto','$type')");
                if($query){
                    echo "File uploaded successfully.";
                }else{
                    echo "File upload failed.";
                } 

        }*/
    }


   

    $main->setContent("body", $body->get());
    $main->close();

?>