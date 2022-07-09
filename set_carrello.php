<?php
require "include/dbms.inc.php";
session_start();
$product=1;
$_SESSION['cart'][$product]['quantity']=5;
$_SESSION['cart'][$product]['color']="giallo";
$_SESSION['cart'][$product]['size']="500x500";