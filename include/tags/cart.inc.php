<?php
    class cart extends taglibrary {
        
        //funzione imposrtatnte
        function injectStyle(){}

        function view($name,$data,$pars){
            global $mysqli;

                $main=new Template("dhtml\webarch\cart.html");
                

                foreach($_SESSION['cart'] as $item){

                    $body=new Template("dhtml\webarch\cart-item.html");
                    $id=$item['id'];
                    $oid=$mysqli->query("SELECT * FROM prodotto,immagine WHERE prodotto.id_prodotto=$id AND prodotto_idprodotto=$id LIMIT 1");
                    $data = $oid->fetch_assoc();
                    foreach($data as $key => $value) {
                        $body->setContent($key, $value);
                    }
                    $main->setContent("item",$body->get());
                }

                return $main->get();

        }


    }
?>