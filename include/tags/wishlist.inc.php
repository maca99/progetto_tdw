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
    }
?>