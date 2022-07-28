<?php
    class cart extends taglibrary {
        
        //funzione imposrtatnte
        function injectStyle(){}

        function view($name,$data,$pars){
            global $mysqli;

                $main=new Template("dhtml\webarch\cart.html");
                $num_item=0;$num_product=0;$total=0;
                
                if(isset($_SESSION['cart'])){
                    foreach($_SESSION['cart'] as $item){
                        $body=new Template("dhtml\webarch\cart-item.html");
                        $id=$item['id'];
                        $oid=$mysqli->query("SELECT nome,prezzo FROM prodotto WHERE prodotto.id_prodotto=$id");
                        $data = $oid->fetch_assoc();

                        //dati
                        $body->setContent("id", $id);
                        $body->setContent("nome", $data['nome']);
                        $body->setContent("prezzo", $data['prezzo']);
                        $body->setContent("quantity",$item['quantity']);

                        $img_query=$mysqli->query("SELECT idimmagine FROM immagine WHERE prodotto_idprodotto=$id LIMIT 1");
                        //immagine
                        $data_img=$img_query->fetch_assoc();
                        if(isset($data_img['idimmagine'])){
                            $tag=$data_img['idimmagine'];
                            $img="<img src=show.php?id=$tag>";
                            $body->setContent("immagine", $img);
                        }else{
                            $img="<img src='dhtml/img/not_found.png'>";
                            $body->setContent("immagine",$img);
                        }
                        

                        $total=$total+($item['quantity']*$data['prezzo']);
                        $num_product=$num_product+$item['quantity'];
                        $num_item=$num_item+1;
                        $main->setContent("item",$body->get());
                    }   
                } 
                $main->setContent("total",$total);
                $main->setContent("num_product",$num_product);
                $main->setContent("num_item",$num_item);
                return $main->get();
        }

        function cart_list($name,$data,$pars){
            global $mysqli;
                $main=new Template("dhtml\webarch\product-table.html");
                $totale=0;
                if(isset($_SESSION['cart'])){
                    foreach($_SESSION['cart'] as $item){
                        $id=$item['id'];
                        $oid=$mysqli->query("SELECT nome,prezzo FROM prodotto WHERE prodotto.id_prodotto=$id");
                        $data = $oid->fetch_assoc();

                        //dati
                        $main->setContent("nome", $data['nome']);
                        $main->setContent("prezzo", $data['prezzo']);
                        $main->setContent("quantity",$item['quantity']);


                        $img=$mysqli->query("SELECT * FROM immagine WHERE prodotto_idprodotto='".$id."' LIMIT 1");
                        if(mysqli_num_rows($img)!=1){
                            $main->setContent("immagine","<img width='100' height='100' src='dhtml/img/not_found.png'>");
                        }else{
                            $res=mysqli_fetch_array($img);
                            $tag=$res['idimmagine'];
                            $main->setContent("immagine","<img width='100' height='100' src=show.php?id=".$tag.">");
                        }

                        $totale=$totale+($item['quantity']*$data['prezzo']);
                    }
                }
                $main->setContent("totale",$totale);
                return $main->get();

        }
        
        function checkout_list($name,$data,$pars){

            global $mysqli;

                $main=new Template("dhtml\webarch\product-checkout.html");
            
                if(isset($_SESSION['cart'])){
                    foreach($_SESSION['cart'] as $item){
                        $id=$item['id'];
                        $oid=$mysqli->query("SELECT * FROM prodotto WHERE prodotto.id_prodotto=$id ");
                        $data = $oid->fetch_assoc();
                        $total= $data['prezzo'] * $item['quantity'];

                        //dati
                        $main->setContent("id", $id);
                        $main->setContent("nome", $data['nome']);
                        $main->setContent("totale", $total);
                        $main->setContent("quantity",$item['quantity']);

                    }
                }
                return $main->get();  

        }
    }

?>