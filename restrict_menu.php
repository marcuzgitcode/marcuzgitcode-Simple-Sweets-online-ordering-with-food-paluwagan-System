<?php
    session_start();
    include 'db.php';

    $on=$_GET['on'];
    if (mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM customer WHERE identification='' AND customer_ID='$on'"))){
        $_SESSION['status']="Please upload identification first and wait for the approval from the admin.";
        $_SESSION['status_code']="warning";
        header("location: myaccount.php");
        exit();
    }

    if (mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM customer WHERE address='' AND customer_ID='$on'"))){
        $_SESSION['status']="Please tell me specifically where you live.!";
        $_SESSION['status_code']="warning";
        header("location: myaccount.php");
        exit();
    }
    
    date_default_timezone_set('Asia/Manila');
	$petsa=date("Y-m-d");
	
// 	$oneMonthLater = date('Y-m-d', strtotime('-1 month'));
//     if (mysqli_fetch_array(mysqli_query($conn, "SELECT expiry_date FROM customer_identification WHERE expiry_date != $petsa AND customer_ID='$on'"))){
//         $_SESSION['status']="Your ID is expired, please upload a new ID.!";
//         $_SESSION['status_code']="warning";
//         header("location: myaccount.php");
//         exit();
//     }
    
    if (mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM customer WHERE status = 0 AND customer_ID='$on'"))){
        $_SESSION['status']="Your account has not been approved yet, or perhaps it has been frozen by the admin for some reason.";
        $_SESSION['status_code']="warning";
        header("location: checkout.php?on=$on");
        exit();
    }

?>