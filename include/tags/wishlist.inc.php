<?php
    class wishlist extends taglibrary {
        
        function injectStyle(){}
        
        function icon($name,$data,$pars){
            global $mysqli;

            $number=0;
            if(isset($_SESSION['auth']) && isset($_SESSION['user'])){
                
                if($_SESSION['auth']){
                    $user=$_SESSION['user']['username'];
                    $oid=$mysqli->query("SELECT COUNT(*) as prodotti FROM utente RIGHT JOIN (wishlist,wishlist_has_prodotto,prodotto) 
                                                ON (utente.id_utente=wishlist.id_cliente 
                                                AND wishlist.id_wishlist=wishlist_has_prodotto.id_wishlist 
                                                AND wishlist_has_prodotto.id_prodotto=prodotto.id_prodotto) 
                                                WHERE utente.username='$user'");
                    
                    $data=$oid->fetch_assoc();
                    $number=$data['prodotti'];
                }  
            }
            return $number;
        }

        function whish_list($name,$data,$pars){
            global $mysqli;
                $main=new Template("dhtml\webarch\product-table.html");
                $totale=0;
                $result=$mysqli->query("SELECT * FROM  whishlist WHERE utente.id_utente=whishlist.id_utente");
                if(mysqsli_num_rows($result) > 0){

                        $oid=$mysqli->query("SELECT nome,prezzo,data FROM whishlist 
                                                    LEFT JOIN (whishlist_has_prodotto,prodotto) 
                                                    ON (whishlist.id_whishlist=whishlist_has_prodotto.id_whishlist
                                                    AND whishlist_has_prodotto.id_prodotto=prodotto.id_prodotto) WHERE prodotto.id_prodotto=$id");
                        $oid = $oid->fetch_assoc();
    
                        //dati
                        $main->setContent("nome", $data['nome']);
                        $main->setContent("prezzo", $data['prezzo']);
                        $main->setContent("quantity",$item['quantity']);
    
                        $totale=$totale+($item['quantity']*$data['prezzo']);
                    }
                $main->setContent("totale",$totale);
                return $main->get();

        }
    }
?>