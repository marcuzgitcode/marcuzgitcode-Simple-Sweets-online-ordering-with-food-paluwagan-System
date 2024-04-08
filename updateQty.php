<?php

require('db.php');
// $myid=$_SESSION['SEESSMYID'];

if (isset($_POST['scope'])) {
  $qty = $_POST['quantity'];
  $pid = $_POST['prod_id'];

  $chk_existing_cart = "SELECT * FROM `mycart` WHERE id='$pid'";
  $chk_existing_cart_run = mysqli_query($conn,$chk_existing_cart);

  if(mysqli_num_rows($chk_existing_cart_run) > 0)
    {
      $update_query = "UPDATE `mycart` SET qty = '$qty' WHERE id = '$pid'";
      $update_query_run = mysqli_query($conn,$update_query);
      
    }else{
      echo "Something went wrong";
    }
}

?>