<?php
    session_start();
    include 'db.php';
    if (!isset($_SESSION['login_me']) || trim($_SESSION['login_me'] == '')) {
        header("Location: login.php");
        die();
    }

    $me=$_GET['aid'];
    $myid=$_SESSION['login_me'];
    $qrycheck=mysqli_query($conn,"SELECT * FROM mycart WHERE buyer_ID='$myid'");
    $countercheck=mysqli_num_rows($qrycheck);


    if ($countercheck>=1){
        $data=mysqli_fetch_array($qrycheck);
        
        header("location: shoping-cart.php?on=$data[orderNo]");
        exit();
    }else{
        
        header("location: shoping-cart.php?on=XX");
        exit();

    }


?>