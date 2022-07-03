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

			$main= new Template("dhtml/prodotto_icon.html");

			$oid=$mysqli->query("SELECT * FROM prodotto,categoria WHERE prodotto.id_prodotto=$id AND prodotto.id_categoria=categoria.id_categoria");

			if(mysqli_num_rows($oid) != 1){
				echo("prodotto non trovato");
				exit();
			}
            //dati prodotto
			$data = $oid->fetch_assoc();
			foreach($data as $key => $value) {
				$main->setContent($key, $value);
			}

            //recensioni 
            $oid=$mysqli->query("SELECT AVG(recensione.voto) as recensione FROM prodotto,recensione WHERE prodotto.id_prodotto=$id AND prodotto.id_prodotto=recensione.id_prodotto");

            $row = $oid->fetch_assoc();
            $star = (isset($row['recensione'])) ? $row['recensione'] : 5;
            
            for($i=0;$i<$star;$i++){
                $tag="<i class='fa fa-star'></i>";
                $main->setContent("recensione",$tag);
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
        function product_widget($id){
            global $mysqli;
    
                $main= new Template("dhtml/prodotto_widget.html");
    
                $oid=$mysqli->query("SELECT * FROM prodotto,categoria WHERE prodotto.id_prodotto=$id AND prodotto.id_categoria=categoria.id_categoria");
    
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

        function rating($id){
            global $mysqli;

            $main= new Template("dhtml/rating_table.html");

            $oid=$mysqli->query("SELECT voto, COUNT(*) as numero FROM recensione WHERE recensione.id_prodotto=1 GROUP BY recensione.voto");

            $row = $oid->fetch_assoc();
            $star = (isset($row['recensione'])) ? (int) $row['recensione'] : 5;
            $main->setContent("recensione",$star);
                       
            for($i=0;$i<$star;$i++){
                $tag="<i class='fa fa-star'></i>";
                $main->setContent("stelle",$tag);
            }

            $oid=$mysqli->query("SELECT voto, COUNT(*) as numero FROM recensione WHERE recensione.id_prodotto=$id GROUP BY recensione.voto ");

            $rating = array();
            while($row=mysqli_fetch_assoc($oid)){
                $rating[$row['voto']]=$row['numero'];
            }

            $conta1 = (isset($rating[1])) ? $rating[1] : 0;
            $conta2 = (isset($rating[2])) ? $rating[2] : 0;
            $conta3 = (isset($rating[3])) ? $rating[3] : 0;
            $conta4 = (isset($rating[4])) ? $rating[4] : 0;
            $conta5 = (isset($rating[5])) ? $rating[5] : 0;
            $main->setContent("conta1",$conta1);
            $main->setContent("conta2",$conta2);
            $main->setContent("conta3",$conta3);
            $main->setContent("conta4",$conta4);
            $main->setContent("conta5",$conta5);


            return $main->get();
        }



          function reviews($id){

            global $mysqli;

            $main= new Template("dhtml/reviews_table.html");

            $oid=$mysqli->query("SELECT COUNT(ALL *) as numero, voto FROM recensione WHERE recensione.id_prodotto=1 GROUP BY recensione.voto");



            /*
            $i=0;
	        while($i<$star){
		        $tag="<i class='fa fa-star'></i>";
		        $body->setContent("star",$tag);	
		        $i++;
	        }
	        $body->setContent("recensione",$i);*/

	        //numero recensioni per stella

          }

    }

?>