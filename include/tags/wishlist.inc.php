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
                                                ON (utente.username=wishlist.username)
                                                AND wishlist.id_wishlist=wishlist_has_prodotto.id_wishlist 
                                                AND wishlist_has_prodotto.id_prodotto=prodotto.id_prodotto) 
                                                WHERE utente.username='$user'");
                    if($oid != null){
                       $data=$oid->fetch_assoc(); 
                       $number=$data['prodotti'];
                    }
                }  
            }
            return $number;
        }

        function whish_list($name,$data,$pars){
            global $mysqli;
                $main=new Template("dhtml\webarch\product-table.html");
                $totale=0;
                $result=$mysqli->query("SELECT id_wishlist FROM wishlist WHERE wishlist.username='".$_SESSION['user']['username']."'");
                if(mysqli_num_rows($result) > 0){

                        $oid=$mysqli->query("SELECT * FROM wishlist LEFT JOIN (wishlist_has_prodotto,prodotto) ON (wishlist.id_wishlist=wishlist_has_prodotto.id_wishlist AND wishlist_has_prodotto.id_prodotto=prodotto.id_prodotto)");
                        $data = $oid->fetch_assoc();
                        //dati
                        $main->setContent("nome", $data['nome']);
                        $main->setContent("prezzo", $data['prezzo']);
    
                    }
                return $main->get();

        }
    }
?>