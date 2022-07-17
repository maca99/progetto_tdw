<?php
    session_start();
    require "include/auth.inc.php";
    require "include/dbms.inc.php";
	require "include/template2.inc.php";

    $product=isset($_REQUEST['product'])? $_REQUEST['product']:"";
    $action=$_REQUEST['action'];

    $oid=$mysqli->query("SELECT * FROM prodotto WHERE id_prodotto=$product");
    if(mysqli_num_rows($oid)!=1){

    } else{

    switch($action){
        case "add":

            $wid=$mysqli->query("SELECT id_wishlist FROM wishlist WHERE wishlist.username='".$_SESSION['auth']['username']."'");
            while($row=mysqli_fetch_array($wid)){
                $new_wish=$row['id_wishlist'];
            }

            $result= $mysqli->query("INSERT INTO wishlist_has_prodotto (id_wishlist,id_prodotto) VALUES ($new_wish,$product) ");
            break;
        case "remove":
            if(isset($_POST['id_prodotto'])){

                $id = mysqli_real_escape_string($mysqli,$_POST['id_prodotto']);
            
                $del = $mysqli -> query("DELETE FROM wishlist_has_prodotto WHERE id_prodotto = '".$id."'") or die(mysqli_error($mysqli));
            }
            break;
    }
}
    header("Location: product.php?product_code=$product");
?>
