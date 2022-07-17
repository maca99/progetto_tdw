<?php
    session_start();
    require "include/auth.inc.php";
    require "include/dbms.inc.php";
	require "include/template2.inc.php";

    $product=isset($_REQUEST['product'])? $_REQUEST['product']:"";
    $action=$_REQUEST['action'];

    if(isset($_SESSION['auth']) && $_SESSION['auth']){
         $oid=$mysqli->query("SELECT * FROM prodotto WHERE id_prodotto=$product");
        if(mysqli_num_rows($oid)!=1){

        } else{

        switch($action){
            case "add":

                $wid=$mysqli->query("SELECT * FROM wishlist WHERE username='".$_SESSION['user']['username']."'");
                if(!$wid){
                    echo $_SESSION['auth']['username'];
                    echo $mysqli->error;
                    exit;
                }
                $row=mysqli_fetch_array($wid);
                $id_wish=$row['id_wishlist'];
                $result= $mysqli->query("INSERT INTO wishlist_has_prodotto (id_wishlist,id_prodotto) VALUES ($id_wish,$product) ");
                break;
            case "remove":
                if(isset($_POST['id_prodotto'])){

                    $id = mysqli_real_escape_string($mysqli,$_POST['id_prodotto']);
                
                    $del = $mysqli -> query("DELETE FROM wishlist_has_prodotto WHERE id_prodotto = '".$id."'") or die(mysqli_error($mysqli));
                }
                break;
        }
    }
   
}
    header("Location: product.php?product_code=$product");

?>