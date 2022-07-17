<?php
    session_start();
    require "include/dbms.inc.php";
    

    if(isset($_POST['action'])){

        $id = mysqli_real_escape_string($mysqli,$_POST['action']);
            
        $del = $mysqli -> query("DELETE FROM wishlist_has_prodotto WHERE id_prodotto = '".$id."'") or die(mysqli_error($mysqli));

        if($del){
            echo "<script>alert('Delete Successful.'); window.location='wishlist.php'</script>";
                    
        } else{
            echo "<script>alert('Delete Failed.');</script>";
            }   
                
        }


?>
