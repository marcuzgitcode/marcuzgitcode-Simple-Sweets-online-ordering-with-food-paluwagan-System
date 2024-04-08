<?php

    require ('db.php');
    if(isset($_POST['update_cart'])){
        $myid=$_POST['codex'];
        $quantity = $_POST['quantity'];
        $proid = $_POST['prod_id'];

        $watcher=mysqli_query($conn,"SELECT * FROM mycart WHERE buyer_ID!=$myid");
        $counter=mysqli_num_rows($watcher);

        if($counter<=0){

            $qrysave = "UPDATE `mycart` SET qty='$quantity' WHERE id = '$proid'";
            $result=@mysqli_query($conn, $qrysave);
            if ($result){
                header("Location: shoping-cart.php");
            }else{
            
                die("Query Failed!");
            }
            
            }else{
                $qrysave = "UPDATE `mycart` SET qty='$quantity' WHERE id = '$proid'";
                $result=@mysqli_query($conn, $qrysave);
                header("Location: shoping-cart.php");
        }

    }
?>