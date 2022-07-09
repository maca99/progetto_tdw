<?php
session_start();
 foreach($_SESSION['cart'] as $product){
    echo $product['quantity'];
    echo $product['color'];
}

?>