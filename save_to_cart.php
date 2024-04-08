<?php
session_start();
require ('db.php');

$myid=$_SESSION['login_me'];
if(!isset($_SESSION['login_me']) || trim($_SESSION['login_me']=="")){
    header("location: login.php");
    exit();
}

if(isset($_POST['add_to_cart']))
{
    $qrycheck=mysqli_query($conn,"SELECT * FROM `mycart` WHERE buyer_ID='$myid'");
    $select_cart=mysqli_num_rows($qrycheck);
    if($select_cart >=1){
        $getter=mysqli_fetch_array($qrycheck);
        $karon=date_default_timezone_set('Asia/Manila'); 
        $petsa=date("Y-m-d");
        $myorderno=$getter['orderNo'];
        $menu = $_POST['code'];
        $price = $_POST['price'];
        $quantity = $_POST['num-product'];
        $insert_product = "INSERT INTO `mycart`(orderNo, menu_ID, buyer_ID, price, qty, menu_iden, date_entry) 
        VALUES('$myorderno', '$menu','$myid','$price','$quantity','g','$petsa')";
        $result=mysqli_query($conn, $insert_product);
        if($result){
            header("location: shoping-cart.php?on=$myorderno");
            exit();
    
        }else{
            echo "Error";
        }
    }else{
        $karon=date_default_timezone_set('Asia/Manila'); 
        $petsa=date("Y-m-d");
        $myorderno=rand()."00".$petsa."ZS".$myid;
        $menu = $_POST['code'];
        $price = $_POST['price'];
        $quantity = $_POST['num-product'];
        $insert_product = "INSERT INTO `mycart`(orderNo, menu_ID, buyer_ID, price, qty, menu_iden, date_entry) 
        VALUES('$myorderno', '$menu','$myid','$price','$quantity','g', '$petsa')";
        $result=mysqli_query($conn, $insert_product);
        if($result){
            header("Location: shoping-cart.php?on=$myorderno");
            exit();
        }else{
            echo "Error";
        }
    }
}
?>