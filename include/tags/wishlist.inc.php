<?php
    class wishlist extends taglibrary {
        
        function injectStyle(){}
        
        function icon($name,$data,$pars){
            global $mysqli;

            $number=0;
            if(isset($_SESSION['auth']) && isset($_SESSION['user'])){
                
                if($_SESSION['auth']){
                    $oid=$mysqli->query("SELECT count(*) as prodotti FROM utente  JOIN (wishlist,wishlist_has_prodotto,prodotto) 
                                                ON (utente.username=wishlist.username 
                                                AND wishlist.id_wishlist=wishlist_has_prodotto.id_wishlist 
                                                AND wishlist_has_prodotto.id_prodotto=prodotto.id_prodotto) WHERE utente.username='".$_SESSION['user']['username']."'");
                    if($oid){
                       $data=$oid->fetch_assoc(); 
                        $number=$data['prodotti'];
                    }else{
                        echo $mysqli->error;
                        exit;
                    }
                }  
            }
            return $number;
        }

        function whish_list($name,$data,$pars){
            global $mysqli;
                $main=new Template("dhtml\webarch\wish-list.html");
                $totale=0;
                $result=$mysqli->query("SELECT id_wishlist FROM wishlist WHERE wishlist.username='".$_SESSION['user']['username']."'");
                if(mysqli_num_rows($result) > 0){

                        $oid=$mysqli->query("SELECT *  FROM utente  JOIN (wishlist,wishlist_has_prodotto,prodotto) 
                                                        ON (utente.username=wishlist.username 
                                                        AND wishlist.id_wishlist=wishlist_has_prodotto.id_wishlist 
                                                        AND wishlist_has_prodotto.id_prodotto=prodotto.id_prodotto) WHERE utente.username='".$_SESSION['user']['username']."'");
                        if($oid){
                            //dati
                            while($data = $oid->fetch_assoc()){
                                $main->setContent("id_prodotto", $data['id_prodotto']);
                                $main->setContent("nome", $data['nome']);
                                $main->setContent("data", $data['data']);
                                $main->setContent("prezzo", $data['prezzo']);
                            }
                             
                        }else{
                            echo $mysqli->error;
                            exit;
                        }
                        
    
                    }
                return $main->get();

        }
    }
?>