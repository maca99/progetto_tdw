<?php
    session_start();

        
    require "include/template2.inc.php";
    require "include/dbms.inc.php";
    //require "include/auth.inc.php";

    
    if(isset($_POST['submit'])){
        $prodotto=$_POST['id_prodotto'];
        $nome=$_POST['nome'];
        $prezzo=$_POST['prezzo'];
        $descrizione=$_POST['descrizione'];
        $descrizione_breve=$_POST['descrizione_breve'];
        $dettagli=$_POST['dettagli'];
        $categoria=$_POST['categoria'];
        $oid=$mysqli->query("UPDATE prodotto SET nome='".$nome."', prezzo='".$prezzo."', 
                            descrizione='".$descrizione."', descrizione_breve='".$descrizione_breve."', 
                            dettagli='".$dettagli."', id_categoria='".$categoria."'
                            WHERE id_prodotto='".$prodotto."' ");
                   
                            
        //aggiunta immagine
        $result = is_uploaded_file($_FILES["userImage"]["tmp_name"]);

        //Check if the user has selected an image

        if($result){
            //Get the contents of the image

                $size = $_FILES['userImage']['size'];
                if($size > 100000){
                    echo"il file è troppo grande!";
                    exit();
                }
                $type= $_FILES['userImage']['type'];
                $immagine=file_get_contents($_FILES['userImage']['tmp_name']);
                $immagine=addslashes($immagine);
                
                //Insert the image into the database
                $query = $mysqli->query("INSERT INTO immagine (immagine,prodotto_idprodotto,type) VALUES ('$immagine','$prodotto','$type')");
        }

        header("location: product-list.php");

    }else {
        $product=$_REQUEST['product_code'];
        $body=new Template("dhtml/product-update.html");
        $main = new Template("dhtml/admin-panel.html");

        //categoria
        $option= new Template("dhtml/webarch/option.html");
        $oid=$mysqli->query("SELECT *  FROM categoria ");
        $oid2=$mysqli->query("SELECT categoria.id_categoria as categoria FROM prodotto,categoria WHERE prodotto.id_prodotto='".$product."' AND prodotto.id_categoria=categoria.id_categoria");
        $selected=$oid2->fetch_assoc();
        while($data=$oid->fetch_array()) { 
            $option->setContent("value", $data['id_categoria']);
            $option->setContent("title", $data['nome_categoria']);
            //aggiunge selezionata la categoria del prodotto
            if($selected['categoria'] == $data['id_categoria'] ){
                $option->setContent("selected","selected");
            }
        }
        $body->setContent("categoria",$option->get());

        //campi
        $oid=$mysqli->query("SELECT * FROM prodotto WHERE prodotto.id_prodotto='".$product."'");
        if(mysqli_num_rows($oid) != 1){
            echo("prodotto non trovato");
            exit();
        }
        //dati prodotto
        $data = $oid->fetch_assoc();
        foreach($data as $key => $value) {
            $body->setContent($key, $value);
        }



        $main->setContent("body", $body->get());
        $main->close();
    }

?>