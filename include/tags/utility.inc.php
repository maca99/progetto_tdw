<?php

    class utility extends taglibrary {

        function dummy() {}

        
        function notify($name, $data, $pars) {

            switch($data) {

                case "00":
                    $msg = "La transazione è andata a buon fine";
                    $class = "alert alert-success";
                    break;
                case "10":
                    $msg = "Attenzione: Si è verificato un errore";
                    $class = "alert alert-danger";
                    break;
                case "11":
                    $msg = "Attenzione: l'aggioramento non è andato a buon fine!";
                    $class = "alert alert-danger";
                    break;
                default:
                    $msg = "";
                    $class = "hidden_notification";
                    break;

            }


            $result ="<div class=\"{$class}\"><button class=\"close\" data-dismiss=\"alert\"></button>{$msg}. </div>";

            return $result;

        }


        function product_icon($id){

            global $mysqli;

			$main= new Template("dhtml/prodotto_index.html");

			$oid=$mysqli->query("SELECT * FROM `prodotto` WHERE id_prodotto= $id ");

			if(mysqli_num_rows($oid) != 1){
				echo("prodotto non trovato");
				exit();
			}

			$data = $oid->fetch_assoc();
			foreach($data as $key => $value) {
				$main->setContent($key, $value);
			}

			$result=$mysqli->query("SELECT idimmagine FROM `immagine` WHERE  prodotto_idprodotto = $id LIMIT 1");
			if(mysqli_num_rows($result)!=1){
				$img="<img src='dhtml/img/product02.png'>";
                $main->setContent("immagine",$img);
				//prodotto senza immagine
				exit();
			}else{
				while($row = mysqli_fetch_array($result)){
					$tag=$row['idimmagine'];
					$img="<img src=show.php?id=$tag>";
					$main->setContent("immagine",$img);
				}
			}
		return $main->get();
        }

    }

?>