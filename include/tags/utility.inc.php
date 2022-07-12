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
            
            for($i=0;$i<5;$i++){
                if($i<$star){
                   $tag="<i class='fa fa-star'></i>"; 
                }else{
                    $tag="<i class='fa fa-star-o'></i>"; 
                }
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

            $oid=$mysqli->query("SELECT voto, AVG(recensione.voto) as recensione FROM recensione WHERE recensione.id_prodotto=$id GROUP BY recensione.voto");

            $row = $oid->fetch_assoc();
            $star = (isset($row['recensione'])) ? (int)$row['recensione'] : 5;
            $main->setContent("recensione",$star);
                       
            for($i=0;$i<5;$i++){
                if($i<$star){
                   $tag="<i class='fa fa-star'></i>"; 
                }else{
                    $tag="<i class='fa fa-star-o'></i>"; 
                }
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

            $oid=$mysqli->query("SELECT *  FROM recensione WHERE id_prodotto=$id LIMIT 3");

            if(mysqli_num_rows($oid) == 0){
                return $main->get();
            }
            while($row=$oid->fetch_assoc()){
                $main->setContent("name",$row['name']);
                $main->setContent("voto",$row['voto']);
                $main->setContent("data",$row['data']);
                $main->setContent("commento",$row['commento']);
            }


            return $main->get();
          }

          function color($id){
            global $mysqli;

            $main= new Template("dhtml/webarch/option.html");
                $oid=$mysqli->query("SELECT nome_colore AS title, color.id_color AS valore FROM prodotto_has_color ,color WHERE prodotto_has_color.id_prodotto=$id AND prodotto_has_color.id_color=color.id_color ");
                while($data=$oid->fetch_array()) {
                    $main->setContent("title", $data['title']);
                    $main->setContent("value", $data['valore']);
               }
               return $main->get();
            }
            function size($id){
                global $mysqli;

                $main= new Template("dhtml/webarch/option.html");
                $oid=$mysqli->query("SELECT misure as title,size.id_size as valore FROM prodotto_has_size,size WHERE prodotto_has_size.id_prodotto=$id AND prodotto_has_size.id_size=size.id_size");
                while($data=$oid->fetch_array()) {
                    $main->setContent("title", $data['title']);
                    $main->setContent("value", $data['valore']);
                }
                return $main->get();
            }

            function category($name,$data,$pars){
                global $mysqli;

                $main= new Template("dhtml/webarch/option.html");
                $oid=$mysqli->query("SELECT *  FROM categoria ");
                while($data=$oid->fetch_array()) {
                    $main->setContent("title", $data['nome_categoria']);
                    $main->setContent("value", $data['id_categoria']);
                }
                return $main->get();
            }


    }

?>