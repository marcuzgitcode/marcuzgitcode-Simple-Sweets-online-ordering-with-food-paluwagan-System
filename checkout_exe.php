<?php
    session_start();
    require('db.php');

    $myid=$_SESSION['login_me'];
    if (isset($_POST['placeorder'])){
    $code = $_POST['code'];
    $date_pickup = $_POST['date_pick_up'];
    $time_pickup = $_POST['time_pick_up'];
    $karon = date_default_timezone_set("Asia/Manila");
    $petsa = date("Y-m-d");
    $time = date("H:i:s");

    $cusid=mysqli_query($conn,"SELECT * FROM customer WHERE id='$myid'");
    $cusid_run=mysqli_fetch_array($cusid);
    $customer = $cusid_run['customer_ID'];

    $iden=mysqli_query($conn,"SELECT * FROM mycart WHERE orderNo='$code'");
    while($row=mysqli_fetch_array($iden)){

        $p_identify=$row['menu_iden'];
        $i_code=$row['menu_ID'];
        $mc_price=$row['price'];
        $e=$row['qty'];	
        $total = $row['price'] * $row['qty'];

        if($p_identify=='a'){

            $savinga=mysqli_query($conn,"SELECT * FROM  menu WHERE menu_ID='$i_code'");
            $row1=mysqli_fetch_array($savinga);
            $g=$row['menu_ID'];
            $c=($mc_price);
            $f=$total;
            $a=$code;
            $h="pending";
            $dte=$date_pickup;
            $dtm=$time_pickup;
        
            $qrysavethis=mysqli_query($conn,"INSERT INTO orders (menu_ID, price, qty, total_price, order_ID, status, customer_ID, date_pickup, time_pickup, terms_condition, date_entry) 
            VALUES ('$g', '$c', '$e', '$f', '$a', '$h', '$customer', '$dte', '$dtm', '1', '$petsa')");

        }else{
            
            $savinglass=mysqli_query($conn,"SELECT * FROM  menu WHERE  menu_ID='$i_code'");
            $row2=mysqli_fetch_array($savinglass);
                
            $a=$code;
            $c=($mc_price);
            $f=$total;
            $g=$row['menu_ID'];
            $h="pending";
            $dte=$date_pickup;
            $dtm=$time_pickup;
        
            $qrysavethis=mysqli_query($conn,"INSERT INTO orders (menu_ID, price, qty, total_price, order_ID, status, customer_ID, date_pickup, time_pickup, terms_condition, date_entry) 
            VALUES ('$g','$c','$e','$f','$a','$h','$customer','$dte', '$dtm', '1', '$petsa')");
        
        }
    }

    $qrydel="DELETE FROM mycart WHERE orderNo='$code' ";
    $result1=mysqli_query($conn,$qrydel);
    if($result1){

        header("location: thankyou.php");
        exit();
    }else{die("failed :( ");}

    }
?>
