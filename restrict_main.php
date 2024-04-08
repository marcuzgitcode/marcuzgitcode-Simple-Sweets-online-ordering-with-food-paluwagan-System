<?php
    session_start();
    include 'db.php';
	
    $on=$_GET['on'];
    if (mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM customer WHERE identification='' AND customer_ID='$on'"))){
        $_SESSION['status']="Please upload identification first.!";
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
    

?>