<?php
    class cart extends taglibrary {
        
        //funzione imposrtatnte
        function injectStyle(){}

        function view($name,$data,$pars){
            global $mysqli;

                $main=new Template("dhtml\webarch\cart.html");
                $num_item=0;$num_product=0;
                
                if(isset($_SESSION['cart'])){
                    foreach($_SESSION['cart'] as $item){
                        $body=new Template("dhtml\webarch\cart-item.html");
                        $id=$item['id'];
                        $oid=$mysqli->query("SELECT nome,prezzo,idimmagine FROM prodotto,immagine WHERE prodotto.id_prodotto=$id AND prodotto_idprodotto=$id LIMIT 1");
                        $data = $oid->fetch_assoc();

                        //dati
                        $body->setContent("nome", $data['nome']);
                        $body->setContent("prezzo", $data['prezzo']);
                        $body->setContent("quantity",$item['quantity']);

                        //immagine
                        $tag=$data['idimmagine'];
                        $img="<img src=show.php?id=$tag>";
                        $body->setContent("immagine", $img);

                        $num_product=$num_product+$item['quantity'];
                        $num_item=$num_item+1;
                        $main->setContent("item",$body->get());
                    }   
                } 
                $main->setContent("num_product",$num_product);
                $main->setContent("num_item",$num_item);
                return $main->get();

        }


    }
?>