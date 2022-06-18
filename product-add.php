<?php

    session_start();
    
    require "include/template2.inc.php";
    require "include/dbms.inc.php";

    $main = new Template("dhtml/blank.html");
    $body = new Template("dhtml/product-add.html");


    if (!isset($_REQUEST['step'])) {
        $_REQUEST['step'] = 0;
    }

    if(isset($_POST["submit"])){

        $b = getimagesize($_FILES["userImage"]["tmp_name"]);

        //Check if the user has selected an image

        if($b !== false){
        
            //Get the contents of the image

            $file = $_FILES['userImage']['tmp_name'];
            $image = addslashes(file_get_contents($file));
            
            //Insert the image into the database
            $oid = $mysqli->query("INSERT into immagine (immagine) VALUES ('$image')");
            if($query){
                echo "File uploaded successfully.";
            }else{
                echo "File upload failed.";
            } 
        }else{
            echo "Please select an image to upload.";
        }
    }

    if(!empty($_GET['id'])){

        //Get the image from the database
        $oid = $mysqli->query("SELECT image FROM prodotto WHERE id = {$_GET['id']}");
        
        if($res->num_rows > 0){
            $img = $res->fetch_assoc();
            
            //Render the image
            header("Content-type: image/jpg"); 
            echo $img['image']; 
        }else{
            echo 'Image not found...';
        }
    }


    switch ($_REQUEST['step']) { 
        case 0: // form emission
            
            break;
        case 1: // transaction

            $oid = $mysqli->query("INSERT INTO prodotto VALUES (
                0,
                    '{$_REQUEST['nome']}',
                    '{$_REQUEST['prezzo']}',
                    '{$_REQUEST['descrizione']}')"
                );
                
            if (!$oid) {
                $main->setContent("message", "10");
            } else {
                $main->setContent("message", "00");
            }
            break;



    }

    $main->setContent("body", $body->get());
    $main->close();

?>