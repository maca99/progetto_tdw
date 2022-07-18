<?php
    session_start();
    require "include/dbms.inc.php";
    require "include/template2.inc.php";
    require "include/auth.inc.php";
    

    //conferma ordine
    if(isset($_POST['conferma'])){
        if(isset($_SESSION['cart']) && isset($_POST['payment'])){
            $product=array();
            $totale=0;
            foreach($_SESSION['cart'] as $item){
                $product[$item['id']]['id']=$item['id'];
                $product[$item['id']]['quantity']=$item['quantity'];
                $oid=$mysqli->query("SELECT * FROM prodotto WHERE prodotto.id_prodotto='".$item['id']."' ");
                $data = $oid->fetch_assoc();
                $totale=$totale+($data['prezzo'] * $item['quantity']);
            }
            $oid=$mysqli->query("SELECT id_utente FROM utente WHERE username='".$_SESSION['user']['username']."'");
            $oid=$oid->fetch_assoc();
            $ordine=$mysqli->query("INSERT INTO ordine (id_ordine,id_cliente,importo,pagamento,stato)
                                        VALUES (NULL,'".$oid['id_utente']."','$totale','".$_POST['payment']."','Da spedire')");
            if(!$ordine){
                echo $mysqli->error;
                exit;
            }
            $id_ordine=$mysqli->insert_id;

            if(isset($_POST['shiping-address'])){
                //spedizione ad un indirizzo diverso
                $spedizione=$mysqli->query("INSERT INTO spedizione(id_spedizione,id_ordine,nome,cognome,email,indirizzo,citta,paese,cap,telefono,note)
                                                    VALUES (NULL,'$id_ordine','".$_POST['nome']."','".$_POST['cognome']."','".$_POST['email']."'
                                                    ,'".$_POST['indirizzo']."','".$_POST['citta']."','".$_POST['paese']."','".$_POST['cap']."'
                                                    ,'".$_POST['tel']."','".$_POST['note']."')");
                if(!$spedizione){
                    echo $mysqli->error;
                    exit;
                }
            }else{
                $result=$mysqli->query("SELECT * FROM utente,cliente WHERE utente.username='".$_SESSION['user']['username']."' AND utente.username=cliente.username");
                if(!$result){
                    echo $mysqli->error;
                    exit;
                }
                $dati=$result->fetch_assoc();
                $spedizione=$mysqli->query("INSERT INTO spedizione(id_spedizione,id_ordine,nome,cognome,email,indirizzo,citta,paese,cap,telefono,note)
                                                    VALUES (NULL,'$id_ordine','".$dati['name']."','".$dati['surname']."','".$dati['email']."'
                                                    ,'".$dati['indirizzo']."','".$dati['citta']."','".$dati['paese']."','".$dati['cap']."'
                                                    ,'".$dati['telefono']."','".$_POST['note']."')");
               if(!$spedizione){
                    echo $mysqli->error;
                    exit;
               }
            }
            foreach($product as $prodotto){
                $oid=$mysqli->query("INSERT INTO ordine_has_prodotto(id_ordine,id_prodotto,pezzi)
                                            VALUES ('$id_ordine','".$prodotto['id']."','".$prodotto['quantity']."')");
                if(!$oid){
                    echo $mysqli->error;
                    exit;
                }
            }

        }else{
            header("location: checkout.php");
        }
    }

    $main= new Template("dhtml/blank-min.html");
    $body = new Template("dhtml/checkout.html");
    $total=0;

    if(isset($_SESSION['cart'])){
        //carrello
        foreach($_SESSION['cart'] as $item){
            $id=$item['id'];
            $oid=$mysqli->query("SELECT * FROM prodotto WHERE prodotto.id_prodotto=$id ");
            $data = $oid->fetch_assoc();
            $total= $data['prezzo'] * $item['quantity'];
        }
    }
    $body->setContent("totale",$total);

    //indirizzo
    $result=$mysqli->query("SELECT * FROM utente,cliente WHERE utente.username='".$_SESSION['user']['username']."' AND utente.username=cliente.username");
    $data=$result->fetch_assoc();
    if($data){
        foreach($data as $key => $value){
            $body->setContent($key,$value);
        }
    }

    


    $main->setContent("body",$body->get());
    $main->close();
?>