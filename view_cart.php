<?php
session_start();
 foreach($_SESSION['cart'] as $product){
    echo ($product['quantity']."<br>");
    echo($product['color']);

}

?>