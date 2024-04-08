<?php
    include 'db.php';
    if (!isset($_SESSION['login_me']) || trim($_SESSION['login_me'] == '')) {
        header("Location: login.php");
        die();
    }

    $myid=	$_SESSION['login_me'];
    $me=$_GET['aid'];
    $qrycheck=mysqli_query($conn,"SELECT * FROM mycart WHERE buyer_ID='$myid' AND menu_ID='$me'");
    $countercheck=mysqli_num_rows($qrycheck);

    if ($countercheck>=1){
        $data=mysqli_fetch_array($qrycheck);
        // $squery = ("UPDATE mycart SET qty = qty + 1 WHERE menu_ID='$me'");
        // $result = $mysqli->query($query);
        header("location: shoping-cart.php?on=$data[orderNo]");
        exit();
    }else{
            
    }

?>